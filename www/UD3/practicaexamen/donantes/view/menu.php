<?php

function menuDonantes()
{
    return <<<HTML
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100 ">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/UD3/practicaexamen/donantes/index.php">
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/practicaexamen/donantes/init.php">
                    Inicializar BD
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/practicaexamen/donantes/donante/nuevoDonanteForm.php">
                    Nuevo Donantes (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/practicaexamen/donantes/donante/listaDonantes.php">
                    Lista de donantes (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/practicaexamen/donantes/donacion/listaDonaciones.php">
                    Lista de Donaciones (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/practicaexamen/donantes/donante/buscaDonantesForm.php">
                   Buscador de Donantes(mysqli)
                </a>
            </li>
        </ul>
    </div>
</nav>
HTML;

}