<?php
require "../PHPMailer/PHPMailerAutoload.php";
require 'conexion.php';
function smtpmailer($to, $from, $from_name, $subject, $body){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 

    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'softnetpe.com';
    $mail->Port = "465";  
    $mail->Username = 'atencionalcliente@softnetpe.com';
    $mail->Password = '30856077$99';
    $mail->IsHTML(true);
    $mail->From="atencionalcliente@softnetpe.com";
    $mail->FromName=$from_name;
    $mail->Sender=$from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send())
    {
        $error ="Please try Later, Error Occured while Processing...";
        return $error; 
    }
    else 
    {
        $error = "Thanks You !! Your email is sent.";  
        return $error;
    }
}
$id_seguimiento = $_POST["id_seguimiento"];
$query = "SELECT
documento.documento_id,
documento.doc_dniremitente,
CONCAT_WS(' ',
documento.doc_nombreremitente,
documento.doc_apepatremitente,
documento.doc_apematremitente) AS remitente,
documento.doc_celularremitente,
documento.doc_emailremitente,
documento.doc_direccionremitente,
documento.doc_representacion,
documento.doc_ruc,
documento.doc_empresa,
documento.tipodocumento_id,
documento.doc_nrodocumento,
documento.doc_folio,
documento.doc_asunto,
documento.doc_archivo,
DATE_FORMAT(documento.doc_fecharegistro,'%d/%m/%Y') doc_fecharegistro,
documento.area_id,
documento.doc_estatus,
tipo_documento.tipodo_descripcion,
documento.area_origen,
documento.area_destino,
IFNULL(origen.area_nombre ,'EXTERNO')as origen,
destino.area_nombre as destino
FROM
documento
INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
LEFT JOIN area AS origen ON documento.area_origen = origen.area_cod
LEFT JOIN area AS destino ON documento.area_destino = destino.area_cod
WHERE documento.documento_id = '".$_POST["id_seguimiento"]."'";
$resultado1 = $mysqli->query($query);
$query2='
SELECT
usuario.empleado_id,
empleado.emple_email
FROM
usuario
INNER JOIN empleado ON usuario.empleado_id = empleado.empleado_id
WHERE usuario.usu_rol = "Administrador"
';
$resultado2 = $mysqli->query($query2);

$mensaje = '';
while($row1 = $resultado1->fetch_assoc()){
    $mensaje .='
    <table width="70%" cellspacing="0" cellpadding="5">
        <tr>
            <td colspan="2" style="border:1px solid black;text-align: center;font-weight: bold;background-color: #F0F0F0;" height="30px" >REMITENTE</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">DNI:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_dniremitente'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">REMITENTE:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['remitente'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">CELULAR:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_celularremitente'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">EMAIL:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_emailremitente'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">DIRECCI&Oacute;N:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_direccionremitente'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">EN REPRESENTACI&Oacute;N:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_representacion'].'</td>
        </tr>';
        if ($row1['doc_representacion'] == 'Persona Jurídica') {       
            $mensaje .='
            <tr>
                <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">RUC - EMPRESA:</td>
                <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_ruc'].' - '.$row1['doc_empresa'].'</td>
            </tr>';
        }
        $mensaje .='
        <tr>
            <td colspan="2" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;text-align: center;font-weight: bold;background-color: #F0F0F0;" height="30px">DOCUMENTO</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">TIPO DOCUMENTO:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['tipodo_descripcion'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">NRO FOLIO:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_folio'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">NRO SEGUIMIENTO:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['documento_id'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">NRO DOCUMENTO:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">'.$row1['doc_nrodocumento'].'</td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">ARCHIVO:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;">';
                if ($row1['doc_archivo']!="") {
                    $mensaje .='<a target="_blank" href="https://softnetpe.com/Sistema_MesaPartes/Vista/documento/descargar.php?file='.$row1['doc_archivo'].'">DESCARGAR AQU&Iacute;</a>';
                }else{
                    $mensaje .='NO EXISTE ARCHIVO';
                }
            $mensaje .='
            </td>
        </tr>
        <tr>
            <td width="20%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold;background-color: #F0F0F0;">FECHA CREACI&Oacute;N:</td>
            <td width="80%" style="border:1px solid black;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;text-align: justify;font-weight: bold">'.$row1['doc_fecharegistro'].'</td>
        </tr>
    </table>
';
}
$correo = '';
while($row2 = $resultado2->fetch_assoc()){
    $correo = $row2['emple_email'];
}
$to1   = $correo;
$from1 = 'atencionalcliente@softnetpe.com';
$name1 = 'CONSTANCIA DE REGISTRO';
$subj1 = 'Datos del tramite' ;
$msg1 = $mensaje;
$error=smtpmailer($to1,$from1, utf8_decode($name1),$subj1, utf8_decode($msg1));
    echo $correo;
?>