<?php 


class Permiso extends Conexion
{


function agregar($id)
{


try {
	
$conexion   = $this->get_conexion();
$query      = "SELECT  * FROM permiso_submenu WHERE id_usuario=:id_usuario";
$statement  = $conexion->prepare($query);
$statement->bindParam(':id_usuario',$id);
$statement->execute();
$result     = $statement->fetchAll();
if (count($result)>0) 
{

$query      = "INSERT INTO permiso_submenu(id_usuario,id_submenu)
SELECT ".$id.",s.id FROM submenu s LEFT JOIN (SELECT id_submenu FROM permiso_submenu where id_usuario=:id_usuario) p ON 
s.id=p.id_submenu WHERE p.id_submenu IS NULL";
$statement  = $conexion->prepare($query);
$statement->bindParam(':id_usuario',$id);
$statement->execute();
return "ok";


} 
else
{

$query      = "INSERT INTO permiso_submenu(id_submenu,id_usuario)
SELECT s.id,".$id." FROM submenu s";
$statement  = $conexion->prepare($query);
$statement->execute();
return "ok222";

}


} catch (Exception $e) {
 
  echo "Error: ".$e->getMessage();

}

}




function lista()
{


$id    = $_SESSION[KEY.ID];

try {

$conexion =  $this->get_conexion();

$query =  "SELECT  m.nombre,m.item,m.icon,''url,'menu'tipo,s.id_menu FROM submenu s 
INNER JOIN 
(

SELECT id_usuario,id_submenu FROM permiso_submenu WHERE id_usuario=:id AND estado=1
) p ON s.id=p.id_submenu
INNER JOIN
(
SELECT * FROM menu WHERE flagDelete=1
) m  ON s.id_menu=m.id WHERE s.flagDelete=1
GROUP BY s.id_menu
UNION

SELECT  s.nombre,s.item,s.icon,s.url,'submenu'tipo,s.id_menu FROM submenu s 
INNER JOIN 
(

SELECT id_usuario,id_submenu FROM permiso_submenu WHERE id_usuario=:id AND estado=1
) p ON s.id=p.id_submenu
INNER JOIN
(
SELECT * FROM menu
) m  ON s.id_menu=m.id ORDER BY item";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->execute();
$result    = $statement->fetchAll(PDO::FETCH_ASSOC);
return $result;

	
} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}



}


function actualizar($id_submenu,$id_usuario,$estado)
{

try {
	
$conexion   =  $this->get_conexion();
$query      =  "UPDATE permiso_submenu SET estado=:estado WHERE id_usuario=:id_usuario AND id_submenu=:id_submenu";
$statement  = $conexion->prepare($query);
$statement->bindParam(':id_submenu',$id_submenu);
$statement->bindParam(':id_usuario',$id_usuario);
$statement->bindParam(':estado',$estado);
$statement->execute();
return "ok";

} catch (Exception $e) {
 
  echo "Error: ".$e->getMessage();

}

}








}


 ?>