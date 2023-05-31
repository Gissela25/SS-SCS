<?php
require_once "./Core/config.php";
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Reporte Ingreso por rango de fecha</title>
    <style>
    body {
        margin: 0 auto;
        padding: 0px;
        width: 100%;
        min-width: 650px;
        font-size: 10;
    }
    th, td {
        text-align: center;
        padding: 25px;
    }
    </style>
</head>

<body>
    <h3 style="text-align:left">CENTRO DE SANGRE : : : AREA DE <?=$_SESSION['areaBuffer']['Nombre']?> </h3>
    <h3 style="text-align:left">IMPRESION DE INGRESO POR RANGO DE FECHA</h3>
    <?php
    date_default_timezone_set('America/El_Salvador');
    $hora_actual = date('Y-m-d H:i:s');
    ?>
    <h3 style="text-align:right">Fecha actual: <?php echo $hora_actual; ?></h3>
    <?php
    $nombreA = $productos[0]['F_Movimiento'];
    ?>
    <div style="display: flex; justify-content: space-between;">
        <h3 style="text-align:left">Fecha de Entrada: <?=$nombreA?></h3>
        <!-- <h3 style="text-align:right">Saldo Inicial: <?=$productos[0]['SaldoInicial']?> </h3> -->
    </div>

    <table style="margin: 0 auto;">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre del Articulo</th>
                <th>Presentación</th>
                <th>Responsable</th>
                <th>Entrada</th>
                <th>Correctivo</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                            //Recorremos el arreglo alojado en ViewBag con nombre empleados
                    foreach($productos as $producto)
                    {
                        //Para imprimir a los usarios inactivos
                        // con $empleado['campo'] entramos al campo o variable que queremos imprimir
                        ?>
            <tr id="id_<?=$producto['F_Movimiento']?>">
                <td><?=$producto['Codigo']?></td>
                <td><?=$producto['NombreA']?></td>
                <td><?=$producto['NombreP']?></td>
                <td><?=$producto['Nombre']?> <?=$producto['Apellido']?></td>
                <td><?=$producto['Entrada']?></td>
                <td><?=$producto['Correctivo']?></td>
                <td><?=$producto['SaldoResultante']?></td>
            </tr>
            <?php
                     }
                    ?>
        </tbody>
    </table>
</body>
</html>
<?php
$html=ob_get_clean();
//echo $html;
include_once ("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'landscape');
$dompdf->render();
$dompdf->stream("Ingresos_".$producto['F_Movimiento'].".pdf", array("Attachment"=>false))
?>