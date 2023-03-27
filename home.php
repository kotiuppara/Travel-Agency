<?php
    require "connection.php";
    session_start();
    $q= "CREATE TABLE `vehicle` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,`CarName` varchar(50) NOT NULL,`Type` enum('AC','NON-AC') NOT NULL,`Count`int(50) NOT NULL,`CPL` int(50) NOT NULL,`CPK` int(50) NOT NULL,`Image` longblob NOT NULL);";
    mysqli_query($c,$q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="project.css">
    <title>Document</title>
    <script type="text/javascript">
        function book(){
            if(confirm("\tNOTE:\n1.Minimum of 4 hrs renting amount is charged.\n2.For Every night halt Rs.150 charged additionally.\n3.Need to Pay Advance of Rs.1000 extra amount will be refunded.\n\n\tDo you want to confirm booking? "))
                return true;
            else
                return false;
        }
    </script>
</head>
<body style="background-image: url(img/d.jpg);">
    <div class="body-container">
    <a href="index.html"><button class="button">Back</button></a>
    <div class="large"><u>Vehicle Details</u></div>
        <div class="row g-0">
            <?php 
                $query="SELECT * FROM vehicle;";
                $check=mysqli_query($c,$query);
                if(mysqli_num_rows($check))
                {
                    if(mysqli_num_rows($check))
                    {
                        while($row=mysqli_fetch_assoc($check))
                        {
                            $id=$row["Id"];
                            $car=$row["CarName"];
                            $type=$row["Type"];
                            $count=$row['Count'];
                            $cpl=$row['CPL'];
                            $cpk=$row['CPK'];
                            $image=$row['Image'];
                            echo '<div class="col-md-8 offset-md-2 wrap">';
                            echo '<div class="col-md-6 mt-0" >';
                            echo '<div class="card-lg" style="border-radius: 25px;">';
                            echo '<div class="card-body mt-4">';
                            echo '<td><img height="200px" width="auto" src="data:image/jpeg;base64,'.base64_encode($image).'"/></td>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';  
                            echo '<div class="col-md-6 mt-0" >';
                            echo '<div class="card-lg" style="border-radius: 25px;">';
                            echo '<div class="card-body mt-4">';
                            echo '<table class="tab1">';
                            echo '<tr>';
                            echo '<th>Car Name</th>';
                            echo '<th>:</th>';
                            echo '<td>'.$car.'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th>Type</th><th>:</th>';
                            echo '<td>'.$type.'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th>Available Cars</th><th>:</th>';
                            echo '<td>'.$count.'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th>Charge per Hour</th><th>:</th>';
                            echo '<td>'.$cpl.'</td>';
                            echo '</tr>';
                            echo '<th>Charge per KM</th><th>:</th>';
                            echo '<td>'.$cpk.'</td>';
                            echo '</tr>';
                            echo '<tr><td><form method = "POST" onsubmit="return book()" action="confirm.php" ><a href="confirm.php"><button class="but" name="button" value="'.$id.'">Book Now</button></a></form></td>' ;
                            echo '</tr>';
                            echo '</table>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>