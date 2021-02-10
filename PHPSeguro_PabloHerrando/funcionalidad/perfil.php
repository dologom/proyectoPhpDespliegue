<?php 

include 'conectarBD.php';
session_start();
echo "Hola ".$_SESSION['Usuario'];

$nick = $_SESSION['Usuario'];

$method = 'blowfish';
$pass = 'Génesis 1:3-5';
$iv = '12345678';
$iv = substr(hash('sha256',$iv),0,8);

$crypNick = openssl_encrypt ($nick, $method, $pass, false, $iv);
$codNick = base64_encode($crypNick);
//echo $codNick;
$stmt = $db -> prepare("SELECT * FROM alumno WHERE nick = ?") ;
$stmt -> bindParam(1, $codNick);
$stmt->execute();

$resultado=$stmt->fetch();
//var_dump($resultado);
$nick= openssl_decrypt(base64_decode($resultado['nick']),$method,$pass, false, $iv);
//echo $nick;
$correo = openssl_decrypt(base64_decode($resultado['mail']),$method,$pass, false, $iv);
$nombre = openssl_decrypt(base64_decode($resultado['nombre']),$method,$pass, false, $iv);
$apellido1 = openssl_decrypt(base64_decode($resultado['apellido1']),$method,$pass, false, $iv);
$apellido2 = openssl_decrypt(base64_decode($resultado['apellido2']),$method,$pass, false, $iv);
$telefono = openssl_decrypt(base64_decode($resultado['telefono']),$method,$pass, false, $iv);

$id = $resultado['id'];
//$decoder=openssl_decrypt(base64_decode("4EY8b+UHe6My05n1Se5LwQ=="),$method,$pass, false, $iv);

?>


<br>
<br>
	<form action="modificarPerfil.php" method="post">
		<label>Nick</label><br>
		<input type="text" name="nick" value="<?php echo $nick; ?>"><br><br>
		<label>Correo Electrónico</label><br>
		<input type="email" name="correo" value="<?php echo $correo; ?>"><br><br>
		<label>Nombre</label><br>
		<input type="text" name="nombre"value="<?php echo $nombre; ?>"><br><br>
		<label>Primer Apellido</label><br>
		<input type="text" name="apellido1" value="<?php echo $apellido1; ?>"><br><br>
		<label>Segundo Apellido</label><br>
		<input type="text" name="apellido2" value="<?php echo $apellido2; ?>"><br><br>
		<label>Teléfono</label><br>
		<input type="text" name="telefono" value="<?php echo $telefono; ?>"><br><br>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="submit" name="Modificar" value="Modificar">
	</form>

	<a href="cerrarSesion.php">Cerrar Sesion</a><br><br><br>
	<a href="eliminarSesion.php">Eliminar Sesion</a><br><br><br>


