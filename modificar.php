<!--Programación de sistemas web-->
<!--Examen práctico del segundo parcial ISC 5°A-->
<!--Oscar Ganzález Esparza-->
<?php
  // Se accede a la sesión 
  session_name("Foro");
  session_start();
?>
<html>
	<head>
		<!--Formato de codificación UNICODE-->
		<meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="estilosCSS.css">
		<title>Modificar</title>
	</head>
	<body class="index">
		<?php if(@$_REQUEST["modi"]=="true" || @$_REQUEST["modi"]=="clic" || @$_REQUEST["modi"]=="modificar"){ ?>
		<!--Sección de encabezado===============================================================================-->
		 <header class=Encabezado>
			<section class=InfoExamen>
				<table border=0 width=100%>
					<tr align=center>
						<td class=letrasInfoExamen>Programación de sistemas web ISC 5°A</td>
						<td class=letrasInfoExamen>|</td>
						<td class=letrasInfoExamen>Examen práctico del segundo parcial</td>
						<td class=letrasInfoExamen>|</td>
						<td class=letrasInfoExamen>Oscar Ganzález Esparza</td>
					</tr>
				</table>
			</section>
			<section class=MenuPrincipal>
				<table border=0 width=100%>
					<td class="foroTitulo" align="left">
						Episteme Forum <br><p class="foroSubtitulo">Foro de variedades</p>
					</td>
					<td align="left"><p class="opcionesAcceso">Bienvenido administrador &nbsp;&nbsp; <?php echo "$_SESSION[nomUsuario]"; ?></p></td>
				</table>
				<ul class="listaAdmin">
					<a href="verUsuarios.php?ver=true" class="listaAdmin">Ver usuarios</a>
					<a href="index.php" class="listaAdminSele">Modificar</a>
					<a href="altas.php?alta=true" class="listaAdmin">Dar de alta</a>
					<a href="bajas.php?baja=true" class="listaAdmin">Dar de baja</a>
					<a href="cerrarSesion.php?cerrar=true" class="listaAdmin">Cerrar sesión</a>
				</ul>
			</section>
		</header>
		<!--Sección de formulario para modificar===============================================================================-->
		<div class="marco" >
			<br>
			<fieldset class="datosCuenta">
					<legend class="tituloDatos">Ingrese el ID de la cuenta que desea modificar</legend><br>
					 <form action="modificar.php?modi=clic" method="post" >
					 	ID: <input type="text" name="idCuenta" size=20> <br><br><br>
						<input class="boton" type="submit" value="Buscar ID">
					</form>
			  </fieldset>
			  <?php 
			  //Sentencia para verificar que el campos hayan sido ingresados
			  	if(!(@$_POST['idCuenta']=="")){
			  		include("conexion.php");
	    			//Conexón a la base de datos
	    			$conexion = conectar();
	    			//Consulta con los datos de login
	    			$consulta="SELECT * FROM usuario WHERE idusuario=$_POST[idCuenta];";
    				$resultado=$conexion->query($consulta);
    				if($resultado->num_rows > 0){
						//Recorremos cada registro y obtenemos los valores de las columnas especificadas. 
						echo "<br><table border=2 class='tabla' width=100%>
						<tr>
							<td><p class='tablaTitulos'>ID de Usuario</p></td>
							<td><p class='tablaTitulos'>Cuenta</p></td>
							<td><p class='tablaTitulos'>Contraseña</p></td>
							<td><p class='tablaTitulos'>Nombre</p></td>
							<td><p class='tablaTitulos'>Apellido paterno</p></td>
							<td><p class='tablaTitulos'>Apellido materno</p></td>
							<td><p class='tablaTitulos'>Tipo de cuenta</p></td>
						</tr>";
						while($row = $resultado->fetch_assoc()){
							//Se determina el tipo de usario
							if($row["is_admin"]){
								$tipoCuenta="Administrador";
							}
							else{
								$tipoCuenta="Usuario";
							}
							echo "<tr>
								<td>".$row["idusuario"]."</td>
								<td>".$row["usr"]."</td>
								<td>".$row["pwd"]."</td> 
								<td>".$row["nombre"]."</td> 
								<td>".$row["ape_pat"]."</td>
								<td>".$row["ape_mat"]."</td>
								<td>".$tipoCuenta."</td>     
							</tr>";
						$idU=$row["idusuario"];
						}
						echo "</table>";
						?>
						<br>
						<!--Formulario para modificar la cuanta===============================================================-->
						<fieldset class="datosCuenta">
							<legend class="tituloDatos">Ingrese todos los campos para modificar la cuenta</legend><br>
							 <form action="modificar.php?modi=modificar" method="post" >
							 	<input type='hidden' name='idU' value=<?php echo "$idU"?>>
							 	Nombre de la Cuenta: <input type="text" name="cuenta" size=20> <br><br>
								Contraseña: <input type="text" name="pass" size=20> <br><br>
								Nombre: <input type="text" name="nom" size=20> <br><br>
								Apellido paterno: <input type="text" name="apePa" size=20> <br><br>
								Apellido materno: <input type="text" name="apeMa" size=20> <br><br>
								Tipo de cuenta:&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" name="tipoCuenta" value=1>Administrador&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" name="tipoCuenta" value=0>Usuario
								<br><br><br>
								<input class="boton" type="submit" value="Modificar cuenta">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="boton" type="reset" value="Limpiar"><br>
							</form>
							<form action="modificar.php?modi=true" method="post" >
								<input class="boton" type="submit" value="Cancelar">
							</form>
			  			</fieldset>
						<?php
					}
					else{
						echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID no encontrado</p>";
					}	
			    }
			    else{
			    	if(@$_REQUEST["modi"]=="clic"){
			    		echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Campo incompleto </p>";
			    	}
			    }
			    //En caso de que se le diera clic a modificar
			    if(@$_REQUEST["modi"]=="modificar"){
			    	//Sentencia para verificar que todos los campos hayan sido ingresados
				  	if(!(@$_POST['cuenta']=="") AND !(@$_POST['pass']=="") AND !(@$_POST['nom']=="") AND !(@$_POST['apePa']=="") AND !(@$_POST['apeMa']=="") AND !(@$_POST['tipoCuenta']=="")){
		    			include("conexion.php");
	    				//Conexón a la base de datos
	    				$conexion = conectar();
		    			//Se encripta la contraseña con md5
		    			$passEncrip=md5(@$_POST[pass]);
		    			//Consulta con los datos para modificar
		    			$consulta="UPDATE usuario SET usr='$_POST[cuenta]', pwd='$passEncrip', nombre='$_POST[nom]', ape_pat='$_POST[apePa]', ape_mat='$_POST[apeMa]', is_admin=$_POST[tipoCuenta] WHERE idusuario= $_POST[idU] "; 
		    			if($conexion->query($consulta) == TRUE){
							echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; La cuenta ha sido modificada</p>";
						}else{
							echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Error:  $conexion->error</p>";
						}
				    	mysqli_close($conexion);
				    }
				    else{
				    	if(@$_REQUEST["modi"]=="modificar"){
				    		echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Campos incompletos</p>";
				    	}	
				    }
			    }
			  ?>
		</div>		
		<?php }?>
	</body>
</html>