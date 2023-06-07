<?php 
include_once "./Core/config.php";
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
    <title>Salida de insumos - Cruz roja</title>
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
        <h3 style="text-align:center" class="display-6">Salida de Insumos - <?=$_SESSION['areaBuffer']['Nombre']?></h3>
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
                                <th class="text-center">Saldo Actual</th>
                                <th class="text-center">Presentación</th>
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Retirar</th>
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
                                <td class="text-center"><?=$producto['Codigo']?></td>
                                <td class="text-center"><?=$producto['NombreA']?></td>
                                <td class="text-center"><?=$producto['Saldo']?></td>
                                <td class="text-center"><?=$producto['NombreP']?></td>
                                <td class="text-center"><?=$producto['NombreD']?></td>
                                <td class="text-center">

                                    <a title="Retirar" name="Retirar"
                                        href="<?=PATH?>Movements/WithDraw/<?=$producto['Id_Articulo']?>" id="Retirar"
                                        class="btn btn-dark">
                                        <i class="bi bi-arrow-90deg-right"></i>
                                    </a>

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

    <?php
    if(count($quantity)>0)
    {
    ?>
    <div class="row mx-5 mt-5">
        <h3 style="text-align:center" class="display-6">Artículos por Retirar</h3>
        <?php
                   if(isset($errores))
                   {
                       if(count($errores)>0)
                       {
                        echo "<div class='alert alert-danger' style='color:#343a40' ><ul>";
                           foreach ($errores as $error) {
                               echo "<li style='color:#343a40'>$error</li>";
                           }
                           echo "</ul></div>";
                       }
                   }
                   ?>
        <div class="col ml-5">

            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered " id="datatable2">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">No. Comprobante</th>
                                <th class="text-center">Artículo</th>
                                <th class="text-center">Saldo a retirar</th>
                                <th class="text-center">Presentación</th>
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Agregar</th>
                                <th class="text-center">Quitar</th>
                                <th class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Recorremos el arreglo alojado en ViewBag con nombre empleados
                    foreach($movimientos as $movimiento)
                    {
                        //Para imprimir a los usarios inactivos
                        // con $empleado['campo'] entramos al campo o variable que queremos imprimir
                        ?>
                            <tr id="id_<?=$movimiento['Id_Articulo']?>">
                                <td class="text-center"><?=$movimiento['Codigo']?></td>
                                <td class="text-center"><?=$movimiento['NoComprobante']?></td>
                                <td class="text-center"><?=$movimiento['NombreA']?></td>
                                <td class="text-center"><?=$movimiento['Cantidad']?></td>
                                <td class="text-center"><?=$movimiento['NombreP']?></td>
                                <td class="text-center"><?=$movimiento['NombreD']?></td>
                                <td class="text-center">

                                    <button type="button" title="Agregar" name="Agregar" id="Agregar"
                                        class="btn btn-dark btn-operacion" data-id="<?=$movimiento['Id_Articulo']?>"
                                        data-operacion="Agregar">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>

                                </td>
                                <td class="text-center">
                                    <button title="Quitar" name="Quitar" type="button" id="Quitar"
                                        class="btn btn-dark btn-operacion" data-id="<?=$movimiento['Id_Articulo']?>"
                                        data-operacion="Quitar">
                                        <i class="bi bi-dash-circle"></i>

                                </td>

                                <td class="text-center">
                                    <form role="form" method="post"
                                        action="<?=PATH?>Movements/Operations/<?=$movimiento['Id_Articulo']?>">
                                        <button title="Eliminar" name="Eliminar" type="submit" id="Eliminar"
                                            class="btn btn-dark btn-operacion" data-operacion="Eliminar">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

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
    <div class="row mx-3 my-3 text-center ">
        <div>
            <form role="form" method="post" action="<?=PATH?>Movements/CompleteWithDrawls">
                <button type="submit" class="btn btn-danger btn-block" title="Completar" name="Completar"
                    id="Completar">Completar
                    retiro
                </button>
            </form>
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
    <script>
    $(document).ready(function() {
        $('.btn-operacion').click(function() {
            var button = $(this);
            var id = button.data('id');
            var operacion = button.data('operacion');
            var url = '<?=PATH?>Movements/Operations/' + id;
            var cantidadCell = button.closest('tr').find('.text-center:eq(3)');
            var cantidad = parseInt(cantidadCell.text());

            if (operacion === 'Agregar') {
                cantidad++;
            } else if (operacion === 'Quitar' && cantidad > 0) {
                cantidad--;
            }

            $.post(url, {
                [operacion]: true,
                Salida: cantidad
            }, function(response) {
                if (response === 'success') {
                    cantidadCell.text(cantidad);
                }
            });
        });
    });
    </script>
</body>

</html>