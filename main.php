<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animalover</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

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
                <li><a href="">Login</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
    </header>
    
    

    <section class="home">

      <div class="swiper home-slider">

        <div class="swiper-wrapper">

          <div class="swiper-slide slide">
            <div class="content">
              <span>Adopt online</span>
              <h3>Any animal</h3>
              <a href="" class="btn">Find your pet</a>
            </div>
            <div class="image">
              <img src="https://img.freepik.com/darmowe-zdjecie/sliczny-golden-retriever_144627-26661.jpg?t=st=1708714065~exp=1708717665~hmac=2119fe096af475f6d9abea0c49ada8d26fc3c37344602a98880f34508c8b6db5&w=996" alt="">
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="content">
                <span>Adopt online</span>
                <h3>Plenty of shelters</h3>
                <a href="" class="btn">See all </a>
            </div>
            <div class="image">
              <img src="https://img.freepik.com/darmowe-zdjecie/osoba-siegajaca-po-psy-przez-plot-przy-schronisku_23-2148682945.jpg?t=st=1708716712~exp=1708720312~hmac=914968dda0783cf87ea0771597b488edfc6c94cfb8bee970e4fa3b4e27aa6ed3&w=1060" alt="">
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="content">
              <span>About us</span>
              <h3>In love with animals</h3>
              <a href="" class="btn">Read more ...</a>
            </div>
            <div class="image">
              <img src="https://img.freepik.com/darmowe-zdjecie/zblizenie-dloni-pieszczoty-buzke_23-2148699706.jpg?t=st=1708713942~exp=1708717542~hmac=722655423b41834fd1d9a7173c29cd6aed66a4f275c686bc688fa897c12aaf2a&w=996" alt="">
            </div>
          </div>

        </div>

          <div class="swiper-pagination"></div>

      </div>
      
    </section>
      
   
    <div class="container">
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
          <
        </button>
        <ul class="image-list">
            <?php foreach ($shelterImages as $image): ?>
            <li class="image-item-wrapper">
                <img class="image-item" src="<?= htmlspecialchars($image['Img']) ?>" alt="Schronisko" />
                <div class="image-overlay">"<?= htmlspecialchars($image['ShelterName']) ?>", <?= htmlspecialchars($image['City']) ?></div>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>          
    <script>
      var swiper = new Swiper (".home-slider", {
        effect: "slide",
        loop: true,
        grabCursor: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    </script>
</body>

</html>

