<?php
require_once 'connection.php'; // Załącz plik połączenia z bazą danych

// Pobierz ID zwierzaka z parametru GET
$animalId = isset($_GET['id']) ? $_GET['id'] : null;

$animal = null;
if ($animalId) {
    // Pobierz dane zwierzaka do edycji
    $stmt = animalover::connect()->prepare("SELECT * FROM animals WHERE ID = :id");
    $stmt->execute([':id' => $animalId]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obsługa żądania POST do aktualizacji danych zwierzaka
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $animalId) {
    // Tutaj pobierasz dane z formularza
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $sex = $_POST['sex'];
    // Dodaj więcej pól z formularza zgodnie z Twoją strukturą tabeli

    // Zapytanie aktualizujące dane zwierzaka
    $stmt = animalover::connect()->prepare("UPDATE animals SET Name = :name, Species = :species, Breed = :breed, Sex = :sex WHERE ID = :id");
    $stmt->execute([
        ':name' => $name,
        ':species' => $species,
        ':breed' => $breed,
        ':sex' => $sex,
        ':id' => $animalId
    ]);

    // Przekierowanie do listy zwierząt po aktualizacji
    header('Location: list_animals.php');
    exit();
}

if (!$animal) {
    echo "Zwierzę nie zostało znalezione.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Zwierzę</title>
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
    <h2>Edytuj Zwierzę</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($animal['Name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="race">Rasa</label>
            <input type="text" class="form-control" id="race" name="race" value="<?= htmlspecialchars($animal['Race']) ?>" required>
        </div>
        <div class="form-group">
            <label for="species">Gatunek</label>
            <input type="text" class="form-control" id="species" name="species" value="<?= htmlspecialchars($animal['Species']) ?>" required>
        </div>
        <div class="form-group">
            <label for="sex">Płeć</label>
            <select class="form-control" id="sex" name="sex" required>
                <option value="M" <?= $animal['Sex'] == 'M' ? 'selected' : '' ?>>Męska</option>
                <option value="F" <?= $animal['Sex'] == 'F' ? 'selected' : '' ?>>Żeńska</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image-path">Scieżka do pliku img ze zdjęciem zwierzaka</label>
            <input type="image-path" class="form-control" id="image-path" name="image-path" value="<?= htmlspecialchars($animal['Img']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Zaktualizuj</button>
    </form>
</div>

</body>
</html>
