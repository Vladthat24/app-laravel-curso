<?php
require_once '../conexion.php';
$codigo=htmlspecialchars($_GET['codigo'],ENT_QUOTES,'UTF-8');
$query="SELECT
documento.documento_id,
documento.doc_dniremitente,
documento.doc_nombreremitente,
documento.doc_apepatremitente,
documento.doc_apematremitente,
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
documento.doc_fecharegistro,
documento.area_id,
documento.doc_estatus,
tipo_documento.tipodo_descripcion
FROM
documento
INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
where
documento.documento_id = '".$codigo."'";
$resultado = $mysqli->query($query);
while($row = $resultado->fetch_assoc()){
$html.='<style>
@page {
    margin: 10mm;
    margin-header: 0mm;
    margin-footer: 0mm;
}

</style><h3>TR&Aacute;MITE</h3>
<span style="font-size:12px"><b>Número de Expediente:
    </b> '.$row['documento_id'].'
</span><br><br>
<span style="font-size:12px"><b>Número de trámite:
    </b> '.$row['doc_nrodocumento'].'
</span><br><br>
<span style="font-size:12px"><b>Fecha - Hora:
    </b> '. date('d-m-Y H:i:s', strtotime($row['doc_fecharegistro'])).'
</span><br><br>
<span style="font-size:12px"><b>Tipo:
    </b> '.strtoupper(substr(utf8_encode($row['tipodo_descripcion']),0,32)).'
</span><br><br>
<span style="font-size:12px"><b>DNI:
    </b> '.$row['doc_dniremitente'].'
</span><br><br>
<span style="font-size:12px"><b>Remitente:<br>
    </b> '.strtoupper(substr(utf8_encode($row['doc_nombreremitente']),0,32)).' '.strtoupper(substr(utf8_encode($row['doc_apepatremitente']),0,32)).' '.strtoupper(substr(utf8_encode($row['doc_apematremitente']),0,32)).'
</span><br><br><hr><br>
<table class="items" width="100%" cellpadding="8">
<thead>
	<tr>		
        <td class="barcodecell" align="center"><barcode code="'.$row['documento_id'].'" type="QR" class="barcode" size="1.2" error="M" disableborder="1"/></td>
	</tr>
</thead>

</table>
';
}
require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(
['mode' => 'UTF-8', 'format' => [80,130]]
);

$mpdf->WriteHTML($html);
$mpdf->Output();