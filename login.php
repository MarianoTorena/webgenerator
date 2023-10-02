<?php 
	include('functions.php');
	session_start();

	if (isset($_SESSION['user'])) {
		header('Location: panel.php');
	}elseif (isset($_POST['btn_LogIn'])) {
		$email=$_POST['email'];
		$password=$_POST['password'];
		if (checkUser($email,$password)){
			$resp=getIdUser($email);
			$_SESSION['user']=$resp['idUsuario'];
			header('Location: panel.php');
		}else{
			echo('Usuario o contrasenia incorrecta');
		}
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h1><center>webgenerator Mariano Torena Bastos</center></h1>
	<form action="" method="POST">
		<input type="email" name="email" placeholder="email">
		<input type="password" name="password" placeholder="contraseña ">
		<input type="submit" name="btn_LogIn" value="Log In">
		<a href="register.php">Register</a>
	</form>
</body>
</html>