<?php

$method = 'blowfish';
$pass = 'Génesis 1:3-5';
$iv = substr(hash('sha256',$iv),0,8);
function cifrar($string){

	$saneado = filter_var($string, FILTER_SANITIZE_STRING);
	$trimed = strip_tags(trim($saneado));
	$encripted = openssl_encrypt ($trimed, $method, $pass, false, $iv);
	$coded = base64_encode($encripted);

	return $coded;
}
function descifrar($string){
	$decrypted = openssl_decrypt($crypText,$method,$pass, false, $iv);
}

function hashear($contra){
	$hashed = hash('sha3-512' , $contra);
	return $hashed;
}
?>