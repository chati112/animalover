<?php
require_once 'connection.php'; // Załącz plik połączenia z bazą danych

// Pobierz ID użytkownika z parametru GET
$userId = isset($_GET['id']) ? $_GET['id'] : null;

$user = null;
if ($userId) {
    // Pobierz dane użytkownika do edycji
    $stmt = animalover::connect()->prepare("SELECT * FROM users WHERE ID = :id");
    $stmt->execute([':id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obsługa żądania POST do aktualizacji danych użytkownika
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tutaj pobierasz dane z formularza
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    // Dodaj więcej pól z formularza zgodnie z Twoją strukturą tabeli

    // Zapytanie aktualizujące dane użytkownika
    $stmt = animalover::connect()->prepare("UPDATE users SET FirstName = :firstName, LastName = :lastName, Email = :email WHERE ID = :id");
    $stmt->execute([
        ':firstName' => $firstName,
        ':lastName' => $lastName,
        ':email' => $email,
        ':id' => $userId
    ]);

    // Przekierowanie do listy użytkowników po aktualizacji
    header('Location: list_users.php');
    exit();
}

if (!$user) {
    echo "Użytkownik nie został znaleziony.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Użytkownika</title>
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
    <h2>Edytuj Użytkownika</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="firstName">Imię</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($user['FirstName']) ?>" required>
        </div>
        <div class="form-group">
            <label for="lastName">Nazwisko</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($user['LastName']) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Birth date</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($user['DateOfBirth']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Zaktualizuj</button>
    </form>
</div>

</body>
</html>
