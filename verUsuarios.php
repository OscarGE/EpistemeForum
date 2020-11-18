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
		<title>Ver usuarios</title>
	</head>
	<body class="index">
		<?php if(@$_REQUEST["ver"]=="true"){ ?>
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
					<a href="index.php" class="listaAdminSele">Ver usuarios</a>
					<a href="modificar.php?modi=true" class="listaAdmin">Modificar</a>
					<a href="altas.php?alta=true" class="listaAdmin">Dar de alta</a>
					<a href="bajas.php?baja=true" class="listaAdmin">Dar de baja</a>
					<a href="cerrarSesion.php?cerrar=true" class="listaAdmin">Cerrar sesión</a>
				</ul>
			</section>
		</header>
		<!--Sección del marco de tabla===============================================================================-->
		<div class="marcoTabla">
			<?php
    			include("conexion.php");
    			//Conexón a la base de datos
    			$conexion = conectar();
    			//Consulta con los datos de login
    			$consulta="SELECT * FROM usuario;";
    			$resultado=$conexion->query($consulta);
				if($resultado->num_rows > 0){
					//Recorremos cada registro y obtenemos los valores de las columnas especificadas. 
					echo "<table border=2 class='tabla' width=100%>
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
				}
				mysqli_free_result($resultado);
				mysqli_close($conexion);
  
 			?> 	
		</div>
		<?php }?>
	</body>
</html>