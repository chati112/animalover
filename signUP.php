<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./signUp.css">

    <title>Sign UP</title>
  </head>
  <body>
  <?php
    require('./connection.php');

    $info = ""; 

    if (isset($_POST['signUP_button'])) {
        
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confPassword = $_POST['confiPassword'];
        $birthDate = $_POST['birthDate'];

       if (!empty($name) && !empty($lastName) && !empty($email) && !empty($password) && !empty($birthDate)) {
            if ($password == $confPassword) {
                // Sprawdzenie, czy email jest już zajęty
                $checkEmail = animalover::connect()->prepare('SELECT Email FROM users WHERE Email = :e');
                $checkEmail->bindValue(':e', $email);
                $checkEmail->execute();

                if ($checkEmail->rowCount() > 0) {
                    $info = "Email already in use. ";
                } else {
                    if (new DateTime($birthDate) > new DateTime()) {
                        $info = "Birth date cannot be in the future!";
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        // zapisywanie danych użytkownika z zahashowanym hasłem do bazy
                        $p = animalover::connect()->prepare('INSERT INTO users(FirstName, LastName, Email, Password, DateOfBirth) VALUES(:n, :l, :e, :p, :b)');
                        $p->bindValue(':n', $name);
                        $p->bindValue(':l', $lastName);
                        $p->bindValue(':e', $email);
                        $p->bindValue(':p', $hashedPassword); 
                        $p->bindValue(':b', $birthDate);
                        $p->execute();
                        $info = 'User added successfully!';
                    }
                }
            } else {
                $info = 'Password does not match!';
            }
        }
    }
?>

    <div class="container">
      
      <div class="form">
          <div class="title">
              <p id="title" >Sign Up</p>
          </div>
          <form action="" method="post">
              <input type="text" name="name" placeholder="Name">
              <input type="text" name="lastName" placeholder="Last name">
              <input type="date" name="birthDate" placeholder="Birth date">
              <input type="email" name="email" placeholder="Email">
              <input type="password" name="password" placeholder="Password">
              <input type="password" name="confiPassword" placeholder="Confrim password">
              
              <input type="submit" value="Sign Up" name="signUP_button"> 
              <a href="./login.php">Do you have account? Sign in</a> <br>
              <a id="info" style="color: red;"><?php echo $info; ?></a>
          </form>
      </div>

    </div>
  </body>
</html>
