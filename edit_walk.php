<?php
require_once 'connection.php'; 
$users = animalover::SelectUsers();
$animals = animalover::SelectAnimals();
$walkId = isset($_GET['id']) ? $_GET['id'] : null;
$walk = null;

if ($walkId) {

    $stmt = animalover::connect()->prepare("SELECT * FROM walks WHERE ID = :id");
    $stmt->execute([':id' => $walkId]);
    $walk = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $walkId) {

    $dateOfWalk = $_POST['dateOfWalk'];
    $userId = $_POST['userId'];
    $animalId = $_POST['animalId'];

    $stmt = animalover::connect()->prepare("UPDATE walks SET DateOfWalk = :dateOfWalk, UserID = :userId, AnimalID = :animalId WHERE ID = :id");
    $stmt->execute([
        ':dateOfWalk' => $dateOfWalk,
        ':userId' => $userId,
        ':animalId' => $animalId,
        ':id' => $walkId
    ]);

    header('Location: list_walks.php');
    exit();
}

if (!$walk) {
    echo "Spacer nie został znaleziony.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Spacer</title>
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

    <h2>Edytuj Spacer</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="dateOfWalk">Data Spaceru</label>
            <input type="date" class="form-control" id="dateOfWalk" name="dateOfWalk" value="<?= htmlspecialchars($walk['DateOfWalk']) ?>" required>
        </div>
        <div class="form-group">
    <label for="userId">Użytkownik</label>
    <select class="form-control" id="userId" name="userId" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['ID'] ?>" <?= $user['ID'] == $walk['UserID'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($user['FirstName']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    </div>
    <div class="form-group">
        <label for="animalId">Zwierzę</label>
        <select class="form-control" id="animalId" name="animalId" required>
            <?php foreach ($animals as $animal): ?>
                <option value="<?= $animal['ID'] ?>" <?= $animal['ID'] == $walk['AnimalID'] ? 'selected' : '' ?>>
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
