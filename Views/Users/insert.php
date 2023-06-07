<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrear Usuario - Cruz Roja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
    /* Desactivar estilos de :hover en el enlace */
    a#regresar:hover {
        background-color: transparent;
        color: inherit;
        border-color: transparent;
    }
</style>
</head>

<body>
    <div class="row justify-content-center pt-5 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?=PATH?>Users/AddUser" enctype="multipart/form-data" role="form">
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
                            <h3 class="text" style="color:#FF0032">Agregar Usuario</h3>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    <div class="mb-2">
                                        <label for="Nombre" class="form-label">Nombre</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control" placeholder="Agregue nombre"
                                            aria-label="Name" aria-describedby="basic-addon1" name="Nombre" id="Nombre"
                                            value="<?=isset($empleado)?$empleado['Nombre']:''?>">
                                    </div>
                                    <div class="mb-2">
                                        <label for="Apellido" class="form-label">Apellido</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control" placeholder="Agregue apellido"
                                            aria-label="Lastname" aria-describedby="basic-addon1" name="Apellido"
                                            id="Apellido" value="<?=isset($empleado)?$empleado['Apellido']:''?>">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">E-mail</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-envelope-at-fill"></i></span>
                                        <input type="text" class="form-control" placeholder="Agregue E-mail"
                                            aria-label="Email" aria-describedby="basic-addon1" name="Correo" id="Correo"
                                            value="<?=isset($empleado)?$empleado['Correo']:''?>">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-2">
                                        <label for="Clave" class="form-label">Contraseña</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-person-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="Agregue Contraseña"
                                            aria-label="Password" aria-describedby="basic-addon1" name="Clave"
                                            id="Clave">
                                    </div>

                                    <div class="mb-2">
                                        <label for="Id_Area" class="form-label">Selecciona Area</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="Id_Area" id="Id_Area"
                                            aria-label="Floating label select example">
                                            <option selected value=""></option>
                                            <?php
                               foreach ($areas as $area) 
                               {
                                   ?>
                                            <option value="<?=$area['Id_Area']?>"><?=$area['Nombre']?>
                                            </option>
                                            <?php
                               }
                               ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto my-4">
                                    <button type="submit" class="btn btn-danger" name="Guardar"
                                        id="Guardar">Guardar</button>
                                    <a name="regresar" href="<?=PATH?>Users/Index" id="regresar" class="btn btn-outline-danger"
                                        title="Regresar">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>