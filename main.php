<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animalover</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="script.js" defer></script>
</head>
<?php
require_once 'connection.php'; 

try {
    $pdo = animalover::connect();
    $stmt = $pdo->query("SELECT Img, ShelterName, City FROM shelters WHERE Img IS NOT NULL");
    $shelterImages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Nie można pobrać obrazów: " . $e->getMessage());
}
?>

<body>
    <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='https://img.freepik.com/darmowe-wektory/recznie-rysowane-ilustracja-sylwetki-zwierzat_23-2149550558.jpg?w=740&t=st=1708463083~exp=1708463683~hmac=6eaa0b8d1df80f5ff011b39cfaed090d1724187045525108da2ce70945182e28'/></a></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li><a href="">Home</a></li>
                <li><a href="">Animals</a></li>
                <li><a href="">Shelters</a></li>
                <li><a href="">About us</a></li>
                <li><a href="">Contact</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
    </header>
    
    <div class="content">
    <br><br><br>
    <div class="container">
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
          <
        </button>
        <ul class="image-list">
            <?php foreach ($shelterImages as $image): ?>
            <li class="image-item-wrapper">
                
                
                <img class="image-item" src="<?= htmlspecialchars($image['Img']) ?>" alt="Schronisko" />
                <div class="image-overlay"><?= htmlspecialchars($image['ShelterName']) ?>, <?= htmlspecialchars($image['City']) ?></div>
            </li>
            <?php endforeach; ?>
        </ul>
          
  
        <button id="next-slide" class="slide-button material-symbols-rounded">
          >
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
    </div>

    </div>

</body>

</html>

