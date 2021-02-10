<?php

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulario</title>
</head>

<body>
	<form action="registro.php" method="post">
		<label>Nick</label><br>
		<input type="text" name="nick"><br>
		<label>Contraseña</label><br>
		<input type="password" name="contrasena"><br>
		<label>Correo Electrónico</label><br>
		<input type="email" name="correo"><br>
		<label>Nombre</label><br>
		<input type="text" name="nombre"><br>
		<label>Primer Apellido</label><br>
		<input type="text" name="apellido1"><br>
		<label>Segundo Apellido</label><br>
		<input type="text" name="apellido2"><br>
		<label>Teléfono</label><br>
		<input type="text" name="telefono"><br>
		<input type="submit" name="Registrar">
	</form>
	<a href="../index.php">Logearse</a>
</body>
</html>