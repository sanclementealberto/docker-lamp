<?php

/**
 * Summary of menuTienda
 * @return string
 * con col- numero el numero indica el % del ancho que ocupara la columna
 */
function menuTienda()
{
    $actionUrl = htmlspecialchars('./listaUsuarios.php');

    return <<<HTML
        <div class="container vh-100  col-2  menu-background text-white-100 elemento-fijo">
        <div class="row ">

        <h4 class="text-center">Menú</h4>
            <ul class="nav flex-column ">
            <li class="nav mb-3" >
                    <a  class="nav-link col-6 text-white-100" href="?page=inicio">Inicio</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  col-6 text-white-100" href="?page=listaUsuariosView">Lista Usuarios</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link col-6 text-white-100 " href="?page=nuevoUsuarioView">Nuevo Usuario</a>
                </li>
              
            </ul>
        </div>
        </div>
    HTML;
}

