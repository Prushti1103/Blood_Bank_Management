<?php
include 'db_config.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}
if (isset($_POST['quantity'])) {

  
    $quantity= $_POST['quantity']; 

    $pat_id=$_SESSION['user_id'];


   // $sql="SELECT bgrp FROM `req_blood` WHERE pat_id=' $pat_id'";
   // $bgrp= mysqli_query($conn,$sql);


    // $result = mysqli_query($conn,$sql);
    // $num=mysqli_num_rows($result);

    if($num==0)
    {
       // $sql = "INSERT INTO donations (donor_id, food_item, quantity, donation_date) VALUES ('$donor_id', '$food_item', $quantity, '$donation_date')";
    }
    else{

        //$row=mysqli_fetch_assoc($result);
        //$quan=$row['quantity']-$quantity;
       // echo ($quan);
       // $tempid=$row['id'];
       
        $sql="UPDATE donations SET quantity ='$quan'  WHERE donations.id = '$tempid'";
    }
    //$sql=INSERT INTO `req_blood` (`id`, `pat_id`, `bgrp`, `qty`, `Time_date`) VALUES ('2', '5', 'O-', '1', current_timestamp());
    
    //$sql="INSERT INTO `req_blood` (`pat_id`, `bgrp`, `qty`) VALUES ('$pat_id', ' $pat_bgrp', '$quantity')";
    
    if($conn->query($sql)== true){
        //if qty is present in bloodblank than  
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
    <title>Patient_details</title>
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

        <label>Gender:</label><br>
        <input type="radio" id="male" name="pgender" value="male" required>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="pgender" value="female" required>
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="pgender" value="other" required>
        <label for="other">Other</label><br>
    
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

       

        <input type="submit" value="Submit">
    </form>

    <form1>
        <h2>Enter the request</h2>
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
        <input type="number" id="quantity" name="quantity" step="1" min="1" required><br>
    </form1>
</body>
</html>