<?php
include 'conectarBD.php';

function sanitar($string){
	$filtrado= filter_var($string, FILTER_SANITIZE_STRING);
	$final = strip_tags(trim($filtrado));
	if (empty($final)) {
		echo "Error. Hay campos vacíos, asegurese de rellenar todos los campos ";
	}else{
		return $final;
	}
}
session_start();

$nick = $_POST['nick'];
$correo = $_POST['correo'];
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$telefono = $_POST['telefono'];
$id = $_POST['id'];

//Variables Encriptado.
$method = 'blowfish';
$pass = 'Génesis 1:3-5';
$iv = '12345678';
$iv = substr(hash('sha256',$iv),0,8);

//Sanitación y control de campos.
$nickSan=sanitar($nick);
//echo $nickSan;
$correoSan=sanitar($correo);
$nombreSan=sanitar($nombre);
$apellido1San=sanitar($apellido1);
$apellido2San=sanitar($apellido2);
$telefonoSan=sanitar($telefono);

$crypNick = base64_encode(openssl_encrypt($nickSan, $method, $pass, false, $iv));
//$decrypNick = openssl_decrypt(base64_decode($crypNick),$method,$pass, false, $iv);
//echo $decrypNick;
//echo $crypNick;
$crypCorreo = base64_encode(openssl_encrypt($correoSan, $method, $pass, false, $iv));
//$decrypCorreo = openssl_decrypt(base64_decode($crypCorreo),$method,$pass, false, $iv);
//echo $decrypCorreo;
//echo $crypCorreo;
$crypNombre = base64_encode(openssl_encrypt($nombreSan, $method, $pass, false, $iv));
//$decrypNombre = openssl_decrypt(base64_decode($crypNombre),$method,$pass, false, $iv);
//echo $decrypNombre;
$crypApellido1 = base64_encode(openssl_encrypt($apellido1San, $method, $pass, false, $iv));
//$decrypApellido1 = openssl_decrypt(base64_decode($crypApellido1),$method,$pass, false, $iv);
//echo $decrypApellido1;
$crypApellido2 = base64_encode(openssl_encrypt($apellido2San, $method, $pass, false, $iv));
//$decrypApellido2 = openssl_decrypt(base64_decode($crypApellido2),$method,$pass, false, $iv);
//echo $decrypApellido2;
$crypTelefono = base64_encode(openssl_encrypt($telefonoSan, $method, $pass, false, $iv));
//$decrypTelefono = openssl_decrypt(base64_decode($crypTelefono),$method,$pass, false, $iv);
//echo $decrypTelefono;
//echo $nickSan.$nombreSan.$apellido1San.$apellido2San.$telefonoSan;
// Prepare
$stmt = $db->prepare("UPDATE alumno SET nick=?, apellido1=?, apellido2=?, mail=?, telefono=?, nombre=? WHERE id= ? ");
// Bind
$stmt->bindParam(1, $crypNick);
$stmt->bindParam(2, $crypApellido1);
$stmt->bindParam(3, $crypApellido2);
$stmt->bindParam(4, $crypCorreo);
$stmt->bindParam(5, $crypTelefono);
$stmt->bindParam(6, $crypNombre);
$stmt->bindParam(7, $id);
// Excecute
$resultado = $stmt->execute();
$_SESSION['Usuario'] = $nick;

if ($resultado) {
	header("refresh:2;url= perfil.php");
		exit("Perfil modificado con exito");
}else{
	echo "Error en la modificación de perfil";
}
?>