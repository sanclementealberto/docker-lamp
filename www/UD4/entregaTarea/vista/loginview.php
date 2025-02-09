<form action="../controlador/loginAuth.php" method="POST">
    <div class="mb-3">
        <h2 class="text-center">Iniciar sesion</h2>

    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
    </div>

    <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="contraseña" required>
    </div>

    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
</form>
