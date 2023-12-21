<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Profil</title>
    <!-- Link do arkusza CSS -->
</head>
<style> 
*{
    text-align:center;
    align-items:center;
}
</style>
<body>
<?php
session_start();
require('./connection.php');

if (!isset($_SESSION['validate']) || !$_SESSION['validate']) {
    header('location:login.php');
    exit();
}

$currentEmail = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthDate = $_POST['birthDate'];
    $newEmail = $_POST['email'];
    $password = $_POST['password'];

    // Pobierz aktualne hasło użytkownika z bazy danych
    $query = animalover::connect()->prepare('SELECT Password FROM users WHERE Email = :e');
    $query->bindValue(':e', $currentEmail);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Sprawdź czy podane hasło jest poprawne
    if (password_verify($password, $user['Password'])) {
        // Aktualizacja danych użytkownika
        $updateQuery = animalover::connect()->prepare('UPDATE users SET FirstName = :firstName, LastName = :lastName, BirthDate = :birthDate, Email = :newEmail WHERE Email = :currentEmail');
        $updateQuery->bindValue(':firstName', $firstName);
        $updateQuery->bindValue(':lastName', $lastName);
        $updateQuery->bindValue(':birthDate', $birthDate);
        $updateQuery->bindValue(':newEmail', $newEmail);
        $updateQuery->bindValue(':currentEmail', $currentEmail);
        $updateQuery->execute();

        // Aktualizacja e-maila w sesji
        $_SESSION['email'] = $newEmail;

        echo "Dane zostały zaktualizowane.";
    } else {
        echo "Błędne hasło.";
    }
}
?>



    <div class="container">
        <h1>Edytuj Profil</h1>
        <form action="edit_profile.php" method="post">
            <div>
                <p for="firstName">First name:</p>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div>
                <p for="lastName">Last name:</p>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div>
                <p>Date of birth:</p>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>
            <div>
                <p for="email">Email:</p>
                <input type="email" id="newEmail" name="newEmail" required>
            </div>
            <div>
                <p for="password">Confirm password:</p>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Save changes">
        </form>
    </div>
</body>
</html>
