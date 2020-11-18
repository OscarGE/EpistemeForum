<?php
    session_name("Foro");
	session_start();
    include("conexion.php");
    if(isset($_POST['usuario']) && isset($_POST['password'])){
    	$usuario=$_POST['usuario'];
    	$password=$_POST['password'];
    	$passwordCodif=md5($password);
    	//Conexón a la base de datos
    	$conexion = conectar();
    	//Consulta con los datos de login
    	$consulta="SELECT * FROM usuario WHERE usr='$usuario' AND pwd='$passwordCodif'";
    	$resultado=$conexion->query($consulta);
		//Sentencia que verifica que la cuenta exista en la base de datos.
		if($resultado->num_rows){
			$datos=mysqli_fetch_array($resultado);
			//Sentencia que verifica que la cuenta sea de administradr.
			if($datos['is_admin']==false){
				$_SESSION["tipoCuenta"]= "usuario";
				$_SESSION["idCuenta"]=$datos['idusuario'];
				$_SESSION["nomUsuario"]=$datos['usr'];
				header("location:index.php");
			}
			else{
				include("iniciarSesionUsuario.php");	
				?>
				<div class="credencialesErroneas">Esta cuenta no es de usuario</div>
				<?php
			}
		}
		else{			
			include("iniciarSesionUsuario.php");	
			?>
			<div class="credencialesErroneas">Las credenciales son incorrectas</div>
			<?php
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
    }
 ?> 

