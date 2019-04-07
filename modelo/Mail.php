<?php 

class Mail{


function automatico_reserva($email,$fullname,$diploma1,$diploma2,$diploma3)
{

//Enviar Mail
//Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Config UTF-8
$mail->CharSet = "utf-8";

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = USER_MAIL;
//Password to use for SMTP authentication
$mail->Password = USER_PASS;

//Set who the message is to be sent to
$mail->addAddress($email, $fullname);

//Leer plantilla desde la BD
$funciones = new Funciones();
$query = "SELECT * FROM plantilla_correo WHERE id=1";
$dato  = $funciones->query($query)[0];


//Set who the message is to be sent from
$mail->setFrom(USER_MAIL, $dato['user_mail']);

//Set the subject line
$mail->Subject = $dato['asunto'];


//Crear Cuerpo del Mensaje
$html           = $dato['cuerpo']; 

$url_banner_img = URL."uploads/banner/".$dato['banner'];

$html           = str_replace('banner_correo', $url_banner_img, $html);

$html = str_replace('#cliente#','<strong>'.$fullname.'</strong>', $html);

//Agregar Contenido
$mail->msgHTML($html);

//Adjuntos
$mail->addAttachment('../uploads/diplomados/'.$diploma1.'.pdf');
$mail->addAttachment('../uploads/diplomados/'.$diploma2.'.pdf');
$mail->addAttachment('../uploads/diplomados/'.$diploma3.'.pdf');

$msg_correo = "";
//send the message, check for errors
if (!$mail->send()) 
{

$msg_correo = $mail->ErrorInfo;
} 
else 
{
 $msg_correo ="correo enviado";
}

return $msg_correo;

}



function recordatorio_reserva($email,$fullname)
{

//Enviar Mail
//Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Config UTF-8
$mail->CharSet = "utf-8";

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = USER_MAIL;
//Password to use for SMTP authentication
$mail->Password = USER_PASS;



//Set who the message is to be sent to
$mail->addAddress($email, $fullname);

//Leer plantilla desde la BD
$funciones = new Funciones();
$query = "SELECT * FROM plantilla_correo WHERE id=2";
$dato  = $funciones->query($query)[0];


//Set who the message is to be sent from
$mail->setFrom(USER_MAIL, $dato['user_mail']);


//Set the subject line
$mail->Subject = $dato['asunto'];

//Crear Cuerpo del Mensaje
$html           = $dato['cuerpo']; 

$url_banner_img = URL."uploads/banner/".$dato['banner'];

$html           = str_replace('banner_correo', $url_banner_img, $html);


$html = str_replace('#cliente#','<strong>'.$fullname.'</strong>', $html);

//Agregar Contenido
$mail->msgHTML($html);

//Adjuntos
//$mail->addAttachment('../uploads/diplomados/'.$diploma1.'.pdf');
//$mail->addAttachment('../uploads/diplomados/'.$diploma2.'.pdf');
//$mail->addAttachment('../uploads/diplomados/'.$diploma3.'.pdf');

$msg_correo = "";
//send the message, check for errors
if (!$mail->send()) 
{

$msg_correo = $mail->ErrorInfo;
} 
else 
{
 $msg_correo ="correo enviado";
}

return $msg_correo;

}



}


 ?>