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
        <h3 style="text-align:center">Ingreso de Insumos - <?=$_SESSION['areaBuffer']['Nombre']?></h3>
        <h3>Centro de Sangre: <?=$_SESSION['dataBuffer']['Nombre']?> <?=$_SESSION['dataBuffer']['Apellido']?></h3>
        <div class="col ml-5">
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF8B8B">
                        <tr>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Artículo</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">Fecha actualización</th>
                            <th class="text-center">editar</th>
                            <th class="text-center">Agregar</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($stock as $existencias){
                        ?>

                        <tr id="id_<?=$existencias['Id_Existencia']?>">
                            <td class="text-center"><?=$existencias['Codigo']?></td>
                            <td class="text-center"><?=$existencias['NombreA']?></td>
                            <td class="text-center"><?=$existencias['Saldo']?></td>
                            <td class="text-center"><?=$existencias['F_LastUpdate']?></td>
                            <td class="text-center"><a name="Actualizar" title="Actualizar"
                                    href="<?=PATH?>Stocks/Update/<?=$existencias['Id_Existencia']?>" id="Actualizar"
                                    class="btn btn-dark"><i class="bi bi-pencil"> </i></a>
                            </td>
                            <td class="text-center"><a title="agregar"
                                    href="<?=PATH?>Stocks/Insert/<?=$existencias['Id_Existencia']?>" name="Agregar"
                                    id="Agregar" class="btn btn-dark"><i class="bi bi-file-plus"> </a></i>
                            </td>

                        </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
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