<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar contraseña - Cruz Roja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?=PATH?>Users/SetPassword" role="form">
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

                   if(isset($messageSuccess))
                   {
                       if(count($messageSuccess)>0)
                       {
                        echo "<div class='alert alert-danger' style='color:#343a40' ><ul>";
                               echo "<li style='color:#343a40'>$messageSuccess[0]</li>";
                           echo "</ul></div>";
                       }
                   }
                   ?>
                        <div class="form-group text-center my-3">
                            <h3 class="text" style="color:#FF0032">Actualizar contraseña</h3>
                        </div>
                        <input value="<?=isset($empleados)?$empleados[0]['Clave']:''?>" name="CurrentPassword" hidden
                            id="CurrentPassword">
                </div>
                <div class="mb-2">
                    <label for="Clave" class="form-label">Contraseña Actual</label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-lock"></i></span>
                    <input type="password" class="form-control" placeholder="Agregue Contraseña" aria-label="Password"
                        aria-describedby="basic-addon1" name="Clave" id="Clave">
                </div>

                <div class="mb-2">
                    <label for="NuevaClave" class="form-label">Nueva Contraseña</label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-lock"></i></span>
                    <input type="password" class="form-control" placeholder="Agregue Contraseña" aria-label="Password"
                        aria-describedby="basic-addon1" name="NuevaClave" id="NuevaClave">
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-danger" name="Actualizar" id="Actualizar">Actualizar
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>