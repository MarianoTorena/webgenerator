<?php 
	include('functions.php');
	session_start();

	if (isset($_SESSION['user'])) {
		header('Location: panel.php');
	}elseif (isset($_POST['btn_Register'])) {
		$email=$_POST['email'];
		$pass1=$_POST['password'];
		$pass2=$_POST['passwordA'];
		$resp=checkData($email,$pass1,$pass2);
		if($resp==3){
			header('Location: login.php');
		}elseif ($resp==1) {
			echo('El email ingresado ya fue registrado');
		}else{
			echo('Las contrasenias no conciden');
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
</head>
<body>
	<h1><center>Registrarte es simple.</center></h1>
	<form action="" method="POST">
		<input type="email" name="email" placeholder="email">
		<input type="password" name="password" placeholder="contraseña ">
		<input type="password" name="passwordA" placeholder="repetir contraseña">
		<input type="submit" name="btn_Register" value="Regist">
	</form>
</body>
</html>