<?php

// recibe "nombre", "apellido", "rol", "dni_argentino", "dni_extranjero", "celular", "mail", "foto", "pass", "token"
// si no se recibe alguno de los valores sera remplazado por "NULL"

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");

	include '../src/db_connect.php';

		if(isset($_POST["nombre"])){
			$nombre = $_POST["nombre"];
		} else {
			$nombre = "NULL";
		}
		if(isset($_POST["apellido"])){
			$apellido = $_POST["apellido"];
		} else {
			$apellido = "NULL";
		}
		if(isset($_POST["rol"])){
			$rol = $_POST["rol"];
		} else {
			$rol = "NULL";
		}
		if(isset($_POST["dni_argentino"])){
			$dni_argentino = $_POST["dni_argentino"];
		} else {
			$dni_argentino = "NULL";
		}
		if(isset($_POST["dni_extranjero"])){
			$dni_extranjero = $_POST["dni_extranjero"];
		} else {
			$dni_extranjero = "NULL";
		}
		if(isset($_POST["celular"])){
			$celular = $_POST["celular"];
		} else {
			$celular = "NULL";
        }
        if(isset($_POST["mail"])){
		    $mail = $_POST["mail"];
		} else {
		    $mail = "NULL";
		}
		if(isset($_POST["foto"])){
			$foto = $_POST["foto"];
		} else {
			$foto = "https://image.shutterstock.com/image-vector/avatar-man-icon-profile-placeholder-260nw-1229859850.jpg";
        }
        if(isset($_POST["pass"])){
		    $pass = $_POST["pass"];
		} else {
		    $pass = "NULL";
        }
        if(isset($_POST["token"])){
		    $token = $_POST["token"];
		} else {
		    $token = "NULL";
		}
        
        $rol = "NULL";
		

		$sql_2 = "SELECT * FROM `USUARIOS` WHERE dni = '$dni' OR celular = '$celular' OR correo = '$correo'";

		$result_2 = mysqli_query($conn, $sql_2);
		$count_2 = mysqli_num_rows($result_2);

		if($count_2 > 0) {
			while($row = $result_2->fetch_assoc()) {
				if($row["dni"] == $dni){
				echo 'error_dni';
				}
				if($row["celular"] == $celular){
					echo 'error_celular';
				}
				if($row["correo"] == $correo){
					echo 'error_correo';
				}
			}
		} else {
			$sql_a = "INSERT INTO `USUARIOS`";
			$sql_b = "(`nombre`, `apellido`, `rol`, `dni_argentino`, `dni_extranjero`, `celular`, `mail`, `foto`, `pass`, `token`)";
			$sql_c = "VALUES";
			$sql_d = "('".$nombre."', '".$apellido."', '".$rol."', '".$dni_argentino."', '".$dni_extranjero."', '".$celular."', '".$mail."', '".$foto."', '".$rol."', '".$token."')";
			$sql = $sql_a.$sql_b.$sql_c.$sql_d;
			$result = mysqli_query($conn, $sql);

			//echo $sql;
			echo 'result='.$result;
		}

?>
