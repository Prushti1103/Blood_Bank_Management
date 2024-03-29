<?php
include 'authentication.php';

// Log the user out
logoutUser();

// Redirect to the index page after logout
header("Location: index.php");
exit();
?>
