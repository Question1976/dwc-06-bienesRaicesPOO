<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        value="<?php echo s( $vendedor->nombre ); ?>" 
        placeholder="Nombre vendedor(a)"
    >

    <label for="apellido">Apellido:</label>
    <input 
        type="text" 
        id="apellido" 
        name="vendedor[apellido]" 
        value="<?php echo s( $vendedor->apellido ); ?>" 
        placeholder="Apellido vendedor(a)"
    >

</fieldset>

<fieldset>
    <legend>Información extra</legend>

    <label for="telefono">Teléfono:</label>
    <input 
        type="text" 
        id="telefono" 
        name="vendedor[telefono]" 
        value="<?php echo s( $vendedor->telefono ); ?>" 
        placeholder="Teléfono vendedor(a)"
    >
</fieldset>