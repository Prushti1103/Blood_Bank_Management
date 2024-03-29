
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/adminlogin.css">  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
   
     
</head>
<body>

<div class="container">
    <h3>Login as admin</h3>
    <form action="admin_login.php" method="post">
        
        <input type="text" name="name" id="name" placeholder="Enter your name" autocomplete="given-name"><br>
        <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="email"><br>
        <input type="password" name="pwd" id="pwd" placeholder="Enter your password" autocomplete="current-password"><br>
        
        <button type="submit">Log In</button>
    </form>
</div>
</html>
<?php
// Include the database configuration
include 'db_config.php';
include 'authentication.php';


// Define validation variables
$nameError = $passwordError = $emailError = '';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];

    // Validation for name
    if (empty($name)) {
        $nameError = "Name is required.";
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    // Validate email
    if (empty($email)) {
        $emailError = "Email is required.";
    }

    // Check if there are no validation errors
    if (empty($nameError) && empty($passwordError) && empty($emailError)) {
        $sql = "SELECT * FROM `user_admin` WHERE username='$name' AND pwd='$password' AND email='$email'";
       

        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result))
        {
            $row=$result->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];  
            header("Location: admin_dashboard.php");
          
        }
        else{
            
            echo "<script>  alert('Admin Does Not Exist')  </script>";
        }
        // if ($conn->query($sql) == true) {
        //     echo "Login successful";
        // } else {
        //     echo "ERROR: $sql <br> $conn->error";
        // }
        $conn->close();
    }
}
?>
