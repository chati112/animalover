<?php
require_once 'connection.php';
if (isset($_GET['id'])) {
    $animalId = $_GET['id'];

    $stmt = animalover::connect()->prepare("DELETE FROM animals WHERE ID = :id");
    $stmt->bindValue(':id', $animalId);
    $stmt->execute();

    header('Location: list_animals.php');
    exit();
} else {
   
    header('Location: list_animals.php');
    exit();
}
?>