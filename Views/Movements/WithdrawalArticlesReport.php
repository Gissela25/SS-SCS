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
        padding: 25px;
    }
    </style>
</head>

<body>
    <h3 style="text-align:left">REQUESICION INSUMOS PARA USUARIOS DEL CENTRO DE SANGRE</h3>
    <h4 style="text-align:left">Para ser Usado En: <?=$_SESSION['areaBuffer']['Nombre']?> </h4>
    <?php
    date_default_timezone_set('America/El_Salvador');
    $hora_actual = date('Y-m-d H:i:s');
    ?>
    <h3 style="text-align:right">Fecha actual: <?php echo $hora_actual; ?></h3>
    </div>
    <?php
        $correlativoI = $movimientos[0]['Id_Correlativo'];
    ?>
    <h3 style="text-align:left">Correlativo Interno: <?=$correlativoI?> </h3>

    <table style="margin: 0 auto;">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cantidad</th>
                <th>Nombre del Articulo</th>
                <th>Presentación</th>
            </tr>
        </thead>
        <tbody>
            <?php
        //Recorremos el arreglo alojado en ViewBag con nombre empleados
        foreach($movimientos as $movimiento)
        {
            //Para imprimir a los usarios inactivos
            // con $empleado['campo'] entramos al campo o variable que queremos imprimir
            ?>
            <tr id="id_<?=$movimiento['Id_Correlativo']?>">
                <td><?=$movimiento['Codigo']?></td>
                <td><?=$movimiento['Salida']?></td>
                <td><?=$movimiento['NombreA']?></td>
                <td><?=$movimiento['NombreP']?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <h3>Retira: <?=$_SESSION['dataBuffer']['Nombre']?> <?=$_SESSION['dataBuffer']['Apellido']?></h3>

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
$dompdf->stream("Retiro_".$movimiento['Id_Correlativo'].".pdf", array("Attachment"=>false))
?>