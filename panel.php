<?php 
	include('functions.php');
	session_start();

	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
	}else{
		$idUser=$_SESSION['user'];
		if (isset($_POST['btn_submit'])) {
			$dominio=$idUser.$_POST['webName'];
			if (checkDominio($dominio,$idUser)) {
				shell_exec("./wix.sh $dominio");
			}
		}
		if (isset($_GET['mode'])) {
			switch ($_GET['mode']) {
				case 'descargar':
					shell_exec("./descargar.sh ".$_GET['dominio']);
					header("Location: http://mattprofe.com.ar:81/alumno/3882/ACTIVIDADES/CLASE_11/".$_GET['dominio']."/".$_GET['dominio'].".zip");
				break;

				case 'eliminar':
					shell_exec("./eliminar.sh ".$_GET['dominio']);
					deleteWeb($_GET['dominio']);
				break;
				
				default:

					break;
			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel</title>
</head>
<body>
	<h1><center>Bienvenido a tu panel</center></h1>
	<a href="logout.php">Cerrar sesión de <?php echo($idUser) ?></a>
	<form action="" method="POST">
		<label for="">Generar Web de:</label>
		<input type="text" name="webName">
		<br>
		<input type="submit" name="btn_submit" value="Crear Web">
	</form>
	<br>
	<table border="solid">
		<tr>
			<td>ID_WEB</td>
			<td>ID_USUARIO</td>
			<td>DOMINIO</td>
			<td>CREACION</td>

		</tr>


	<?php 
		if ($idUser=="999") {
			echo "<h3>MODO BLACK ACTIVADO</h3>";
			foreach (getAllWebs() as $key => $row) {
				$urlApp="http://mattprofe.com.ar:81/alumno/3882/ACTIVIDADES/CLASE_11/".$row['dominio'];
				echo "
					<tr>
						<td>".$row['idWeb']."</td>
						<td>".$row['idUsuario']."</td>
						<td><a href=".$urlApp.">".$row['dominio']."</a></td>
						<td>".$row['fechaCreacion']."</td>
						<td><a href='?mode=descargar&dominio=".$row['dominio']."'>Descargar</a></td>
						<td><a href='?mode=eliminar&dominio=".$row['dominio']."'>Eliminar</a></td>
					</tr>
				";
			}
		}else{
			foreach (getWebs($idUser) as $key => $row) {
				$urlApp="http://mattprofe.com.ar:81/alumno/3882/ACTIVIDADES/CLASE_11/".$row['dominio'];
				echo "
					<tr>
						<td>".$row['idWeb']."</td>
						<td>".$row['idUsuario']."</td>
						<td><a href=".$urlApp.">".$row['dominio']."</a></td>
						<td>".$row['fechaCreacion']."</td>
						<td><a href='?mode=descargar&dominio=".$row['dominio']."'>Descargar</a></td>
						<td><a href='?mode=eliminar&dominio=".$row['dominio']."'>Eliminar</a></td>
					</tr>
				";
			}
		}
		

	 ?>
	 </table>
</body>
</html>