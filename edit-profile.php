<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Profil</title>
   
</head>
<style> 
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

form div {
    margin-bottom: 15px;
}

label, p {
    margin-bottom: 5px;
    color: #333;
    font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="email"],
input[type="password"] {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #0056b3;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #004494;
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
    $newEmail = $_POST['newEmail'];
    $password = $_POST['password'];

    
    $query = animalover::connect()->prepare('SELECT Password FROM users WHERE Email = :e');
    $query->bindValue(':e', $currentEmail);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    
    if (password_verify($password, $user['Password'])) {
        
        $updateQuery = animalover::connect()->prepare('UPDATE users SET FirstName = :firstName, LastName = :lastName, DateOfBirth = :birthDate, Email = :newEmail WHERE Email = :currentEmail');
        $updateQuery->bindValue(':firstName', $firstName);
        $updateQuery->bindValue(':lastName', $lastName);
        $updateQuery->bindValue(':birthDate', $birthDate);
        $updateQuery->bindValue(':newEmail', $newEmail);
        $updateQuery->bindValue(':currentEmail', $currentEmail);
        $updateQuery->execute();

        // Aktualizacja e-maila w sesji
        $_SESSION['email'] = $newEmail;

        echo "<script>alert('Dane zostały zaktualizowane.'); window.location.href='profile.php';</script>";
        exit();
    } else {
        echo "Błędne hasło.";
    }
}
?>
    


    <div class="container">
        <h1>Edytuj Profil</h1>
        <form action="edit-profile.php" method="post">
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
            <br><input type="submit" value="Save changes">
        </form>
    </div>
</body>
</html>
