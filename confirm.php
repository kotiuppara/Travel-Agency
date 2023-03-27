<?php
    require "connection.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
        $but=$_POST['button'];
        $query="SELECT * FROM vehicle where Id='$but';";
        $check=mysqli_query($c,$query);
        if(mysqli_num_rows($check))
        {  	
            while($row=mysqli_fetch_assoc($check)){
                $val=$row['Count'];
                $car=$row['CarName'];
                $type=$row['Type'];
                $cpk=$row['CPK'];
                $cpl=$row['CPL'];
                $image=$row['Image'];
            }
        }
        $val=$val-1;
        if($val>0){
            $q3="UPDATE vehicle SET Count='$val' WHERE Id='$but';";
            mysqli_query($c,$q3);
        }
        else{
            $q4="DELETE FROM vehicle WHERE Id = '$but';";
            mysqli_query($c,$q4);
        }
    }
    
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
</head>
<body style="background-image: url(img/c.jpg);" >
    <a href="home.php"><button class="button">Home</button></a>
    <h1 class="large">BOOKING SUCESS</h1>
    <h3 class="box3 ms-5 ps-5"><u>Order Details:</u></h3
    <?php
        echo '<div class="ms-5 ps-5">';
        echo '<div class="col-md-6 ms-5 ps-5 mt-0" >';
        echo '<div class="card-lg" style="border-radius: 25px;">';
        echo '<div class="card-body mt-4">';
        echo '<td><img height="200px" width="auto" src="data:image/jpeg;base64,'.base64_encode($image).'"/></td>';
        echo '</div>';
        echo '</div>';
        echo '</div>';  
        echo '<div class="col-md-6 ms-5 ps-5 mt-0" >';
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
        echo '<th>Charge per Hour</th><th>:</th>';
        echo '<td>'.$cpl.'</td>';
        echo '</tr>';
        echo '<th>Charge per KM</th><th>:</th>';
        echo '<td>'.$cpk.'</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    ?>
    <h4 class="text-success ms-5">🚗Our Driver will contact you soon.Thankyou for choosing Us.Have a Safe Ride</h4>
</body>
</html>