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
<?php 
 require_once "./Views/NavbarScreen.php";
?>
    <div class="row mx-5 mt-5">
        <h5 style="text-align:center">Ingresar Articulos</h5>
        <h3>Centro de Sangre: William Portan</h3>
        <div class="col ml-5">
            <a class="edit" href="<?=PATH?>Articles/Insert" style="color: #FF0032"><i class="bi bi-plus-circle"></i>Agregar
                Articulo</a>
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF8B8B">
                        <tr>
                            <th>Fecha</th>
                            <th>Codigo</th>
                            <th>Articulo</th>
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
                            <td>Unidad</td>
                            <td>Ambulancias</td>
                            <td>100</td>
                            <td><button name="editar" type="submit" id="editar" class="btn btn-dark"><i class="bi bi-pencil">  </button></i>
                            <button name="Desactivar" type="submit" id="Desactivar" class="btn btn-dark"><i class="bi bi-file-excel">  </button></i>
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