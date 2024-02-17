<?php
require_once 'connection.php'; // Dostosuj ścieżkę

$walks = animalover::SelectWalks(); // Zakładam, że taka funkcja istnieje
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista Spacerów</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <h1 class="h2">Lista Spacerów</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data Spaceru</th>
                        <th>ID Użytkownika</th>
                        <th>ID Zwierzęcia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($walks as $walk): ?>
                    <tr>
                        <td><?= htmlspecialchars($walk['ID']) ?></td>
                        <td><?= htmlspecialchars($walk['DateOfWalk']) ?></td>
                        <td><?= htmlspecialchars($walk['UserID']) ?></td>
                        <td><?= htmlspecialchars($walk['AnimalID']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

</body>
</html>
