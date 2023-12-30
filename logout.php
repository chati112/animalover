<?php
session_start();
session_unset(); 
session_destroy(); 
header('location:login.php'); // Przekierowuje do strony logowania
exit();
?>
