<?php  
	function conectar(){
		//Parámetros de conexión
		$servername = "localhost";
		$database = "foro";
		$username = "root"; 
		$password = "";
		//Crear la conexión 
		$conn = mysqli_connect($servername, $username, $password, $database);//método de Conexión	
		//Checar si se realizó la conexión 
		if(!$conn){
			die("ERROR: La conexión no se realizó correctamente." . mysqli_connect_error());
		}
		$cbd = mysqli_select_db($conn,$database);
		return($conn);
	}	
?>