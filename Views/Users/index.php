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
       Sección de usuarios activos e inactivos
    -->
    <div class="row mx-5 mt-5">
        <h3 style="text-align:center">Usuarios Activos</h3>
        <h3>Centro de Sangre: <?=$_SESSION['dataBuffer']['Nombre']?> <?=$_SESSION['dataBuffer']['Apellido']?></h3>
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Users/Insert" style="color: #FF0032"><i class="bi bi-plus-circle"></i>Agregar
                Usuario</a>
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">ID Usuario</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Apellido</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Area Asignada</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Activar/Desactivar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Recorremos el arreglo alojado en ViewBag con nombre empleados
                    foreach($empleados as $empleado)
                    {
                        //Para imprimir a los usarios inactivos
                        // con $empleado['campo'] entramos al campo o variable que queremos imprimir
                        ?>
                            <tr id="id_<?=$empleado['Id_Usuario']?>"
                                class="<?=($empleado['Id_Estado']==2)?"text-danger":""?>">
                                <td class="text-center"><?=$empleado['Id_Usuario']?></td>
                                <td class="text-center"><?=$empleado['Nombre']?></td>
                                <td class="text-center"><?=$empleado['Apellido']?></td>
                                <td class="text-center"><?=$empleado['Correo']?></td>
                                <td class="text-center"><?=$empleado['NombreArea']?></td>
                                <td class="text-center">
                                    <?php
                                if($empleado['Id_Estado']==1)
                                {
                                ?>
                                    Activo
                                    <?php
                                }
                                else{
                                ?>
                                    Inactivo
                                    <?php
                                }
                                ?>
                                <td class="text-center"><a name="editar"
                                        href="<?=PATH?>Users/Update/<?=$empleado['Id_Usuario']?>" id="editar"
                                        class="btn btn-dark" title="Editar"><i class="bi bi-pencil">
                                    </a></i></td>
                                <td class="text-center">


                                    <?php
                                if($empleado['Id_Estado']==1)
                                {
                                ?>
                                    <button type="button" name="Desactivar" id="Desactivar" class="btn btn-dark"><i
                                            class="bi bi-dash-lg" data-bs-toggle="modal"
                                            data-bs-target="#setModalStateOf_<?=$empleado['Id_Usuario']?>"
                                            title="Desactivar"> </button></i>
                                    <?php
                                }
                                else{
                                ?>
                                    <button type="button" name="Desactivar" id="Desactivar" class="btn btn-dark"><i
                                            class="bi bi-plus-lg" data-bs-toggle="modal"
                                            data-bs-target="#setModalStateOn_<?=$empleado['Id_Usuario']?>"
                                            title="Activar"> </button></i>
                                    <?php
                                }
                                ?>


                                </td>
                            </tr>
                            <?php include 'deactivate_modal.php'; ?>
                            <?php include 'activate_modal.php'; ?>
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