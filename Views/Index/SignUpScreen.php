<?php include_once "./Core/config.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-center my-2">
                        <h3 class="text" style="color:#FF0032">Centro de Sangre</h3>
                    </div>
                    <div class="row justify-content-around my-2">
                        <div class="col-4 my-3">
                            <img src="<?=PATH?>Assets/imgs/logo.png" class="img-thumbnail" alt="...">
                        </div>
                        <div class="col-4 my-3">
                            <form action="<?=PATH?>Articles/Index" method="POST" role="form">
                                <div class="mb-3">
                                    <select class="form-select" name="area" aria-label="Default select example">
                                        <option selected>área</option>
                                        <option value="1">Sangria</option>
                                        <option value="2">Tamizaje</option>
                                        <option value="3">Serologia</option>
                                        <option value="4">Celulares</option>
                                        <option value="5">Jefatura</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="user" class="form-label">Usuario</label>
                                    <input type="user" class="form-control" id="user">
                                </div>
                                <div class="mb-3">
                                    <label for="Password" class="form-label">Clave</label>
                                    <input type="password" class="form-control" id="Password">
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button name="login" type="submit" id="login" class="btn btn-danger">
                                        Enviar
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