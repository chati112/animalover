<?php
require_once 'connection.php'; 

if (isset($_GET['id'])) {
    $shelterId = $_GET['id'];
    // Zapytanie SQL do usunięcia schroniska
    $stmt = animalover::connect()->prepare("DELETE FROM shelters WHERE ID = :id");
    $stmt->bindValue(':id', $shelterId);
    $stmt->execute();

    // Przekierowanie do listy schronisk po usunięciu
    header('Location: list_shelters.php');
    exit();
}
?>
