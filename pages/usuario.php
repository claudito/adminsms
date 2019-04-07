<?php 
include'../autoload.php';
$session =  new Session();
$session->validity();
$session->acceso();
$assets =  new Assets();
$assets->nav('..','Usuario');
$assets->sweetalert();
$assets->breadcrumbs('Administrador','Usuario');

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
              <th>Usuario</th>
              <th>Role</th>
              <th>Acciones</th>
              

                      
     			</tr>
     		</thead>
     	</table>
     </div>

</div>

</div>


<!-- Modal Pecil -->
<form id="pencil" autocomplete="off">
<div class="modal fade" id="modal-pencil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

     <input type="hidden" name="id" class="id">
      
     <div class="row">
     <div class="col-md-6">
     <div class="form-group">
     <label>Ingresar Contraseña</label>
     <input type="password" name="pass1"  class="pass1 form-control" required minlength="8" maxlength="24">
     </div>
     </div>
     <div class="col-md-6">
     <div class="form-group">
     <label>Confirmar Contraseña</label>
     <input type="password" name="pass2"  class="pass2 form-control" required minlength="8" maxlength="24">
     </div>	
     </div>
     </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</form>


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
     <input type="hidden"   name="tipo" class="tipo">
      
     <div class="row">
     <div class="col-md-6">
     <div class="form-group">
     <label>Nombres</label>
     <input type="text" name="nombres" pattern="[a-zA-Z0-9]+" class="nombres form-control form-control-sm" required 
     onchange="Mayusculas(this)">
     </div>
     </div>
     <div class="col-md-6">
     <div class="form-group">
     <label>Apellidos</label>
     <input type="text" name="apellidos"  pattern="[a-zA-Z0-9]+"  class="apellidos form-control form-control-sm" required  onchange="Mayusculas(this)">
     </div> 
     </div>
     </div>


    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Telefóno</label>
    <input type="tel" name="telefono" min="0"  class="telefono form-control form-control-sm" maxlength="10">
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
    <label>Celular</label>
    <input type="tel" name="celular"  class="celular form-control form-control-sm" required pattern="[0-9]{9}" maxlength="9">
    </div> 
    </div>
    </div>


     <div class="form-group">
     <label>Email</label>
     <input type="email" name="email"  class="email form-control form-control-sm" required>
     </div> 


    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Usuario</label>
    <input type="text" name="usuario"  class="usuario form-control form-control-sm" required maxlength="12">
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
    <label>Contraseña</label>
    <input type="password" name="password" class="password form-control form-control-sm" required minlength="8" maxlength="24">
    </div> 
    </div>
    </div>

     <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Dni</label>
    <input type="text" name="dni"  pattern="[0-9]{8}"  class="dni form-control form-control-sm" required minlength="8"  maxlength="8">
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
    <label>Rol</label>
    <select name="rol" class="rol form-control form-control-sm" required></select>
    </div> 
    </div>
    </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary btn-submit"value="">
      </div>
    </div>
  </div>
</div>
</form>


<!-- Modal Lock -->
<form id="lock" autocomplete="off">
<div class="modal fade" id="modal-lock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="id" class="id">

      
      <div class="frm-permiso"></div>

      


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
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
"sAjaxSource": "../sources/usuario?op=1",
"aoColumns": [

{ mData: 'id'},
{ mData: 'nombres'},
{ mData: 'apellidos'},
{ mData: 'dni'},
{ mData: 'email'},
{ mData: 'telefono'},
{ mData: 'celular'},
{ mData: 'usuario'},
{ mData: 'role'},
{ mData: 'acciones'}


]

});

 });

}
//Cargar Data
loadData();


//Cargar Modal Pencil
$(document).on('click','.btn-pencil',function (e){

id = $(this).data('id');
$('.id').val(id);
$('.pass1').val('');
$('.pass2').val('');
$('#modal-pencil').modal('show');

})

//Actualizar Contraseña
$(document).on('submit','#pencil',function (e){

id    = $('.id').val();
pass1 = $('.pass1').val();
pass2 = $('.pass2').val();

url   = "../sources/usuario.php?op=2";

if(pass1==pass2)
{

$.post(url,{"id":id,"pass":md5(pass1)},function (data){

$('.pass1').val('');
$('.pass2').val('');
$('.pass1').focus();

swal({
  title: "Buen Trabajo",
  type:  "success",
  text:  "Contraseña Actualizada",
  timer: 3000,
  showConfirmButton: false
  })

});

}
else
{

swal({
  title: "Las contraseñas no coinceden",
  type:  "warning",
  text:  "Intente de Nuevo",
  timer: 3000,
  showConfirmButton: false
  })

}

e.preventDefault();
})


//Cargar Modal Agregar
$(document).on('click','.btn-agregar',function (e){

$('.title-registro').html('Agregar');
$('.tipo').val('agregar');
$('.btn-submit').attr('value','Agregar');
$('.nombres').val('');
$('.apellidos').val('');
$('.telefono').val('');
$('.celular').val('');
$('.email').val('');
$('.usuario').val('');
$('.dni').val('');
$('.password').val('');
 $('.password').removeAttr('readonly');

rol = '<option value="">[Seleccionar]</option>';

//Cargar Role
url = "../sources/usuario.php?op=3";

$.getJSON(url,{},function (data){

data.forEach(function (data){

rol +='<option value="'+data.id+'">'+data.nombre+'</option>';


$('.rol').html(rol);

});


});

$('#modal-registro').modal('show');

});


//Cargar Modal Actualizar

$(document).on('click','.btn-edit',function (e){

id = $(this).data('id');
rol     = "";

$('.title-registro').html('Actualizar');
$('.tipo').val('actualizar');
$('.btn-submit').attr('value','Actualizar');



//Leer registro Almacenado
url = "../sources/usuario.php?op=5";

$.getJSON(url,{"id":id},function (data){
 
 $('.id').val(id);
 $('.nombres').val(data.first_name);
 $('.apellidos').val(data.last_name);
 $('.telefono').val(data.phone);
 $('.celular').val(data.cellphone);
 $('.email').val(data.email);
 $('.usuario').val(data.username);
 $('.dni').val(data.id_number);
 $('.password').val('123456');
 $('.password').attr('readonly','readonly');

rol += '<option value="'+data.id_role+'">'+data.role+'</option>';

id_role = data.id_role;

});


//Cargar Roles

url = "../sources/usuario.php?op=3";

$.getJSON(url,{},function (data){

data.forEach(function (data){

 
if(id_role!==data.id)
{

  rol +='<option value="'+data.id+'">'+data.nombre+'</option>';
}


$('.rol').html(rol);

});


});

$('#modal-registro').modal('show');

});


//Registro
$(document).on('submit','#registro',function (e){

parametros = $(this).serialize();

$.ajax({

url:"../sources/usuario.php?op=6",
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


if(data.type=='warning')
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


//Cargar Modal Lock
$(document).on('click','.btn-lock',function (e){

id  = $(this).data('id');
$('.id').val(id);
url = "../sources/usuario.php?op=7";

$('#modal-lock').modal('show');

$.post(url,{"id":id},function (data){


$('.frm-permiso').html(data);


});

 });


//Lock
$(document).on('submit','#lock',function (e){

parametros = $(this).serialize();

$.ajax({

url:"../sources/usuario.php?op=8",
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
success:function(data)
{

swal({
  title: "Buen Trabajo",
  type:  "success",
  text:  "Permisos Actualizados",
  timer: 3000,
  showConfirmButton: false
  })


}

});



e.preventDefault();
 });
</script>


 <?php  $assets->footer('..'); ?>