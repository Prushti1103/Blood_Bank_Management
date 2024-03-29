<?php
session_start();

// Include the database configuration
include 'db_config.php';

// Function to register a user
function registerUser($username,$register, $password, $email) {
    global $conn;

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the 'users' table
    $sql = "INSERT INTO users (username, register, password, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $register, $hashedPassword, $email);

    if ($stmt->execute()) {
        return true; // Registration successful
    } else {
        return false; // Registration failed
    }
}

// Function to log in a user
function loginUser($username, $password) {
    global $conn;

    // Retrieve user data from the 'users' table
    $sql = "SELECT id, username, register, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        $register = $row['register'];
        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $row['id'];
            if($register=="Donor")
            {
                return 1; // Login successful
            }
            elseif($register=="Hospital")
            {
                return 2;
            }
            elseif($register=="Admin")
            {
                return 3;
            }
            
        }
    }
    
    return false; // Login failed
}

// Function to log out a user
function logoutUser() {
    // Destroy the session to log the user out
    session_destroy();
}
?>
