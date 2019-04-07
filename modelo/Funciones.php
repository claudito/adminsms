<?php 


class Funciones extends Conexion
{


function conexion()
{
  return $this->get_conexion();
}

  

function validar_xss($string)
{


return htmlspecialchars(trim($string), ENT_QUOTES,'UTF-8');


}

function get_edad($fecha_nac)
{
$fecha1 = new DateTime($fecha_nac);
$fecha2 = new DateTime(date('Y-m-d'));
$fecha = $fecha1->diff($fecha2);
//printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
printf('%d', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
}



function sumarmin($horainicio,$minutos)
{
$horaInicial  = $horainicio;
$minutoAnadir = $minutos;
 
$segundos_horaInicial=strtotime($horaInicial);
 
$segundos_minutoAnadir=$minutoAnadir*60;
 
$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
 
return $nuevaHora;
}


function buttons_export($orientacion='letter')
{

$buttons = <<<EOF
<script>
$(document).ready(function() {
$('#consulta').DataTable( {
dom: 'Bfrtip',
buttons: [
{
extend:    'copyHtml5',
text:      '<i class="fa fa-files-o"></i>',
titleAttr: 'Copiar Filas'
},
{
extend:    'excelHtml5',
text:      '<i class="fa fa-file-excel-o"></i>',
titleAttr: 'Exportar en documento Excel'
},
{
extend:    'print',
text:      '<i class="fa fa-print"></i>',
titleAttr: 'Imprimir Documento'
},
{
extend:    'pdfHtml5',
text:      '<i class="fa fa-file-pdf-o"></i>',
titleAttr: 'Exporta en Documento PDF',
orientation: '$orientacion',
pageSize: 'LEGAL'
}

]
} );
} );
</script>
EOF;

echo  $buttons;

}


function select_dependiente($idselect,$iddata,$url)
{

echo '
<script>
$(document).ready(function() {
// Parametros para el combo
$("#'.$idselect.'").change(function () {
$("#'.$idselect.' option:selected").each(function () {
elegido=$(this).val();
$.post("'.$url.'", { elegido: elegido }, 
function(data){
$("#'.$iddata.'").html(data);
});     
});
});    
});
</script>';

}


function  input($type='',$codigo='',$placeholder='')
{

//switch
switch ($type) {
case 'text':
echo '<div class="form-group">
     <input type="text"   name="'.$codigo.'"   placeholder="'.$placeholder.'" class="form-control" required>
     </div>';
    break;
case 'number':
echo '<div class="form-group">
     <input type="number"   name="'.$codigo.'"   placeholder="'.$placeholder.'" class="form-control" required>
     </div>';
    break;
case 'date':
echo '<div class="form-group">
     <input type="text"   name="'.$codigo.'"   id="datepicker'.substr($codigo,1,2).'" placeholder="'.$placeholder.'" class="form-control" required>
     </div>';
echo "<script>
    $( function() {
    $('#datepicker".substr($codigo,1,2)."').datepicker({dateFormat:'yy-mm-dd'});
    } );
    </script>
     ";
    break;
  default:
echo "elemnto html sin registrar";
    break;
}

////


}



function query($sql)
{

try {
  
$conexion  = $this->get_conexion();
$query    = $sql;
$statement= $conexion->prepare($sql);
$statement->execute();
$result     =  $statement->fetchAll(PDO::FETCH_ASSOC);
return $result;

} catch (Exception $e) {
  
 echo "Error: ".$e->getMessage();

}

}





function select_query($table)
{

try {
  
$conexion  = $this->get_conexion();
$query    = "SELECT * FROM ".$table;
$statement= $conexion->prepare($query);
$statement->execute();
$result     =  $statement->fetchAll(PDO::FETCH_ASSOC);
return $result;

} catch (Exception $e) {
  
 echo "Error: ".$e->getMessage();

}


}



function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
  function getBrowser($user_agent){
    if(strpos($user_agent, 'Maxthon') !== FALSE)
      return "Maxthon";
    elseif(strpos($user_agent, 'SeaMonkey') !== FALSE)
      return "SeaMonkey";
    elseif(strpos($user_agent, 'Vivaldi') !== FALSE)
      return "Vivaldi";
    elseif(strpos($user_agent, 'Arora') !== FALSE)
      return "Arora";
    elseif(strpos($user_agent, 'Avant Browser') !== FALSE)
      return "Avant Browser";
    elseif(strpos($user_agent, 'Beamrise') !== FALSE)
      return "Beamrise";
    elseif(strpos($user_agent, 'Epiphany') !== FALSE)
      return 'Epiphany';
    elseif(strpos($user_agent, 'Chromium') !== FALSE)
      return 'Chromium';
    elseif(strpos($user_agent, 'Iceweasel') !== FALSE)
      return 'Iceweasel';
    elseif(strpos($user_agent, 'Galeon') !== FALSE)
      return 'Galeon';
    elseif(strpos($user_agent, 'Edge') !== FALSE)
      return 'Microsoft Edge';
    elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
      return 'Internet Explorer';
    elseif(strpos($user_agent, 'MSIE') !== FALSE)
      return 'Internet Explorer';
    elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
      return "Opera Mini";
    elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
      return "Opera";
    elseif(strpos($user_agent, 'Firefox') !== FALSE)
      return 'Mozilla Firefox';
    elseif(strpos($user_agent, 'Chrome') !== FALSE)
      return 'Google Chrome';
    elseif(strpos($user_agent, 'Safari') !== FALSE)
      return "Safari";
    elseif(strpos($user_agent, 'iTunes') !== FALSE)
      return 'iTunes';
    elseif(strpos($user_agent, 'Konqueror') !== FALSE)
      return 'Konqueror';
    elseif(strpos($user_agent, 'Dillo') !== FALSE)
      return 'Dillo';
    elseif(strpos($user_agent, 'Netscape') !== FALSE)
      return 'Netscape';
    elseif(strpos($user_agent, 'Midori') !== FALSE)
      return 'Midori';
    elseif(strpos($user_agent, 'ELinks') !== FALSE)
      return 'ELinks';
    elseif(strpos($user_agent, 'Links') !== FALSE)
      return 'Links';
    elseif(strpos($user_agent, 'Lynx') !== FALSE)
      return 'Lynx';
    elseif(strpos($user_agent, 'w3m') !== FALSE)
      return 'w3m';
    else
      return 'No hemos podido detectar su navegador';
  }



function subir_archivo($archivo,$id,$ruta)
{

$id          = $id;
$fecha       = date('YmdHis');
$extension   = pathinfo($archivo['name'],PATHINFO_EXTENSION);
$filename    = $archivo['tmp_name'];
$destination = $ruta.md5($id.$fecha.$archivo['name']).'.'.$extension;

if(move_uploaded_file($filename, $destination))
{

return "archivo subido";

}
else
{

return "error archivo";

}


}


function formato_fecha_inicio($fecha)
{

$dia_lista = array(

  0=>'Domingo',
  1=>'Lunes',
  2=>'Martes',
  3=>'Miércoles',
  4=>'Jueves',
  5=>'Viernes',
  6=>'Sábado'

  );

$mes_lista = array(

  '01'=>'Enero',
  '02'=>'Febrero',
  '03'=>'Marzo',
  '04'=>'Abril',
  '05'=>'Mayo',
  '06'=>'Junio',
  '07'=>'Julio',
  '08'=>'Agosto',
  '09'=>'Septiembre',
  '10'=>'Octubre',
  '11'=>'Noviembre',
  '12'=>'Diciembre'

  );


$nombre_dia  =  date("w",strtotime($fecha));
$dia         =  date("d",strtotime($fecha)); 
$mes         =  date("m",strtotime($fecha)); 
$anio        =  date("Y",strtotime($fecha)); 

return $dia_lista[$nombre_dia].', '.$dia.' de '.$mes_lista[$mes].' '.$anio;

}


function restar_meses($mes)
{
$fechaActual = date('Y-m-d');
$fechaMesPasado = strtotime ('-'.$mes.' month', strtotime($fechaActual));
$fechaMesPasadoDate = date('Y-m-d', $fechaMesPasado);
return $fechaMesPasadoDate;
}


}


 ?>