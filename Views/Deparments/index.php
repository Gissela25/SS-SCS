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
    <title>Departamentos - Cruz Roja</title>
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
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Deparments/Insert" style="color: #FF0032"><i
                    class="bi bi-plus-circle"></i>Agregar Departamento</a>
            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">ID Departamento</th>
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Anular</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach($lugares as $departamento){
                            // if($departamento['Id_Estado']==1)
                            // {
                            ?>
                            <tr id="id_<?=$departamento['Id_Departamento']?>">
                                <td class="text-center"><?=$departamento['Id_Departamento']?></td>
                                <td class="text-center"><?=$departamento['NombreD']?></td>
                                <td class="text-center">
                                <?php
                                if($departamento['Id_Departamento']==1)
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
                                    <form action="<?=PATH?>Deparments/Operations/<?=$departamento['Id_Departamento']?>" method="post">
                                        <a name="editar"
                                            href="<?=PATH?>Deparments/Update/<?=$departamento['Id_Departamento']?>"
                                            id="editar" class="btn btn-dark"><i class="bi bi-pencil"> </a></i>
                                                
                                </td>
                                <td class="text-center">

                                     <?php
                                if($departamento['Id_Departamento']==1)
                                {
                                ?>
                                    <button type="button" name="Desactivar" id="Desactivar" class="btn btn-dark"><i
                                            class="bi bi-dash-lg" data-bs-toggle="modal"
                                            data-bs-target="#setModalStateOf_<?=$departamento['Id_Departamento']?>"
                                            title="Desactivar"> </button></i>
                                    <?php
                                }
                                else{
                                ?>
                                    <button type="button" name="Desactivar" id="Desactivar" class="btn btn-dark"><i
                                            class="bi bi-plus-lg" data-bs-toggle="modal"
                                            data-bs-target="#setModalStateOn_<?=$departamento['Id_Departamento']?>"
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