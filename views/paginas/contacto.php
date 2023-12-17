<h1 class="fw-300 centrar-texto">Contacto</h1>
<?php
if ($mensaje) {
    if ($mensaje === 'exito') {
        echo "<p class='alerta exito'>El correo se envió correctamente</p>";
    } else {

        echo "<p class='alerta error'>El correo no se pudo enviar</p>";
    }
}
?>
<img src="/build/img/destacada3.jpg" alt="Imagen Principal">

<main class="contenedor seccion contenido-centrado">
    <h2 class="fw-300 centrar-texto">Llena el formulario de Contacto</h2>


    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]">
            <label for="mensaje">Mensaje: </label>
            <textarea id="mensaje" name="contacto[mensaje]"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre Propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select id="opciones" name="contacto[tipo]">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="cantidad">Precio o presupuesto:</label>
            <input type="number" id="cantidad" name="contacto[cantidad]">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser Contactado:</p>
            <div class="forma-contacto">
                <label for="seltelefono">Teléfono</label>
                <input type="radio" value="telefono" id="seltelefono" name="contacto[contacto]"></input>
                <label for="correo">E-mail</label>
                <input type="radio" value="correo" id="correo" name="contacto[contacto]"></input>
            </div>
            <div id="contacto"></div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton boton-verde">

    </form>
</main>