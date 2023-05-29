<?php
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar áreas - Cruz Roja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?=PATH?>Areas/AddArea" enctype="multipart/form-data" role="form">
                        <?php
                    if(isset($errores))
                    {
                        if(count($errores)>0){
                            echo "<div class='alert alert-danger' style='color:#343a40' ><ul>";
                            foreach ($errores as $error) {
                                echo "<li style='color:#343a40'>$error</li>";
                            }
                            echo "</ul></div>";
                        }
                    }
                    ?>
                        <div class="form-group text-center my-1">
                            <h3 class="text" style="color:#FF0032">Agregar Área</h3>
                        </div>
                        <!-- <div class="">
                            <label for="exampleInputPassword1" class="form-label">ID Area</label>
                        </div>
                        <div class="input-group mb-3 ">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
                            <input type="text" class="form-control" placeholder="A001" aria-label="Username"
                                aria-describedby="basic-addon1" readonly>
                        </div> -->
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Área</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-archive-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregar Area" aria-label="Username"
                                aria-describedby="basic-addon1" name="Nombre" id="nombre"
                                value="<?=isset($zona)?$zona['Nombre']:''?>">
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-danger" name="Guardar" id="Guardar">Guardar</a>
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