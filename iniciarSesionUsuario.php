<!--Programación de sistemas web-->
<!--Examen práctico del segundo parcial ISC 5°A-->
<!--Oscar Ganzález Esparza-->
<html>
	<head>
		<!--Formato de codificación UNICODE-->
		<meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="estilosCSS.css">
		<title>Iniciar sesión como usuario</title>
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
				<table border=0 width=100%>
					<tr>
						<td class="foroTitulo2" align="center">
							Episteme Forum
							<p class="foroSubtitulo2">Foro de variedades</p>
						</td>
					</tr>
				</table>
			</section>
		</header>
		<!--Sección de login de administrador===============================================================================-->
		<div class="login">
			<table  border=0 width=100%>
				<tr>
					<td><p class="tituloIniciarSesionAdmin">Iniciar sesión como usuario</p></td>
				</tr>
				<tr>
					<td align="center">
						<!--formulario de usuario administrador-->
						<form action="verificarUsuario.php" method="post">
				            <input type="hidden" name="autentiBan" value="true">
				                <p class="usuarioYpass1">Usuario</p>
				                <input class="usuarioYpass" type="usuario" name="usuario" size=20 maxlength=18><br>
				                <p class="usuarioYpass2">Contraseña</p>
				                <input class="usuarioYpass" type="password" name="password" size=20 maxlength=18>
				                <br><br><br><br>
								<input class="boton" type="submit" value="Acceder">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="boton" type="reset" value="Limpiar"><br>
            			</form>
					</td>
				</tr>
			</table>
			<a href="index.php" class="volver">&nbsp; Volver</a>
		</div>
	</body>
</html> 