<?php

include 'conectarBD.php';

$nick = $_POST['nick'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$telefono = $_POST['telefono'];

//Sanitación y control de campos.
	//Nick.
if(!empty($nick)){
	$nickSan = filter_var($nick, FILTER_SANITIZE_STRING);
	$newNick = strip_tags(trim($nickSan));
	//echo $newNick;
}else{
	echo "El campo nick esta vacío";
}
	//Contrasena.
if(!empty($contrasena)){
	$contrasenaSan = filter_var($contrasena, FILTER_SANITIZE_STRING);
	$newContrasena = strip_tags(trim($contrasenaSan));
	//echo $newContrasena;
}else{
	echo "El campo contrasena esta vacío";
}
	//E-mail.
if(!empty($correo)){
	$correoSan = filter_var($correo, FILTER_SANITIZE_EMAIL);
	$newCorreo = strip_tags(trim($correoSan));
	//echo $newCorreo;
}else{
	echo "El campo e-mail esta vacío";
}
	//Nombre
if(!empty($nombre)){
	$nombreSan = filter_var($nombre, FILTER_SANITIZE_STRING);
	$newNombre = strip_tags(trim($nombreSan));
	//echo $newNombre;
}else{
	echo "El campo nombre esta vacío";
}
	//Apellido1.
if(!empty($apellido1)){
	$apellido1San = filter_var($apellido1, FILTER_SANITIZE_STRING);
	$newApellido1 = strip_tags(trim($apellido1San));
	//echo $newApellido1;
}else{
	echo "El campo apellido1 esta vacío";
}

	//Apellido2.
if(!empty($apellido2)){
	$apellido2San = filter_var($apellido2, FILTER_SANITIZE_STRING);
	$newApellido2 = strip_tags(trim($apellido2San));
	//echo $newApellido2;
}else{
	echo "El campo apellido2 esta vacío";
}

	//Telefono
if(!empty($telefono)){
	$telefonoSan = filter_var($telefono, FILTER_SANITIZE_STRING);
	$newTelefono = strip_tags(trim($telefonoSan));
	//echo $newTelefono;
}else{
	echo "El campo telefono esta vacío";
}

//Variables para encriptar

$method = 'blowfish';
$pass = 'Génesis 1:3-5';
$iv = '12345678';
//Obligatorio iv de 8 caracteres.
$iv = substr(hash('sha256',$iv),0,8);
	//Nick.
$crypNick = openssl_encrypt ($newNick, $method, $pass, false, $iv);
$codNick = base64_encode($crypNick);
//echo "<br>".$codNick;
	//Password.
$hashContrasena = hash('sha3-512' , $contrasena);
	//Correo.
$crypCorreo = openssl_encrypt ($newCorreo, $method, $pass, false, $iv);
$codCorreo = base64_encode($crypCorreo);
//echo "<br>".$codCorreo;
	//Nombre.
$crypNombre = openssl_encrypt ($newNombre, $method, $pass, false, $iv);
$codNombre = base64_encode($crypNombre);
//echo "<br>".$codNombre;
	//Apellido1
$crypApellido1 = openssl_encrypt ($newApellido1, $method, $pass, false, $iv);
$codApellido1 = base64_encode($crypApellido1);
//echo "<br>".$codApellido1;
	//Apellido2.
$crypApellido2 = openssl_encrypt ($newApellido2, $method, $pass, false, $iv);
$codApellido2 = base64_encode($crypApellido2);
//echo "<br>".$codApellido2;
	//Telefono.
$crypTelefono = openssl_encrypt ($newTelefono, $method, $pass, false, $iv);
$codTelefono = base64_encode($crypTelefono);
//echo "<br>".$codTelefono;

// Prepare
$stmt = $db->prepare("INSERT INTO alumno (nick, contrasena, apellido1, apellido2, mail, telefono, nombre) VALUES (?, ?, ?, ?, ?, ?, ?)");
// Bind
$stmt->bindParam(1, $codNick);
$stmt->bindParam(2, $hashContrasena);
$stmt->bindParam(3, $codApellido1);
$stmt->bindParam(4, $codApellido2);
$stmt->bindParam(5, $codCorreo);
$stmt->bindParam(6, $codTelefono);
$stmt->bindParam(7, $codNombre);
// Excecute
$stmt->execute();

header("refresh:5;url= ../index.php");
		exit("Usuario Registrado con exito");
?>