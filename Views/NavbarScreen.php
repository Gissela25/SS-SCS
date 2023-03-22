<?php 
include_once "./Core/config.php"
?>
<style>
.dropdown .nav-link {
    color: white;
}

.dropdown-item:hover {
    background-color: #FF8B8B;
}
</style>
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?=PATH?>Articles/Index" style="color: white">Articulos</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a style="color: white" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Articulos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=PATH?>Articles/Index">Inventario</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>Presentations/Index">Presentaciones</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>Stocks/Index">Existencias</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>