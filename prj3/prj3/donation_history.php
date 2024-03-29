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
<h1>Donation History</h1>
    <table border="2" >
            <th>Donor id</th>
            <th>Donor Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Blood Group</th>
            <th>Quantity</th>

        <tr>
           <?php
            $q="SELECT `history`.donor_id , `dname`,`dage`, `daddress`, `dbgrp`, `qty` FROM history JOIN donor_details ON history.donor_id=donor_details.id";
            $result=mysqli_query($conn,$q);
            while($row=mysqli_fetch_assoc($result))
            {
                ?>
            <td> <?php echo $row['donor_id']; ?> </td>
            <td> <?php echo $row['dname']; ?> </td>
            <td> <?php echo $row['dage']; ?> </td>
            <td> <?php echo $row['daddress']; ?> </td>
            <td> <?php echo $row['dbgrp']; ?> </td>
            <td> <?php echo $row['qty']; ?> </td>
            </tr>
            <?php
            }
            ?>
    
    </table>
</body>
</html>