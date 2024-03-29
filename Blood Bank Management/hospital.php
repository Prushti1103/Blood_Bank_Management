<?php
include 'db_config.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

if (isset($_POST['hospitalName'])) {

    $host_id=$_SESSION['user_id'];
    echo $host_id;
    $host_name = $_POST['hospitalName'];
    $host_city = $_POST['city'];
    $host_contact = $_POST['phoneNumber'];
    
    $sql = "INSERT INTO `hospital_details` (`host_id`, `hname`, `hcity`, `hcontact`) VALUES ('$host_id', '$host_name', '$host_city', '$host_contact')";
    echo $sql;
    if($conn->query($sql)== true){
        header("Location: patientform.php");
    }
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Details Form</title>
    <link rel="stylesheet" type="text/css" href="css/hospital.css">
    
</head>
<body>
    

    <form id="hospitalForm" action="hospital.php" method="post">
    <centre><h1>Hospital Details</h1></centre>
        <label for="hospitalName">Hospital Name:</label>
        <input type="text" id="hospitalName" name="hospitalName" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" required>
        

        <!-- <label for="email">Email:</label>
        <input type="email" id="email" name="email" required> -->

        <!-- <label for="password">Password:</label>
        <input type="password" id="password" name="password" required> -->

        <button type="Register">Register</button>

    </form>

</body>
</html>
