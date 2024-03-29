
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signinpage</title>
</head>
<body>
    
</body>
<div class="container">
        <h3>Signing In as Hospital</h3>
        <?php
            // echo "";
        ?>
        <form action="signin_donor.php" method="post">
            
            <input type="text" name="name" id="name" placeholder="Enter your name" autocomplete="given-name">
            <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="email">
            <input type="text" name="pwd" id="pwd" placeholder="Enter your password" autocomplete="current-password"> 
           
            <button type="submit">SignIn</button>

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

    $sql = "INSERT INTO user_donor (username, email, pwd) VALUES ('$name', '$email', ' $password');";
    echo $sql;

    if($con->query($sql)== true){
        echo "successfully inserted";
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }
    $con->close();

    


?>