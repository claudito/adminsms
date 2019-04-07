<?php 

class Auditoria extends Conexion
{

public function acceso($usuario,$tipo,$ip,$dispositivo,$navegador,$latitude,$longitude)
{
   try {

    //extracción de log de clientes
    $log = '';

    foreach ($_SERVER as $key => $value) {
        
      $log .= $key.' => '.$value."<br>";

    }

    $fecha  = date('Y-m-d H:i:s');
    $conexion   = $this->get_conexion();
    $query     = "INSERT INTO auditoria(usuario,fecha,tipo,ip,dispositivo,navegador,log,latitude,longitude)VALUES(:usuario,:fecha,:tipo,:ip,:dispositivo,:navegador,:log,:latitude,:longitude)";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':usuario',$usuario);
    $statement->bindParam(':fecha',$fecha);
    $statement->bindParam(':tipo',$tipo);
    $statement->bindParam(':ip',$ip);
    $statement->bindParam(':dispositivo',$dispositivo);
    $statement->bindParam(':navegador',$navegador);
    $statement->bindParam(':log',$log);
    $statement->bindParam(':latitude',$latitude);
    $statement->bindParam(':longitude',$longitude);
    if($statement)
    {
     $statement->execute();
    return "ok";
    }
    else
    {
     return "error";
    }
       
   }
    catch (Exception $e) 
   {
      echo "ERROR: " . $e->getMessage();
   
   }
}




public function lista()
{

try {

$conexion   = $this->get_conexion();
$query     = "SELECT * FROM auditoria ORDER BY id DESC";
$statement = $conexion->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
return $result;

} catch (Exception $e) {
  echo "ERROR: " . $e->getMessage();
}

}







}



 ?>