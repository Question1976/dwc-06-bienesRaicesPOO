<?php 
    require 'includes/app.php';                                 
    incluirTemplate('header');          //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi repellendus nam iure libero minima tenetur neque nulla, illum voluptas quasi facere ipsam nisi consequuntur, labore consequatur blanditiis voluptatem perferendis! Dicta.
                Asperiores quam nesciunt, repellendus perspiciatis nisi, et qui doloremque quod molestias deleniti voluptatum nam delectus id eaque perferendis! Vel iste ad amet repudiandae iusto consequatur saepe ullam dolorem non tempora.</p>

                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi exercitationem commodi iusto cupiditate illum velit adipisci eveniet recusandae, cumque sint tempore officiis nostrum ipsum.</p>
            </div>
        </div>
    </main> 

    <!-- Main | contenido principal -->
    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, libero debitis impedit aperiam unde at, quo deleniti pariatur nam saepe maxime! Voluptatibus iure illo praesentium maiores provident fugit quod eos?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, libero debitis impedit aperiam unde at, quo deleniti pariatur nam saepe maxime! Voluptatibus iure illo praesentium maiores provident fugit quod eos?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, libero debitis impedit aperiam unde at, quo deleniti pariatur nam saepe maxime! Voluptatibus iure illo praesentium maiores provident fugit quod eos?</p>
            </div>
        </div>
    </section> 

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>