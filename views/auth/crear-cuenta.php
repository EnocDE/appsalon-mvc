<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">LLena el siguiente formulario para crear una cuenta.</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre </label>
        <input id="nombre" name="nombre" type="text" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido </label>
        <input id="apellido" name="apellido" type="text" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido) ?>">
    </div>
    <div class="campo">
        <label for="email">Email </label>
        <input id="email" name="email" type="email" placeholder="Tu Email" value="<?php echo s($usuario->email) ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono </label>
        <input id="telefono" name="telefono" type="tel" placeholder="Tu Teléfono" value="<?php echo s($usuario->telefono) ?>">
    </div>
    <div class="campo">
        <label for="password">Contraseña </label>
        <div class="campo-password">
            <input id="password" name="password" type="password" placeholder="Tu Contraseña">
            <img class="icono-ojo" src="./build/img/eye.png" alt="icono-visibilidad" onclick="toggleVisible()">
        </div>
    </div>
    <input class="boton" type="submit" value="Registrarse">
</form>

<div class="acciones">
    <p>¿Ya tienes cuenta? <a href="/">Ingresa desde aqui</a> </p>
</div>

<?php
$script = "
    <script src='build/js/app.js'></script>
";
?>