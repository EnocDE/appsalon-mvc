<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, voluptatibus.</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" action="/" method="POST">
    <div class="campo">
        <label for="email">Email </label>
        <input id="email" type="email" name="email" placeholder="Tu Email">
    </div>
    <div class="campo">
        <label for="pass">Contraseña </label>
        <div class="campo-password">
            <input id="password" name="password" type="password" placeholder="Tu Contraseña">
            <img class="icono-ojo" src="./build/img/eye.png" alt="icono-visibilidad" onclick="toggleVisible()">
        </div>
    </div>
    <input class="boton" type="submit" value="Iniciar Sesión">
</form>

<div class="acciones">
    <p>¿Aún no estas registrado? <a href="/new-account">Registrate</a> </p>
    <p>¿Olvidaste tu Contraseña? <a href="/forgot">Recupera tu contraseña</a> </p>
</div>

<?php
$script = "
    <script src='build/js/app.js'></script>
";
?>