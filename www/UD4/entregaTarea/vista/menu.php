<?php
$clase_tema = cambiarColor();

?>

<nav class="col-md-3 col-lg-2 d-md-block <?php echo $clase_tema; ?> " >
 
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/index.php">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/init.php">
                    Inicializar (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/usuarios/usuarios.php">
                    Lista de usuarios (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/usuarios/nuevoUsuarioForm.php">
                    Nuevo usuario (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/tareas/tareas.php">
                    Lista de tareas (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/tareas/nuevaForm.php">
                    Nueva tarea (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/tareas/buscaTareas.php">
                    Buscador de tareas (PDO)
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/UD4/entregaTarea/controlador/logout.php">
                    Salir
                </a>
            </li>
            <form class="m-3 w-50 action="tema.php" method="POST">
                <select id="tema" name="tema" class="form-select mb-2" aria-label="Selector de tema">
                    <option value="light" selected> Claro</option>
                    <option value="dark">Oscuro</option>
                    <option value="auto">Automático</option>
                </select>
                <button type="submit" class="btn btn-primary w-100">Aplicar</button>
            </form>

        </ul>
    </div>
</nav>