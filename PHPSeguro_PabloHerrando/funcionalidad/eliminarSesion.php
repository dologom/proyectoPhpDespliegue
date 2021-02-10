<?php

	include 'conectarBD.php';

	session_start();
	$nick = $_SESSION['Usuario'];

	$method = 'blowfish';
	$pass = 'Génesis 1:3-5';
	$iv = '12345678';
	$iv = substr(hash('sha256',$iv),0,8);

	$crypNick = base64_encode(openssl_encrypt($nick, $method, $pass, false, $iv));

	$statement = $db->prepare("DELETE FROM alumno WHERE nick = ?");
	$statement->bindParam(1, $crypNick);
	$statement->execute();

	session_destroy();

	header("refresh:2;url= ../index.php");
		exit("Se ha eliminado esta sesion");
?>