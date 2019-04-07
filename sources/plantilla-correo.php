<?php 

include'../autoload.php';

$session =  new Session();
$session->validity();

$opcion     = $_REQUEST['op'];
$funciones  = new Funciones();

$conexion   =  new Conexion();
$conexion   =  $conexion->get_conexion();

$userCreate = $_SESSION[KEY.NOMBRES].' '.$_SESSION[KEY.APELLIDOS];
$dateCreate = date('Y-m-d H:i:s');

switch ($opcion) {
case 1:
header("Content-type: application/json; charset=utf-8");

$query =  "SELECT id,nombre,asunto,user_mail,banner,cuerpo FROM plantilla_correo";
$statement = $conexion->query($query);
$statement->execute();
$result      = $statement->fetchAll(PDO::FETCH_ASSOC);

$results = ["sEcho" => 1,
          "iTotalRecords" => count($result),
          "iTotalDisplayRecords" => count($result),
          "aaData" => $result 
           ];
echo json_encode($results);

break;

case 2:

$id      = $_REQUEST['id'];
$query   = "SELECT * FROM plantilla_correo WHERE id=".$id;
$result  = $funciones->query($query)[0];

echo json_encode(array('cuerpo'=>$result['cuerpo']));


break;

case 3:

$id        = $_REQUEST['id'];
$cuerpo    = trim($_REQUEST['cuerpo']);

try {

$query = "UPDATE plantilla_correo SET 
cuerpo=:cuerpo  WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':cuerpo',$cuerpo);
$statement->bindParam(':id',$id);
$statement->execute();
echo "ok";

	
} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}

break;

case 4:

$id           =  $_REQUEST['id'];

$extension    = pathinfo($_FILES['archivo']['name'],PATHINFO_EXTENSION);
$filename     = $_FILES['archivo']['tmp_name'];
$archivo      = $id.'.'.$extension;
$destination  = "../uploads/banner/".$archivo;

if (move_uploaded_file($filename, $destination)) 
{


try {

$query     = "UPDATE plantilla_correo SET banner=:banner WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->bindParam(':banner',$archivo);
$statement->execute();
echo "ok";

} catch (Exception $e) {

 echo "Error: ".$e->getMessage();
	
}

echo "archivo subido";

} 
else 
{

echo "error archivo";

}

break;


case  5:

$id      = $_REQUEST['id'];
$query   = "SELECT * FROM plantilla_correo WHERE id=".$id;
$result  = $funciones->query($query)[0];


$url    = URL."uploads/banner".$result['banner'];

if (strlen($result['banner'])>0) 
{
echo json_encode(array('url'=>$url,'msj'=>'yes'));

} 
else 
{
echo json_encode(array('url'=>$url,'msj'=>'no'));

}







break;

case 6:

$id        = $_REQUEST['id'];
$asunto    = $funciones->validar_xss($_REQUEST['asunto']);
$user_mail = $funciones->validar_xss($_REQUEST['user_mail']);

try {

$query     = "UPDATE plantilla_correo SET 
asunto=:asunto,
user_mail=:user_mail 

WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->bindParam(':asunto',$asunto);
$statement->bindParam(':user_mail',$user_mail);
$statement->execute();
echo "ok";
	
} catch (Exception $e) {
	

echo "Error: ".$e->getMessage();

}




break;

default:
echo "opción no disponible";
break;
}




 ?>