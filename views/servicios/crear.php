<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">LLena los campos para añadir un nuevo servicio</p>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/services/create" method="POST">
    <?php include_once 'formulario.php' ?>
    <input class="boton" type="submit" value="Guardar servicio">
</form>