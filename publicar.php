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
		<title>Nueva publicación</title>
	</head>
	<body class="index">
		<?php if(@$_REQUEST["publi"]=="true" || @$_REQUEST["publi"]=="clic"){ ?>
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
				<td align="left"><p class="opcionesAcceso">Bienvenido usuario &nbsp;&nbsp; <?php echo "$_SESSION[nomUsuario]"; ?></p></td>
			</table>
			<ul class="listaUsua">
				<a href="index.php?publi=true" class="listaUsuaSele">Crear una nueva publicación</a>
				<a href="cerrarSesion.php?cerrar=true" class="listaUsua">Cerrar sesión</a>
			</ul>
			</section>
		</header>
		<!--Sección de publicación===============================================================================-->
		<div class="marcoPublicacion" >
			<br>
			<!--Formulario de publicación -->
			<fieldset class="datosPublicacion">
					<legend class="tituloTema">Nueva publicación</legend><br>
					 <form action="publicar.php?publi=clic" method="post" >
					 	Ingrese el tema: <input type="text" name="tema" size=59> <br><br>
					 	Consulta: <br> <textarea cols="80px" rows="18px" name="consulta"></textarea> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="boton" type="submit" value="Publicar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="boton" type="reset" value="Limpiar"><br>
					</form>
			  </fieldset>
			  <?php 
			  //Sentencia para verificar que todos los campos hayan sido ingresados
			  	if(!(@$_POST['tema']=="") AND !(@$_POST['consulta']=="")){
			  		include("conexion.php");
	    			//Conexón a la base de datos
	    			$conexion = conectar();
	    			//Consulta con los datos de la publicación
	    			$consultaSql="INSERT INTO consulta(titulo, descripcion, fecha_hora, id_usuario)" . "VALUES ('$_POST[tema]', '$_POST[consulta]', CURRENT_TIMESTAMP(), $_SESSION[idCuenta])"; 
	    			if($conexion->query($consultaSql) == TRUE){
						echo "<p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nueva publicación en el foro</p>";
					}else{
						echo "<p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Error:  $conexion->error</p>";
					}
					mysqli_close($conexion);
			    }
			    else{
			    	if(@$_REQUEST["publi"]=="clic"){
			    		echo "<p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Campos incompletos</p>";
			    	}	
			    }
			  ?>
		</div>	
		<?php } ?>
	</body>
</html>