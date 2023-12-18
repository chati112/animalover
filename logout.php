<?php
session_start();
session_unset(); // Usuwa wszystkie zmienne sesji
session_destroy(); // Niszczy sesję
header('location:login.php'); // Przekierowuje do strony logowania
exit();
?>
