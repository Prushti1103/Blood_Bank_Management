<?php
include 'db_config.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}
if (isset($_POST['name'])) {

    $donor_id=$_SESSION['user_id'];
    //echo $donor_id;
    $donor_name = $_POST['name'];
    $donor_address = $_POST['address'];
    $donor_age = $_POST['age'];
    $donor_gender = $_POST['gender'];
    $blood_group = $_POST['bloodGroup'];
    $haemoglobin = $_POST['hemoglobin'];
    $contact = $_POST['contact'];
    $disease = $_POST['diseases'];

    // $weight = isset($_POST['weight']) ? $_POST['weight'] : 0;
    // $height = isset($_POST['height']) ? $_POST['height'] : 0;

    // BMI calculation
 //   $bmi = ($weight > 0 && $height > 0) ? $weight / (($height / 100) ** 2) : null;


    $disease_string= implode(",",$disease);
    
    $sql = "INSERT INTO `donor_details` ( `donor_id`, `dname`, `daddress`, `dage`, `dgender`, `dbgrp`, `dhbin`, `ddisease`) VALUES ('$donor_id', '$donor_name', '$donor_address', '$donor_age', ' $donor_gender', '$blood_group', '$haemoglobin', '$disease_string')";
    
    if($conn->query($sql)== true){
        header("Location: BMI.php");
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
    <title>Blood Bank Management System</title>
    <link rel="stylesheet" type="text/css" href="css/donor1.css">
   
</head>
<body>

<h1>Donor Details Form</h1>

<form action="donor.php" method="post">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    
    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea><br>

    
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br>

    <label>Gender:</label>
    <div class="gender-radio">
    <input type="radio" id="male" name="gender" value="male" class="radio-input" required>
    <label class="radio-label" for="male">
        <div class="radio-custom"></div>
        Male
    </label>

    <input type="radio" id="female" name="gender" value="female" class="radio-input" required>
    <label class="radio-label" for="female">
        <div class="radio-custom"></div>
        Female
    </label>

    <input type="radio" id="other" name="gender" value="other" class="radio-input" required>
    <label class="radio-label" for="other">
        <div class="radio-custom"></div>
        Other
    </label>
    </div>
    
    <label for="contact">Contact:</label>
    <input type="tel" id="contact" name="contact" required><br>

    
    <label for="bloodGroup">Blood Group:</label>
    <select id="bloodGroup" name="bloodGroup" required>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select><br>

    <label for="hemoglobin">Hemoglobin Level (g/dL):</label>
    <input type="number" id="hemoglobin" name="hemoglobin" step="0.1" required><br>

    <label>Select (if applicable):</label>
    <div class="checkbox-container">
        <div class="checkbox-item">
            <input type="checkbox" id="disease1" name="diseases[]" value="None">
            <label class="checkbox-label" for="disease1"> None of these</label>
        </div>

        <div class="checkbox-item">
            <input type="checkbox" id="disease2" name="diseases[]" value="Hypertension">
            <label class="checkbox-label" for="disease2"> Hypertension</label>
        </div>

        <div class="checkbox-item">
            <input type="checkbox" id="disease3" name="diseases[]" value="Diabetes">
            <label class="checkbox-label" for="disease3"> Diabetes</label>
        </div>

        <div class="checkbox-item">
            <input type="checkbox" id="disease4" name="diseases[]" value="Heart Disease">
            <label class="checkbox-label" for="disease4"> Heart Disease</label>
        </div>

        <div class="checkbox-item">
            <input type="checkbox" id="disease5" name="diseases[]" value="Pregnant">
            <label class="checkbox-label" for="disease5"> Pregnant</label>
        </div>

        <div class="checkbox-item">
            <input type="checkbox" id="disease6" name="diseases[]" value="Tattoo">
            <label class="checkbox-label" for="disease6"> Tattoo</label>
        </div>

        <!-- Add other checkboxes here as needed -->
    </div>


    <!-- <label>Select (if applicable):</label>
    <div class="checkbox-wrapper">
        <input type="checkbox" id="disease1" name="diseases[]" value="None">
        <label class="checkbox-label" for="disease1"> None of these</label>

        <input type="checkbox" id="disease2" name="diseases[]" value="Hypertension">
        <label class="checkbox-label" for="disease2"> Hypertension</label>
 
        <input type="checkbox" id="disease3" name="diseases[]" value="Diabetes">
        <label class="checkbox-label" for="disease3"> Diabetes</label>

        <input type="checkbox" id="disease4" name="diseases[]" value="Heart Disease">
        <label class="checkbox-label" for="disease4"> Heart Disease</label>

        <input type="checkbox" id="disease5" name="diseases[]" value="Pregnant">
        <label class="checkbox-label" for="disease5"> Pregnant</label>

        <input type="checkbox" id="disease6" name="diseases[]" value="Tattoo">
        <label class="checkbox-label" for="disease6"> Tattoo</label>
    </div>
     -->
    

    <input type="submit" value="Submit">
</form>

</body>
</html>

