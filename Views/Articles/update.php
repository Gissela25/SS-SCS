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

<body>
    <div class="row justify-content-center pt-5 mt-5 ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <?php
                    //Para recorrer el arreglo de datos del usuario ingresado
            foreach($productos as $producto){
            ?>
                    <form method="post" action="<?=PATH?>Articles/SetArticle" enctype="multipart/form-data" role="form">
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
                        <input type="hidden" name="Id_Articulo" id="Id_Articulo"
                            value="<?=$producto['Id_Articulo']?>">
                        <div class="form-group text-center my-1">
                            <h3 class="text" style="color:#FF0032">Actualizar Articulo</h3>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Codigo</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregar Codigo" aria-label="Name"
                                aria-describedby="basic-addon1" name="Codigo" id="Codigo"
                                value="<?=isset($producto)?$producto['Codigo']:''?>">
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Articulo</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregar Departamento" aria-label="Name"
                                aria-describedby="basic-addon1" name="Nombre" id="nombre"
                                value="<?=isset($producto)?$producto['NombreA']:''?>">
                        </div>
                        <!-- <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" placeholder="Agregar Departamento" aria-label="Name"
                                aria-describedby="basic-addon1" name="Id_Area" id="Id_Area"
                                value="<?=isset($producto)?$producto['Id_Area']:''?>">
                        </div> -->
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Departamento</label>
                        </div>
                        <div class="input-group mb-3">
                        <select class="form-select" name="Id_Departamento" id="Id_Departamento"
                                aria-label="Floating label select example">
                                <?php
							foreach($lugares as $lugar)
							{
							?>


                                <?php if($producto['NombreD']==$lugar['NombreD'])
							{

								?>
                                <option selected value="<?=$lugar['Id_Departamento']?>"><?=$lugar['NombreD']?></option>
                                <?php
							} 
							else
							{
								?>
                                
                                <option value="<?=$lugar['Id_Departamento']?>"><?=$lugar['NombreD']?></option>
                                <?php
							}
							?>
                                <?php
                            }
						
                        ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Presentacion</label>
                        </div>
                        <div class="input-group mb-3">
                        <select class="form-select" name="Id_Presentacion" id="Id_Presentacion"
                                aria-label="Floating label select example">
                                <?php
							foreach($formas as $forma)
							{
							?>


                                <?php if($producto['NombreP']==$forma['NombreP'])
							{

								?>
                                <option selected value="<?=$forma['Id_Presentacion']?>"><?=$forma['NombreP']?></option>
                                <?php
							} 
							else
							{
								?>
                                
                                <option value="<?=$forma['Id_Presentacion']?>"><?=$forma['NombreP']?></option>
                                <?php
							}
							?>
                                <?php
                            }
						
                        ?>
                            </select>
                        </div>
                        <!-- <input type="hidden" name="Id_Area" id="Id_Area"
                            value="<?=$producto['Id_Area']?>"> -->
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-danger" name="Actualizar" id="Actualizar">Guardar</a>
                            </button>
                        </div>
                    </form>
                    <?php }
                    ?>
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