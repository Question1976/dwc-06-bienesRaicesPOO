<?php 
    require 'includes/funciones.php';                                 
    incluirTemplate('header');          //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>
        
        <p class="informacion-meta">Escrito el: <span>15/10/2025</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur, libero ex. Blanditiis inventore velit vero cum optio, at modi excepturi perferendis debitis dicta ad quas! Officia totam voluptatum repellat nihil.
            Eligendi, dolores esse hic fugiat sit aperiam sunt dolorem autem excepturi quasi magni perferendis neque rerum laboriosam rem ea. Quasi exercitationem culpa harum dolor debitis praesentium a quidem nobis quia!</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum dignissimos rerum nam, unde beatae laboriosam corporis consequatur, ipsum eius numquam, assumenda vitae aliquid velit ipsa consectetur maxime. Alias, voluptatem ex!</p>
        </div>
    </main>

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>