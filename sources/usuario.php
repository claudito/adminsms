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

$query =  "
SELECT  

u.id,
u.first_name,
u.last_name,
u.id_number,
u.email,
u.phone,
u.cellphone,
u.username,
u.password,
u.id_role,
r.nombre role

FROM usuario  u 
INNER JOIN role_usuario r ON u.id_role=r.id";
$statement = $conexion->query($query);
$statement->execute();
$result      = $statement->fetchAll(PDO::FETCH_ASSOC);

$data  = array();

foreach ($result as $key => $value) {


 $data[] = [ 

'id'=>$value['id'],
'nombres'=>$value['first_name'],
'apellidos'=>$value['last_name'],
'dni'=>$value['id_number'],
'email'=>$value['email'],
'telefono'=>$value['phone'],
'celular'=>$value['cellphone'],
'usuario'=>$value['username'],
 'role'=>$value['role'],
'acciones'=>'

<button type="button" class="btn btn-default btn-pencil btn-sm" data-id="'.$value['id'].'"><i class="fa fa-pencil"></i></button>
<button type="button" class="btn btn-primary btn-edit btn-sm" data-id="'.$value['id'].'"><i class="fa fa-edit"></i></button>
<button type="button" class="btn btn-warning btn-lock btn-sm" data-id="'.$value['id'].'"><i class="fa fa-lock"></i></button>

 '



 ];

}

$results = ["sEcho" => 1,
          "iTotalRecords" => count($data),
          "iTotalDisplayRecords" => count($data),
          "aaData" => $data 
           ];
echo json_encode($results);


break;

case 2:

$id     = trim($_REQUEST['id']);
$pass   = trim($_REQUEST['pass']);

try {
	
$query =  "UPDATE usuario SET password=:pass WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->bindParam(':pass',$pass);
$statement->execute();
echo "ok";

} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}

break;

case 3:

$query  =  "SELECT * FROM role_usuario";
$result =  $funciones->query($query);

echo json_encode($result);

break;

case 4:

$query  =  "SELECT * FROM role_usuario";
$result =  $funciones->query($query);

echo json_encode($result);

break;

case 5:

$id  = $_REQUEST['id'];

$query  =  "SELECT  

u.id,
u.first_name,
u.last_name,
u.id_number,
u.email,
u.phone,
u.cellphone,
u.username,
u.password,
u.id_role,
r.nombre role

FROM usuario  u 
INNER JOIN role_usuario r ON u.id_role=r.id WHERE u.id=".$id;
$result =  $funciones->query($query)[0];

echo json_encode($result);

break;

case 6:


$nombres   = $funciones->validar_xss($_REQUEST['nombres']);
$apellidos = $funciones->validar_xss($_REQUEST['apellidos']);
$telefono  = $funciones->validar_xss($_REQUEST['telefono']);
$celular   = $funciones->validar_xss($_REQUEST['celular']);
$email     = $_REQUEST['email'];
$usuario   = $_REQUEST['usuario'];
$password  = md5($_REQUEST['password']);
$dni       = $_REQUEST['dni'];
$rol       = $_REQUEST['rol'];

if($_REQUEST['tipo']=='agregar')
{

//Agregar
try {

$query  =  "SELECT  * FROM usuario WHERE username=:usuario";
$statement = $conexion->prepare($query);
$statement->bindParam(':usuario',$usuario);
$statement->execute();
$result  = $statement->fetchAll(PDO::FETCH_ASSOC);

if(count($result)>0)
{
 
echo json_encode(array('title'=>'Usuario Duplicado','type'=>'warning','text'=>'Intente con otro usuario'));

}
else
{

$query  =  "INSERT INTO  usuario
(first_name,last_name,id_number,email,phone,cellphone,username,password,id_role,userCreate,dateCreate)VALUES
(:first_name,:last_name,:id_number,:email,:phone,:cellphone,:username,:password,:id_role,:userCreate,:dateCreate)";
$statement = $conexion->prepare($query);
$statement->bindParam(':first_name',$nombres);
$statement->bindParam(':last_name',$apellidos);
$statement->bindParam(':id_number',$dni);
$statement->bindParam(':email',$email);
$statement->bindParam(':phone',$telefono);
$statement->bindParam(':cellphone',$celular);
$statement->bindParam(':username',$usuario);
$statement->bindParam(':password',$password);
$statement->bindParam(':id_role',$rol);
$statement->bindParam(':userCreate',$userCreate);
$statement->bindParam(':dateCreate',$dateCreate);
$statement->execute();
echo json_encode(array('title'=>'Buen Trabajo','type'=>'success','text'=>'Registro Agregado'));


}
	
} catch (Exception $e) {

 echo "Error: ".$e->getMessage();

	
}


}
else
{

//Actualizar
$id       = $_REQUEST['id'];

$query  =  "SELECT  * FROM usuario WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->execute();
$result  = $statement->fetch(PDO::FETCH_ASSOC);

if($result['username']==$usuario)
{

try {

$query  =  "UPDATE  usuario SET
first_name=:first_name,
last_name=:last_name,
id_number=:id_number,
email=:email,
phone=:phone,
cellphone=:cellphone,
username=:username,
id_role=:id_role,
userUpdate=:userUpdate,
dateUpdate=:dateUpdate
WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':first_name',$nombres);
$statement->bindParam(':last_name',$apellidos);
$statement->bindParam(':id_number',$dni);
$statement->bindParam(':email',$email);
$statement->bindParam(':phone',$telefono);
$statement->bindParam(':cellphone',$celular);
$statement->bindParam(':username',$usuario);
$statement->bindParam(':id',$id);
$statement->bindParam(':id_role',$rol);
$statement->bindParam(':userUpdate',$userCreate);
$statement->bindParam(':dateUpdate',$dateCreate);
$statement->execute();
echo json_encode(array('title'=>'Buen Trabajo','type'=>'success','text'=>'Registro Actualizado'));



} catch (Exception $e) {
	
 echo "Error: ".$e->getMessage();

}


}
else
{

$query  =  "SELECT  * FROM usuario WHERE username=:usuario";
$statement = $conexion->prepare($query);
$statement->bindParam(':usuario',$usuario);
$statement->execute();
$result  = $statement->fetchAll(PDO::FETCH_ASSOC);
if(count($result)>0)
{

echo json_encode(array('title'=>'Usuario Duplicado','type'=>'warning','text'=>'Intente con otro usuario'));

}
else
{


try {

$query  =  "UPDATE  usuario SET
first_name=:first_name,
last_name=:last_name,
id_number=:id_number,
email=:email,
phone=:phone,
cellphone=:cellphone,
username=:username,
id_role=:id_role,
userUpdate=:userUpdate,
dateUpdate=:dateUpdate
WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':first_name',$nombres);
$statement->bindParam(':last_name',$apellidos);
$statement->bindParam(':id_number',$dni);
$statement->bindParam(':email',$email);
$statement->bindParam(':phone',$telefono);
$statement->bindParam(':cellphone',$celular);
$statement->bindParam(':username',$usuario);
$statement->bindParam(':id',$id);
$statement->bindParam(':id_role',$rol);
$statement->bindParam(':userUpdate',$userCreate);
$statement->bindParam(':dateUpdate',$dateCreate);
$statement->execute();
echo json_encode(array('title'=>'Buen Trabajo','type'=>'success','text'=>'Registro Actualizado'));



} catch (Exception $e) {
	
 echo "Error: ".$e->getMessage();

}


}




}



}

break;


case 7:

$id    = $_REQUEST['id'];

//Agregar Permisos:
$permiso = new Permiso();
$permiso->agregar($id);

try {
	
$query =  "SELECT  m.id,m.nombre,m.item,m.icon,''url,'menu'tipo,s.id_menu,''estado,''checked FROM submenu s 
INNER JOIN 
(

SELECT id_usuario,id_submenu FROM permiso_submenu WHERE id_usuario=:id
) p ON s.id=p.id_submenu
INNER JOIN
(
SELECT * FROM menu WHERE flagDelete=1
) m  ON s.id_menu=m.id WHERE s.flagDelete=1
GROUP BY s.id_menu
UNION

SELECT  s.id,s.nombre,s.item,s.icon,s.url,'submenu'tipo,s.id_menu,estado,
case estado
WHEN 1 THEN 'checked'
WHEN 0 THEN ''
END checked FROM submenu s 
INNER JOIN 
(

SELECT id_usuario,id_submenu,estado FROM permiso_submenu WHERE id_usuario=:id
) p ON s.id=p.id_submenu
INNER JOIN
(
SELECT * FROM menu
) m  ON s.id_menu=m.id";

$statement  =  $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->execute();
$result     = $statement->fetchAll(PDO::FETCH_ASSOC);


} catch (Exception $e) {

echo "Error: ".$e->getMessage();
	
}

?>

<?php foreach ($result as $key_c => $value_c): ?>
<?php if ($value_c['tipo']=='menu'): ?>
<ul style="list-style: none">
<li><strong><?= $value_c['nombre'] ?></strong>
<ul>
<?php foreach ($result as $key => $value): ?>
<?php if ($value['tipo']=='submenu'): ?>
<?php if ($value['id_menu']==$value_c['id_menu']): ?>
<div class="checkbox">
<label>
<li style="list-style: none"><input type="checkbox" name="<?= $value['id'] ?>" <?= $value['checked'] ?> > 
<?= $value['nombre'] ?>
</li>
</label>
</div>
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
</ul>
</li>
</ul>
<?php endif ?>
<?php endforeach ?>


<?php
break;


case 8:

$id = $_REQUEST['id'];

$permiso = new Permiso();

//SubMenú
$query = "SELECT * FROM submenu";
$submenu = $funciones->query($query);

foreach ($submenu as $key => $value) {
	
  $estado      = (isset($_POST[$value['id']])) ? 1 : 0;
  $id_submenu = $value['id'];
   

echo    $permiso->actualizar($id_submenu,$id,$estado);



}



break;


default:
echo "opción no disponible";
break;
}




 ?>