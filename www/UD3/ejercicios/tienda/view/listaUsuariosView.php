<?php
include_once("../model/ModeloUsuarios.php");
    function listaUsuariosView()
{
    $usuarios = listaUsuarios();

    $html = '<div class="container col-8 mt-4">';
    $html .= '<h2>Lista de Usuarios</h2>';
    $html .= '<table class="table table-hover table-bordered">';
    $html .= '<thead class="table-dark">';
    $html .= '<tr>';
    $html .= '<th>ID</th>';
    $html .= '<th>Nombre</th>';
    $html .= '<th>Apellidos</th>';
    $html .= '<th>Edad</th>';
    $html .= '<th>Provincia</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    if (!empty($usuarios)) {
        foreach ($usuarios as $usuario) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($usuario['id']) . '</td>';
            $html .= '<td>' . htmlspecialchars($usuario['nombre']) . '</td>';
            $html .= '<td>' . htmlspecialchars($usuario['apellidos']) . '</td>';
            $html .= '<td>' . htmlspecialchars($usuario['edad']) . '</td>';
            $html .= '<td>' . htmlspecialchars($usuario['provincia']) . '</td>';
            $html .= '</tr>';
        }
    } else {
        $html .= '<tr><td colspan="5" class="text-center">No hay usuarios registrados.</td></tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';

    return $html;
}






