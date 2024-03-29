<?php
include 'db_config.php';
include 'authentication.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}
if (isset($_POST['pname'])) {

    $host_id=$_SESSION['user_id'];
   // echo $host_id;
    $pat_name= $_POST['pname'];
    $pat_address= $_POST['paddress'];
    $pat_age= $_POST['page'];
    $pat_gender= $_POST['pgender'];
    $pat_bgrp= $_POST['pbloodGroup'];
    $contact= $_POST['pcontact'];
    $quantity= $_POST['quantity']; 
    echo $quantity;


    $sql1="SELECT quantity FROM `donation` WHERE blood_group='$pat_bgrp';";
    $result1= $conn->query($sql1);
    $row1=mysqli_fetch_assoc($result1);
    //to check if the request is present in bloodbank

    if(($quantity<$row1['quantity']) ||($quantity==$row1['quantity'])  ){
        
        $sql="INSERT INTO `patient details` (`host_id`, `pname`, `paddress`, `page`, `pgender`, `pcontact`, `pbgrp`,`pqty`) VALUES ( '$host_id', '$pat_name', '$pat_address', '$pat_age', '$pat_gender', '$contact', '$pat_bgrp','$quantity');";
        $conn->query($sql);
     

        $quan=$row1['quantity']-$quantity;
        $sql2="UPDATE donation SET quantity='$quan' where blood_group='$pat_bgrp'; ";
        $conn->query($sql2);
        // echo  '<script>alert("REQUEST ACCEPTED!")</script>';
        // echo  '<script>alert("Requested Blood= '. $quantity.'")</script>';
        logoutUser();
        echo '<script>';
        echo 'alert("REQUEST ACCEPTED!");';
        echo 'alert("Requested Blood= '. $quantity.'");';
        echo 'window.location.href = "index.php";'; // Replace with your actual destination
        echo '</script>';
    }
    else{
        // echo  '<script>alert("Insufficient quantity available")</script>';
        // echo  '<script>alert("REQUEST DENIED!")</script>';
        logoutUser();
        echo '<script>';
        echo 'alert("Insufficient quantity available");';
        echo 'alert("REQUEST DENIED!");';
        echo 'window.location.href = "index.php";'; // Replace with your actual destination
        echo '</script>';
        // $redirect=1;

        // if($redirect=1){
        //     header("Location: signin.php");
        // }
        
    }


  

    $conn->close();

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient_details</title>
    <link rel="stylesheet" type="text/css" href="css/patientform.css">

</head>
<body>
    
    <h1>Patient Details Form</h1>

    <form action="patientform.php" method='post'>
        
        <label for="pname">Name:</label>
        <input type="text" id="pname" name="pname" required><br>

        <label for="paddress">Address:</label>
        <textarea id="paddress" name="paddress" required></textarea><br>

        <label for="page">Age:</label>
        <input type="number" id="page" name="page" required><br>

        <!-- <label>Gender:</label><br>
        <input type="radio" id="male" name="pgender" value="male" required>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="pgender" value="female" required>
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="pgender" value="other" required>
        <label for="other">Other</label><br> -->

        <label>Gender:</label>
    <div class="gender-radio">
    <input type="radio" id="male" name="pgender" value="male" class="radio-input" required>
    <label class="radio-label" for="male">
        <div class="radio-custom"></div>
        Male
    </label>

    <input type="radio" id="female" name="pgender" value="female" class="radio-input" required>
    <label class="radio-label" for="female">
        <div class="radio-custom"></div>
        Female
    </label>

    <input type="radio" id="other" name="pgender" value="other" class="radio-input" required>
    <label class="radio-label" for="other">
        <div class="radio-custom"></div>
        Other
    </label>
    </div>
    
        <label for="pcontact">Contact:</label>
        <input type="tel" id="pcontact" name="pcontact" required><br>

    
        <label for="pbloodGroup">Blood Group:</label>
        <select id="pbloodGroup" name="pbloodGroup" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity"  required><br>



        <input type="submit" value="Submit">
    </form>

    
</body>
</html>