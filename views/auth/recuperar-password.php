<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Escribe tu nueva contraseña en el campo de abajo</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<?php if ($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <div class="campo-password">
            <input id="password" name="password" type="password" placeholder="Tu Nueva Contraseña">
            <img class="icono-ojo" src="./build/img/eye.png" alt="icono-visibilidad" onclick="toggleVisible()">
        </div>
    </div>
    <input class="boton" type="submit" value="Cambiar contraseña">
</form>

<div class="acciones">
    <p>¿Ya tienes cuenta? <a href="/">Ingresa desde aqui</a> </p>
</div>

<?php
$script = "
    <script src='build/js/app.js'></script>
";
?>