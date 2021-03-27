<?php
ini_set("pcre.backtrack_limit", "5000000");
require_once __DIR__ . '/../vendor/autoload.php';
require '../conexion.php';
$nombrepdf="";
$mpdf = new \Mpdf\Mpdf(['mode' => 'UTF-8', 'format' => 'A4']);
        $query1 = "SELECT
documento.documento_id,
documento.doc_fecharegistro
FROM
documento
where (DATE_FORMAT(documento.doc_fecharegistro,'%Y-%m-%d') BETWEEN '".$_GET['fecnainicio']."' AND '".$_GET['fecnafin']."')
AND documento.doc_estatus LIKE '".$_GET['estado']."%' ";
  date_default_timezone_set('America/Lima');

        $resultado1 = $mysqli->query($query1);
      $html = '';

  
        $html .= '
        <html>
        <head>
        <style>
            @page {
                
                size: auto;
                odd-header-name: html_myHeader1;
                /*odd-footer-name: html_myFooter1;*/
                margin-top: 145px; /* <any of the usual CSS values for margins> */
                margin-bottom: 40px;
                margin-left: 20px;
                margin-right: 20px;
            }
            table{
                table-layout: fixed;
                border-collapse: collapse;
            }

            #table2 {
              border-collapse: collapse;
              table-layout: fixed;
            }
            th, td {
                border-collapse: collapse;
                word-wrap: break-word;
            }
            .logo{
              width: 120px;
              height:100px;
            }
            body {
               font-family: Arial !important;
            }
            .derecha{
              width:359px;
              float: right;
            }
            .barcodecell {
             text-align: center;
             vertical-align: middle;
             padding: 0;
            }
            .barcode {
               padding: 1.5mm;
               padding-left: 0px;
               margin: 0;
               vertical-align: top;
               color: #000000;
            }
            span{
              font-size:17px
            }
            td{
              font-size:15px
            }
        </style>
        </head>

        <body style="font-family: "Arial",Sans-Serif;">

          <htmlpageheader name="myHeader1" style="display:none;">
            <table width="100%" border="0">
                <tr>
                  <th style="width:50px">
                    <img src="escudo.jpg" style="width:80px">
                  </th>
                  <th  valign="top" align="center" style="width:400px;border-right: 0px;vertical-align: middle;font-size:16px">
                    Instituto de Educación Superior Tecnólogico<br>
                    Público de las Fuerzas Armadas
                  </th>
                  <th  valign="top"  align="center"  style="width:300px;border-left: 0px;">
                  <br>
                  </th>
                  <th style="width:50px"></th>
                  <th  valign="top" align="right" style="width:200px;vertical-align: middle;">
                    Page: {PAGENO}/{nbpg}<br>'.date('d / m / Y').' </th>
                  <th style="width:50px"></th>
                </tr>
                <tr>
                  <th colspan="6"><br></th> 
                </tr>
              </table>
              <table width="100%" border="0"> 
                <tr>
                  <th style="width:50px"></th>
                  <th style="width:100px"></th>
                    <th colspan="2" style="background-color:#DCDCDC;height:30px">TR&Aacute;MITE DOCUMENTARIO - HOJA DE CARGO</th> 
                    <th style=""></th>
                    <th style="width:50px"></th>
                </tr>
                <tr>
                  <th colspan="6"><br></th> 
                </tr> 
            </table>
            <br>
          </htmlpageheader>
          <table border="0" id="table2" style="table-layout:fixed;width: 100%;font-size:10px;">
           ';
           $contador=0;
           while($row1 = $resultado1->fetch_assoc()){
            $nombrepdf=$row1['documento_id'];
            
            $contador++;
            //$contador=0;
                $query2 = "SELECT
                documento.documento_id,
                documento.doc_nrodocumento,
                CONCAT_WS(' ',
                documento.doc_nombreremitente,
                documento.doc_apepatremitente,
                documento.doc_apematremitente) AS solicitante,
                documento.doc_asunto,
                destino.area_nombre,
                tipo_documento.tipodo_descripcion,
                documento.doc_folio,
                date_format(documento.doc_fecharegistro,'%d/%m/%Y %H:%i:%s')doc_fecharegistro,
                IF(documento.area_origen = 0,'EXTERIOR','INTERNO') area_origen,
                documento.doc_estatus
                FROM
                documento
                INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
                INNER JOIN area AS destino ON documento.area_id = destino.area_cod
                where documento.documento_id='".$row1['documento_id']."'";
                $resultado2 = $mysqli->query($query2);
                while($row2 = $resultado2->fetch_assoc()){
                  
                  $html.='
                  <tr style="">
                    <td style="width:130px;text-align:left;border-top: 2px solid black;border-right: 0px;height:30px;"><b>Nº REGISTRO</b></td>
                    <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;">'.strtoupper(substr(utf8_encode($row2['documento_id']),0,32)).'</td>
                    <td style="width:200px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;"><b>ESTADO</b> <span style="color:#9B0000;">'.strtoupper(substr(utf8_encode($row2['doc_estatus']),0,32)).'</span></td>
                    <td  style="width:300px;text-align:center;height:30px;border-top: 2px solid black;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>Nº EXPDIENTE</b></td>
                    <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row2['doc_nrodocumento']),0,32)).'</td>
                    <td style="width:100px"><b>Nº FOLIOS</b> '.strtoupper(substr(utf8_encode($row2['doc_folio']),0,32)).'</td>
                    <td  style="width:300px;text-align:center;height:30px;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>SOLICITANTE</b></td>
                    <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row2['solicitante']),0,32)).'</td>
                    <td  style="width:400px;text-align:center;height:30px;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>ASUNTO</b></td>
                    <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row2['doc_asunto']).'</td>
                    <td  style="width:300px;text-align:center;height:30px;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>LOCALIZADO</b></td>
                    <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row2['area_nombre']).'</td>
                    <td  style="width:300px;text-align:center;height:30px;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>TIPO DOCUMENTO</b></td>
                    <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row2['tipodo_descripcion']).'</td>
                    <td  style="width:300px;text-align:center;height:30px;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>FECHA REGISTRO</b></td>
                    <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row2['doc_fecharegistro']).'</td>
                    <td  style="width:300px;text-align:center;height:30px;"></td>
                  </tr>
                  <tr>
                    <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-bottom: 2px solid black;"><b>DOCUMENTO</b></td>
                    <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-bottom: 2px solid black;font-weight:bold;">'.utf8_encode($row2['area_origen']).'</td>
                    <td  style="width:300px;text-align:center;height:30px;border-bottom: 2px solid black;"></td>
                  </tr>
                  ';
                }
              }
              if ($contador==0) {
                $html.='<tr><td style="text-align:center;font-weight:bold"><br><br><br>No se encontraron tr&aacute;mites en el rango de fecha seleccionado</td></tr>';
              }
          $html.='</table><br>

        </body>
        </html>';

$mpdf->WriteHTML($html);
$mpdf -> Output('reporte_tramites.pdf', 'D');
?>
