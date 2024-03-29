
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginpage</title>
</head>
<body>
    
</body>
<div class="container">
        <h3>Loging In as Donor</h3>
        <?php
            // echo "";
        ?>
        <form action="login.php" method="post">
            
            <input type="text" name="name" id="name" placeholder="Enter your name" autocomplete="given-name">
            <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="email">
            <input type="text" name="pwd" id="pwd" placeholder="Enter your password" autocomplete="current-password"> 
            
            <button type="submit">LogIn</button>

   
        </form>

    </div>
</html>
<?php
   // Include the database configuration
    include 'db_config.php';

    $name = $_POST['name'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];

    //validation for username
    if (empty($username)) {
        $usernameError = "Username is required.";
    }
     // Validate password
     if (empty($password)) {
        $passwordError = "Password is required.";
    }

    $sql = " SELECT * FROM `user_donor` WHERE username=' $name' and pwd='$password' and email='$email'";
    echo $sql;

    if($con->query($sql)== true){
        echo "Login successfull";
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }
    $con->close();

    


?>