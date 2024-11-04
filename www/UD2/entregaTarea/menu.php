<?php

function menuUD2( )
{

    echo ' <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">';
    echo '  <div class="position-sticky">';
    echo '    <ul class="nav flex-column">';
    echo '      <li class="nav-item">';
    echo '          <a class="nav-link" href="./index.php">';
    echo 'Home';
    echo '        </a>';
    echo '    </li>';

    echo '     <li class="nav-item">';
    echo '         <a class="nav-link" href="./listaTareas.php">';
    echo '       Mis tareas';
    echo '        </a>';
    echo '    </li>';
    echo '    <li class="nav-item">';
    echo '       <a class="nav-link" href="./nuevaForm.php">';
    echo '        Nueva tarea';
    echo '       </a>';
    echo '   </li>';
    echo '  </ul>';
    echo '  </div>';
    echo '</nav>';
}
