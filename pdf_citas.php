<?php


require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetMargins(10, 10, 10, 10);

// Cargar los datos del archivo JSON

$jsonData = file_get_contents('./controladores/citasdatos.json');
$data = json_decode($jsonData, true);

// Generar el contenido del PDF con los datos cargados
$id = $data['id'];
$fecha_asignada = $data['fecha_asignada'];
$fechaFormateada = date('Y-m-d', strtotime($fecha_asignada));
$hora_asignada = $data['hora_asignada'];

$numero_identificacion = $data['numero_identificacion'];
$nombre_completo = $data['nombre_completo'];
$apellido_completo = $data['apellido_completo'];
$nombre_empleado = $data['nombre_empleado'];
$nombre_servicio = $data['nombre_servicio'];
$estado = $data['estado'];

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
                        <td style="font-size: 20px; padding: 20px; width="200"">
                           Cita CSB0000' . $id . '<br><br>
                           ESTADO: ' . $estado . '<br>
                        </td>
                    </tr>
                </table>         
                <table style="font-size: 15px; width: 100%; text-align: center;">
                    <tr>
                        <th colspan="6" style="padding: 1px; background-color: #9d9d9d; text-align: end;"></th>
                    </tr>
                    <tr>
                        <th style="width: 25%; ">N° Cita</th>
                        <td style="">' . $id . '</td>
                        <th style="width: 25%; ">Fecha Cita</th>
                        <td style="">' . $fechaFormateada . '</td>
                        <th style="width: 25%; ">Hora Cita</th>
                        <td style="">' . $hora_asignada . '</td>
                    </tr>

                </table>
                <table style="font-size: 15px; width: 100%; text-align: center;">
                    <tr>
                        <th colspan="5" style="padding: 10px; background-color: #9d9d9d; text-align: end">Datos de la Cita.</th>
                    </tr>
                    <tr>
                        <th style="width:">N° Identificacion</th>
                        <th style="width:">Nombres</th>
                        <th style="width:">Apellidos</th>
                    </tr>
                    <tr>
                        <td style="">' . $numero_identificacion . ' </td>
                        <td style="">' . $nombre_completo . ' </td>
                        <td style="">' . $apellido_completo . ' </td>
                    </tr>
                </table>
                <table style="font-size: 15px; width: 100%; text-align: center;">
                    <tr>
                        <th colspan="5" style="padding: 1px; background-color: #9d9d9d; text-align: end"></th>
                    </tr>
                    <tr>
                        <th style="width:">Nombre Empleado</th>
                        <td style="">' . $nombre_empleado . ' </td>
                        <th style="width:">Nombre Servicio</th>
                        <td style="">' . $nombre_servicio . ' </td>
                    </tr>
                </table>               
             </div  
    </body>
</html>

';


$mpdf->WriteHTML($html);
$mpdf->SetTitle('Cita CSB0000' . $id);

// Descargar el PDF
$mpdf->Output('Cita CSB0000' . $id .  '.pdf', 'I');
