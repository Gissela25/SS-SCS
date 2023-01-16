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
</head>

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-center my-1">
                        <h3 class="text" style="color:#FF0032">Agregar Artìculo</h3>
                    </div>
                    <div class="">
                        <label for="exampleInputPassword1" class="form-label">Fecha</label>
                    </div>
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
                        <input type="text" class="form-control" placeholder="15/01/2023" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Còdigo</label>
                    </div>
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-upc-scan"></i></span>
                        <input type="text" class="form-control" placeholder="agregue còdigo" aria-label="Username"  readonly
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Nombre</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue nombre" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Artìculo</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-basket"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue artìculo" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Mìnimo</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-bar-chart-steps"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue Mìnimo" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Presentaciòn</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-clipboard2-pulse"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue Presentaciòn" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Existencias</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-archive"></i></span>
                        <input type="text" class="form-control" placeholder="Agregue existencias" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-danger"><a href="index.php" style="color: white"  >Enviar</a>
                                    </button>
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