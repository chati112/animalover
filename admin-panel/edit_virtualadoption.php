<?php
require_once 'connection.php'; 

$virtualadoptionId = isset($_GET['id']) ? $_GET['id'] : null;
$users = animalover::SelectUsers();
$animals = animalover::SelectAnimals();
$virtualadoption = null;
if ($virtualadoptionId) {

    $stmt = animalover::connect()->prepare("SELECT * FROM virtualadoptions WHERE ID = :id");
    $stmt->execute([':id' => $virtualadoptionId]);
    $virtualadoption = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obsługa żądania POST do aktualizacji danych adopcji
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $virtualadoptionId) {
    // Tutaj pobierasz dane z formularza
    $startDate = $_POST['startDate'];
    $userId = $_POST['userId'];
    $animalId = $_POST['animalId'];

    // Zapytanie aktualizujące dane adopcji
    $stmt = animalover::connect()->prepare("UPDATE virtualadoptions SET StartDate = :startDate, UserID = :userId, AnimalID = :animalId WHERE ID = :id");
    $stmt->execute([
        ':startDate' => $startDate,
        ':userId' => $userId,
        ':animalId' => $animalId,
        ':id' => $virtualadoptionId
    ]);

    // Przekierowanie do listy adopcji po aktualizacji
    header('Location: list_virtualadoptions.php');
    exit();
}

if (!$virtualadoption) {
    echo "Adopcja nie została znaleziona.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj wirtualną adopcję</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px; 
            margin: 5vw auto; 
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edytuj wirtualną adopcję</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="startDate">Data Rozpoczęcia</label>
            <input type="date" class="form-control" id="startDate" name="startDate" value="<?= htmlspecialchars($virtualadoption['StartDate']) ?>" required>
        </div>
        <div class="form-group">
            <label for="userId">Użytkownik</label>
            <select class="form-control" id="userId" name="userId" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['ID'] ?>" <?= $user['ID'] == $virtualadoption['UserID'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($user['FirstName']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
    <div class="form-group">
        <label for="animalId">Zwierzę</label>
        <select class="form-control" id="animalId" name="animalId" required>
            <?php foreach ($animals as $animal): ?>
                <option value="<?= $animal['ID'] ?>" <?= $animal['ID'] == $virtualadoption['AnimalID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($animal['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Zaktualizuj</button>
    </form>
</div>

</body>
</html>
