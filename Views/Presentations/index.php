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
    <title>Presentaciones - Cruz Roja</title>
    <link rel="stylesheet" href="styles/style.css">
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
    
</head>

<body>
    <?php 
 require_once "./Views/NavbarScreen.php";
?>
    <div class="row mx-5 mt-5">
        <h3 style="text-align:center" class="display-6">Presentaciones</h3>
        <h6 class="display-6"> <?=$_SESSION['areaBuffer']['Nombre'];?>: <?=$_SESSION['dataBuffer']['Nombre']?>
            <?=$_SESSION['dataBuffer']['Apellido']?></h6>
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Presentations/Insert" style="color: #FF0032"><i
                    class="bi bi-plus-circle"></i>Agregar Presentación</a>
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">ID Presentación</th>
                                <th class="text-center">Presentación</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Activar/Desactivar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach($formas as $presentacion){
                            // if($departamento['Id_Estado']==1)
                            // {
                            ?>
                            <tr id="id_<?=$presentacion['Id_Presentacion']?>"
                                class="<?=($presentacion['Id_Estado']==2)?"text-danger":""?>">
                                <td class="text-center"><?=$presentacion['Id_Presentacion']?></td>
                                <td class="text-center"><?=$presentacion['NombreP']?></td>
                                <td class="text-center">
                                    <?php
                                if($presentacion['Id_Estado']==1)
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
                                </td>
                                <td class="text-center">
                                    <a name="editar"
                                        href="<?=PATH?>Presentations/Update/<?=$presentacion['Id_Presentacion']?>"
                                        id="editar" class="btn btn-dark"><i class="bi bi-pencil">
                                    </a></i>
                                </td>
                                <td class="text-center">

                                    <?php
                                if($presentacion['Id_Estado']==1)
                                {
                                ?>
                                    <button type="button" name="Desactivar" id="Desactivar" class="btn btn-dark"  data-bs-toggle="modal"
                                            data-bs-target="#setModalStateOf_<?=$presentacion['Id_Presentacion']?>"
                                            title="Desactivar"><i
                                            class="bi bi-dash-lg"> </button></i>
                                    <?php
                                }
                                else{
                                ?>
                                    <button type="button" name="Activar" id="Activar" class="btn btn-dark"  data-bs-toggle="modal"
                                            data-bs-target="#setModalStateOn_<?=$presentacion['Id_Presentacion']?>"
                                            title="Activar"><i
                                            class="bi bi-plus-lg"> </button></i>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
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