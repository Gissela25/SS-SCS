<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Historial de salida de insumos - Cruz Roja</title>
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
        <h3 class="display-6" style="text-align:center">Historial de Salida de Insumos</h3>
        <h6 class="display-6"> <?=$_SESSION['areaBuffer']['Nombre'];?>: <?=$_SESSION['dataBuffer']['Nombre']?>
            <?=$_SESSION['dataBuffer']['Apellido']?></h6>
        <div class="col ml-5">
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Artículo</th>
                                <th class="text-center">Correlativo Interno</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Entrada</th>
                                <th class="text-center">Correctivo</th>
                                <th class="text-center">Salida</th>
                                <th class="text-center">Saldo Resultante</th>
                                <th class="text-center">Reporte</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach($movimientos as $movimiento){
                        ?>

                            <tr id="id_<?=$movimiento['Id_Articulo']?>">
                                <td class="text-center"><?=$movimiento['Codigo']?></td>
                                <td class="text-center"><?=$movimiento['NombreA']?></td>
                                <td class="text-center"><?=$movimiento['Id_Correlativo']?></td>
                                <td class="text-center"><?=$movimiento['F_Movimiento']?></td>
                                <td class="text-center"><?=$movimiento['Entrada']?></td>
                                <td class="text-center"><?=$movimiento['Correctivo']?></td>
                                <td class="text-center"><?=$movimiento['Salida']?></td>
                                <td class="text-center"><?=$movimiento['SaldoResultante']?></td>
                                <td class="text-center"><a title="KardexReport"
                                        href="<?=PATH?>Movements/WithdrawalArticlesReport/<?=$movimiento['Id_Correlativo']?>"
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <?php include_once "./Views/DataTableScript.php"; ?>
</body>

</html>