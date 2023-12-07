<fieldset>
        <legend>Información General</legend>
        <label for="nombre">Nombre:</label>
        <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre" value="<?php echo s($vendedor->nombre); ?>">

        <label for="apellidos">Apellidos: </label>
        <input name="vendedor[apellidos]" type="text" id="apellidos" placeholder="Apellidos" value="<?php echo s($vendedor->apellidos); ?>">

        <label for="telefono">Teléfono:</label>
        <input name="vendedor[telefono]" type="text" id="telefono" placeholder="Teléfono" value="<?php echo s($vendedor->telefono); ?>">

</fieldset>
