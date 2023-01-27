<?php 
include_once "./Core/config.php"
?>
<nav class="navbar navbar-expand-lg" style="background-color: #FF0032;">
    <div class="container-fluid">
        <a><img src="<?=PATH?>Assets/imgs/logon.png" alt="" width="90" height="90"
                class="d-inline-block align-text-top"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <div class="mx-3" style="color: white">
                <h3>Cruz Roja Salvadoreña</h3>
                </div>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=PATH?>Users/Index"
                        style="color: white">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Deparments/index" style="color: white">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Areas/Index" style="color: white">Areas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Articles/Index" style="color: white">Articulos</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" href="../Articlesindex.php" style="color: black">Salida de Articulos</a>
                    </li> -->
                <!-- <li class="nav-item">
                        <a class="nav-link" href="../SingUpScreen.php" style="color: black"><i class="bi bi-box-arrow-left"></i></a>
                    </li> -->
            </ul>
        </div>
    </div>
</nav>