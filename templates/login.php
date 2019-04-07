<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

  <!-- MD5 JS -->
  <script src="https://blueimp.github.io/JavaScript-MD5/js/md5.js"></script>

  <!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="assets/vendor/jquery/jquery.min.js"></script>
   
    <script src="ajax/login.js"></script>

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">Administrador</div>
        <div class="card-body">
          <form id="login">

           <!-- Hidden -->
        <input type="hidden"  id="latitude" >
        <input type="hidden"  id="longitude" >


        <input type="hidden" id="url" value="<?= URL ?>">


             <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="user" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus">
                <label for="user">Usuario</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="pass" class="form-control" placeholder="Contraseña" required="required">
                <label for="pass">Contraseña</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Recordar Contraseña
                </label>
              </div>
            </div>
            <button  type="submit"  class="btn btn-primary btn-block"  >Ingresar</button>
          </form>
          <div class="text-center">
          <!--
            <a class="d-block small mt-3" href="register.html">Register an Account</a>
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
              -->
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- GeoLocalización -->
<script>
function geoFindMe() {
  var output = document.getElementById("out");
  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    $('#latitude').val(latitude);
    $('#longitude').val(longitude);
  };
  navigator.geolocation.getCurrentPosition(success);
}
geoFindMe();
</script>


  </body>

</html>
