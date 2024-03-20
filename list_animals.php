<?php
require_once 'connection.php'; 

$animals = animalover::SelectAnimals();
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista Zwierząt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umdplib.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function deleteAnimal(animalId) {
        if (confirm('Czy na pewno chcesz usunąć tego zwierzaka i wszystkie rekordy(również te w innych tabelach) z nim związane ?')) {
            window.location.href = 'delete_animal.php?id=' + animalId;
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
                        <img src="https://img.freepik.com/premium-wektory/biznesmen-ikona-avatar-w-stylu-plaski-kolor_755164-938.jpg?w=740" alt="admin-avatar" width="175" height="175" padding>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-view.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Lista Zwierząt <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_shelters.php">Lista Schronisk</a>
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
                <h1 class="h2">Lista zwierząt</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-sm btn-outline-secondary" onclick="location.href='logout.php'">Wyloguj</button>
                </div>
            </div>
            
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Rasa</th>
                <th>Gatunek</th>
                <th>Płeć</th>
                <th>Adopcja</th>
                <th>Adopcja Wirtualna</th>
                <th>Spacer</th>
                <th>Zdjęcie</th>
                <th>Schronisko</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animals as $animal): ?>
            <tr>
                <td><?= htmlspecialchars($animal['ID']) ?></td>
                <td><?= htmlspecialchars($animal['Name']) ?></td>
                <td><?= htmlspecialchars($animal['Race']) ?></td>
                <td><?= htmlspecialchars($animal['Species']) ?></td>
                <td><?= htmlspecialchars($animal['Sex']) ?></td>
                <td><?= htmlspecialchars($animal['Adoption']) ?></td>
                <td><?= htmlspecialchars($animal['VirtualAdoption']) ?></td>
                <td><?= htmlspecialchars($animal['Walk']) ?></td>
                <td><img src="<?= htmlspecialchars($animal['Img']) ?>" height="50"></td>
                <td><?= htmlspecialchars($animal['ShelterID']) ?></td>
                <td><a href="edit_animal.php?id=<?= $animal['ID'] ?>" class="btn btn-primary btn-sm">Edytuj</a></td>
                <td><button onclick="deleteAnimal(<?= $animal['ID'] ?>)" class="btn btn-danger btn-sm">Usuń</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </main>
    </div>
</div>
</body>
</html>

