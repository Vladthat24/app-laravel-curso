<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Tr&aacute;mite Virtual | Sistema Mesa de Partes</title>
  <link rel="icon" href="Vista/_Plantilla/img/escudo.png" type="image/x-icon">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="Vista/_Plantilla/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="Vista/_Plantilla/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="Vista/_Plantilla/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Vista/_Plantilla/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="Vista/_Plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="tramite_nuevo.php" class="navbar-brand">
        <img src="Vista/_Plantilla/img/escudo.png" style="width: 30px" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-weight: bold !important;">Mesa de Partes Virtual</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link"><i class="fa fa-user"></i> &nbsp;Login</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
              class="fas fa-th-large"></i></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Tr&aacute;mite Virtual <small></small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active" style="font-weight: bold;"><i class="far fa-file-word"></i> Tr&aacute;mite</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card  card-danger card-outline " >
              <div class="card-header  d-flex p-0">
                <h3 class="card-title p-3">Tr&aacute;mite</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Nuevo Tr&aacute;mite</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Consultar Tr&aacute;mite</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form autocomplete="false" id="form_registro_tramite">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="card card-danger">
                            <div class="card-header">
                              <h3 class="card-title"><b>Datos del Remitente</b></h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="">
                                <div class="row">
                                  <div class="col-lg-4 form-group">
                                    <label id="xprogress"></label>
                                      <label>Nº DNI (*):</label>
                                      <input class="form-control" type="text" placeholder="Ingresar dni" maxlength="8" id="txtdni" name="txtdni" onkeypress="return soloNumeros(event)">
                                  </div>
                                  <div class="col-lg-8 form-group">
                                      <label>Nombre  (*):</label>
                                      <input class="form-control" type="text" placeholder="Ingresar nombre" maxlength="150" id="txtnombre" name="txtnombre" onkeypress="return soloLetras(event)">
                                  </div>
                                  <div class="col-lg-6 form-group">
                                      <label>Apellido Paterno  (*):</label>
                                      <input class="form-control" type="text" placeholder="Ingresar apellido paterno" maxlength="70" id="txtapepat" name="txtapepat" onkeypress="return soloLetras(event)">
                                  </div>
                                  <div class="col-lg-6 form-group">
                                      <label>Apellido Paterno  (*):</label>
                                      <input class="form-control" type="text" placeholder="Ingresar apellido materno" maxlength="70" id="txtapemat" name="txtapemat" onkeypress="return soloLetras(event)">
                                  </div>
                                  <div class="col-lg-6 form-group">
                                      <label>Celular:</label>
                                      <input class="form-control" onkeypress="return soloNumeros(event)" type="text" placeholder="Ingresar nro de celular" maxlength="9" id="txtcelular" name="txtcelular">
                                  </div>
                                  <div class="col-lg-6 form-group">
                                      <label>Email (*):</label>
                                      <input class="form-control" onkeypress="return soloNumerosyletras(event)" type="text" placeholder="Ingresar email" maxlength="250" id="txtemail" name="txtemail">
                                  </div>
                                  <div class="col-lg-12 form-group" >
                                    <label>Direcci&oacute;n (*):</label>
                                    <input class="form-control" onkeypress="return soloNumerosyletras(event)" type="text" placeholder="Ingresar direcci&oacute;n" id="txt_direccion" name="txt_direccion" maxlength="255" >
                                  </div>
                                  <div class="col-md-12">
                                    <div class="col-12 row">
                                       <label>En representacion de (*):</label>
                                    </div>
                                    <div class="col-12 row">
                                      <input type="text" hidden id="txt_representacion" name="txt_representacion">
                                      <div class="col-4 form-group clearfix">
                                        <div class="icheck-danger d-inline">
                                          <input type="radio" id="rad_representacion1" value="A Nombre Propio" name="r1" checked>
                                          <label for="rad_representacion1" style="font-size: 15px !important;font-weight: normal;"> A Nombre Propio </label>
                                        </div>
                                      </div>
                                      <div class="col-4 form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                          <input type="radio" disabled id="rad_representacion2" value="A otra Persona Natural" name="r1">
                                          <label for="rad_representacion2" style="font-size: 15px !important;font-weight: normal;">A otra Persona Natural</label>
                                        </div>
                                      </div>
                                      <div class="col-4 form-group clearfix">
                                        <div class="icheck-success d-inline">
                                          <input type="radio" id="rad_representacion3" value="Persona Jurídica" name="r1">
                                          <label for="rad_representacion3" style="font-size: 15px !important;font-weight: normal;">Persona Jur&iacute;dica</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="div_juridico"  class="col-12" style="display: none;">
                                    <div class="row">
                                      <div class="col-md-4 form-group">
                                        <label>RUC (*):</label>
                                        <input type="text" id="txt_ruc" name="txt_ruc" maxlength="12"  onkeypress="return soloNumeros(event)" placeholder="Ingresar ruc" class="form-control">
                                      </div>
                                      <div class="col-md-8 form-group">
                                        <label>Empresa (*):</label>
                                        <input type="text" id="txt_empresa" onkeypress="return soloNumerosyletras(event)" name="txt_empresa" placeholder="Ingresar datos de la empresa" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
                                      Campos Obligatorios (*)
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card card-danger">
                            <div class="card-header"  style="background-color: #8900B0;">
                              <h3 class="card-title"><b>Datos del Documento</b></h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                
                                <div class="col-md-12 form-group">
                                  <label>Tipo Documento (*):</label>
                                  <select class="select2-danger select2" name="cmb_tipodocumento" data-dropdown-css-class="select2-danger" id="cmb_tipodocumento" style="width: 100%;">
                                  </select>
                                </div>
                                <div class="col-md-6 form-group" hidden>
                                  <label>Nº Documento (*):</label>
                                  <input type="text" value="" class="form-control" onkeypress="return soloNroDocumento(event)" id="txt_nrodocumentos" maxlength="20" name="txt_nrodocumentos" placeholder="Ingrese nro del documento">
                                </div>
                                <div class="col-md-12 form-group">
                                  <label>Nº Folios:</label>
                                  <input type="text" class="form-control" onkeypress="return soloNumeros(event)" id="txt_folios" name="txt_folios" placeholder="Ingrese nro de hojas">
                                </div>
                                <div class="col-md-12 form-group">
                                  <label>Asunto del Tr&aacute;mite (*):</label>
                                  <textarea rows="2" name="txt_asunto" id="txt_asunto" onkeypress="return soloLetras(event)" class="form-control" style='resize: none' maxlength="255" placeholder="Asunto del documento"></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                  <label for="txt_archivo">Adjuntar documento (pdf,docx,zip,jpg,png,rar,xlsx):</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" accept=".pdf,.PDF,.docx,.zip,.jpg,.png,.jpeg,.rar,.xls,.xlsx" class="custom-file-input form-control" id="txt_archivo" name="txt_archivo">
                                      <label class="custom-file-label" id="lb_archivo" for="txt_archivo">Seleccionar Archivo</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group clearfix">
                                    <div class="icheck-warning d-inline" style="">
                                      <input type="checkbox" onclick="opcion_verificar()" id="checkaceptar">
                                      <label for="checkaceptar" style="text-align: justify;">
                                        Declaro bajo penalidad de perjurio, que toda la información proporcionada es correcta y verídica.
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-12 form-group" style="text-align:left;font-weight:bold;color: #9B0000">
                                  Campos Obligatorios (*)
                                </div>
                                <div class="col-md-12 fom-group">
                                  <input type='text' name='postID' hidden id='postID'>
                                  <input type="text" style="display: none;" id="txtformato" name="txtformato">
                                  <a  style="cursor:pointer;color: white !important" type="button" class="btn btn-block btn-success" id="btn_subir" onclick="registrar_tramite();">&nbsp;Enviar Tr&aacute;mite</a>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                          <div id="div_buscartramite">
                            <div class="card card-success">
                              <div class="card-header">
                                <h3 class="card-title"><b>Rastrear Tr&aacute;mite</b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                              </div>
                              <div class="card-body">
                                <form onsubmit="return false" autocomplete="false">
                                  <div class="row">
                                    <div class="col-lg-4 form-group">
                                      <label>Nº Documento:</label>
                                      <input class="form-control" type="text" placeholder="Nro documento" maxlength="15" id="txtnrodocumento" onkeypress="return soloNroDocumento(event)">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                      <label>A&ntilde;o del documento</label>
                                      <select id="cbm_anio" style="text-align: center;width: 100%" class="select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option>2000</option><option>2001</option><option>2002</option>
                                        <option>2003</option><option>2004</option><option>2005</option>
                                        <option>2006</option><option>2007</option><option>2008</option>
                                        <option>2009</option><option>2010</option><option>2011</option>
                                        <option>2012</option><option>2013</option><option>2014</option>
                                        <option>2015</option><option>2016</option><option>2017</option>
                                        <option>2018</option><option>2019</option><option>2020</option>
                                        <option>2021</option><option>2022</option><option>2023</option>
                                        <option>2024</option><option>2025</option><option>2026</option>
                                        <option>2027</option><option>2028</option><option>2029</option>
                                        <option>2030</option><option>2031</option><option>2032</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4 fom-group">
                                      <label>&nbsp;</label>
                                      <button id="btn_buscar" onclick="buscar_orden_externo()" class="btn btn-block bg-gradient-danger"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div id="div_datostramite" style="display: none;">
                            <div class="card card-orange">
                              <div class="card-header">
                                <h3 class="card-title" style="color: white;"><b>Informaci&oacute;n del Tr&aacute;mite</b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                              </div>
                              <div class="card-body">
                                <form onsubmit="return false" autocomplete="false">
                                  <div class="row">
                                    <div class="col-lg-12 ">
                                      <div class="container-fluid">
                                        <div class="row mb-2">
                                          <div class="col-sm-6">
                                          </div>
                                          <div class="col-sm-6">
                                            <ol class="float-sm-right">
                                              <button class="btn btn-danger btn-sm" style="width: 100%;" onclick="Generar_Reporte()"><i class="fa fa-print"></i> &nbsp;Imprimir Ticket</button>
                                            </ol>
                                            <ol class="float-sm-right">
                                              <button class="btn btn-success btn-sm" style="width: 100%;" onclick="nueva_busqueda()"><i class="fa fa-search"></i> &nbsp;Nueva Busqueda</button>
                                            </ol>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="">
                                        <table class="table" style="width: 100%;">
                                          <tr>
                                            <td style="width: 100%;text-align: center;font-weight: bold;border-top: 2px solid black;background-color: #E4E4E4" colspan="2">
                                              DATOS DEL REMITENTE
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">DNI</td>
                                            <td style="width: 70%;"><label id="lb_dni"></label></td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">NOMBRES - APELLIDOS</td>
                                            <td style="width: 70%;" id="lb_datos"></td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">DIRECCI&Oacute;N</td>
                                            <td style="width: 70%;" id="lb_direccion"></td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">E-MAIL</td>
                                            <td style="width: 70%;" id="lb_email"></td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">REPRESENTACI&Oacute;N</td>
                                            <td style="width: 70%;" id="lb_representacion"></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="table-responsive">
                                        <table class="table" style="width: 100%;">
                                          <tr>
                                            <td style="width: 100%;text-align: center;font-weight: bold;border-top: 2px solid black;background-color: #E4E4E4" colspan="2">
                                              DATOS DEL DOCUMENTO
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">TIPO DOCUMENTO</td>
                                            <td style="width: 70%;" id="lb_tipodocumento"></td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">NRO DOCUMENTO</td>
                                            <td style="width: 70%;">
                                              <label  id="lb_nrodocumento"></label>
                                              <label hidden id="lb_iddocumento"></label> 
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="width: 30%;font-weight: bold;background-color: #E4E4E4">ASUNTO</td>
                                            <td style="width: 70%;" rowspan="3" id="lb_asunto"></td>
                                          </tr>
                                          <tr>
                                            <td style="border: 0px solid black;">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td style="border: 0px solid black;">&nbsp;</td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title"><b>Seguimiento Tr&aacute;mite</b></h3>
                                </div>
                                <div class="card-body">
                                  <form onsubmit="return false" autocomplete="false">
                                    <div class="row">
                                      <div class="col-12" >
                                        <div class="timeline">
                                          <div id="div_historial2"></div>
                                          <div id="div_historial"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <b>Version</b> 3.0.5
    </div>
    <!-- Default to the left -->
    <strong>Derechos Reservados <a href="https://www.facebook.com/softnetpe/" target="_blank">Softnet Solutions Pe</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="Vista/_Plantilla/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Vista/_Plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Vista/_Plantilla/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="Vista/_Plantilla/dist/js/adminlte.min.js"></script>

<script src="Vista/_Plantilla/plugins/select2/js/select2.full.min.js"></script>
<script src="Vista/js/sweetalert2.js"></script>
<script src="Vista/js/console_tramite.js?rev=<?php echo time();?>"></script>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
    //buscar_orden_externo();
  });
</script>
<style type="text/css">
  a, h3, h1{
    font-weight: bold !important;
  }
</style>
<script type="text/javascript">
  $('.select2').select2();
  function soloNumerosyletrasDatapicker(e) {
     key = e.keyCode || e.which;
     tecla = String.fromCharCode(key).toLowerCase();
     letras = "0123456456789-";
     especiales = "";

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
  function soloNumerosyletras(e) {
     key = e.keyCode || e.which;
     tecla = String.fromCharCode(key).toLowerCase();
     letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456456789:/.,\@-_";
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
  function soloNumeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
  }
  function soloLetras(e){
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
      especiales = "8-37-39-46";
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
  function soloNroDocumento(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnñopqrstuvwxyz0123456456789\@-_";
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
  function mantenimiento() {
    Swal.fire("Mensaje de Aviso","Opci&oacute;n en mantenimiento","info");
  }
</script>
<style>
  .btn{
    font-weight: bold;
  }
  h1{
    font-weight: bold;
  }
  small{
    font-weight: bold;
  }
  .select2{
    font-weight:bold;
    text-align-last:center;
  }
</style>
<script type="text/javascript">
  $("#cbm_anio").val("2020").trigger("change");
  traer_idunico();
  $('input[type="file"]').on('change', function(){
      var ext = $( this ).val().split('.').pop();
      if ($( this ).val() != '') {
      if(ext == "PDF" || ext == "pdf" || ext == "docx"|| ext == "DOCX"|| ext == "zip" || ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "rar" || ext == "xlsx"  || ext == "xls" ){
          if($(this)[0].files[0].size > 31457280){ //---- 30 MB 
          //if($(this)[0].files[0].size > 1048576){ // 1 MB
          //if($(this)[0].files[0].size > 10485760){ // ---> 10 MB
            Swal.fire("El archivo selecionado es demasiado pesado","<label style='color:#9B0000;'>seleccionar un archivo mas liviano</label>","warning");
            $("#txtformato").val("");
            $("#txt_archivo").val("");
            $("#lb_archivo").html("Seleccionar Archivo");
            return;
            //$("#btn_subir").prop("disabled",true);
          }else{
            //$("#btn_subir").attr("disabled",false);
          }
          $("#txtformato").val(ext);
        }
        else
        {
          $("#txtformato").val("");
          $("#txt_archivo").val("");
          $("#lb_archivo").html("Seleccionar Archivo");
          $( this ).val('');
          Swal.fire("Extensión no permitida: " + ext,"","error");
        }
      }
  });
  $(".form-control").on('paste', function(e){
    e.preventDefault();
  });
  var cbm_representacion ="";
  var porrepresentacion=document.getElementsByName("r1");
  for(var i=0;i<porrepresentacion.length;i++){
      if(porrepresentacion[i].checked)
          cbm_representacion=porrepresentacion[i].value;
        //alert(cbm_representacion);
  }
  $("#txt_representacion").val(cbm_representacion);

  if (cbm_representacion==="A Nombre Propio") {
    document.getElementById('div_juridico').style.display = 'none';
  }
  if (cbm_representacion==="A otra Persona Natural") {
    document.getElementById('div_juridico').style.display = 'none';
  }
  if (cbm_representacion==="Persona Jurídica") {
    document.getElementById('div_juridico').style.display = 'block';
  }
  $('#rad_representacion1').on('click', function() {
      document.getElementById('div_juridico').style.display = 'none';
      $("#txt_representacion").val("A Nombre Propio");
  });
  $('#rad_representacion2').on('click', function() {
      document.getElementById('div_juridico').style.display = 'none';
      $("#txt_representacion").val("A otra Persona Natural");
  });
  $('#rad_representacion3').on('click', function() {
      document.getElementById('div_juridico').style.display = 'block';
      $("#txt_representacion").val("Persona Jurídica");
  });
  combo_tipodocumento_externo();
  opcion_verificar();
  function opcion_verificar() {
    if (document.getElementById('checkaceptar').checked==false) {
      $("#btn_subir").addClass("disabled");
    }else{
      $("#btn_subir").removeClass("disabled");
    }
  }
</script>
<style type="text/css">
  td{
    border: 2px solid black;
    word-wrap: break-word;
    text-align: justify;
  }
</style>
<style type="text/css">
  .timeline > div > div {
    margin-bottom: 15px;
    margin-right: 10px;
    position: relative;
}
  .timeline > div > .time-label > span {
    border-radius: 4px;
    background-color: #fff;
    display: inline-block;
    font-weight: 600;
    padding: 5px;
}
.timeline > div > .fa, .timeline > div > .fab, .timeline > div > .far, .timeline > div > .fas, .timeline > div > div > .fas, .timeline > div > .glyphicon, .timeline > div > .ion {
    background: #adb5bd;
        background-color: rgb(173, 181, 189);
    border-radius: 50%;
    font-size: 15px;
    height: 30px;
    left: 18px;
    line-height: 30px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 30px;
}
.timeline > div > div > .timeline-item {
    box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
    border-radius: .25rem;
    background: #fff;
    color: #495057;
    margin-left: 60px;
    margin-right: 15px;
    margin-top: 0;
    padding: 0;
    position: relative;
}

.timeline > div > div > .timeline-item > .time {
    color: #999;
    float: right;
    font-size: 12px;
    padding: 10px;
}
.timeline > div >  div > .timeline-item > .timeline-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
    color: #495057;
    font-size: 16px;
    line-height: 1.1;
    margin: 0;
    padding: 10px;
}
.timeline > div > div > .timeline-item > .timeline-body, .timeline > div > .timeline-item > .timeline-footer {
    padding: 10px;
}
.timeline > div > div > .timeline-item > .timeline-body, .timeline > div > .timeline-item > .timeline-footer {
    padding: 10px;
}
</style>
<div id="div_progress">
  <div class="modal fade bs-example-modal-lg" id="modal_procesar_datos_2">
    <div class="modal-dialog modal-lg modal-dialog-centered"  style="width: 75%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-clock-o"></i> ESPERE UNOS MOMENTOS PORFAVOR: LOS DATOS SE ESTAN PROCESANDO.</h4>
        </div>
        <div class="modal-body center-block"> 
          <div id="div_cadena_progress"></div>       
        </div>
      </div>
    </div>
  </div>
</div>