<?php
require_once 'connection.php'; 

if (isset($_GET['id'])) {
    $virtualadoptionId = $_GET['id'];

    try {
        $pdo = animalover::connect();
        $stmt = $pdo->prepare("DELETE FROM virtualadoptions WHERE ID = :id");
        $stmt->bindValue(':id', $virtualadoptionId, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: list_adoptions.php');
        exit();
    } catch (PDOException $e) {
        die("Nie można usunąć adopcji: " . $e->getMessage());
    }
} else {
    header('Location: list_virtualadoptions.php');
    exit();
}
?>
