<?php
	session_start();
	require "connection.php";
	$_SESSION['error']="";
	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{	
		$name=$_POST['name'];
		$pwd=$_POST['pwd'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$q1="create table data(Name varchar(50),Email varchar(50),Phone varchar(12),Password varchar(50),PRIMARY KEY (Email));";
		$q2="Insert into data(Name,Email,Phone,Password) values('$name','$email','$phone','$pwd');";
		mysqli_query($c,$q1);
		$query="SELECT * FROM data;";
		$check=mysqli_query($c,$query);
		if(mysqli_num_rows($check))
		{	
			$count=0;
			while($row=mysqli_fetch_assoc($check))
			{
				if($row['Email']==$email)
					$count=$count+1;
			}
			if($count>0)
				$_SESSION["error"]="Email exists try another";
			else
			{
				mysqli_query($c,$q2);
				$_SESSION["userid"]=$_POST['Email'];
				header("Location:home.html");
			}
		}
		else
		{
			mysqli_query($c,$q2);
			$_SESSION["userid"]=$_POST['Email'];
			header("Location:home.html");
		}
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Bootstrap Example</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="project.css">
		<script type="text/javascript">
		function validate()
		{	
			let name = document.getElementById("name").value.trim();
			let phone = document.getElementById("tele").value.trim();
			let mail = document.getElementById("mail").value.trim();
			let pwd = document.getElementById("password").value.trim();
			let a=function name(name)
			{
				if (name == "") {
					document.getElementById("error").innerText = "Name cannot be empty";
					return false;
				}
				if (name.length < 3) {
					document.getElementById("error").innerText = "Name should be atleast 3 Characters";
					return false;
				}
				return true;
			}
			let b=function pwd(pwd)
			{
				if (pwd == "") {
					document.getElementById("error").innerText = "Password cannot be empty";
					return false;
				}
				if (pwd.length < 8) {
					document.getElementById("error").innerText = "Password should be atleast 8 Characters";
					return false;
				}
				if (!pwd.match(/[a-z]/)) {
					document.getElementById("error").innerText = "Password must contain one Lowercase letter";
					return false;
				}
				if (!pwd.match(/[A-Z]/)) {
					document.getElementById("error").innerText = "Password must contain one Uppercase letter";
					return false;
				}
				if (!pwd.match(/[@#&-]/)) {
					document.getElementById("error").innerText = "Password must contain one Special Character";
					return false;
				}
				if (!pwd.match(/[0-9]/)) {
					document.getElementById("error").innerText = "Password must contain one digit Character";
					return false;
				}
				return true;
			}
			let c=function phone(phone)
			{
				if (phone == "") {
					document.getElementById("error").innerText = "Phone cannot be empty";
					return false;
				}
				if (phone.length != 10) {
					document.getElementById("error").innerText = "Phone number should be 10 Characters.";
					return false;
				}
				return true;
			}
			let d=function mail(mail)
			{
				if ((mail =="")) {
					document.getElementById("error").innerText = "Mail cannot be empty";
					return false;
				}
				return true;
			}
			if (a(name) && b(pwd) && c(phone) && d(mail))
				return true;
			else
				return false;
		}
	</script>
	</head>

	<body style="background-image: url(img/a.jpg);">
		<div class="body-container">
			<div class="row g-0">
				<div class="col-md-4 ms-5 pt-5 mt-5 ">
					<div class="card-lg" style="border-radius: 25px;background-color:rgb(150, 230, 255);">
						<div class="card-body">
							<h3 class="text-primary">CREATE NEW ACCOUNT</h3>
							<form id="form" onsubmit=" return validate()" method="POST" enctype="multipart/form-data">
								<div class="form-floating mt-4 mb-4">
									<input type="text" class="form-control" name="name" id="name"placeholder="uname">
									<label class="form-label">NAME</label>
								</div>
								<div class="form-floating mt-4 mb-4">
									<input type="email" class="form-control" name="email" id="mail" placeholder="email">
									<label class="form-label">EMAIL</label>
								</div>
								<div class="form-floating mt-4 mb-4">
									<input type="tel" class="form-control" name="phone" id="tele"
										placeholder="phone">
									<label class="form-label">PHONE</label>
								</div>
								<div class="form-floating mt-4 mb-4">
									<input type="password" class="form-control" name="pwd" id="password" placeholder="pass">
									<label class="form-label" >PASSWORD</label>
								</div>
								<div class="form-floating mt-4 mb-4"><span id="error" name='error' class="text-danger"></span></div>
								<div style="text-align: center;">
									<button type="submit" name="submit" class="btn btn-danger">Create
										Account</button>
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