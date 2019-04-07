<?php 
include'../autoload.php';
$session =  new Session();
$session->validity();
$session->acceso();
$assets =  new Assets();
$assets->nav('..','Plantilla Correo');
$assets->breadcrumbs('Reserva','Plantilla Correo');
$assets->summernote();




 ?>


<div class="row">
  
<div class="col-md-12">

  
    <div class="table-responsive">
      <table id="consulta"  class="table table-hover table-condensend" style="font-size: 12px">
        <thead>
         <tr class="table-active">
              <th>Id</th>
              <th>Nombre</th>
              <th>Asunto</th>
              <th>Banner</th>
              <th>Cuerpo</th>
                      
          </tr>
        </thead>
      </table>
     </div>

</div>

</div>

<!-- Modal Actualizar  -->
<form id="actualizar" autocomplete="off">
<!-- Modal -->
<div class="modal fade" id="modal-actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="id"      class="id">

      <div class="form-group">
      <textarea id="cuerpo" name="cuerpo" class="cuerpo" required ></textarea>
      </div>
      <script>
      $(document).ready(function() {
      $('#cuerpo').summernote({

      height:350,
      placeholder: 'Ingrese el texto.'


      });
      });
      </script>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- Modal Banner  -->
<form id="banner" autocomplete="off">
<!-- Modal -->
<div class="modal fade" id="modal-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="id" class="id">



      <div class="input-group">
        <input type="file"  name="archivo" class="archivo form-control"  accept="image/*" required>
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Subir Imagen</button>
        </span>
      </div>
    
     <p></p>

      <div class="form group">
      <label>Url Imagen:&nbsp;&nbsp;</label><label id="url"></label>
      </div>


      </div>

    </div>
  </div>
</div>
</form>

<!-- Modal Asunto -->
<form id="asunto" autocomplete="off">
  
<div class="modal fade" id="modal-asunto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asunto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="id" class="id">

      <div class="form-group">
      <label>Nombre para mostrar</label>
      <input type="text" name="user_mail" class="user_mail form-control" required 
      onchange="Mayusculas(this)">
      </div>


      <div class="form-group">
      <label>Asunto</label>
      <input type="text" name="asunto" class="asunto form-control" required 
      onchange="Mayusculas(this)">
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
"sAjaxSource": "../sources/plantilla-correo.php?op=1",
"aoColumns": [

{ mData: 'id'},
{ mData: 'nombre'},
{ mData: null,render:function(data){

asunto = '<button type="button" class="btn btn-primary btn-sm btn-asunto" data-nombre="'+data.nombre+'" data-id="'+data.id+'"  data-asunto="'+data.asunto+'"  data-user_mail="'+data.user_mail+'"><i class="fa fa-edit"></i> Editar</button>';

return asunto;


}},
{ mData: null,render:function(data){

banner = '<button type="button" class="btn btn-primary btn-sm btn-banner" data-nombre="'+data.nombre+'" data-id="'+data.id+'"><i class="fa fa-upload"></i> Subir / Actualizar</button>';

return banner;

}},
{ mData: null,render:function(data){

cuerpo = '<button type="button" class="btn btn-primary btn-sm btn-cuerpo" data-nombre="'+data.nombre+'" data-id="'+data.id+'"><i class="fa fa-edit"></i> Editar</button>';

return cuerpo;


}}

]

});

 });

}
//Cargar Data
loadData();

//Cargar Modal Actualizar Cuerpo
$(document).on('click','.btn-cuerpo',function(){


id        = $(this).data('id');
nombre    = $(this).data('nombre');

$('.id').val(id);


url = "../sources/plantilla-correo.php?op=2";

$.getJSON(url,{'id':id},function(data){

$('.cuerpo').summernote('code', data.cuerpo);


});


$('.modal-title').html(nombre);
$('#modal-actualizar').modal('show');

});


//Formulario Actualizar
$(document).on('submit','#actualizar',function (e){

parametros = $(this).serialize();

$.ajax({

url:"../sources/plantilla-correo.php?op=3",
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
  title:"Buen Trabajo",
  type: "success",
  text: "Registro Actualizado",
  timer: 3000,
  showConfirmButton: false
});


}

});


e.preventDefault();
});

//Cargar Modal Banner
$(document).on('click','.btn-banner',function(){

$('#url').html('');
id        = $(this).data('id');
nombre    = $(this).data('nombre');

$('.id').val(id);

url = "../sources/plantilla-correo.php?op=5";

$.getJSON(url,{'id':id},function(data){

if(data.msj=='yes')
{
 
 $('#url').html(data.url);

}




});




$('.modal-title').html(nombre);
$('#modal-banner').modal('show');

});



//Formulario Subir Archivo
$(document).on('submit','#banner',function (e){

parametros = $(this).serialize();

$.ajax({

url:"../sources/plantilla-correo.php?op=4",
type:"POST",
data: new FormData(this),
contentType: false,
cache: false,
processData:false,
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

$('.archivo').val('');
$('#modal-banner').modal('hide');

swal({
  title:"Buen Trabajo",
  type: "success",
  text: "Registro Actualizado",
  timer: 3000,
  showConfirmButton: false
});


}

});


e.preventDefault();
});


//Cargar Modal Asunto
$(document).on('click','.btn-asunto',function(){

id        = $(this).data('id');
nombre    = $(this).data('nombre');
asunto    = $(this).data('asunto');
user_mail = $(this).data('user_mail');

$('.id').val(id);
$('.asunto').val(asunto);
$('.user_mail').val(user_mail);

$('.modal-title').html(nombre);
$('#modal-asunto').modal('show');


});


//Actualizar Asunto
$(document).on('submit','#asunto',function(e){

parametros = $(this).serialize();


$.ajax({

url:"../sources/plantilla-correo.php?op=6",
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
success:function(){

//$('#modal-asunto').modal('hide');
//Cargar Data
loadData();

swal({
  title:"Buen Trabajo",
  type: "success",
  text: "Registro Actualizado",
  timer: 3000,
  showConfirmButton: false
});



}




});




e.preventDefault();
});
</script>


 <?php  $assets->footer('..'); ?>