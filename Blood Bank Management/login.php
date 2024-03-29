<?php
include 'authentication.php';

// Initialize variables to store user input and error messages
$username = $password = "";
$usernameError = $passwordError = $loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = $_POST["password"];

    // Validate username
    if (empty($username)) {
        $usernameError = "Username is required.";
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    // If there are no validation errors, attempt user login
    if (empty($usernameError) && empty($passwordError)) {
        $loginResult = loginUser($username, $password);

        if ($loginResult==1) {
            // Redirect to the dashboard after successful login
            header("Location: donor.php");
            exit();
        } 
        elseif ($loginResult==2) {
            // Redirect to the dashboard after successful login
            header("Location: hospital.php");
            exit();
        } 
        elseif ($loginResult==3) {
            // Redirect to the dashboard after successful login
            header("Location: admindash.php");
            exit();
        } 
        else {
            $loginError = "Login failed. Please check your credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="icon" href="./files/logo.png">
    <link rel="stylesheet" type="text/css" href="css/login_signin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<img class="bg" src="images\bb1.jpg">
    <header>
        <h1>Login</h1>
    </header>

    <main>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="error"><?php echo $usernameError; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password">
                <span class="error"><?php echo $passwordError; ?></span>
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>

            <span class="error"><?php echo $loginError; ?></span>
        </form>

        <p>Don't have an account? <a href="signin.php">SignIn</a></p>
    </main>
</body>
</html>
