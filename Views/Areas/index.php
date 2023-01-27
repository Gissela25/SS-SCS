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
            <a class="edit" href="<?=PATH?>Areas/Insert" style="color: #FF0032"><i class="bi bi-plus-circle"></i>Agregar Area</a>
            <div class="row mt-3">
                <table class="table table-bordered " id="datatable">
                    <thead class="Te" style="background-color: #FF0032">
                        <tr>
                            <th>ID Area</th>
                            <th>Area</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>A004</td>
                            <td>Sangria</td>
                            <td><button name="editar" type="submit" id="editar" class="btn btn-dark"><i class="bi bi-pencil">  </button></i>
                            <button name="Desactivar" type="submit" id="Desactivar" class="btn btn-dark"><i class="bi bi-file-excel">  </button></i>
                            


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