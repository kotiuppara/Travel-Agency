<?php
	session_start();
	require "connection.php";
	$_SESSION['error']="";
	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$name=$_POST['uname'];
		$pwd=$_POST['pwd'];
		$query="SELECT * FROM admin;";
		$check=mysqli_query($c,$query);
		if(mysqli_num_rows($check))
		{	
			$c1=0;
			$c2=0;
			$c3=0;
			while($row=mysqli_fetch_assoc($check))
			{
				if($row['userid']==$name)
					$c1=$c1+1;
				if($row['pwd']==$pwd)
					$c2=$c2+1;
				if($row['userid']==$name && $row['pwd']==$pwd)
					$c3=$c3+1;
			}
			if($c3)
				{	
					$_SESSION["userid"]=$name;
					header("location:admin2.php");
				}
			elseif ($c1==0 && $c2==0)
				$_SESSION["error"]="Incorrect Username and Password";
			elseif($c1==0 && $c2>=1)
				$_SESSION["error"]="Incorrect Username";
			elseif($c1==1 && $c2==0 )
				$_SESSION["error"]="Incorrect Password";
			else
				$_SESSION["error"]="USERID and Password Mismatch";
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
    <title>Admin</title>
</head>
<body style="background-image: url(img/a.jpg);">
		<div class="body-container">
			<div class="row g-0">
				<div class="col-md-4 offset-md-1 mt-5 pt-5 " >
					<div class="card-lg" style="border-radius: 25px;background-color:rgb(150, 230, 255);">	
						<div class="card-body mt-4">
							<h3 class="text-primary">Admin Login</h3>
							<form method="post" >
								<div class="form-floating mt-4 mb-4">
									<input type="text" class="form-control" name="uname" required id="uname" placeholder="UserId">
									<label class="form-label">USERID</label>
								</div>
								<div class="form-floating mt-4 mb-4">
								<input type="password" class="form-control" name="pwd" required id="pwd" placeholder="Password">
								<label class="form-label" for="pwd">PASSWORD</label>
								</div>
								<div style="text-align: center;">
									<button type="submit" name="submit" class="btn btn-danger">Login</button>
									<a class="text-decoration-none ms-3" href="index.html"> <-- Back </a>
								</div>
								<span><?php echo $_SESSION['error'];$_SESSION['error']=""; ?></span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>