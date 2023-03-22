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
        <div class="col ml-5">
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF8B8B">
                        <tr>
                            <th>ID existencia</th>
                            <th>Artìculos</th>
                            <th>Fecha entrada</th>
                            <th>Entrada</th>
                            <th>Fecha salida</th>
                            <th>Salida</th>
                            <th>Fecha actualizaciòn</th>
                            <th>Saldo</th>
                            <th>editar</th>
                            <th>Eliminar</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A004</td>
                            <td>Sangria</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button name="editar" type="submit" id="editar" class="btn btn-dark"><i class="bi bi-pencil">  </button></i>
                            </td>
                            <td><button name="Desactivar" type="submit" id="Desactivar" class="btn btn-dark"><i class="bi bi-file-excel">  </button></i>
                            </td>
                            <td><a class="edit" href="<?=PATH?>Stocks/Insert" style="color: #FF0032"><button name="Agregar" type="submit" id="Agregar" class="btn btn-dark"><i class="bi bi-file-plus">  </button></i>
                            </td>

                        </tr>
                        <tr>
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