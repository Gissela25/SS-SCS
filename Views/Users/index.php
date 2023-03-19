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
    <!--
        DataTable 
    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!--
        DataTable 
    -->
    <title>Usuarios - Cruz Roja</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <?php 
 require_once "./Views/NavbarScreen.php";
?>
    <!--
       Sección de usuarios activos
    -->
    <div class="row mx-5 mt-5">
        <h3 style="text-align:center">Usuarios Activos</h3>
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Users/Insert" style="color: #FF0032"><i class="bi bi-plus-circle"></i>Agregar
                Usuario</a>
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th>ID Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Recorremos el arreglo alojado en ViewBag con nombre empleados
                    foreach($empleados as $empleado)
                    {
                        //Para imprimir a los usarios inactivos
                        if($empleado['Id_Estado']==1)
                        {
                        // con $empleado['campo'] entramos al campo o variable que queremos imprimir
                        ?>
                            <tr id="id_<?=$empleado['Id_Usuario']?>">
                                <td><?=$empleado['Id_Usuario']?></td>
                                <td><?=$empleado['Nombre']?></td>
                                <td><?=$empleado['Apellido']?></td>
                                <td><?=$empleado['Correo']?></td>
                                <td>
                                    <form action="<?=PATH?>Users/Operations/<?=$empleado['Id_Usuario']?>" method="post">
                                        <a name="editar" href="<?=PATH?>Users/Update/<?=$empleado['Id_Usuario']?>"
                                            id="editar" class="btn btn-dark"><i class="bi bi-pencil"> </a></i>
                                        <button name="Desactivar" type="submit" id="Desactivar" class="btn btn-dark"><i
                                                class="bi bi-file-excel"> </button></i>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--
       Sección de usuarios inactivos
    -->

    <!--
        Código php para evitar la impresión de la tabla Inactivos si el número de estas es cero
    -->
    <?php
    if($inactivos>0)
    {
    ?>
    <div class="row mx-5 mt-5">
        <h3 style="text-align:center">Usuarios Inanctivos</h3>
        <div class="col ml-5">
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable2">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th>ID Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Recorremos el arreglo alojado en ViewBag con nombre empleados
                    foreach($empleados as $empleado)
                    {
                        //Para imprimir a los usarios inactivos
                        if($empleado['Id_Estado']!=1)
                        {
                        // con $empleado['campo'] entramos al campo o variable que queremos imprimir
                        ?>
                            <tr id="id_<?=$empleado['Id_Usuario']?>">
                                <td><?=$empleado['Id_Usuario']?></td>
                                <td><?=$empleado['Nombre']?></td>
                                <td><?=$empleado['Apellido']?></td>
                                <td><?=$empleado['Correo']?></td>
                                <td>
                                    <form action="<?=PATH?>Users/Operations/<?=$empleado['Id_Usuario']?>" method="post">
                                        <a name="editar" href="<?=PATH?>Users/Update/<?=$empleado['Id_Usuario']?>"
                                            id="editar" class="btn btn-dark"><i class="bi bi-pencil"> </a></i>
                                        <button name="Activar" type="submit" id="Activar" class="btn btn-dark"><i
                                                class="bi bi-check-square"> </button></i>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!--
                Script para el datatable
            -->
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