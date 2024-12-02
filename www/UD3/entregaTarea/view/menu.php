<?php

function menuTarea()
{
    return <<<HTML
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar ">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../model/mysqli.php.php">
                    Inicializar BD
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tareas.php">
                    Nuevo Usuario (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tareas.php">
                    Lista de Usuarios (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tareas.php">
                    Nueva Tarea (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tareas.php">
                    Lista de Tareas (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tareas.php">
                   Buscador de Tareas(PDO)
                </a>
            </li>
        </ul>
    </div>
</nav>
HTML;

}