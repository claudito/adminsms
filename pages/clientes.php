<?php 
include'../autoload.php';
$session =  new Session();
$session->validity();
$session->acceso();
$assets =  new Assets();
$assets->nav('..','Clientes');
$assets->sweetalert();
$assets->summernote();
$assets->breadcrumbs('Gestión','Clientes');

 ?>


<div class="row">
  
<div class="col-md-12">

<div class="pull-right">
<div class="form-group">
<button class="btn btn-primary btn-agregar"><i class="fa fa-plus"></i> Agregar</button>
</div>
</div>

  
    <div class="table-responsive">
     	<table id="consulta"  class="table table-hover table-condensend" style="font-size: 12px">
     		<thead>
     			<tr class="table-active">
              <th>Id</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Dni</th>
              <th>Email</th>
              <th>Telefóno</th>
              <th>Celular</th>
              <th>Acciones</th>
              

                      
     			</tr>
     		</thead>
     	</table>
     </div>

</div>

</div>



<!-- Modal Registro -->
<form id="registro" autocomplete="off">
<div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-registro" id="exampleModalLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

     <input type="hidden" name="id" class="id">
     <input type="hidden" name="accion" class="accion">
      
     <div class="row">
     <div class="col-md-6">
     <div class="form-group">
     <label>Nombres</label>
     <input type="text" name="nombres" class="nombres form-control form-control-sm" required 
     onchange="Mayusculas(this)">
     </div>
     </div>
     <div class="col-md-6">
     <div class="form-group">
     <label>Apellidos</label>
     <input type="text" name="apellidos"   class="apellidos form-control form-control-sm" required  onchange="Mayusculas(this)">
     </div> 
     </div>
     </div>


    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Telefóno</label>
    <input type="tel" name="telefono" min="0"  class="telefono form-control form-control-sm" >
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
    <label>Celular</label>
    <input type="tel" name="celular"  class="celular form-control form-control-sm" required >
    </div> 
    </div>
    </div>


    <div class="row">
    <div class="col-md-6">
     <div class="form-group">
     <label>Email</label>
     <input type="email" name="email"  class="email form-control form-control-sm" required>
     </div>  
    </div>
    <div class="col-md-6">
      <div class="form-group">
<label>Dni</label>
<input type="text" name="dni"  pattern="[0-9]{8}"  class="dni form-control form-control-sm" required minlength="8"  maxlength="8">
</div>
    </div>
    </div>


     








      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-submit">submit</button>
      </div>
    </div>
  </div>
</div>
</form>


<form id="frm-sms" autocomplete="off">
  
<div class="modal fade" id="modal-sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="id"  class="id">
      <input type="hidden" name="celular"  class="celular">
       
      <div class="form-group">
      <label>Mensaje:</label>
      <textarea name="sms"  class="sms form-control" rows="3" required maxlength="140"></textarea>
       <small id="emailHelp" class="form-text text-muted">*Tenga en cuenta que es un máximo de 140 caracteres.</small>
       <small id="emailHelp" class="form-text text-muted">*Excluya las vocales con tilde(á, é, í, ó, ú) y caracteres especiales tales como (ñ,ü,etc)</small>
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>

</form>


<form id="frm-email" autocomplete="off">
  
<div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="id"        class="id">
      <input type="hidden" name="email"     class="email">
      <input type="hidden" name="username"  class="username">



     <textarea name="cuerpo" class="cuerpo" rows="3"></textarea>  
     <script>
    $(document).ready(function() {
    $('.cuerpo').summernote({
     
     placeholder: '',
     height: 500


    });
    });
     </script>
     


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>

</form>


<script>
function loadData()
{

 $(document).ready(function (){

$("#consulta").dataTable().fnDestroy();
$('#consulta').dataTable({

 //"order": [[ 4, "desc" ]],
//dom: 'Bfrtip',
 "deferRender": true,
"bAutoWidth": false,
"iDisplayLength": 25,
"language": {
"url": "../assets/js/spanish.json"
},
"bProcessing": true,
"sAjaxSource": "../sources/clientes?op=1",
"aoColumns": [

{ mData: 'id'},
{ mData: 'nombres'},
{ mData: 'apellidos'},
{ mData: 'dni'},
{ mData: 'email'},
{ mData: 'telefono'},
{ mData: 'celular'},
{ mData: null,render:function(data){

acciones ='<button type="button" class="btn btn-primary btn-edit btn-sm" data-id="'+data.id+'"><i class="fa fa-edit"></i></button> ';
acciones +='<button type="button" class="btn btn-success btn-sms btn-sm" data-id="'+data.id+'" data-nombres="'+data.nombres+'" data-apellidos="'+data.apellidos+'" data-celular="'+data.celular+'"><i class="fa fa-send"></i></button> ';
acciones +='<button type="button" class="btn btn-warning btn-email btn-sm" data-id="'+data.id+'" data-nombres="'+data.nombres+'" data-apellidos="'+data.apellidos+'" data-email="'+data.email+'"><i class="fa fa-envelope-o"></i></button>';

return acciones;

}}

]

});

 });

}
//Cargar Data
loadData();


//Cargar Modal Agregar
$(document).on('click','.btn-agregar',function (e){

$('#registro')[0].reset();
id = $(this).data('id');
$('.id').val(id);
$('.accion').val('agregar');


$('.btn-submit').html('Agregar');
$('.modal-title').html('Agregar');
$('#modal-registro').modal('show');
});


//Cargar Modal Actualizar
$(document).on('click','.btn-edit',function (e){

$('#registro')[0].reset();
id = $(this).data('id');
$('.id').val(id);
$('.accion').val('actualizar');

//Cargar Datos
$.getJSON('../sources/clientes.php?op=2',{'id':id},function(data){

$('.nombres').val(data.nombres);
$('.apellidos').val(data.apellidos);
$('.telefono').val(data.telefono);
$('.celular').val(data.celular);
$('.email').val(data.email);
$('.dni').val(data.dni);

});

$('.btn-submit').html('Actualizar');
$('.modal-title').html('Actualizar');
$('#modal-registro').modal('show');
});

//Registro
$(document).on('submit','#registro',function (e){

parametros = $(this).serialize();

$.ajax({

url:"../sources/clientes.php?op=3",
type:"POST",
dataType :"JSON",
data:parametros,
beforeSend:function()
{

swal({
  title: "Cargando",
  imageUrl:"../assets/img/loader2.gif",
  text:  "Espere un momento, no cierre la ventana.",
  timer: 3000,
  showConfirmButton: false
});

},
success:function(data)
{


if(data.type=='warning' || data.type=='error')
{

swal({
  title: data.title,
  type:  data.type,
  text:  data.text,
  timer: 3000,
  showConfirmButton: false
});


}
else
{

swal({
  title: data.title,
  type:  data.type,
  text:  data.text,
  timer: 3000,
  showConfirmButton: false
});

loadData();

$('#modal-registro').modal('hide');


}


}

});


e.preventDefault();
})

//Cargar Modal SMS
$(document).on('click','.btn-sms',function (e){

$('#frm-sms')[0].reset();
id        = $(this).data('id');
nombres   = $(this).data('nombres');
apellidos = $(this).data('apellidos');
celular   = $(this).data('celular');
$('.id').val(id);
$('.celular').val(celular);

$('.modal-title').html(nombres+' '+apellidos);
$('#modal-sms').modal('show');
});


//Enviar SMS

$(document).on('submit','#frm-sms',function (e){

parametros  = $(this).serialize();

$.ajax({

url:"../sources/clientes.php?op=4",
type:"POST",
dataType :"JSON",
data:parametros,
beforeSend:function()
{

swal({
  title: "Cargando",
  imageUrl:"../assets/img/loader2.gif",
  text:  "Espere un momento, no cierre la ventana.",
  timer: 3000,
  showConfirmButton: false
});

},
success:function(data)
{

swal({
  title: data.title,
  type:  data.type,
  text:  data.text,
  timer: 3000,
  showConfirmButton: false
});

$('#modal-sms').modal('hide');

}

});

e.preventDefault();
});

//Cargar Modal Mail
$(document).on('click','.btn-email',function (e){

$('#frm-email')[0].reset();
id        = $(this).data('id');
nombres   = $(this).data('nombres');
apellidos = $(this).data('apellidos');
email     = $(this).data('email');
$('.id').val(id);
$('.email').val(email);
$('.username').val(nombres+' '+apellidos);


url = "../sources/clientes.php?op=5";

$.getJSON(url,{'id':id,'username':nombres+' '+apellidos},function(data){

 $('.cuerpo').summernote('code', data.cuerpo);


});

$('.modal-title').html(nombres+' '+apellidos);
$('#modal-email').modal('show');
});


//Enviar MAIL

$(document).on('submit','#frm-email',function (e){

parametros  = $(this).serialize();

$.ajax({

url:"../sources/clientes.php?op=6",
type:"POST",
data:parametros,
beforeSend:function()
{

swal({
  title: "Cargando",
  imageUrl:"../assets/img/loader2.gif",
  text:  "Espere un momento, no cierre la ventana.",
  timer: 3000,
  showConfirmButton: false
});

},
success:function()
{

swal({
  title: "Buen Trabajo",
  type:  "success",
  text:  "Correo Enviado",
  timer: 3000,
  showConfirmButton: false
});

$('#modal-email').modal('hide');

}

});

e.preventDefault();
});

</script>


 <?php  $assets->footer('..'); ?>