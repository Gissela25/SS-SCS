<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos por Departamentos - Cruz Roja</title>
    <link rel="stylesheet" href="styles/style.css">

    <!--
        Scripts and Styles
    -->
    <?php include_once "./Views/NavDataTables.php"; ?>
    <!--
        Scripts and Styles
    -->

</head>

<body>
    <?php 
 require_once "./Views/NavbarScreen.php";
?>
    <div class="row mx-5 mt-5">
        <h3 style="text-align:center" class="display-6">Movimientos por Departamento </h3>
        <h6 class="display-6"> <?=$_SESSION['areaBuffer']['Nombre'];?>: <?=$_SESSION['dataBuffer']['Nombre']?>
            <?=$_SESSION['dataBuffer']['Apellido']?></h6>
        <h3 class="display-6"><?=$productos[0]['NombreD']?> / Saldo Inicial:<?=$productos[0]['SaldoInicial']?> </h3>
        <div class="col ml-5">
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable2">
                    <thead class="Te" style="background-color: #FF8B8B">
                        <tr>
                            <th class="text-center">Codigo Art.</th>
                            <th class="text-center">Nombre del Articulo</th>
                            <th class="text-center">Presentacion</th>
                            <th class="text-center">Responsable</th>
                            <th class="text-center">Correlativo Interno</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Entrada</th>
                            <th class="text-center">Correctivo</th>
                            <th class="text-center">Salida</th>
                            <th class="text-center">Saldo</th>
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
                        <tr id="id_<?=$producto['Id_Departamento']?>">
                            <td class="text-center"><?=$producto['Codigo']?></td>
                            <td class="text-center"><?=$producto['NombreA']?></td>
                            <td class="text-center"><?=$producto['NombreP']?></td>
                            <td class="text-center"><?=$producto['Nombre']?> <?=$producto['Apellido']?></td>
                            <td class="text-center"><?=$producto['Id_Correlativo']?></td>
                            <td class="text-center"><?=$producto['F_Movimiento']?></td>
                            <td class="text-center"><?=$producto['Entrada']?></td>
                            <td class="text-center"><?=$producto['Correctivo']?></td>
                            <td class="text-center"><?=$producto['Salida']?></td>
                            <td class="text-center"><?=$producto['SaldoResultante']?></td>
                        </tr>
                        <?php
                     }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!--
                Script para el datatable
    -->
    <?php include_once "./Views/DataTableTwoScript.php"; ?>

</body>

</html>