<?php
	require("postClass.php");
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$thisPost = new Post_Block;
if ($thisPost->postBlock($_POST['postID'])) {
	$txtdni  		= htmlspecialchars($_POST['txtdni'],ENT_QUOTES,'UTF-8');
    $txtnombre 		= htmlspecialchars($_POST['txtnombre'],ENT_QUOTES,'UTF-8');
    $txtapepat      = htmlspecialchars($_POST['txtapepat'],ENT_QUOTES,'UTF-8');
    $txtapemat  	= htmlspecialchars($_POST['txtapemat'],ENT_QUOTES,'UTF-8');

    $txtcelular  	= htmlspecialchars($_POST['txtcelular'],ENT_QUOTES,'UTF-8');
    $txtemail 		= htmlspecialchars($_POST['txtemail'],ENT_QUOTES,'UTF-8');
    $txt_direccion  = htmlspecialchars($_POST['txt_direccion'],ENT_QUOTES,'UTF-8');
    $txt_representacion= htmlspecialchars($_POST['txt_representacion'],ENT_QUOTES,'UTF-8');

    $txt_ruc  	  	= htmlspecialchars($_POST['txt_ruc'],ENT_QUOTES,'UTF-8');
    $txt_empresa  	= htmlspecialchars($_POST['txt_empresa'],ENT_QUOTES,'UTF-8');

    $cmb_tipodocumento = htmlspecialchars($_POST['cmb_tipodocumento'],ENT_QUOTES,'UTF-8');
    $txt_nrodocumentos = htmlspecialchars($_POST['txt_nrodocumentos'],ENT_QUOTES,'UTF-8');
    $txt_folios  	   = htmlspecialchars($_POST['txt_folios'],ENT_QUOTES,'UTF-8');
    $txt_asunto        = htmlspecialchars($_POST['txt_asunto'],ENT_QUOTES,'UTF-8');
    $formato  	       = htmlspecialchars($_POST['txtformato'],ENT_QUOTES,'UTF-8');
	if (!empty($_FILES["txt_archivo"]["name"])) {
		$total_imagenes = count(glob('../../Vista/documento/archivo/{*.pdf,*.PDF,*.docx,*.jpg,*.png,*.jpeg,*.rar,*.zip,*.xlsx,*.xls}',GLOB_BRACE));
		$archivo  = "archivo/".($total_imagenes+1).".".$formato;
		$nombre   = "../../Vista/documento/archivo/".($total_imagenes+1).".".$formato;
		$ruta1    = $_FILES['txt_archivo']['tmp_name'];
		move_uploaded_file($ruta1, $nombre); 
	}else{
		$archivo  = ""; 
	}
	
	$consulta = $MC->registrar_documento_externo($txtdni,$txtnombre,$txtapepat,$txtapemat,$txtcelular,$txtemail,$txt_direccion,$txt_ruc,$txt_empresa,$cmb_tipodocumento,$txt_nrodocumentos,$txt_folios,$txt_asunto,$archivo,$txt_representacion);
	if (!empty($_FILES["txt_archivo"]["name"])) {
		if ($consulta) {
			move_uploaded_file($ruta1, $nombre); 
		}
	}
} else {
    // Doble post, no procesamos el form.
    $consulta=10;
}
	echo $consulta;
?>

