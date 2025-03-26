<nav class="col-md-3 col-lg-2 d-md-block sidebar <?php echo $temaBootstrap == 'dark' ? '' : 'bg-light'; ?> ">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/index.php">
                    Home
                </a>
            </li>

            <?php
             if (checkAdmin())
             {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/init.php">
                    Inicializar (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/usuarios/usuarios.php">
                    Lista de usuarios (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/usuarios/nuevoUsuarioForm.php">
                    Nuevo usuario (PDO)
                </a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/tareas/tareas.php">
                    Lista de tareas (mysqli)
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/tareas/nuevaForm.php">
                    Nueva tarea (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/UD3/entregaTarea_solucion/tareas/buscaTareas.php">
                   Buscador de tareas (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $raiz?>"/login/logout.php">
                Salir
            </a>

            </li>
            
        </ul>
        <!-- Cambiar color-->
       <?php $valorTema =isset($_COOKIE['tema']) ? $_COOKIE['tema'] : "light";?>
       <form class="m-3 w-50" action="<?php echo $raiz?>/controlador/tema.php" method="post">
            <select name="tema" id="tema" class="form-select mb-2" aria-label="Selector de tema">
                <option value="light" <?php echo $valorTema=='light'? 'selected' : '' ?>>Claro</option>
                <option value="dark" <?php echo $valorTema=='dark' ? 'selected' : '' ?>>Oscuro  </option>
                <option value="auot" <?php echo $valorTema=='auot' ? 'selected' : ''?>>Automatico</option>

            </select>
            <button type="submit" class="btn btn-primary w-100"> Aplicar </button>
       </form>
    </div>
</nav>