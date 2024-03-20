<?php
require_once 'connection.php'; 

$virtualadoptions = animalover::SelectVirtualAdoptions(); 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista Adopcji Wirtualnych</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umdplib.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function deleteVirtualadoption(virtualadoptionId) {
        if (confirm('Czy na pewno chcesz usunąć to schronisko i wszystkie rekordy(również te w innych tabelach) z nim związane?')) {
            window.location.href = 'delete_virtualadoption.php?id=' + virtualadoptionId;
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
                        <a class="nav-link" href="admin-view.php">Dashboard </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_animals.php">Lista Zwierząt</a>
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
                        <a class="nav-link active" href="list_virtualadoptions.php">Wirtualne adopcje<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Lista adopcji wirtualnych</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-sm btn-outline-secondary" onclick="location.href='logout.php'">Wyloguj</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data Rozpoczęcia</th>
                        <th>Numer Konta Bankowego</th>
                        <th>ID Użytkownika</th>
                        <th>ID Zwierzęcia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($virtualadoptions as $virtualadoption): ?>
                    <tr>
                        <td><?= htmlspecialchars($virtualadoption['ID']) ?></td>
                        <td><?= htmlspecialchars($virtualadoption['StartDate']) ?></td>
                        <td><?= htmlspecialchars($virtualadoption['BankAccountNumber']) ?></td>
                        <td><?= htmlspecialchars($virtualadoption['UserID']) ?></td>
                        <td><?= htmlspecialchars($virtualadoption['AnimalID']) ?></td>
                        <td><a href="edit_virtualadoption.php?id=<?= $virtualadoption['ID'] ?>" class="btn btn-primary btn-sm">Edytuj</a></td>
                        <td><button onclick="deleteVirtualadoption(<?= $virtualadoption['ID'] ?>)" class="btn btn-danger btn-sm">Usuń</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

</body>
</html>
