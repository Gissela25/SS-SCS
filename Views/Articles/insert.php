<?php
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar artículo - Cruz Roja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?=PATH?>Articles/AddArticle" enctype="multipart/form-data" role="form">
                        <?php
                               if (isset($errores)) {
                                   if (count($errores) > 0) {
                                       echo "<div class='alert alert-danger' style='color:#343a40' ><ul>";
                                       foreach ($errores as $error) {
                                           echo "<li style='color:#343a40'>$error</li>";
                                       }
                                       echo "</ul></div>";
                                   }
                               }
                         ?>
                        <div class="form-group text-center my-1">
                            <h3 class="text" style="color:#FF0032">Agregar Artículo</h3>
                        </div>
                        <div class="mb-2">
                            <label for="Codigo" class="form-label">Código</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="bi bi-clipboard2-data-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregue codigo" aria-label="Username"
                                aria-describedby="basic-addon1" name="Codigo" id="Codigo"
                                value="<?=isset($productos[0])?$productos[0]['Codigo']:''?>">
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Artículo</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-basket"></i></span>
                            <input type="text" class="form-control" placeholder="Agregue artículo" aria-label="Username"
                                aria-describedby="basic-addon1" name="Nombre" id="Nombre"
                                value="<?=isset($productos[0])?$productos[0]['NombreP']:''?>">
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Departamento</label>
                        </div>
                        <div class="input-group mb-3">
                            <!-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-bar-chart-steps"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue Mìnimo" aria-label="Username"
                            aria-describedby="basic-addon1"> -->
                            <select class="form-select" name="Id_Departamento" id="Id_Departamento"
                                aria-label="Floating label select example">
                                <option selected value=""></option>
                                <?php
                               foreach ($lugares as $departamento) 
                               {
                                   ?>
                                <option value="<?=$departamento['Id_Departamento']?>"><?=$departamento['NombreD']?>
                                </option>
                                <?php
                               }
                               ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Presentación</label>
                        </div>
                        <div class="input-group mb-3">
                            <!-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-bar-chart-steps"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue Mìnimo" aria-label="Username"
                            aria-describedby="basic-addon1"> -->
                            <select class="form-select" name="Id_Presentacion" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option selected value=""></option>
                                <?php
                                 foreach ($formas as $presentacion) {
                                     ?>
                                <option value="<?=$presentacion['Id_Presentacion']?>"><?=$presentacion['NombreP']?>
                                </option>
                                <?php
                                   }
                                   ?>
                            </select>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-danger" name="Guardar" id="Guardar">Guardar
                            </button>
                        </div>
                    </form>
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