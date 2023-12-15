<h1 class="fw-300 centrar-texto">Contacto</h1>
<img src="/build/img/destacada3.jpg" alt="Imagen Principal">

<main class="contenedor seccion contenido-centrado">
    <h2 class="fw-300 centrar-texto">Llena el formulario de Contacto</h2>
    

    <form class="formulario" action="/contacto"  method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" required>

            <label for="email">E-mail: </label>
            <input type="email" id="email" placeholder="Tu Correo electrónico" name="contacto[email]" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" placeholder="Tu Teléfono" name="contacto[telefono]">

            <label for="mensaje">Mensaje: </label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>

        </fieldset>


        <fieldset>
            <legend>Información sobre Propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="cantidad">Precio o presupuesto:</label>
            <input type="number" id="cantidad" name="contacto[cantidad]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser Contactado:</p>

            <div class="forma-contacto">
                <label for="telefono">Teléfono</label>
                <input type="radio" name="contacto" value="telefono" id="telefono" name="contacto[contacto]" required>

                <label for="correo">E-mail</label>
                <input type="radio" name="contacto" value="correo" id="correo" name="contacto[contacto]" required>
            </div>

            <p>Si eligió Teléfono, elija la fecha y la hora</p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">


        </fieldset>

        <input type="submit" value="Enviar" class="boton boton-verde">

    </form>
</main>