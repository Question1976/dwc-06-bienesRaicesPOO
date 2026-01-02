<fieldset>
    <legend>Información general</legend>

    <label for="titulo">Título:</label>
    <input 
        type="text" 
        id="titulo" 
        name="propiedad[titulo]" 
        value="<?php echo s( $propiedad->titulo ); ?>" 
        placeholder="Título propiedad"
    >

    <label for="precio">Precio:</label>
    <input 
        type="number" 
        id="precio" 
        name="propiedad[precio]" 
        value="<?php echo s( $propiedad->precio ); ?>" 
        placeholder="Precio propiedad"
    >

    <label for="imagen">Imagen:</label>
    <input 
        type="file" 
        id="imagen" 
        accept="image/jpeg, image/png" 
        name="propiedad[imagen]"
    >

    <?php if($propiedad->imagen) { ?>
        <img 
            src="/imagenes/<?php echo $propiedad->imagen; ?>" 
            class="imagen-small" 
            alt="Imagen propiedad"
        >
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]">
    <?php echo s( $propiedad->descripcion ); ?>
    </textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input 
        type="number" 
        id="habitaciones" 
        name="propiedad[habitaciones]" 
        min="1" 
        max="9" 
        placeholder="Número de habitaciones" 
        value="<?php echo s( $propiedad->habitaciones ); ?>"
    >

    <label for="wc">Baños:</label>
    <input 
        type="number" 
        id="wc" 
        name="propiedad[wc]" 
        min="1" 
        max="9" 
        placeholder="Número de baños" 
        value="<?php echo s( $propiedad->wc ); ?>"
    >

    <label for="estacionamiento">Estacionamiento:</label>
    <input 
        type="number" 
        id="estacionamiento" 
        name="propiedad[estacionamiento]" 
        min="1" 
        max="9" 
        placeholder="Número de estacionamientos" 
        value="<?php echo s( $propiedad->estacionamiento ); ?>"
    >
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorId]" id="vendedor">
        <option selected value="">-- Seleccione --</option>

        <?php foreach($vendedores as $vendedor) { ?>
            <option
                <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?> 
                value="<?php echo s($vendedor->id); ?>"
            >
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option>
        <?php } ?>

    </select>    
</fieldset>