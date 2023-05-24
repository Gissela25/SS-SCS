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
<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">

                    <?php
                foreach($stock as $existencias)
                {
                ?>
                    <form role="form" method="post"
                        action="<?=PATH?>Stocks/UpdateBalance/<?=$existencias['Id_Existencia']?>">
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
                        <div class="">
                            <label for="Id_Existencia" class="form-label">ID</label>
                        </div>
                        <div class="input-group mb-3 ">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
                            <input type="text" class="form-control" aria-label="Existencia"
                                aria-describedby="basic-addon1" readonly id="Id_Existencia" name="Id_Existencia"
                                value="<?=isset($existencias)?$existencias['Id_Existencia']:''?>">
                        </div>


                        <input type="text" name="EsSaldoInicial" id="EsSaldoInicial"
                            value="<?=isset($existencias)?$existencias['EsSaldoInicial']:''?>" hidden />
                        <input type="text" name="Id_Articulo" id="Id_Articulo"
                            value="<?=isset($existencias)?$existencias['Id_Articulo']:''?>" hidden />
                        <div class="mb-2">
                            <label for="Saldo" class="form-label">Saldo</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Saldo" aria-label="Saldo" name="Saldo"
                                id="Saldo" value="<?=isset($existencias)?$existencias['Saldo']:''?>"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-danger" title="Actualizar" name="Actualizar"
                                id="Actualizar">Guardar
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
</body>
</html>