<h1 class="nombre-pagina">Panel de administración</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2>Buscar citas</h2>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php if (count($citas) === 0) { ?>
    <?php echo "<h2 class='noCitas'> No hay citas en esta fecha</h2>"; ?>
<?php } ?>

<div id="citas-admin">
    <ul class="citas">
        <?php $idCita = 0; ?>
        <?php foreach ($citas as $key => $cita) { ?>
            <?php
                ?>
            <?php if ($idCita != $cita->id) { ?>
                <?php $total = 0; ?>
                <li>
                    <h3>Datos</h3>
                    <p>ID: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>Email: <span><?php echo $cita->email; ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
                    <h3>Servicios</h3>
                    <?php $idCita = $cita->id; ?>
            <?php } // Fin if ?>
            
                    <p class="servicio"><?php echo $cita->servicio . " $" . $cita->precio ?></p>
                    <?php $total += intval($cita->precio); ?>

            <?php $actual = $cita->id;?>
            <?php $proximo = $citas[$key + 1]->id ?? 0; ?>

                <?php if (esUltimo($actual, $proximo)) { ?>
                    <p>Total: <span class="precio">$<?php echo $total ?> MXN</span></p>
                    <form action="/api/delete" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input class="boton-eliminar" type="submit" value="Eliminar">
                    </form>
                <?php } ?>

        <?php } // Fin foreach ?>
    </ul>
</div>

<?php $script = "<script src='build/js/buscador.js'></script>" ?>