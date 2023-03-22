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
    <title>Articulos - Cruz Roja</title>
</head>

<body>
    <?php 
 require_once "./Views/NavbarScreen.php";
?>
    <div class="row mx-5 mt-5">
        <h5 style="text-align:center">Ingresar Articulos</h5>
        <h3>Centro de Sangre: William Portan</h3>
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Articles/Insert" style="color: #FF0032"><i
                    class="bi bi-plus-circle"></i>Agregar
                Articulo</a>
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF8B8B">
                        <tr>
                            <th>Codigo</th>
                            <th>Articulo</th>
                            <th>Presentacion</th>
                            <th>Departamento</th>
                            <th>Acciones</th>
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
                            <td><?=$producto['Id_Articulo']?></td>
                            <td><?=$producto['NombreA']?></td>
                            <td><?=$producto['NombreP']?></td>
                            <td><?=$producto['NombreD']?></td>
                            <td><button name="editar" type="submit" id="editar" class="btn btn-dark"><i
                                        class="bi bi-pencil"> </button></i>
                                <button name="Desactivar" type="submit" id="Desactivar" class="btn btn-dark"><i
                                        class="bi bi-file-excel"> </button></i>
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