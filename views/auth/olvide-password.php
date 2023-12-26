<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña introduciendo tu email</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" action="/forgot" method="POST">
    <dev class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu Email">
    </dev>
    <input class="boton" type="submit" value="Enviar correo">
</form>

<div class="acciones">
    <p>¿Ya tienes cuenta? <a href="/">Ingresa desde aqui</a> </p>
    <p>¿Aún no estas registrado? <a href="/new-account">Registrate</a> </p>
</div>