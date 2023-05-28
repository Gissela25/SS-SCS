<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos generales - Cruz Roja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <?php
                    //Para recorrer el arreglo de datos del usuario ingresado
            foreach($empleados as $empleado){
            ?>
                    <form method="post" action="<?=PATH?>Users/SetUser" role="form">
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
                        <input hidden name="Id_Usuario" id="Id_Usuario"
                            value="<?=isset($empleado)?$empleado['Id_Usuario']:''?>">
                        <div class="form-group text-center my-1">
                            <h3 class="text" style="color:#FF0032">Actualizar Datos Generales</h3>
                        </div>
                        <div class="mb-2">
                            <label for="Nombre" class="form-label">Nombre</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregue nombre" aria-label="Name"
                                aria-describedby="basic-addon1" name="Nombre" id="Nombre"
                                value="<?=isset($empleado)?$empleado['Nombre']:''?>">
                        </div>
                        <div class="mb-2">
                            <label for="Apellido" class="form-label">Apellido</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregue apellido" aria-label="Lastname"
                                aria-describedby="basic-addon1" name="Apellido" id="Apellido"
                                value="<?=isset($empleado)?$empleado['Apellido']:''?>">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">E-mail</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="bi bi-envelope-at-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregue E-mail" aria-label="Email"
                                aria-describedby="basic-addon1" name="Correo" id="Correo"
                                value="<?=isset($empleado)?$empleado['Correo']:''?>">
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-danger" name="Actualizar" id="Actualizar">Actualizar
                            </button>
                        </div>
                    </form>
                    <?php }
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