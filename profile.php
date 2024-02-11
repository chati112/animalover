<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Użytkownika</title>
    <style>
      body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    color: #333;
}

a {
    display: inline-block;
    margin: 10px 0;
    padding: 10px 15px;
    background-color: #ff00ff; /* różowy kolor fuchsia */
    color: white;
    border-radius: 20px; /* zakrzywione rogi */
    text-decoration: none;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #e0691f; /* ciemniejszy odcień różowego */
}

h1, h2 {
    color: #0056b3; /* niebieski kolor nagłówka */
}

.container {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

/* Styl dla sekcji z informacjami */
div {
    background-color: #ffffff;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Styl dla tekstu wewnątrz sekcji */
div p {
    line-height: 1.6;
    margin: 10px 0;
}

    </style>
  </head>
  <body>

  <?php
  session_start(); // Rozpoczęcie sesji
  require('./connection.php');
  // Sprawdzanie, czy użytkownik jest zalogowany
  if (isset($_SESSION['validate']) && $_SESSION['validate']) { 
    $email = $_SESSION['email'];
    $query = animalover::connect()->prepare('SELECT * FROM users WHERE Email = :e');
    $query->bindValue(':e', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        echo "Nie znaleziono użytkownika.";
        exit;
    }
    $userID = $user['ID'];
    echo "<h1>Witaj, " . htmlspecialchars($user['FirstName']) . "!</h1>"; // Bezpieczne wyświetlenie imienia użytkownika
    // Tutaj możesz dodać więcej informacji o użytkowniku
  } else {
    // Przekierowanie do strony logowania, jeśli użytkownik nie jest zalogowany
    header('location:login.php');
    exit();
  }
?>


<a href="edit-profile.php">Edytuj Dane</a>
<a href="edit-password.php">Zmień hasło</a>
<!-- Tutaj możesz dodać sekcje wyświetlające adopcje, wirtualne adopcje i spacery -->
<div>
    <h2>Twoje Adopcje</h2>
    <?php
      
      $adoptionQuery = animalover::connect()->prepare("
      SELECT adoption.StartDate, animals.Name AS AnimalName, animals.Species
      FROM adoption
      JOIN animals ON adoption.AnimalID = animals.ID
      WHERE adoption.UserID = :userID
      ");
      
      $adoptionQuery->bindValue(':userID', $userID);
      $adoptionQuery->execute();
      $Adoptions = $adoptionQuery->fetchAll(PDO::FETCH_ASSOC);
      
      foreach ($Adoptions as $a) {
          echo "Data Rozpoczęcia: " . $a['StartDate'] . ", Zwierzę: " . $a['AnimalName'] . " (" . $a['Species'] . ")<br>";
      }
      ?>
</div>

<div>
    <h2>Twoje Wirtualne Adopcje</h2>
    <?php
      
      $virtualadoptionQuery = animalover::connect()->prepare("
      SELECT virtualadoption.StartDate, virtualadoption.BankAccountNumber, animals.Name AS AnimalName, animals.Species
      FROM virtualadoption
      JOIN animals ON virtualadoption.AnimalID = animals.ID
      WHERE virtualadoption.UserID = :userID
      ");
      
      $virtualadoptionQuery->bindValue(':userID', $userID);
      $virtualadoptionQuery->execute();
      $virtualAdoptions = $virtualadoptionQuery->fetchAll(PDO::FETCH_ASSOC);
      
      foreach ($virtualAdoptions as $va) {
          echo "Data Rozpoczęcia: " . $va['StartDate'] . ", Numer Konta: " . $va['BankAccountNumber'] . ", Zwierzę: " . $va['AnimalName'] . " (" . $va['Species'] . ")<br>";
      }
      ?>
</div>

<div>
    <h2>Twoje Spacery</h2>
    <?php
      
      $walkQuery = animalover::connect()->prepare("
          SELECT walk.DateOfWalk, animals.Name AS AnimalName, animals.Species, shelter.ShelterName
          FROM walk
          JOIN animals ON walk.AnimalID = animals.ID
          JOIN shelter ON animals.ShelterID = shelter.ID
          WHERE walk.UserID = :userID");
      
      $walkQuery->bindValue(':userID', $userID);
      $walkQuery->execute();
      $walks = $walkQuery->fetchAll(PDO::FETCH_ASSOC);
      
      foreach ($walks as $walk) {
          echo "Data spaceru: " . $walk['DateOfWalk'] . ", Zwierzę: " . $walk['AnimalName'] . " (" . $walk['Species'] . "), Schronisko: " . $walk['ShelterName'] . "<br>";
      }
      ?>
    
</div>
<a href="main.php">Strona główna</a> 
<a href="logout.php">Wyloguj się</a> 

</body>
</html>
