<?php
require_once 'connection.php'; 

if (isset($_GET['id'])) {
    $adoptionId = $_GET['id'];

    try {
        $pdo = animalover::connect();
        $stmt = $pdo->prepare("DELETE FROM adoptions WHERE ID = :id");
        $stmt->bindValue(':id', $adoptionId, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: list_adoptions.php');
        exit();
    } catch (PDOException $e) {
        die("Nie można usunąć adopcji: " . $e->getMessage());
    }
} else {
    header('Location: list_adoptions.php');
    exit();
}
?>
