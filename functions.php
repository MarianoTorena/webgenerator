<?php 
	
	define('HOST','localhost');
	define('USER','adm_webgenerator');
	define('PASS','webgenerator2020');
	define('DB','webgenerator');

  	function consulta($consulta){
  		$conexion = new mysqli(HOST, USER, PASS, DB);

		/* comprobar la conexión */
		if ($conexion->connect_errno) {
		    printf("Falló la conexión: %s\n", $conexion->connect_error);
		    exit();
		}

		$query = $conexion->query($consulta);
        return $query->fetch_all(MYSQLI_ASSOC);
  	}

	function setconsulta($consulta){
		$conexion = mysqli_connect(HOST,USER,PASS);//crea la conexion con la BD
		mysqli_select_db ($conexion, DB);
		$result = mysqli_query($conexion, $consulta);//realiza la consulta a la DB
		mysqli_close($conexion);//cierra la conexion con la DB
	}


	// FUNCIONES SOBRE USUARIOS

	function checkUser($email,$password){
		if ($email=="admin@server.com" and $password=="serveradmin") {
			return true;
		}else{
			$user=consulta("SELECT * FROM `wg__Usuarios` WHERE `email`= '$email' and `password`='$password'");
			if(!$user){
				return false;
			}else{
				return true;
			}
		}	
	}

	function checkMail($email){
		if (!consulta("SELECT * FROM `wg__Usuarios` WHERE `email`= '$email'")) {
			return true;
		}else{
			return false;
		}
	}

	function getIdUser($email){
		$idUser=consulta("SELECT `idUsuario` FROM `wg__Usuarios` WHERE `email`='$email'");
		if(!$idUser){
			return false;
		}else{
			return $idUser[0];
		}
	}

	function checkData($email,$pass1,$pass2){
		if (checkMail($email)){
			if ($pass1 == $pass2){
				$resp=setconsulta("INSERT INTO `wg__Usuarios`(`email`, `password`) VALUES ('$email','$pass1')");
				return 3;
			}else{
				return 2;
			}
		}else{
			return 1;
		}
	}

	// FUNCIONES SOBRE WEBS

	function checkDominio($dominio,$idUser){
		$resp=consulta("SELECT * FROM `wg__Webs` WHERE `dominio`='$dominio'");
		if (!$resp) {
			$resp=setconsulta("INSERT INTO `wg__Webs`(`idUsuario`, `dominio`) VALUES ('$idUser','$dominio')");
			return true;
		}else{
			return false;
		}
	}

	function getWebs($idUser){
		$resp=consulta("SELECT * FROM `wg__Webs` WHERE `idUsuario`='$idUser'");
		return $resp;
	}

	function getAllWebs(){
		$resp=consulta("SELECT * FROM `wg__Webs`");
		return $resp;
	}

	function deleteWeb($dominio){
		$resp=setconsulta("DELETE FROM `wg__Webs` WHERE `dominio`='$dominio'");
	}

?>
