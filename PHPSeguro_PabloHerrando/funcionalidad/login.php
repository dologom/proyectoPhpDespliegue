<?php 

//Conexión con la base de datos

include 'conectarBD.php';

$nick = $_POST['nick'];
$contrasena = $_POST['contrasena'];

if(!empty($nick)){
	$nickSan = filter_var($nick, FILTER_SANITIZE_STRING);
	$newNick = strip_tags(trim($nickSan));
}else{
	echo "El campo nick esta vacío";
}

if (!empty($contrasena)) {
	$nickSan = filter_var($nick, FILTER_SANITIZE_STRING);
	$newNick = strip_tags(trim($nickSan));
}else{
	echo "El campo nick esta vacío";
}
$method = 'blowfish';
$pass = 'Génesis 1:3-5';
$iv = '12345678';

//Obligatorio iv de 8 caracteres.
$iv = substr(hash('sha256',$iv),0,8);
	//Nick.
$crypNick = openssl_encrypt ($nick, $method, $pass, false, $iv);
$codNick = base64_encode($crypNick);
$hashed = hash('sha3-512' , $contrasena);
	//Consulta
$stmt = $db -> prepare("SELECT * FROM alumno WHERE nick = ? AND contrasena=?" ) ;
$stmt -> bindParam(1, $codNick);
$stmt -> bindParam(2, $hashed);
$stmt->execute();

$resultado = $stmt->fetch();
if(isset($resultado['nick'])){
	session_start();
	$_SESSION['Usuario']= $nick;
	header("Location: perfil.php");
}else{
	header("refresh:5; Location: index.php");
		exit("Usuario o contraseña incorrectos");
}
?>