<?php
	require("postClass.php");
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$thisPost = new Post_Block;
if ($thisPost->postBlock($_POST['postID'])) {
	$txt_iddocumento    = htmlspecialchars($_POST['txt_iddocumento_derivar'],ENT_QUOTES,'UTF-8');
    $txt_idareaactual   = htmlspecialchars($_POST['txt_idarea_derivar'],ENT_QUOTES,'UTF-8');
    $txt_idareadestino  = htmlspecialchars($_POST['combo_area_derivar'],ENT_QUOTES,'UTF-8');
    $txt_descripcion    = htmlspecialchars($_POST['txt_descripcion_derivar'],ENT_QUOTES,'UTF-8');
    $txt_estado 	    = htmlspecialchars($_POST['combo_estatus_derivar'],ENT_QUOTES,'UTF-8');
    $txt_idusuario      = htmlspecialchars($_POST['txtidusuario_derivar'],ENT_QUOTES,'UTF-8');
    $txt_idmovimiento   = htmlspecialchars($_POST['txt_idmovimiento_derivar'],ENT_QUOTES,'UTF-8');
    $formato 	    = htmlspecialchars($_POST['txtformato'],ENT_QUOTES,'UTF-8');

	if ($_FILES['txt_archivo']['tmp_name']!="") {
		$total_imagenes = count(glob('../../Vista/documento/archivo/{*.pdf,*.PDF,*.docx}',GLOB_BRACE));
		$archivo  = "archivo/".($total_imagenes+1).".".$formato;
		$nombre   = "../../Vista/documento/archivo/".($total_imagenes+1).".".$formato;
		$ruta1    = $_FILES['txt_archivo']['tmp_name'];
	}else{
		$archivo  = ""; 
	}
	
	$consulta = $MC->registrar_derivacion_finalizacion_con_archivo($txt_iddocumento,$txt_idareaactual,$txt_idareadestino,$txt_descripcion,$txt_estado,$txt_idusuario,$txt_idmovimiento,$archivo);
	if ($_FILES['txt_archivo']['tmp_name']!="") {
		if ($consulta) {
			move_uploaded_file($_FILES["txt_archivo"]["tmp_name"], $nombre);
		}
	}
} else {
    // Doble post, no procesamos el form.
    $consulta=10;
}
	echo $consulta;
?>

