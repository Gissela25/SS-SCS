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
    <title>Reporte kardex por Articulo</title>

    <style>
    body {
        margin: 0 auto;
        padding: 0px;
        width: 100%;
        min-width: 650px;
        font-size: 10;
    }

    th,
    td {
        text-align: center;
        padding: 12px;
        /* Adjust the padding as needed */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        /* Adjust the margin as needed */
    }

    th {
        background-color: #FF8B8B;
        /* Optional: Set a background color for header cells */
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
        /* Optional: Set a background color for even rows */
    }
    </style>
</head>

<body>
    <h3 style="text-align:left">CENTRO DE SANGRE : : : AREA DE <?=$_SESSION['areaBuffer']['Nombre']?> </h3>
    <h3 style="text-align:left">IMPRESION DE KARDEX POR ARTICULO</h3>
    <?php
    date_default_timezone_set('America/El_Salvador');
    $hora_actual = date('Y-m-d H:i:s');
    ?>
    <h3 style="text-align:right">Fecha actual: <?php echo $hora_actual; ?></h3>
    <?php
    $nombreA = $productos[0]['NombreA'];
    ?>
    <div style="display: flex; justify-content: space-between;">
        <h3 style="text-align:left">Nombre del Articulo: <?=$nombreA?></h3>
        <h3 style="text-align:right">Saldo Inicial: <?=$productos[0]['SaldoInicial']?> </h3>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Presentación</th>
                <th>Responsable</th>
                <th>Número de Comprobante</th>
                <th>Correlativo Interno</th>
                <th>Fecha</th>
                <th>Entrada</th>
                <th>Salida</th>
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
            <tr id="id_<?=$producto['Id_Articulo']?>">
                <td><?=$producto['Codigo']?></td>
                <td><?=$producto['NombreP']?></td>
                <td><?=$producto['Nombre']?> <?=$producto['Apellido']?></td>
                <td><?=$producto['NoComprobante']?></td>
                <td><?=$producto['Id_Correlativo']?></td>
                <td><?=$producto['F_Movimiento']?></td>
                <td><?=$producto['Entrada']?></td>
                <td><?=$producto['Salida']?></td>
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
$dompdf->stream("kardexreporteart_".$producto['Codigo'].".pdf", array("Attachment"=>false))
?>