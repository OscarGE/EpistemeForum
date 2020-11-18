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
		<title>Dar de baja</title>
	</head>
	<body class="index">
		<?php if(@$_REQUEST["baja"]=="true" || @$_REQUEST["baja"]=="clic" || @$_REQUEST["baja"]=="eliminado" || @$_REQUEST["baja"]=="error"){ ?>
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
					<a href="modificar.php?modi=true" class="listaAdmin">Modificar</a>
					<a href="altas.php?alta=true" class="listaAdmin">Dar de alta</a>
					<a href="index.php" class="listaAdminSele">Dar de baja</a>
					<a href="cerrarSesion.php?cerrar=true" class="listaAdmin">Cerrar sesión</a>
				</ul>
			</section>
		</header>
		<!--Sección de formulario para bajas===============================================================================-->
		<div class="marco" >
			<br>
			<fieldset class="datosCuenta">
					<legend class="tituloDatos">Ingrese el ID de la cuenta que desea eliminar</legend><br>
					 <form action="bajas.php?baja=clic" method="post" >
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
						}
						echo "</table>";
						?>
						<br>
						<!--Formulario para eliminar la cuanta===============================================================================-->
						<form action="bajasEliminar.php" method="post" class="boton">
							<input type="hidden" name="id" value="<?php echo @$_POST[idCuenta];?>">
							<input class="boton" type="submit" value="Eliminar">
						</form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<form action="bajas.php?baja=true" method="post"  class="boton">
							<input class="boton" type="submit" value="Cancelar">
						</form>
						<?php
					}
					else{
						echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID no encontrado</p>";
					}	
	    			mysqli_free_result($resultado);
					mysqli_close($conexion);
			    }
			    else{
			    	if(@$_REQUEST["baja"]=="clic"){
			    		echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Campo incompleto </p>";
			    	}
			    }
			    if(@$_REQUEST["baja"]=="eliminado"){
			    	echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; La cuenta ha sido eliminada</p>";
			    }
			    if(@$_REQUEST["baja"]=="error"){
			    	echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ha ocurrido un error, la cuenta no ha sido eliminada</p>";
			    }
			  ?>
		</div>		
		<?php }?>
	</body>
</html>