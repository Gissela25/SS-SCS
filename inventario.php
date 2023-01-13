<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #EEEEEE;">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#" style="color: white">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <a><img src="imgs/navicon.jpg" alt="" width="220" height="80" class="d-inline-block align-text-top"></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inventario.php"
                            style="color: black">Ingreso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black">Salida</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" style="color: black"><i class="bi bi-box-arrow-left"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row mx-5 mt-5">
        <h5 style="text-align:center">Ingresar Articulos</h5>
        <h3>Centro de Sangre: William Portan</h3>
        <div class="col ml-5">
            <a class="edit" href="aarticulo.php" style="color: #FF0032"><i class="bi bi-plus-circle"></i>Agregar
                Articulo</a>
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF0032">
                        <tr>
                            <th>Fecha</th>
                            <th>Codigo</th>
                            <th>Articulo</th>
                            <th>Minimo</th>
                            <th>Presentacion</th>
                            <th>Departamento</th>
                            <th>Existencias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10/01/2023</td>
                            <td>123456789</td>
                            <td>Bandeja Plastica</td>
                            <td>2</td>
                            <td>Unidad</td>
                            <td>Ambulancias</td>
                            <td>100</td>
                            <td><i class="bi bi-pencil-square"> Editar </i>
                                <i class="bi bi-trash"> Desactivar </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>
</body>

</html>