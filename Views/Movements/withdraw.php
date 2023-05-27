<?php 
include_once "./Core/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">

                    <?php
                foreach($productos as $producto)
                {
                ?>
                    <form role="form" method="post"
                        action="<?=PATH?>Movements/MakeWithDrawal/<?=$producto['Id_Articulo']?>">
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
                        <div class="form-group text-center my-1">
                            <h3 class="text" style="color:#FF0032"><?=isset($producto)?$producto['NombreA']:''?></h3>
                        </div>
                        <div class="">
                            <label for="Codigo" class="form-label">Código de Artículo</label>
                        </div>
                        <div class="input-group mb-3 ">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
                            <input type="text" class="form-control" aria-label="Existencia"
                                aria-describedby="basic-addon1" readonly id="Codigo" name="Codigo"
                                value="<?=isset($producto)?$producto['Codigo']:''?>">
                        </div>

                        <div class="">
                            <label for="Comprobante" class="form-label">No. Comprobante</label>
                        </div>
                        <div class="input-group mb-3 ">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
                            <input type="text" class="form-control" aria-label="Existencia"
                                aria-describedby="basic-addon1" readonly id="Comprobante" name="Comprobante"
                                value="<?=isset($producto)?$producto['NoComprobante']:''?>">
                        </div>

                        <input type="text" name="Id_Existencia" id="Id_Existencia"
                            value="<?=isset($producto)?$producto['Id_Existencia']:''?>" hidden />
                        <div class="mb-2">
                            <label for="Salida" class="form-label">Saldo a retirar</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Salida" aria-label="Salida"
                                name="Salida" id="Salida" aria-describedby="basic-addon1">
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-danger" title="Aceptar" name="Aceptar"
                                id="Aceptar">Aceptar
                            </button>
                        </div>
                    </form>
                    <?php
                }
                ?>

                </div>
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
    <script>
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
    </script>
</body>
</html>