<?php include_once "./Core/config.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="row justify-content-center pt-5 mt-4 ">
        <div class="col-md-9 ">
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-center my-2">
                        <h2 class="text" style="color:#FF0032">Centro de Sangre</h2>
                    </div>
                    <div class="row justify-content-around my-2">
                        <div class="col-4 my-3">
                            <img src="<?=PATH?>Assets/imgs/logo.png" class="img-thumbnail" alt="...">
                        </div>
                        <div class="col-4 my-2">
                            <form action="<?=PATH?>Index/Login" method="post" role="form">
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
                                <!-- 
<div class="input-group mb-3">
                                    <select class="form-select" name="area" id="area"
                                        aria-label="Default select example">
                                        <?php
                                        foreach($areas as $item)
                                        {
                                        ?>
                                        <option value="<?=isset($item)?$item['Id_Area']:''?>">
                                            <?=isset($item)?$item['Nombre']:''?>
                                        </option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                   -->

                                <div class="mb-3">
                                    <label for="Correo" class="form-label">User</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-person-fill"></i></span>
                                    <input type="text" class="form-control" placeholder="Ingresa tu correo o usuario"
                                        aria-label="Name" aria-describedby="basic-addon1" name="Correo" id="Correo">
                                </div>
                                <div class="mb-3">
                                    <label for="Clave" class="form-label">Clave</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-person-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Ingresa tu contraseña"
                                        aria-label="Name" aria-describedby="basic-addon1" name="Clave" id="Clave">
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button name="Ingresar" type="submit" id="Ingresar" title="Ingresar"
                                        class="btn btn-danger">
                                        Ingresar
                                    </button>
                                </div>
                            </form>
                        </div>
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