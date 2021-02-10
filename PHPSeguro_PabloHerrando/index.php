<?php 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulario</title>
</head>
<body>
	<form action="funcionalidad/login.php" method="post">
		<label>Nick</label>
		<input type="text" name="nick">
		<label>Contraseña</label>
		<input type="password" name="contrasena">
		<input type="submit" name="Acceder">
	</form>
	<a href="funcionalidad/formularioRegistro.php">Registrarse</a>
</body>
</html>