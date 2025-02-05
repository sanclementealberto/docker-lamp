
<?php
function footerUD2()
{
    echo '<footer class="bg-dark text-white text-center fixed-bottom py-2">';
    //mediante el metodo date obtengo la fecha actual de la maquina para que se vaya actualizando
    $currentYear = date("Y");
    echo '<p>&copyCopyright 2024- ' . $currentYear . '.Todos los derechos reservados</p>';
    echo '</footer>';
}
