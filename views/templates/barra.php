<div class="barra">
    <p class="saludo">Bienvenido: <span class="nombre"><?php echo $nombre ?? '' ?></span></p>
    <a class="boton" href="/logout">Cerrar sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a href="/admin" class="boton">Ver citas</a>
        <a href="/services" class="boton">Ver servicios</a>
        <a href="/services/create" class="boton">Nuevo servicio</a>
    </div>
<?php } ?>