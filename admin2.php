<?php
    session_start();
	require "connection.php";
	$d=$_SESSION['userid'];
   // $d1=$_POST['submit'];
    //$d2=$_POST['submit1'];
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {  
        if(isset($_POST['submit'])){ 
            if($_POST['submit'] =="true")
            {
                if(isset($_POST['id'])){
                    $id=$_POST['id'];
                    $count=$_POST['num'];
                    $query="SELECT Count FROM vehicle where Id='$id';";
                    $check=mysqli_query($c,$query);
                    if(mysqli_num_rows($check))
                    {  	
                        while($row=mysqli_fetch_assoc($check)){
                            $val=$row['Count'];
                        }
                        $val=$val+$count;
                        $q3="UPDATE vehicle SET Count='$val' WHERE Id='$id';";
                        mysqli_query($c,$q3);
                    }
                    else{
                        $name=$_POST['name'];
                        $type=$_POST['type'];
                        $cpl=$_POST['cpl'];
                        $cpk=$_POST['cpk'];
                        $n=$_FILES['myfile']['name'];
                        $size= $_FILES['myfile']['size'];
                        $file= $_FILES['myfile']['tmp_name'];
                        $img=addslashes(file_get_contents($file));
                        $allowed=array('jpg','png','jpeg','gif');
                        $extension=pathinfo($n,PATHINFO_EXTENSION);
                        $q1="Insert into vehicle(CarName,Type,Count,CPL,CPK,Image) values('$name','$type','$count','$cpl','$cpk','$img');";
                        mysqli_query($c,$q1); 
                    }
                }
                else{
                    $id=$_POST['id'];
                    $name=$_POST['name'];
                    $type=$_POST['type'];
                    $count=$_POST['num'];
                    $cpl=$_POST['cpl'];
                    $cpk=$_POST['cpk'];
                    $n=$_FILES['myfile']['name'];
                    $size= $_FILES['myfile']['size'];
                    $file= $_FILES['myfile']['tmp_name'];
                    $img=addslashes(file_get_contents($file));
                    $allowed=array('jpg','png','jpeg','gif');
                    $extension=pathinfo($n,PATHINFO_EXTENSION);
                    $q1="Insert into vehicle(CarName,Type,Count,CPL,CPK,Image) values('$name','$type','$count','$cpl','$cpk','$img');";
                    mysqli_query($c,$q1); 
                }
            }
        }
        if(isset($_POST['submit1']))
        {
            if($_POST['submit1']=="true1"){
                $count=$_POST['num'];
                $id=$_POST['id'];
                if(isset($_POST['id'])){
                    $val=0;
                    $query="SELECT Count FROM vehicle where Id='$id';";
                    $check=mysqli_query($c,$query);
                    if(mysqli_num_rows($check))
                    {  	
                        while($row=mysqli_fetch_assoc($check)){
                            $val=$row['Count'];
                        }
                    }
                    if($val>$count){
                        $val=$val-$count;
                        if($val>0){
                            $q3="UPDATE vehicle SET Count='$val' WHERE Id='$id';";
                            mysqli_query($c,$q3);
                        }
                        else{
                            $q4="DELETE FROM vehicle WHERE Id = '$id';";
                            mysqli_query($c,$q4);
                        }
                    }
                    else{
                        $q5="DELETE FROM vehicle WHERE Id = '$id';";
                        mysqli_query($c,$q5);
                    }
                }   
            }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="project.css">
    <title>Document</title>    
    <script>
        $(document).ready(function(){
            $("#a").click(function(){
                $("#edit").toggle();
            });
            $("#b").click(function(){
                $("#edit1").toggle();
            });
        });
    </script>
</head>

<body class="bg">
    <a href="index.html"><button class="button">Back</button></a>
    <div class="large"><u>Vehicle Details</u></div>
    <div class="container box">
        <?php 
            $query="SELECT * FROM vehicle;";
            $check=mysqli_query($c,$query);
            if(mysqli_num_rows($check))
            {	echo "<table class='tab' cellspacing='1' cellpadding='8'>";
                echo "<tr class='fixed'>";
                echo "<th>ID</th>";
                echo "<th>Car</th>";
                echo "<th>Type</th>";
                echo "<th>Available Cars</th>";
                echo "<th>Charge per Hour </th>";
                echo "<th>Charge per KM</th>";
                echo "<th>Image</th>";
                echo "</tr> ";
                while($row=mysqli_fetch_assoc($check))
                {
                    echo "<tr>";
                    echo "<td>".$row["Id"]."</td> ";
                    echo "<td>".$row["CarName"]."</td> ";
                    echo "<td>".$row["Type"]."</td> ";
                    echo "<td>".$row['Count']."</td> ";
                    echo "<td>".$row['CPL']."</td> ";
                    echo "<td>".$row['CPK']."</td> ";
                    echo '<td><img height="100px" width="auto" src="data:image/jpeg;base64,'.base64_encode($row['Image']).'"/></td>';
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </div>
    <div class="row pt-5 g-0">
        <div class="col-md-4 offset-md-1">
            <button class="box2 button1 toggle" id="a" type="button" >Add Vehicle</button>
            <div class="card-md collapse " id="edit" style="border-radius: 25px;background-color:rgb(150, 230, 255);">
                <div class="card-body" >
                    <h3 class="text-primary">Add Vehicle</h3>
                    <form id="form" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mt-4 mb-4">
                            <input type="text" class="form-control" name="id" id="id" placeholder="id">
                            <label class="form-label" for="name">Car ID</label>
                        </div>
                        <div class="form-floating mt-4 mb-4">
                            <input type="text" class="form-control" name="name"  id="name"placeholder="carname">
                            <label class="form-label" for="name">Car Name</label>
                        </div>
                        <div class="mt-4 mb-4">
                            <label>Type</label><br>
                            <input type="radio" name="type" value="AC" id="type"  placeholder="type">AC <br>
                            <input type="radio" name="type" id="type" value="NON-AC" placeholder="type">Non-AC <br>
                        </div>
                        <div class="form-floating mt-4 mb-4">
                            <input type="number" class="form-control" name="num"  id="num"placeholder="num">
                            <label class="form-label" for="num">Available Cars</label>
                        </div>
                        <div class="form-floating mt-4 mb-4">
                            <input type="text" class="form-control" name="cpl" id="cpl"  
                                placeholder="cpl">
                            <label class="form-label" for="cpl">Charge per Hour</label>
                        </div>
                        <div class="form-floating mt-4 mb-4">
                            <input type="text" class="form-control" name="cpk" id="cpk"  
                                placeholder="cpl">
                            <label class="form-label" for="cpk">Charge per KM</label>
                        </div>
                        <div class="form mb-4">
                            <label class="form-label"><b>Upload Pic</b></label>
                            <input type="file" class="form-control" name="myfile" id="upload">
                        </div>
                        <div class="d-grid gap-3">
                            <button type="submit" name="submit" value="true" class="btn btn-danger btn-block">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 offset-md-1">
            <button class="box2 button1 toggle" id="b" type="button" >Remove Vehicle</button>
            <div class="card-md collapse " id="edit1" style="border-radius: 25px;background-color:rgb(150, 230, 255);">
            <div class="card-body" >
                    <h3 class="text-primary">Remove Vehicle</h3>
                    <form id="form" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mt-4 mb-4">
                            <input type="text" class="form-control" name="id" id="id" placeholder="id">
                            <label class="form-label" for="name">Car ID</label>
                        </div>
                         <div class="form-floating mt-4 mb-4">
                            <input type="number" class="form-control" name="num"  id="num" placeholder="num">
                            <label class="form-label" for="num">No. of Cars</label>
                        </div>
                        <div class="d-grid gap-3">
                            <button type="submit" name="submit1" value="true1" class="btn btn-danger btn-block">Remove</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>