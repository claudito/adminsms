<?php 

class Config extends Conexion
{


function consulta()
{

try {
	
$conexion   = $this->get_conexion();
$query      = "SELECT  * FROM config";
$statement  = $conexion->prepare($query);
$statement->execute();
$result     = $statement->fetchAll(PDO::FETCH_ASSOC);
return $result;

} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}


}


}

 ?>