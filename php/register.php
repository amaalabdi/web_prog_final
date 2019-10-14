<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login Form</title>
	<style>
		body{
			background-image: url("car-rental-lot.jpg");
			background-repeat:none;
			background-size: cover;
		}

		form, .form{
			background-color:rgba(221, 160, 221, 0.7);
			width:50%;
			margin:auto;
			padding:5px;
			font-size:200%
		}
		h2{
			text-align:center;
			font-size:200%;
		}
		h1{
			font-size:300%;
			font-family:courier;
			background-color:grey;
		}
		#submit{
			background-color:red;
			width:250px;
			height:50px;
			border-radius:100px;
			border:none;
			transition: background-color 0.5s ease;
		}
		#submit:hover{
			background-color:pink;
		}
		input{
			padding:5px;
			font-size:100%;
		}
		
	</style>
</head>

<body>

<?php

require('db.php');
session_start();

	if(isset($_POST['submit'])){

		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($con,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$query = "SELECT * FROM `customers` WHERE username='$username'";
		$result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $user = mysqli_fetch_assoc($result);
		
		if($user){
            if($user['username']===$username){
                echo "<div class='form'><h3>Username already exists.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
            }
        }else{
        $query2 = "INSERT INTO `customers` (`username`, `password`) VALUES('$username', '$password')";
        mysqli_query($con, $query2);
        $_SESSION['username'] = $username;
        echo $_SESSION['username'];
        echo "<div class='form'><h3>Congratulations! You have registered.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
	}
	else{

?>
<h1>Car Rentals</h1>
<div class="container">	
		<h2>Register</h2>
		
		<form action="register.php" method="POST" name="login">
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input name="submit" type="submit" id="submit" value="Register"/>
			<p>Already registered? <a href='login.php'>Login Here</a></p>
		</form>

	</div>

<?php } ?>

</body>

</html>