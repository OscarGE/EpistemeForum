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
		<title>Dar de alta</title>
	</head>
	<body class="index">
		<?php if(@$_REQUEST["alta"]=="true" || @$_REQUEST["alta"]=="clic"){ ?>
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
					<a href="index.php" class="listaAdminSele">Dar de alta</a>
					<a href="bajas.php?baja=true" class="listaAdmin">Dar de baja</a>
					<a href="cerrarSesion.php?cerrar=true" class="listaAdmin">Cerrar sesión</a>
				</ul>
			</section>
		</header>
		<!--Sección de formulario para altas===============================================================================-->
		<div class="marco" >
			<br>
			<fieldset class="datosCuenta">
					<legend class="tituloDatos">Ingrese todos los campos para dar de alta a una nueva cuenta</legend><br>
					 <form action="altas.php?alta=clic" method="post" >
					 	Nombre de la Cuenta: <input type="text" name="cuenta" size=20> <br><br>
						Contraseña: <input type="text" name="pass" size=20> <br><br>
						Nombre: <input type="text" name="nom" size=20> <br><br>
						Apellido paterno: <input type="text" name="apePa" size=20> <br><br>
						Apellido materno: <input type="text" name="apeMa" size=20> <br><br>
						Tipo de cuenta:&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="tipoCuenta" value=1>Administrador&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="tipoCuenta" value=0>Usuario
						<br><br><br>
						<input class="boton" type="submit" value="Crear cuenta">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="boton" type="reset" value="Limpiar"><br>
					</form>
			  </fieldset>
			  <?php 
			  //Sentencia para verificar que todos los campos hayan sido ingresados
			  	if(!(@$_POST['cuenta']=="") AND !(@$_POST['pass']=="") AND !(@$_POST['nom']=="") AND !(@$_POST['apePa']=="") AND !(@$_POST['apeMa']=="") AND !(@$_POST['tipoCuenta']=="")){
			  		include("conexion.php");
	    			//Se encripta la contraseña con md5
	    			$passEncrip=md5(@$_POST[pass]);
	    			//Conexón a la base de datos
	    			$conexion = conectar();
	    			//Consulta con los datos de login
	    			$consulta="INSERT INTO usuario(usr, pwd, nombre, ape_pat, ape_mat, is_admin)" . "VALUES ('$_POST[cuenta]', '$passEncrip', '$_POST[nom]', '$_POST[apePa]', '$_POST[apeMa]', $_POST[tipoCuenta] )"; 
	    			if($conexion->query($consulta) == TRUE){
						echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; La cuenta ha sido creada</p>";
					}else{
						echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Error:  $conexion->error</p>";
					}
					mysqli_close($conexion);
			    }
			    else{
			    	if(@$_REQUEST["alta"]=="clic"){
			    		echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Campos incompletos</p>";
			    	}	
			    }
			  ?>
		</div>		
		<?php }?>
	</body>
</html>