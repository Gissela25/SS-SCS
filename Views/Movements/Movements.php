<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos - Cruz Roja</title>
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
        <h2 style="text-align:center" class="display-6">Departamentos</h5>
            <h6 class="display-6"> <?=$_SESSION['areaBuffer']['Nombre'];?>: <?=$_SESSION['dataBuffer']['Nombre']?>
                <?=$_SESSION['dataBuffer']['Apellido']?></h6>
            <div class="col ml-5">
                <div class="row mt-3">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">Id_Departamento</th>
                                <th class="text-center">Departamento</th>
                                <!-- <th class="text-center">Codigo</th>
                                <th class="text-center">Articulo</th> -->
                                <th class="text-center">Movimientos/Departamento</th>
                                <th class="text-center">Reporte</th>
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
                                <td class="text-center"><?=$producto['Id_Departamento']?></td>
                                <td class="text-center"><?=$producto['NombreD']?></td>
                                <!-- <td class="text-center"><?=$producto['Codigo']?></td>
                                <td class="text-center"><?=$producto['NombreA']?></td> -->
                                <td class="text-center"><a title="Movimientos"
                                        href="<?=PATH?>Movements/SeeSpecificMovementsforDeparment/<?=$producto['Id_Departamento']?>"
                                        name="Agregar" id="Agregar" class="btn btn-dark"><i
                                            class="bi bi-clipboard2-data-fill"></i></a>
                                </td>
                                <td class="text-center"><a title="MovimientosReport"
                                        href="<?=PATH?>Movements/MovementsByDeparmentReport/<?=$producto['Id_Departamento']?>"
                                        name="Agregar" id="Agregar" class="btn btn-dark"><i
                                            class="bi bi-file-earmark-pdf-fill"></i></a>
                                </td>
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

    <?php include_once "./Views/DataTableScript.php"; ?>
</body>

</html>