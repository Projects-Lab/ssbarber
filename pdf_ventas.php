<?php


require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetMargins(10, 10, 10, 10);

// Cargar los datos del archivo JSON
$jsonData = file_get_contents('./controladores/ventasdatos.json');
$data = json_decode($jsonData, true);

// Generar el contenido del PDF con los datos cargados
$id = $data['id'];
$consecutivo_venta = $data['consecutivo_venta'];
$fecha = $data['fecha'];
$fechaFormateada = date('Y-m-d', strtotime($fecha));
$valor = $data['valor'];
$numero_identificacion = $data['numero_identificacion'];
$primer_nombre = $data['primer_nombre'];
$segundo_nombre = $data['segundo_nombre'];
$primer_apellido = $data['primer_apellido'];
$segundo_apellido = $data['segundo_apellido'];
$producto_nombre = $data['producto_nombre'];
$producto_codigo = $data['producto_codigo'];
$cantidad = 2;
$total = ($cantidad * $valor);

$html = '

<!DOCTYPE html>
<html lang="es">
    <body style="font-family: Arial, sans-serif font-size: 12px; ">
            <div class="container" style="font-size: 10px;    ">
                <table style="width: 100%; border-collapse: collapse; text-align: center">
                    <tr>
                        <td style=" padding: 10px; width: 30%;">
                                <img src="src\img\Logo_SSBarber.png" alt="Imagen 1" width="150" height="150">
                        </td>
                        <td style=" padding: 10px; width="200"">
                           Factura FV0000' . $id . '<br>
                           ' . $fechaFormateada . ' <br>
                        </td>
                    <tr>
                    </tr>
                    </tr>
                </table>         
                <table style="font-size: 15px; width: 100%; text-align: center;">
                    <tr>
                        <th colspan="4" style="padding: 10px; background-color: #9d9d9d; text-align: end;">Datos del Factura.</th>
                    </tr>
                    <tr>
                        <td style="width: 25%; ">N° VENTA</td>
                        <td style="">' . $id . '</td>
                        <td style="width: 25%; ">Fecha VENTA</td>
                        <td style="">' . $fechaFormateada . '</td>
                    </tr>

                </table>
                <table style="font-size: 12px; width: 100%; text-align: center;">
                    <tr>
                        <th colspan="5" style="padding: 10px; background-color: #9d9d9d; text-align: end">Datos del Cliente.</th>
                    </tr>
                    <tr>
                        <th style="width:">N° Identificacion</th>
                        <th style="width:">Primer Nombre</th>
                        <th style="width:">Segundo Nombre</th>                        
                        <th style="width:">Primer Apellido</th>
                        <th style="width:">Segundo Apellido</th>
                    </tr>
                    <tr>
                        <td style="">' . $numero_identificacion . '</td>
                        <td style="">' . $primer_nombre . ' </td>
                        <td style="">' . $segundo_nombre . '   </td>                        
                        <td style="">' . $primer_apellido . '  </td>
                        <td style="">' . $segundo_apellido . '  </td>
                </table>
                <table style="font-size: 12px; width: 100%; text-align: center;">
                    <tr>
                        <th colspan="4" style="padding: 10px; background-color: #9d9d9d; text-align: end ">Producto.</th>
                    </tr>
                    <tr>
                        <th style="width: 10%; ">Cantidad</th>
                        <th style="width: 15%; ">Codigo</th>
                        <th style="width: 60%;">Nombre</th>
                        <th style=" width: 15%;">Valor Unitario</th>
                    </tr>
                    <tr>
                        <td style="">' . $cantidad . '  </td>
                        <td style="">' . $producto_codigo . ' </td>
                        <td style="">' . $producto_nombre . ' </td>
                        <td style="">' . $valor . ' </td>
                    </tr>
                </table>

                <table style="font-size: 15px; width: 100%; text-align: right;">
                    <tr>
                        <th colspan="2" style=" background-color: #9d9d9d; text-align: right "></th>
                    </tr>
                    <tr>
                        <th style="width: 10%; ">Total</th>
                        <td style="">' . $total . ' </td>
                    </tr>
                </table>
               
             </div  
    </body>
</html>

';


$mpdf->WriteHTML($html);
$mpdf->SetTitle('Factura SB0000'. $id );

// Descargar el PDF
$mpdf->Output('Factura SB0000' . $id .  '.pdf', 'I');
