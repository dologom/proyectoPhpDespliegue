<?php
try {
	$db = new PDO('mysql:host=localhost;dbname=montessori', "root", "");
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
	$db->setAttribute(PDO::NULL_TO_STRING, true);
	//echo "conexión realizada con exito";
} catch (PDOException $e) {
	die ("<p><H3>No se ha podido establecer la conexión.
	<P>Compruebe si está activado el servidor de bases de
	datos MySQL.</H3></p>\n <p>Error: " . $e->getMessage() .
	"</p>\n");
}
?>