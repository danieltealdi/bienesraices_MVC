<h1 class="fw-300 centrar-texto">Administración - Nuevo Vendedor</h1>

<main class="contenedor seccion contenido-centrado">
    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Crear Vendedor" class="boton boton-verde">

    </form>

</main>