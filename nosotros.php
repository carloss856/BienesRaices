<?php 

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="nosotros-seccion">
            <div class="imagen">
                <picture>
                    <source srcset="src/img/nosotros.webp" type="image/webp">
                    <source srcset="src/img/nosotros.jpg" type="image/jpeg">
                    <img src="src/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Aliquid inventore ducimus nobis? Quia illo minus neque, reiciendis, consequatur quasi blanditiis fuga rem sapiente eos ipsum asperiores, debitis tempora aperiam ducimus animi? Blanditiis id aliquam ab. Ad fuga, amet fugiat reprehenderit saepe magnam.
                Tempora minima omnis, sint qui velit sed adipisci odio dolores, eveniet placeat deleniti voluptatum harum dolorem expedita voluptate quam vitae at quas. Qui consequatur accusamus vitae nam commodi repudiandae quasi.</p>

                <P>Tempore non cumque tempora quisquam quaerat optio eaque.
                Vero eaque sed sequi corporis reiciendis non animi, quae eligendi tempora nihil incidunt vel suscipit facilis amet placeat enim eos doloribus sint quam voluptates impedit sapiente officiis dolor. Laboriosam, dicta.</P>
            </div>


        </div>

    </main>

    
    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="src/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim accusantium, accusamus ex ut unde doloremque ad cumque amet molestiae distinctio dolores facere quisquam corrupti officia veniam! Facere dolores suscipit consequatur?</p>
            </div>
            <div class="icono">
                <img src="src/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim accusantium, accusamus ex ut unde doloremque ad cumque amet molestiae distinctio dolores facere quisquam corrupti officia veniam! Facere dolores suscipit consequatur?</p>
            </div>
            <div class="icono">
                <img src="src/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim accusantium, accusamus ex ut unde doloremque ad cumque amet molestiae distinctio dolores facere quisquam corrupti officia veniam! Facere dolores suscipit consequatur?</p>
            </div>
        </div>
    </section>

<?php 
    include 'includes/templates/footer.php';
?>