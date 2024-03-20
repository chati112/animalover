<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./signUp.css">
    <title>Sign in</title>
    <style>
        .title{
        transform: translate(80px,25px);
        }
        a{
        position: relative;
        left: 50px;
        top: -15px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        
        }

        .form{
            width:230px;
            height:230px;
        }

        .form input[type="submit"]{
        background: #53747d;
        width: 77%;
        border-radius: 2px;
        color: rgb(255, 255, 255);
        border: none;
        font-size: 17px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-weight: 600;
        margin-top: -45px;
        }

    </style>
  </head>
  <body>
  <?php
      session_start();
      $info = "";
      require('connection.php');
      if (isset($_POST['login_button'])) {
          $_SESSION['validate'] = false;
          $email = $_POST['email'];
          $password = $_POST['password'];
          $p = animalover::connect()->prepare('SELECT * FROM users WHERE Email = :e');
          $p->bindValue(':e', $email);
          $p->execute();
          $user = $p->fetch(PDO::FETCH_ASSOC);

          if ($user && password_verify($password, $user['Password'])) {
              $_SESSION['email'] = $email;
              $_SESSION['validate'] = true;
              $_SESSION['user_id'] = $user['ID']; // Zapisz ID użytkownika w sesji
              $_SESSION['is_admin'] = $user['Admin']; // Zapisz informację, czy użytkownik jest adminem
              echo "Próbuję przekierować...";
                if ($user['Admin']) {
                  
                  header('Location: admin-view.php');
                  exit();
              } else {
                  // Użytkownik nie jest adminem, przekieruj do profilu
                  header('Location: profile.php');
                  exit();
              }
          } else {
              $info = "Account not found :(";
          }
      }
  ?>


    <div class="container">
      
      <div class="form">
          <div class="title">
            <p id="title">Sign In</p>
          </div>
          <form action="" method="post">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password"><br><br>
            <a href="./signUP.php" style="position:relative; left:50px;top:-8px; font-size:14px">Click here to sign up</a><br><br>
            <a id="info" style="color: red;"><?php echo $info; ?></a>
            <input type="submit" value="Login" name="login_button"> 
            
        </form>
      </div>

    </div>
  </body>
</html>