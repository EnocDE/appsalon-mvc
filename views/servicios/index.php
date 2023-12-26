<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de servicios</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="servicios">
    <?php foreach ($servicios as $servicio) { ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio ?></span></p>
            <a class="btn btn-actualizar" href="/services/update?id=<?php echo $servicio->id; ?>"><img src="/build/img/lapiz.png" alt="editar"></a>
            <form action="/services/delete" method="POST">
                <input type="hidden" name="id" value="<?php echo $servicio->id ?>">
                <button class="btn btn-eliminar" type="submit" value=""><img src="/build/img/borrar.png" alt=""></button>
            </form>
        </li>
    <?php } ?>
</ul>