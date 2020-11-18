
<?php
	// Se accede a la sesión 
  	session_name("Foro");
  	session_start();
	include("conexion.php");
	//Conexón a la base de datos
	$conexion = conectar();
	//No se puede eliminar una cuenta que esta en sesión 
	if($_SESSION["idCuenta"] != $_POST["id"]){
		//Consulta con los datos de login
		$consulta="DELETE FROM usuario WHERE idusuario=$_POST[id];"; 
		if($conexion->query($consulta) == TRUE){
			mysqli_close($conexion);
			header("location:bajas.php?baja=eliminado");
		}else{
			mysqli_close($conexion);
			header("location:bajas.php?baja=error");
		}	
	}else{
			mysqli_close($conexion);
			header("location:bajas.php?baja=error");
	}
	
	 			
?>
