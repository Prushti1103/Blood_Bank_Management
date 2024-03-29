<?php
include 'db_config.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation History</title>
    <link rel="stylesheet" href="css/donationhistory.css">
</head>
<body>
<img class="bg" src="images\bb1.jpg">
<h1>Blood bank Stock</h1>
    <table border="2" >
            <th>id</th>
            <th>Blood Group</th>
            <th>Quantity</th>

        <tr>
           <?php
            $q="SELECT * FROM `donation`;";
            $result=mysqli_query($conn,$q);
            while($row=mysqli_fetch_assoc($result))
            {
            ?>
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['blood_group']; ?> </td>
            <td> <?php echo $row['quantity']; ?> </td>
            </tr>
            <?php
            }
            ?>
    
    </table>
</body>
</html>