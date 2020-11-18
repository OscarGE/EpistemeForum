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
		<title>Foro</title>
	</head>
	<body class="index">
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
				<!--Caso en el que no se inicó sesión=====================--->
				<?php if (!(isset($_SESSION["idCuenta"]))) { ?>
					<table border=0 width=100%>
						<td class="foroTitulo" align="left">
							Episteme Forum <br><p class="foroSubtitulo">Foro de variedades</p>
						</td>
						<?php if(@$_REQUEST["in"]=="buscar"){
								echo "<td align='right' class='opcionesAcceso'> <a href='index.php' class='opcionesAcceso'>Volver</a></td>";
					 	} ?>
						<td align="right" class="opcionesAcceso"><a class="opcionesAcceso" href="iniciarSesionAdmin.php">Iniciar sesión como administrador</a></td>
						<td align="center" class="opcionesAcceso"><a class="opcionesAcceso" href="iniciarSesionUsuario.php">Iniciar sesión como usuario</a></td>
					</table>
					<ul class="busqueda">
						<form action="index.php?in=buscar" method="GET" >
			            	<input type='hidden' name='in' value= 'buscar'>
			            	<input class="busqueda" type="text" name="busquedaForo" size=30 placeholder="Buscar tema">
			            	<input class="busqueda"type="submit" value="Buscar">
			        	</form>
			    	</ul>
				<!--Caso en el que se inicó sesión como admin=====================--->	
				<?php } elseif (isset($_SESSION["idCuenta"]) && @$_SESSION["tipoCuenta"]=="adimin") { ?>
					<table border=0 width=100%>
						<td class="foroTitulo" align="left">
							Episteme Forum <br><p class="foroSubtitulo">Foro de variedades</p>
						</td>
						<td align="left"><p class="opcionesAcceso">Bienvenido administrador &nbsp;&nbsp; <?php echo "$_SESSION[nomUsuario]"; ?></p></td>
					</table>
					<table border=0 width=100%>
						<td><ul class="busqueda">
							<form action="index.php?in=buscar" method="GET" >
			            		<input type='hidden' name='in' value= 'buscar'>
			            		<input class="busqueda" type="text" name="busquedaForo" size=30  placeholder="Buscar tema">
			            		<input class="busqueda"type="submit" value="Buscar">
			        		</form>
			    		</ul></td>
						<td><ul class="listaAdmin">
							<?php if(@$_REQUEST["in"]=="buscar"){
								echo "<a href='index.php' class='listaAdmin'>Volver</a>";
					 		} ?>
							<a href="verUsuarios.php?ver=true" class="listaAdmin">Ver usuarios</a>
							<a href="modificar.php?modi=true" class="listaAdmin">Modificar</a>
							<a href="altas.php?alta=true" class="listaAdmin">Dar de alta</a>
							<a href="bajas.php?baja=true"" class="listaAdmin">Dar de baja</a>
							<a href="cerrarSesion.php?cerrar=true" class="listaAdmin">Cerrar sesión</a>
						</ul></td>
					</table>
				<!--Caso en el que se inicó sesión como usario=====================--->	
				<?php } elseif (isset($_SESSION["idCuenta"]) && @$_SESSION["tipoCuenta"]=="usuario") { ?>
					<table border=0 width=100%>
						<td class="foroTitulo" align="left">
							Episteme Forum <br><p class="foroSubtitulo">Foro de variedades</p>
						</td>
						<td align="left"><p class="opcionesAcceso">Bienvenido usuario &nbsp;&nbsp; <?php echo "$_SESSION[nomUsuario]"; ?></p></td>
					</table>
					<table border=0 width=100%>
						<td><ul class="busqueda">
							<form action="index.php?in=buscar" method="GET" >
			            		<input type='hidden' name='in' value= 'buscar'>
			            		<input class="busqueda" type="text" name="busquedaForo" size=30  placeholder="Buscar tema">
			            		<input class="busqueda"type="submit" value="Buscar">
			        		</form>
			    		</ul></td>
						<td><ul class="listaUsua">
							<?php if(@$_REQUEST["in"]=="buscar"){
								echo "<a href='index.php' class='listaAdmin'>Volver</a>";
					 		} ?>
							<a href="publicar.php?publi=true" class="listaUsua">Crear una nueva publicación</a>
							<a href="cerrarSesion.php?cerrar=true" class="listaUsua">Cerrar sesión</a>
						</ul></td>
					</table>	
				<?php }?>
			</section>
		</header>
			<!--Sección del marco de Foro===============================================================================-->
		<div class="marcoForo">
		 	<?php
    			include("conexion.php");
    			//Conexón a la base de datos
    			$conexion = conectar();
    			//Consulta en caso que se ingresaran datos a la barra de busqueda
    			if(@$_REQUEST["in"]=="buscar"){
					$busca=$_GET["busquedaForo"];
					$consulta="SELECT * FROM consulta WHERE titulo LIKE '%$busca%'ORDER BY fecha_hora DESC;";
		 		}
		 		else{
					$consulta="SELECT * FROM consulta ORDER BY fecha_hora DESC;";
		 		}
    			
    			$resultado=$conexion->query($consulta);
				if($resultado->num_rows > 0){
					//Recorremos cada registro y obtenemos los valores de las columnas especificadas. 
					while($row = $resultado->fetch_assoc()){
						echo "<table border=2 class='tabla' width=100%>
						<tr>
							<td class='celdaFor1'><p class='tablaTitulos'>ID Foro</p></td>
							<td class='celdaForo2'><p class='tablaTitulos'>Autor</p></td>
							<td class='celdaForo3'><p class='tablaTitulos'>Tema</p></td>
							<td><p class='tablaTitulos'>Fecha de publicación</p></td>
						</tr>";
						//Segunda consulta para obtener el nombre de usario de la tabla de usarios
						$consulta2="SELECT usr FROM usuario WHERE idusuario= $row[id_usuario]";
						$resultado2=$conexion->query($consulta2);
						$usuarioT=mysqli_fetch_array($resultado2);
						echo "<tr>
							<td class='celdaForo1'>".$row["idconsulta"]."</td>
							<td class='celdaForo2'>".$usuarioT["usr"]."</td>
							<td class='celdaForo3'>".$row["titulo"]."</td>
							<td>".$row["fecha_hora"]."</td> 
							<td align=center>
								<form action='verForo.php' method='get' class='boton'>
									<input type='hidden' name='idFo' value= ".$row['idconsulta'].">
									<input class='boton' type='submit' value='Ver el foro'>
								</form>
							</td>           
						</tr>";
						echo "</table> <br><br>";
					}
				}
				mysqli_free_result($resultado);
				mysqli_close($conexion);
  
 			?>
		</div>

	</body>
</html>