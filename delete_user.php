<?php
require_once 'connection.php'; 

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = animalover::connect()->prepare("DELETE FROM users WHERE ID = :id");
    $stmt->bindValue(':id', $userId);
    $stmt->execute();

    header('Location: list_users.php');
    exit();
} else {
   
    header('Location: list_users.php');
    exit();
}
?>
