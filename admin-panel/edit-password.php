<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zmiana Hasła</title>
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
</head>
<body>

<div class="container">
    <h1>Zmiana Hasła</h1>
    <form action="change-password.php" method="post">
        <div>
            <label for="currentPassword">Aktualne Hasło:</label>
            <input type="password" id="currentPassword" name="currentPassword" required>
        </div>
        <div>
            <label for="newPassword">Nowe Hasło:</label>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div>
            <label for="confirmPassword">Potwierdź Nowe Hasło:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <input type="submit" value="Zmień Hasło">
    </form>
</div>

</body>
</html>
