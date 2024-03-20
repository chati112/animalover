<?php
require_once 'connection.php'; 

if (isset($_GET['id'])) {
    $walkId = $_GET['id'];

    try {
        $pdo = animalover::connect();
        $stmt = $pdo->prepare("DELETE FROM walks WHERE ID = :id");
        $stmt->bindValue(':id', $walkId, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: list_walks.php');
    } catch (PDOException $e) {
        die("Nie można usunąć spaceru: " . $e->getMessage());
    }
} else {

    header('Location: list_walks.php');
}
?>
