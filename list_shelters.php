<?php
require_once 'connection.php'; 

$shelters = animalover::SelectShelters(); 

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

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista Schronisk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script>
    function deleteShelter(shelterId) {
        if (confirm('Czy na pewno chcesz usunąć to schronisko?')) {
            window.location.href = 'delete_shelter.php?id=' + shelterId;
        }
    }
    </script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                        <a class="nav-link" href="admin-view.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_animals.php">Lista Zwierząt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Lista Schronisk <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_users.php">Użytkownicy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_walks.php">Spacery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_adoptions.php">Adopcje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_virtualadoptions.php">Wirtualne adopcje</a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Lista Schronisk</h1>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa Schroniska</th>
                        <th>Lokalizacja</th>
                        <th>Telefon</th>
                        <th>Miasto</th>
                        <th>Opis</th>
                        <th>Zdjęcie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shelters as $shelter): ?>
                    <tr>
                        <td><?= htmlspecialchars($shelter['ID']) ?></td>
                        <td><?= htmlspecialchars($shelter['ShelterName']) ?></td>
                        <td><?= htmlspecialchars($shelter['Location']) ?></td>
                        <td><?= htmlspecialchars($shelter['Phone']) ?></td>
                        <td><?= htmlspecialchars($shelter['City']) ?></td>
                        <td><?= htmlspecialchars($shelter['Description']) ?></td>
                        <td><img src="<?= htmlspecialchars($shelter['Img']) ?>" height="100"></td>
                        <td><a href="edit_shelter.php?id=<?= $shelter['ID'] ?>" class="btn btn-primary btn-sm">Edytuj</a></td>
                        <td><button onclick="deleteShelter(<?= $shelter['ID'] ?>)" class="btn btn-danger btn-sm">Usuń</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

</body>
</html>
