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
    <title>Document</title>
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
        <div class="col ml-5">
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Artículo</th>
                                <th class="text-center">Correlativo</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Entrada</th>
                                <th class="text-center">Correctivo</th>
                                <th class="text-center">Salida</th>
                                <th class="text-center">Saldo Resultante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach($movimientos as $movimiento){
                        ?>

                            <tr id="id_<?=$movimiento['Id_Articulo']?>">
                                <td class="text-center"><?=$movimiento['Id_Articulo']?></td>
                                <td class="text-center"><?=$movimiento['NombreA']?></td>
                                <td class="text-center"><?=$movimiento['Id_Correlativo']?></td>
                                <td class="text-center"><?=$movimiento['F_Movimiento']?></td>
                                <td class="text-center"><?=$movimiento['Entrada']?></td>
                                <td class="text-center"><?=$movimiento['Correctivo']?></td>
                                <td class="text-center"><?=$movimiento['Salida']?></td>
                                <td class="text-center"><?=$movimiento['SaldoResultante']?></td>
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

    <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
    </script>
</body>

</html>