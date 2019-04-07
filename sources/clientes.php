<?php 

include'../vendor/autoload.php';
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
 id
,nombres
,apellidos
,dni
,email
,telefono
,celular
,userCreate
,dateCreate
,userUpdate
 dateUpdate FROM maecli

";
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

$id     = trim($_REQUEST['id']);

try {
	
$query =  "SELECT 
 id
,nombres
,apellidos
,dni
,email
,telefono
,celular
,userCreate
,dateCreate
,userUpdate
 dateUpdate FROM maecli WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->execute();
$result  = $statement->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);


} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}

break;

case 3:


$nombres   = $funciones->validar_xss($_REQUEST['nombres']);
$apellidos = $funciones->validar_xss($_REQUEST['apellidos']);
$dni       = $funciones->validar_xss($_REQUEST['dni']);
$email     = $funciones->validar_xss($_REQUEST['email']);
$telefono  = $funciones->validar_xss($_REQUEST['telefono']);
$celular   = $funciones->validar_xss($_REQUEST['celular']);

if($_REQUEST['accion']=='agregar')
{

//Agregar
try {

$query  =  "INSERT INTO maecli(nombres, apellidos, dni, email, telefono, celular, userCreate, dateCreate) VALUES
(:nombres,:apellidos,:dni,:email,:telefono,:celular,:userCreate,:dateCreate)";
$statement = $conexion->prepare($query);
$statement->bindParam(':nombres',$nombres);
$statement->bindParam(':apellidos',$apellidos);
$statement->bindParam(':dni',$dni);
$statement->bindParam(':email',$email);
$statement->bindParam(':telefono',$telefono);
$statement->bindParam(':celular',$celular);
$statement->bindParam(':userCreate',$userCreate);
$statement->bindParam(':dateCreate',$dateCreate);
$statement->execute();
echo json_encode(array('title'=>'Buen Trabajo','type'=>'success','text'=>'Registro Agregado'));

} catch (Exception $e) {

echo json_encode(array('title'=>'Error','type'=>'error','text'=>$e->getMessage()));

	
}


}
else
{

//Actualizar
$id       = $_REQUEST['id'];


try {
	
$query  =  "UPDATE  maecli SET 
nombres=:nombres,
apellidos=:apellidos,
dni=:dni,
email=:email,
telefono=:telefono,
celular=:celular,
userUpdate=:userUpdate,
dateUpdate=:dateUpdate

 WHERE id=:id";
$statement = $conexion->prepare($query);
$statement->bindParam(':id',$id);
$statement->bindParam(':nombres',$nombres);
$statement->bindParam(':apellidos',$apellidos);
$statement->bindParam(':dni',$dni);
$statement->bindParam(':email',$email);
$statement->bindParam(':telefono',$telefono);
$statement->bindParam(':celular',$celular);
$statement->bindParam(':userUpdate',$userCreate);
$statement->bindParam(':dateUpdate',$dateCreate);
$statement->execute();
echo json_encode(array('title'=>'Buen Trabajo','type'=>'success','text'=>'Registro Actualizado'));


} catch (Exception $e) {

echo json_encode(array('title'=>'Error','type'=>'error','text'=>$e->getMessage()));	
	
}


}

break;

case  4:

$id        = $_REQUEST['id'];
$celular   = trim($_REQUEST['celular']);
$sms       = trim($_REQUEST['sms']);

$config    =  new Config();
$config    = $config->consulta();


try {
	
$basic  = new \Nexmo\Client\Credentials\Basic($config[2]['descripcion'], $config[3]['descripcion']);
$client = new \Nexmo\Client($basic);

$message = $client->message()->send([
    'to' => $celular,
    'from' => 'PeruTec',
    'text' => $sms
]);

echo json_encode(array('title'=>'Buen Trabajo','type'=>'success','text'=>'Mensaje Enviado'));

} catch (Exception $e) {

echo json_encode(array('title'=>'Error','type'=>'error','text'=>$e->getMessage()));
	
}

break;

case  5:

$id        = trim($_REQUEST['id']);
$username  = trim($_REQUEST['username']);

$query     = "SELECT  * FROM plantilla_correo WHERE id=1";
$result    = $funciones->query($query)[0];

$html      = $result['cuerpo'];
$html      = str_replace('#cliente#', $username, $html);

echo json_encode(array('cuerpo'=>$html));

break;

case  6:

$email    = trim($_REQUEST['email']);
$username = trim($_REQUEST['username']);
$cuerpo   = $_REQUEST['cuerpo'];

$config    =  new Config();
$config    = $config->consulta();

try {

//Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//UTF8
$mail->CharSet = 'UTF-8';

//Username to use for SMTP authentication - use full email address for gmail
//$mail->Username = "notificacionsistemasperutec@gmail.com";
$mail->Username = 'envio.mail.sistemas@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'mochilanegra';
//$mail->Password = "aguaazul";

//Set who the message is to be sent from
//Remitente
$mail->setFrom('envio.mail.sistemas@gmail.com', 'Creaciones G&M');
//Remitente
//$mail->setFrom('notificacionsistemasperutec@gmail.com', 'Luis Claudio');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
//Destinatario
$mail->addAddress($email, $username);

//Set the subject line
$mail->Subject = "Creaciones G&M";

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Cuerpo del Correo
$html = $cuerpo;
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->msgHTML($html);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('img/php.jpg');
//$mail->addAttachment('img/php2.jpg');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}


	
} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}

break;

default:
echo "opción no disponible";
break;
}




 ?>