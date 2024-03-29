<?php
include 'db_config.php';
include 'authentication.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$donor_id = $_SESSION['user_id'];

// Fetch donor details from the database
$sql = "SELECT * FROM donor_details WHERE donor_id = '$donor_id' AND ddisease = 'None' AND `dhbin`<15  AND `dhbin`>10 AND `dage`>17 AND `dage`<76  AND id = (select max(id) from donor_details); ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $id= $row['id'];
    //echo $id;
    $donor_name = $row['dname'];
    $donor_age = $row['dage'];
    $donor_gender = $row['dgender'];
    $blood_group = $row['dbgrp'];
    $haemoglobin = $row['dhbin'];
    $diseases = explode(",", $row['ddisease']);

    // Set weight and height to null if not present in POST
    $weight = isset($_POST['weight']) ? $_POST['weight'] : null;
    $height = isset($_POST['height']) ? $_POST['height'] : null;

    // BMI calculation
    $bmi = ($weight > 0 && $height > 0) ? $weight / (($height / 100) ** 2) : null;

    

    if ($bmi !== null) {
        echo '<script type="text/javascript">alert("BMI is: '.$bmi.'")</script>';
        // Check eligibility based on BMI
        $bmiCutoffmin = 18;
        $bmiCutoffmax = 25;
        $betone=1;
        $bettwo=2;
        
        $sql3="SELECT * FROM donation where blood_group='$blood_group';";
        $result1 = $conn->query($sql3);
        $row1=mysqli_fetch_assoc($result1);

        if (($bmi > $bmiCutoffmin) && ($bmi < $bmiCutoffmax)) {   
            echo '<script>alert("You are eligible as a blood donor.")</script>';  
            if($bmi<=22){
                $req_qty=$betone;
                echo  '<script>alert("Quantity of blood donation= '. $req_qty.'")</script>'; 
                $sql1="INSERT into history(donor_id,Bgrp,qty) values('$id','$blood_group','$req_qty')";
              
                $conn->query($sql1); 

                $quan=$row1['quantity']+$req_qty;
                $sql2="UPDATE donation SET quantity='$quan' where blood_group='$blood_group'; ";
                $conn->query($sql2);


                logoutUser();
            echo '<script>';
            echo 'window.location.href = "index.php";'; // Replace with your actual destination
            echo '</script>';
            }
            else{
                $req_qty=$bettwo;
               echo  '<script>alert("Quantity of blood donation= '. $req_qty.'")</script>'; 
               $sql1="INSERT into history(donor_id,Bgrp,qty) values('$id','$blood_group','$req_qty')";
               $conn->query($sql1); 

               $quan=$row1['quantity']+$req_qty;
                $sql2="UPDATE donation SET quantity='$quan' where blood_group='$blood_group'; ";
                $conn->query($sql2);


                logoutUser();
            echo '<script>';
            echo 'window.location.href = "index.php";'; // Replace with your actual destination
            echo '</script>';
            }
        }   

        else {
            // Log the user out
logoutUser();
            echo '<script>';
            echo 'alert("Sorry, you are not eligible as a blood donor based on BMI.");';
            echo 'window.location.href = "index.php";'; // Replace with your actual destination
            echo '</script>';

        }

        
    } else {
        // echo '<script>alert("Please enter valid weight and height to calculate BMI.")</script>';
    }
} 

else {
// Log the user out
logoutUser();
    echo '<script>';
    echo 'alert("Not eligible based on the details entered.");';
    echo 'window.location.href = "index.php";'; // Replace with your actual destination
    echo '</script>';
}

//$row=mysqli_fetch_assoc($result);


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/BMI.css">

    <title>BMI Calculation</title>
</head>
<body>



<form action="BMI.php" method="POST">
<centre><h1>BMI Calculation</h1></centre>
<?php
echo "<p>Donor: $donor_name</p>";
echo "<p>Age: $donor_age years</p>";
echo "<p>Gender: $donor_gender</p>";
echo "<p>Blood Group: $blood_group</p>";
echo "<p>Hemoglobin Level: $haemoglobin g/dL</p>";
?>
<br>
<br>
    <label for="bmi">Check BMI measurement:</label>
    <div id="bmiFields">
        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight">

        <label for="height">Height (cm):</label>
        <input type="number" id="height" name="height">
    </div>

    <!-- Button to Submit the form -->
    <button type="submit">Calculate BMI</button>
</form>

</body>
</html>
