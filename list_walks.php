<?php
require_once 'connection.php'; 

$walks = animalover::SelectWalks(); 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista Spacerów</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script>
    function deleteWalk(walkId) {
        if (confirm('Czy na pewno chcesz usunąć tego użytkownika i wszystkie rekordy(również te w innych tabelach) z nim związane ?')) {
            window.location.href = 'delete_walk.php?id=' + walkId;
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
                        <a class="nav-link" href="list_animals.php">Lista Zwierząt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_shelters.php">Lista Schronisk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_users.php">Użytkownicy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#" >Spacery<span class="sr-only">(current)</span></a>
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
                <h1 class="h2">Lista spacerów</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-sm btn-outline-secondary" onclick="location.href='logout.php'">Wyloguj</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data Spaceru</th>
                        <th>Użytkownik</th>
                        <th>Zwierzak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($walks as $walk): ?>
                    <tr>
                    <td><?= htmlspecialchars($walk['ID']) ?></td>
                    <td><?= htmlspecialchars($walk['DateOfWalk']) ?></td>
                    <td><?= htmlspecialchars($walk['UserName']) ?></td> 
                    <td><?= htmlspecialchars($walk['AnimalName']) ?></td>
                    <td><a href="edit_walk.php?id=<?= $walk['ID'] ?>" class="btn btn-primary btn-sm">Edytuj</a></td>
                    <td><button onclick="deleteWalk(<?= $walk['ID'] ?>)" class="btn btn-danger btn-sm">Usuń</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

</body>
</html>
