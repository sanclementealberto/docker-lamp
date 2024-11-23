<?php
include_once("../model/ModeloUsuarios.php");

function listaUsuariosView()
{

    // Mostrar el mensaje de éxito si está presente en la URL
    $mensaje = $_GET['mensaje'] ?? '';
    $error = $_GET['error'] ?? '';

    // Generar la vista con el formulario
    $html = '<div class="container-fluid col-3 mt-5 vh-100 d-flex justify-content-center">';
    $html .= '<div class="container">';

    // Mostrar mensaje de éxito si existe
    if ($mensaje) {
        $html .= '<div class="alert alert-success">' . htmlspecialchars($mensaje) . '</div>';
    }

    // Mostrar mensaje de error si existe
    if ($error) {
        $html .= '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
    }



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
    $html .= '<th>  </th>';
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
            $html .= '<td>';
            $html .= '<a class="btn btn-primary btn-sm me-2" href="modificarUsuario.php?id=' . htmlspecialchars($usuario['id']) . '" role="button">';
            $html .= '<i class="bi bi-pencil"></i> Modificar</a>'; // Usando un ícono para "Modificar"
            $html .= '<a class="btn btn-danger btn-sm" href="../controller/eliminarUsuarios.php?id=' . htmlspecialchars($usuario['id']) . '" role="button" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\')">';
            $html .= '<i class="bi bi-trash"></i> Eliminar</a>'; // Usando un ícono para "Eliminar"
            $html .= '</td>';
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






