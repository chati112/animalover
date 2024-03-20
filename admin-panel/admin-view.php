<?php
require_once 'connection.php'; // Dostosuj ścieżkę

// Przykładowe funkcje do pobrania statystyk
$totalAnimals = animalover::CountAnimals();
$totalUsers = animalover::CountUsers();
$totalAdoptions = animalover::CountAdoptions();
$totalWalks = animalover::CountWalks();
$totalVirtualAdoptions = animalover::CountVirtualAdoptions();
$animalCounts = animalover::CountAnimalsByCategory();
$topUsers = animalover::GetTopActiveUsers();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        <h3>Hello, Admin </h3>
                    </li>
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
                <h1 class="h2">Dashboard - Statystyki Serwisu</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-sm btn-outline-secondary" onclick="location.href='logout.php'">Wyloguj</button>
                </div>
            </div>
            
            <div class="container mt-5">
    
    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-secondary">Liczba zwierząt: <?= $totalAnimals ?></div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success">Liczba użytkowników: <?= $totalUsers ?></div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-danger">Liczba adopcji: <?= $totalAdoptions ?></div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-warning">Liczba spacerów: <?= $totalWalks ?></div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">Liczba adopcji wirtualnych: <?= $totalVirtualAdoptions ?></div><br>
        </div>
        
        <div class="col-md-6">
        <canvas id="animalsChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="adoptionsChart"></canvas><br>
        </div>
        <h2>Top 3 aktywnych użytkowników</h2>
          <table class="table">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Imię i Nazwisko</th>
                      <th>Adopcje</th>
                      <th>Spacery</th>
                      <th>Wirtualne Adopcje</th>
                      <th>Łączna liczba aktywności</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($topUsers as $user): ?>
                  <tr>
                      <td><?= htmlspecialchars($user['ID']) ?></td>
                      <td><?= htmlspecialchars($user['FirstName'] . ' ' . $user['LastName']) ?></td>
                      <td><?= htmlspecialchars($user['AdoptionsCount']) ?></td>
                      <td><?= htmlspecialchars($user['WalksCount']) ?></td>
                      <td><?= htmlspecialchars($user['VirtualAdoptionsCount']) ?></td>
                      <td><?= htmlspecialchars($user['TotalActivities']) ?></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
    </div>
  
    
    </div>
    </div>
          </main>
      </div>
</div>


</body>
<script>
    // Kontynuacja skryptu wykresu słupkowego...

    // Wykres dla liczby adopcji z procentami
    var ctxAdoptions = document.getElementById('adoptionsChart').getContext('2d');
    var adoptionsChart = new Chart(ctxAdoptions, {
        type: 'pie', // Typ wykresu: 'pie' dla kołowego
        data: {
            labels: ['Adopcje', 'Wirtualne adopcje', 'Spacery'], // Etykiety
            datasets: [{
                label: 'Adopcje',
                data: [<?= $totalAdoptions ?>, <?= $totalVirtualAdoptions ?>, <?= $totalWalks ?>], // Dane z PHP
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 255, 0, 0.2)',
                    'rgba(0, 255, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 255, 0, 0.2)',
                    'rgba(0, 255, 0, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue/total) * 100)+0.5);         
                        return data.labels[tooltipItem.index] + ": " + percentage + "%";
                    }
                }
            }
        }
    });
    var ctxAnimals = document.getElementById('animalsChart').getContext('2d');
    var animalsChart = new Chart(ctxAnimals, {
        type: 'pie',
        data: {
            labels: ['Koty', 'Psy', 'Inne'], // Etykiety dla kategorii zwierząt
            datasets: [{
                label: 'Ilość ',
                data: [
                    <?= $animalCounts['Cat'] ?? 0 ?>, 
                    <?= $animalCounts['Dog'] ?? 0 ?>, 
                    <?= $animalCounts['Other'] ?? 0 ?>
                ], // Dane dla kategorii zwierząt
                backgroundColor: [
                    'rgba(250, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(128, 128, 128, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(128, 128, 128, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                        return data.labels[tooltipItem.index] + ": " + percentage + "%";
                    }
                }
            },
            title: {
                display: true,
                text: 'Podział zwierząt według kategorii'
            }
        }
    });
</script>


</html>
