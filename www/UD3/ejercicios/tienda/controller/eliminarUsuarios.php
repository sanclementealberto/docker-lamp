<?php
include_once("../model/ModeloUsuarios.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar el parámetro
    $resultado = eliminarUsuario($id);

    if ($resultado === true) {
        header("Location: ../view/listaUsuariosView.php?mensaje=" . urlencode("Usuario eliminado con éxito"));
        exit;
    } else {
        header("Location: ../view/listaUsuariosView.php?error=" . urlencode("Error al eliminar el usuario"));
        exit;
    }
} else {
    header("Location: listaUsuariosView.php?error=" . urlencode("ID de usuario no proporcionado."));
    exit;
}