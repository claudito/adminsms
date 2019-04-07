<?php 
class Acceso extends Conexion
{

private   $user;
private   $pass;
protected $latitude;
protected $longitude;


function __construct($user='',$pass='',$latitude='',$longitude='')
{

$this->user      = addslashes($user);
$this->pass      = addslashes($pass);
$this->latitude  = $latitude;
$this->longitude = $longitude;

}

function conexion()
{
  return $this->get_conexion();
}


function login()
{

try {

$conexion  = $this->get_conexion();
$query     = "SELECT * FROM usuario WHERE  UPPER(username)=UPPER(:user) AND password=:pass";
$statement = $conexion->prepare($query);
$statement->bindParam(':user',$this->user);
$statement->bindParam(':pass',$this->pass);
$statement->execute();
$result    = $statement->fetchAll();
if (count($result)>0) 
{
  
$dato   =  $result[0];
#Creación de Sesiones
session_start();
$_SESSION[KEY.ID]        = $dato['id'];
$_SESSION[KEY.NOMBRES]   = $dato['first_name'];
$_SESSION[KEY.APELLIDOS] = $dato['last_name'];

//Auditoria
$auditoria   = new Auditoria();
$funciones   = new Funciones();  
$dispositivo = $_SERVER['HTTP_USER_AGENT'];
$navegador   = $funciones->getBrowser($dispositivo);
$ip          = $funciones->get_ip();
$auditoria->acceso($_SESSION[KEY.NOMBRES].' '.$_SESSION[KEY.APELLIDOS],'login',$ip,$dispositivo,$navegador,$this->latitude,$this->longitude);

return "true";

} 
else 
{
  return false;
}



} catch (Exception $e) {
	
	 echo "Error: ".$e->getMessage();
}



}


function logout()
{

//Auditoria
$auditoria   = new Auditoria();
$funciones   = new Funciones();  

$dispositivo = $_SERVER['HTTP_USER_AGENT'];
$navegador   = $funciones->getBrowser($dispositivo);
$ip          = $funciones->get_ip();
$auditoria->acceso($_SESSION[KEY.NOMBRES].' '.$_SESSION[KEY.APELLIDOS],'logout',$ip,$dispositivo,$navegador);

   unset($_SESSION[KEY.ID]);
   unset($_SESSION[KEY.NOMBRES]);
   unset($_SESSION[KEY.APELLIDOS]);


}




}



 ?>