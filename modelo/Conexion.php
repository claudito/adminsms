<?php 

class Conexion
{

function get_conexion()
{

try {
	
$conexion = new PDO("mysql:host=".SERVER.";dbname=".BD."",USER,PASS,
	array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_PERSISTENT => true

	   ));
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $conexion;
//$conexion = ($conexion) ? "ok" : "error" ;
//echo $conexion;

} catch (Exception $e) {
	
  echo "Error: ".$e->getMessage();
}


}

function get_conexion_promedon()
{

try {
	
$conexion = new PDO("sqlsrv:Server=190.187.102.73;database=BD_PROMEDON","SOPORTE","SOPORTE",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $conexion;

} catch (Exception $e) {
	
  echo "Error: ".$e->getMessage();
}


}




}



 ?>