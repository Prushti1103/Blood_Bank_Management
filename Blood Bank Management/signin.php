<?php
include 'authentication.php';

// Initialize variables to store user input and error messages
$username = $email =$register = $password = $confirmPassword = "";
$usernameError = $emailError =$registerError= $passwordError = $confirmPasswordError = $registrationError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $register=htmlspecialchars(trim($_POST["register"]));
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validate username
    if (empty($username)) {
        $usernameError = "Username is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $usernameError = "Invalid username format.";
    }

    // Validate email
    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }
    if(empty($register)){
        $registerError ="Register as is required.";
    }
    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required.";
    } elseif (strlen($password) < 6) {
        $passwordError = "Password must be at least 6 characters long.";
    }

    // Confirm password
    if (empty($confirmPassword)) {
        $confirmPasswordError = "Please confirm your password.";
    } elseif ($password !== $confirmPassword) {
        $confirmPasswordError = "Passwords do not match.";
    }

    // If there are no validation errors, attempt user registration
    if (empty($usernameError) && empty($emailError) && (empty($registerError)) && empty($passwordError) && empty($confirmPasswordError)) {
        $registrationResult = registerUser($username,$register, $password, $email);

        if ($registrationResult) {
            // Redirect to the login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            $registrationError = "Registration failed. Please try again.";
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
    <title>SignIn</title>
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
        <h1>Register</h1>
    </header>

    <main>
        <form method="post" action="signin.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                <span class="error"><?php echo $usernameError; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailError; ?></span>
            </div>
            <div class="form-group">
                <label for="register">Register as:</label>
                <input type="text" name="register" placeholder="Donor/Hospital" value="<?php echo $register; ?>">
                <span class="error"><?php echo $registerError; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" placeholder="Password" name="password">
                <span class="error"><?php echo $passwordError; ?></span>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" placeholder="Confirm Password" name="confirm_password">
                <span class="error"><?php echo $confirmPasswordError; ?></span>
            </div>

            <div class="form-group">
                <button type="submit">Register</button>
            </div>

            <span class="error"><?php echo $registrationError; ?></span>
        </form>

        <p>Already have an account? <a href="login.php">Log in here</a></p>
    </main>
</body>
</html>
