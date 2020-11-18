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
		<title>Ver foro</title>
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
						<td align="right" class="opcionesAcceso"><a class="opcionesAcceso" href="index.php">Volver</a></td>
						<td align="right" class="opcionesAcceso"><a class="opcionesAcceso" href="iniciarSesionAdmin.php">Iniciar sesión como administrador</a></td>
						<td align="center" class="opcionesAcceso"><a class="opcionesAcceso" href="iniciarSesionUsuario.php">Iniciar sesión como usuario</a></td>
					</table>
					<ul class="busqueda">
						<form action="" method="GET" >
			            	<input class="busqueda" type="text" name="busquedaForo" size=30>
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
							<form action="" method="GET" >
			            		<input class="busqueda" type="text" name="busquedaForo" size=30>
			            		<input class="busqueda"type="submit" value="Buscar">
			        		</form>
			    		</ul></td>
						<td><ul class="listaAdmin">
							<a href="index.php" class="listaAdmin">Volver</a>
							<a href="verUsuarios.php?ver=true" class="listaAdmin">Ver usuarios</a>
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
							<form action="" method="GET" >
			            		<input class="busqueda" type="text" name="busquedaForo" size=30>
			            		<input class="busqueda"type="submit" value="Buscar">
			        		</form>
			    		</ul></td>
						<td><ul class="listaUsua">
							<a href="index.php" class="listaAdmin">Volver</a>
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

			 if(@$_REQUEST["foro"]!="yaEliminado"){
		 		//Se elimina el comentario al dar clic en el botón de eliminar comentario
		 		if(@$_REQUEST["foro"]=="eliminarComen"){
					$idR=@$_GET[idRes];
					$consultaEliminaComen="DELETE FROM respuesta WHERE idrespuesta= $idR;";
					if($conexion->query($consultaEliminaComen) == TRUE){
						echo "<p class='msjDatos'>Comentario eliminado</p>";
					}else{
						echo "<p class='msjDatos'>Ha ocurrido un error</p>";
					}
		 		}
		 		
    			//Consulta con los datos de login
    			$consulta="SELECT * FROM consulta WHERE idconsulta= $_GET[idFo]";
    			$resultado=$conexion->query($consulta);
				if($resultado->num_rows > 0){
					//Recorremos cada registro y obtenemos los valores de las columnas especificadas.========= 
					echo "<table border=2 class='tabla' width=100% cellpadding=4>
						<tr>
							<td class='celdaFor1'><p class='tablaTitulos'>ID Foro</p></td>
							<td class='celdaForo2'><p class='tablaTitulos'>Autor</p></td>
							<td class='celdaForo3'><p class='tablaTitulos'>Tema</p></td>
							<td><p class='tablaTitulos'>Fecha de publicación</p></td>
						</tr>";
					$idconsulta=0;
					$idAutoPubli=0;
					while($row = $resultado->fetch_assoc()){
						//Segunda consulta para obtener el nombre de usario de la tabla de usarios===========
						$consulta2="SELECT usr FROM usuario WHERE idusuario= $row[id_usuario]";
						$resultado2=$conexion->query($consulta2);
						$usuarioT=mysqli_fetch_array($resultado2);
						echo "<tr>
							<td class='celdaForo1'>".$row["idconsulta"]."</td>
							<td class='celdaForo2'>".$usuarioT["usr"]."</td>
							<td class='celdaForo3'>".$row["titulo"]."</td>
							<td>".$row["fecha_hora"]."</td>          
						</tr>
						<tr class='celdaTexto'>
							<td colspan=4><p class='celdaTexto'>".$row["descripcion"]."</p></td>
						</tr>";
						echo "</table> ";
						$idconsulta=$row['idconsulta'];
						$idAutoPubli=$row['id_usuario'];
					}
				}
				//Si un usario o cliente esta conectado podrá acceder
				if (isset($_SESSION["idCuenta"]) && @$_SESSION["tipoCuenta"]=="usuario" ||  @$_SESSION["tipoCuenta"] == "adimin") { 
					echo "<table width=100% cellpadding=4>
						<tr>
							<td align=center>";
								//Botón comentar, solo puede acceder un usario y no en admin
								if(@$_SESSION["tipoCuenta"]=="usuario"){
									echo "<form action='verForo.php?foro=comentario' method='get' class='botonSinSalto'>
										<input type='hidden' name='idFo' value= ".$idconsulta.">
										<input type='hidden' name='foro' value= 'comentar'>
										<input class='boton' type='submit' value='Comentar'>
									</form>";
								}
								//Botón eliminar, solo puede acceder el autor y el admin
								if($idAutoPubli==@$_SESSION["idCuenta"] || @$_SESSION["tipoCuenta"] == "adimin"){
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<form action='verForo.php?foro=eliminar' method='get' class='botonSinSalto'>
										<input type='hidden' name='idFo' value= ".$idconsulta.">
										<input type='hidden' name='foro' value= 'eliminar'>
										<input class='boton' type='submit' value='Eliminar'>
									</form>";
								}
							echo"</td>
						</tr>
					</table> ";
				}
				//Si el usario dió clic en el botón de comentar se mostrará el formulario================================
				if(@$_GET["foro"]=="comentar"){
					echo "
						<form action='verForo.php?foro=comentario' method='get' class='boton'>
							<input type='hidden' name='idFo' value= ".$idconsulta.">
							<input type='hidden' name='foro' value= 'comentar'>
							<input type='hidden' name='foro2' value= 'comentar2'>
							<p class='msjDatos'>".$_SESSION["nomUsuario"].":</p>
							: <textarea cols='80px' rows='5px' name='elComentario'></textarea>&nbsp;&nbsp;&nbsp;&nbsp;
							<input class='boton' type='submit' value='Enviar'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class='boton' type='reset' value='Limpiar'><br>
						</form>
					";
					//Si el comentario no esta vacío se guardarán los datos en la base=========================================.
					if(!(@$_GET['elComentario']=="")){
		    			$consulta3="INSERT INTO respuesta(respuesta, fecha_hora, id_consulta, id_usuario)" . "VALUES ('$_GET[elComentario]', CURRENT_TIMESTAMP(), $idconsulta, $_SESSION[idCuenta])"; 
		    			if($conexion->query($consulta3) == TRUE){
							echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Comentario enviado</p>";
						}else{
							echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Error:  $conexion->error</p>";
						}
				    }
				    else{
				    	if(@$_GET['foro2']=="comentar2"){
				    		echo "<br><p class='msjDatos'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Campo incompleto</p>";
				    	}
				    }
				}
				//Si el usario o admin dió clic en el botón de eliminar================================
				if(@$_GET["foro"]=="eliminar"){
					$consultaElim="DELETE FROM consulta WHERE idconsulta= $idconsulta";
					$consultaElimRes="DELETE FROM respuesta WHERE id_consulta= $idconsulta";
					if($conexion->query($consultaElim) == TRUE && $conexion->query($consultaElimRes)== TRUE){
						header("location:verForo.php?foro=yaEliminado");
					}else{
						echo "<p class='msjDatos'>Ha ocurrido un error</p>";
					}

				}
				//Sección de comentarios========================================================================
				//Consulta con los datos de respuestas
    			$consulta4="SELECT * FROM respuesta WHERE id_consulta = $idconsulta ORDER BY fecha_hora DESC;";
    			$resultado4=$conexion->query($consulta4);
				if($resultado4->num_rows > 0){
					//Recorremos cada registro y obtenemos los valores de las columnas especificadas. 
					echo "<br>";
					$idUsuarioResp=0;
					$idRespu=0;
					while($row = $resultado4->fetch_assoc()){
						//Se obtiene el valor del id_usario
						$idUsuarioResp=$row['id_usuario'];
						echo "<table border=2 class='tabla' width=80%>
						<tr>
							<td class='celdaFor1'><p class='tablaTitulos'>ID respuesta</p></td>
							<td class='celdaForo2'><p class='tablaTitulos'>Autor de la respuesta</p></td>
							<td class='celdaForo3'><p class='tablaTitulos'>Fecha de respuesta</p></td>
						</tr>";
						//consulta para obtener el nombre de usario de la tabla de usarios
						$consulta5="SELECT usr FROM usuario WHERE idusuario= $row[id_usuario]";
						$resultado5=$conexion->query($consulta5);
						$usuarioR=mysqli_fetch_array($resultado5);
						echo "<tr>
							<td class='celdaForo1'>".$row["idrespuesta"]."</td>
							<td class='celdaForo2'>".$usuarioR["usr"]."</td>
							<td class='celdaForo3'>".$row["fecha_hora"]."</td> ";
								//Botón eliminar comentario, solo puede acceder el autor y el admin
								if(@$_SESSION["idCuenta"]!=""){
									echo "<td align=center>";
									if($idUsuarioResp== @$_SESSION["idCuenta"] || $_SESSION["tipoCuenta"] == "adimin"){
										$idRespu=$row["idrespuesta"];
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<form action='verForo.php?foro=eliminarComen' method='get' class='boton'>
											<input type='hidden' name='idFo' value= ".$idconsulta.">
											<input type='hidden' name='idRes' value= ".$idRespu.">
											<input type='hidden' name='foro' value= 'eliminarComen'>
											<input class='boton' type='submit' value='Eliminar'>
										</form>";
									}
								echo "</td>";
								}        
						echo "</tr>
						<tr class='celdaTexto'>
							<td colspan=3><p class='celdaTexto'>".$row["respuesta"]."</p></td>
						</tr>

						";
						echo "</table> <br>";
					}
				}
				mysqli_close($conexion);
 			}
 			else{
 				echo "<p class='msjDatos'>La publicación ha sido eliminada</p>";
 			}?>
		</div>
	</body>
</html>