<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Użytkownika</title>
    <!-- Tutaj dodaj linki do arkuszy CSS, jeśli są potrzebne -->
  </head>
  <body>
    <?php
      session_start(); // Rozpoczęcie sesji
      // Sprawdzanie, czy użytkownik jest zalogowany
      if (isset($_SESSION['validate']) && $_SESSION['validate']) {
          echo "<h1>Witaj na swoim profilu, " . $_SESSION['email'] . "!</h1>";
          // Tutaj możesz dodać więcej informacji o użytkowniku
      } else {
          // Przekierowanie do strony logowania, jeśli użytkownik nie jest zalogowany
          header('location:login.php');
          exit();
      }
    ?>

    <a href="logout.php">Wyloguj się</a> <!-- Link do skryptu wylogowującego -->
  </body>
</html>
