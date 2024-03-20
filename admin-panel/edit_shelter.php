<?php
require_once 'connection.php'; 

$shelterId = isset($_GET['id']) ? $_GET['id'] : null;

$shelter = null;
if ($shelterId) {
    
    $stmt = animalover::connect()->prepare("SELECT * FROM shelters WHERE ID = :id");
    $stmt->execute([':id' => $shelterId]);
    $shelter = $stmt->fetch(PDO::FETCH_ASSOC);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $location = $_POST['location'];
    
    $stmt = animalover::connect()->prepare("UPDATE shelters SET ShelterName = :name, Location = :location WHERE ID = :id");
    $stmt->execute([
        ':name' => $name,
        ':location' => $location,
        ':id' => $shelterId
    ]);

    header('Location: list_shelters.php');
    exit();
}

if (!$shelter) {
    echo "Schronisko nie zostało znalezione.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Schronisko</title>
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
    <h2>Edytuj Schronisko</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Nazwa Schroniska</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($shelter['ShelterName']) ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Lokalizacja</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($shelter['Location']) ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="phone" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($shelter['Phone']) ?>" required>
        </div>
        <div class="form-group">
            <label for="city">Miasto</label>
            <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($shelter['City']) ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Opis</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($shelter['Description']) ?>" required>
        </div>
        <div class="form-group">
            <label for="image-path">Scieżka do pliku img</label>
            <input type="image-path" class="form-control" id="image-path" name="image-path" value="<?= htmlspecialchars($shelter['Img']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Zaktualizuj</button>
    </form>
</div>

</body>
</html>
