<?php 
include_once "./Core/config.php"
?>
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
<form method="post" action="<?=PATH?>Articles/AddArticle" enctype="multipart/form-data" role="form">
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
    <div class="row mx-5 mt-5 my-4">
        <div class="col ml-5">
            <div class="row mt-3">
            

                <table class="table table-borderless">
                    <thead>
                        <tr>
                        
                            <th scope="col"></th>
                            <th scope="col"style="color:#b32821">AGREGAR ARTICULO</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td>
                                <div class="form-group mx-sm-4 pt-3">
                                    <label for="exampleInputPassword1" class="form-label">Articulo</label>
                                    <input type="text" class="form-control" placeholder="Agregue artículo" aria-label="Username"
                                aria-describedby="basic-addon1" name="Nombre" id="Nombre"
                                value="<?=isset($producto)?$producto['NombreP']:''?>">
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div class="form-group mx-sm-4 pt-3">
                                    <label for="exampleInputPassword1" class="form-label">Codigo</label>
                                    <input type="text" class="form-control" placeholder="Agregue codigo" aria-label="Username"
                                aria-describedby="basic-addon1" name="Codigo" id="Codigo"
                                value="<?=isset($producto)?$producto['Codigo']:''?>">
                                </div>
                            </td>
                        </tr>




                        <td></td>
                            <td>
                                <div class="form-group mx-sm-4 pt-3">
                                    <label for="exampleInputPassword1" class="form-label">Departamento</label>
                                    <select class="form-select" name="Id_Departamento" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option selected value=""></option>
                                <?php
                            foreach($lugares as $departamento)
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

                        
                    
                    </td>
                            <td></td>
                            <td>
                                <div class="form-group mx-sm-4 pt-3">
                                    <label for="exampleInputPassword1" class="form-label">Presentacion</label>
                                    <select class="form-select" name="Id_Presentacion" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option selected value=""></option>
                                <?php
                            foreach($formas as $presentacion)
                            {
                            ?>
                                <option value="<?=$presentacion['Id_Presentacion']?>"><?=$presentacion['NombreP']?>
                                </option>
                                <?php
                            }
                            ?>
                            </select>
                                </div>
                            </td>
                        </tr>

                        <td></td>
                        
                        
                        
                        
                            <td>
                                <a href="" class="btn btn-danger btn-block boton mx-5">Ingresar</a>
                            </td>
                            
                        </tr>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
















</body>

</html>