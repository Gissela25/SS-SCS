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
        <h5 style="text-align:center">Ingresar Articulos</h5>
        <h3>Centro de Sangre: <?=$_SESSION['usuario']?></h3>
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Articles/Insert" style="color: #FF0032"><i
                    class="bi bi-plus-circle"></i>Agregar
                Articulo</a>
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF8B8B">
                        <tr>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Articulo</th>
                            <th class="text-center">Presentacion</th>
                            <th class="text-center">Departamento</th>
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
                        <tr id="id_<?=$producto['Id_Articulo']?>"
                            class="<?=($producto['Id_Estado']==2)?"text-danger":""?>">
                            <td class="text-center"><?=$producto['Id_Articulo']?></td>
                            <td class="text-center"><?=$producto['NombreA']?></td>
                            <td class="text-center"><?=$producto['NombreP']?></td>
                            <td class="text-center"><?=$producto['NombreD']?></td>
                        </tr>
                        <?php
                     }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>