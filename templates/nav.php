<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $titulo ?> | PerúTec</title>

   <!-- Favicon -->
<link rel="shortcut icon" sizes="16x16" href="">

    <!-- Bootstrap core CSS-->
    <link href="<?= URL ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?= URL ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Font Awesome -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Page level plugin CSS-->
    <link href="<?= URL ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= URL ?>assets/css/sb-admin.css" rel="stylesheet">


 <!-- Bootstrap core JavaScript-->
    <script src="<?= URL ?>assets/vendor/jquery/jquery.min.js"></script>


<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

  <!-- MD5 JS -->
  <script src="https://blueimp.github.io/JavaScript-MD5/js/md5.js"></script>



<!-- Convertir a Mayúsculas -->
<script>
function Mayusculas(field) 
{
field.value         = field.value.toUpperCase();
}
</script>
<style>
table{font-size: 13px;}
.btn-responsive {
    white-space: normal !important;
    word-wrap: break-word;
}
</style>



  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="#">Admin</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!-- 
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div> -->
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
      <!-- 
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> 
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>-->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"><!-- 
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a> 
            <div class="dropdown-divider"></div>-->
            <a class="dropdown-item" onclick="logout()"  style="cursor:pointer;">Cerrar Sesión</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

       <!-- Sidebar -->
      <ul class="sidebar navbar-nav toggled">
        <li class="nav-item active">
          <a class="nav-link" href="<?= URL ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

         <!-- Inicio NAV -->
        
        <?php $permiso = new Permiso(); ?>
        <?php foreach ($permiso->lista() as $key_c => $value_c): ?>
        
        <?php if ($value_c['tipo']=='menu'): ?>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="<?= $value_c['icon'] ?>"></i>
            <span><?= $value_c['nombre'] ?></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          
            <?php foreach ($permiso->lista() as $key => $value): ?>
            <?php if ($value['tipo']=='submenu'): ?>
            <?php if ($value['id_menu']==$value_c['id_menu']): ?>
            <a class="dropdown-item" href="<?= URL.$value['url'] ?>"><?= $value['nombre'] ?></a>
            <?php endif ?>
            <?php endif ?>
            <?php endforeach ?>
            
          </div>
        </li>
        <?php endif ?>
 
       
        <?php endforeach ?>

    
      <!-- FIN NAV -->
      

      </ul>


  <div id="content-wrapper">

  <div class="container-fluid">


        <script>
          function logout(){

        $.ajax({
        url:localStorage.url_ipeg+'controlador/logout.php',
        type:'POST',
        async:true,
        data:{accion:'logout'},
        success:function()
        {  


        self.location=localStorage.url_ipeg ;
        },
        error:function(xhr,status,error)
        {
        alert('ERROR: '+error);
        }


        });
        }
        </script>


