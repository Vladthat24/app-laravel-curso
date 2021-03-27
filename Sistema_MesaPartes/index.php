<?php
  session_start();
  if (isset($_SESSION['id_usuario_sistematramite'])) {
    header('Location: Vista/index.php');
  }
?>
<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicio de sesion | Sistema Mesa de Partes</title>
  <link rel="icon" href="Vista/_Plantilla/img/escudo.png" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="Vista/_Plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="Vista/_Plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Vista/_Plantilla/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<center>
    <img src="Vista/_Plantilla/img/escudo2.png" style="width: 300px;"> 
</center>
<div class="login-box ancho">
  <div class="login-logo">
    <a style="font-weight: bold"><b>Sistema Mesa de Partes</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Ingrese sus datos para iniciar sesion</b></p>
      <form class="form-horizontal" onsubmit="return false" autocomplete="false">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="txt_usuario" onkeypress="return soloNroDocumento(event)" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="txt_pass" onkeyup = "if(event.keyCode == 13) VerificarUsuario()" onkeypress="return soloNroDocumento(event)" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="remember">
            <label for="remember">
              Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button onclick="VerificarUsuario()" class="btn btn-primary btn-block">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
      <p class="mb-1">
        <a href="tramite_nuevo.php">Tr&aacute;mite Nuevo</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="Vista/_Plantilla/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Vista/_Plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="Vista/_Plantilla/dist/js/adminlte.min.js"></script>

<script src="Vista/js/sweetalert2.js"></script>
<script src="Vista/js/console_usuario.js?rev=<?php echo time();?>"></script>
</body>
<style type="text/css">
  .btn{
    font-weight: bold;
  }
</style>
</html>
<script type="text/javascript">
  function soloNroDocumento(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnopqrstuvwxyz0123456456789\@-_+*/";
    especiales = "8-37-39-46-58";

    tecla_especial = false
    for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
  }
  $(".form-control").on('paste', function(e){
    e.preventDefault();
  })
</script>
<style type="text/css">
    @media (min-width:102px){
        .ancho{
          width: 350px;
        }
    }
    @media (min-width:580px){
        .ancho{
          width: 500px;
        }
    }
    @media (min-width:1600px){
        .ancho{
            width: 500px;
        }
    }
</style>