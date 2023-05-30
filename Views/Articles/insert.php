<?php
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar artículo - Cruz Roja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

<div class="row mx-5 mt-5 my-4">
        <div class="col ml-5">
            <div class="row mt-3">

            <form method="post" action="<?=PATH?>Articles/AddArticle" enctype="multipart/form-data" role="form">
                        <?php
                               if (isset($errores)) {
                                   if (count($errores) > 0) {
                                       echo "<div class='alert alert-danger' style='color:#343a40' ><ul>";
                                       foreach ($errores as $error) {
                                           echo "<li style='color:#343a40'>$error</li>";
                                       }
                                       echo "</ul></div>";
                                   }
                               }
                         ?>
            

                <table class="table table-borderless">
                    <thead>
                        <tr>
                        
                           <th scope="col"></th>
                            <th scope="col"style="color:#FF0000">INGRESE ARTICULO</th>
                            <th scope="col"></th>
                            <th scope="col"style="color:#084594">
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <th scope="row"></th>
                            <td>
                                <label for="Codigo" class="form-label">Código</label>
                            <div class="input-group mb-3">
                            
                            <span class="input-group-text" id="basic-addon1"></span>
                            <input type="text" class="form-control" placeholder="Agregue codigo" aria-label="Username"
                                aria-describedby="basic-addon1" name="Codigo" id="Codigo"
                                value="<?=isset($productos[0])?$productos[0]['Codigo']:''?>">
                        </div>
                            </td>
                            <td></td>
                            <td>
<label for="exampleInputPassword1" class="form-label">Artículo</label>
                            <div class="input-group mb-3">
                            
                            <span class="input-group-text" id="basic-addon1"></span>
                            <input type="text" class="form-control" placeholder="Agregue artículo" aria-label="Username"
                                aria-describedby="basic-addon1" name="Nombre" id="Nombre"
                                value="<?=isset($productos[0])?$productos[0]['NombreP']:''?>">
                        </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>
<label for="exampleInputPassword1" class="form-label">Departamento</label>
                                <div class="input-group mb-3">

                                <select class="form-select" name="Id_Departamento" id="Id_Departamento"
                                aria-label="Floating label select example">
                                <option selected value=""></option>
                                <?php
                               foreach ($lugares as $departamento) 
                               {
                                   ?>
                                <option value="<?=$departamento['Id_Departamento']?>"><?=$departamento['NombreD']?>
                                </option>
                                <?php
                               }
                               ?>
                            </select>
                        </div>
                            </td>
                            
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>
<label for="exampleInputPassword1" class="form-label">Presentación</label>
<div class="input-group mb-3">
                                <select class="form-select" name="Id_Presentacion" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option selected value=""></option>
                                <?php
                                 foreach ($formas as $presentacion) {
                                     ?>
                                <option value="<?=$presentacion['Id_Presentacion']?>"><?=$presentacion['NombreP']?>
                                </option>
                                <?php
                                   }
                                   ?>
                            </select>
                        </div>
                            </td>
                            <td></td>
                            <td>
                               <button type="submit" class="btn btn-danger" name="Guardar" id="Guardar">Guardar
                            </button>
                            </td>
                        </tr>
                        </form>
                        
                            <td></td>
                            <td>
                            </td>
                       
                    </tbody>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
                </table>

                
            </div>

</html>