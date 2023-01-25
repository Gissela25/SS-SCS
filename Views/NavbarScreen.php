<?php 
include_once "./Core/config.php"
?>
<nav class="navbar navbar-expand-lg" style="background-color: #EEEEEE;">
    <div class="container-fluid">
        <a><img src="<?=PATH?>Assets/imgs/navicon.jpg" alt="" width="220" height="80"
                class="d-inline-block align-text-top"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=PATH?>Users/Index"
                        style="color: black">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Deparments/index" style="color: black">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Areas/Index" style="color: black">Areas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Articles/Index" style="color: black">Articulos</a>
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