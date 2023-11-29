<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Entradas por rango de fecha - Cruz Roja</title>
    <link rel="stylesheet" href="styles/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

</head>

<body>
    <?php 
 require_once "./Views/NavbarScreen.php";
?>
    <div class="row mx-5 mt-5">
        <h2 style="text-align:center" class="display-6">Entradas por rango de fecha</h5>
            <h6 class="display-6"> <?=$_SESSION['areaBuffer']['Nombre'];?>: <?=$_SESSION['dataBuffer']['Nombre']?>
                <?=$_SESSION['dataBuffer']['Apellido']?></h6>
            <div class="col ml-5">
                <div class="row mt-3">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">Fecha de Entrada</th>
                                <th class="text-center">Total de Entrada</th>
                                <th class="text-center">Entradas/Fecha</th>
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
                            <tr id="id_<?=$producto['Id_Correlativo']?>">
                                <td class="text-center"><?=$producto['F_Movimiento']?></td>
                                <td class="text-center"><?=$producto['TotalEntradas']?></td>
                                <td class="text-center"><a title="Movimientos"
                                        href="<?=PATH?>Movements/SeeSpecificEntryByDate/<?=$producto['F_Movimiento']?>"
                                        name="Agregar" id="Agregar" class="btn btn-dark"><i
                                            class="bi bi-clipboard2-data-fill"></i></a>
                                </td>
                                <td class="text-center"><a title="MovimientosReport"
                                        href="<?=PATH?>Movements/EntryByDateReport/<?=$producto['F_Movimiento']?>"
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
    <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
    </script>
</body>

</html>