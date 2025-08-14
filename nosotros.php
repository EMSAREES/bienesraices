
    <?php
        require 'include/funciones.php';
        incluirTemplate('header');
    ?>


    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam nec nisi facilisis aliquet. Sed non ligula a enim facilisis tincidunt. 
                    Integer ac felis vel justo facilisis commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam nec nisi facilisis aliquet. 
                    Sed non ligula a enim facilisis tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam nec nisi facilisis aliquet. S
                    ed non ligula a enim facilisis tincidunt. Integer ac felis vel justo facilisis commodo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                    at quam nec nisi facilisis aliquet. Sed non ligula a enim facilisis tincidunt. Integer ac felis vel justo facilisis commodo.Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit. Quisque at quam nec nisi facilisis aliquet. Sed non ligula a enim facilisis tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam nec nisi facilisis aliquet. Sed non ligula a enim facilisis tincidunt. 
                    Integer ac felis vel justo facilisis commodo. Integer ac felis vel justo facilisis commodo.Integer ac felis vel justo facilisis commodo.
                </p>

                <p>Curabitur in libero nec erat efficitur convallis. Donec sed odio id libero facilisis tincidunt. Suspendisse potenti. Maecenas euismod, nunc at facilisis cursus,
                    est erat interdum augue, a bibendum leo enim in justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam nec nisi facilisis aliquet. 
                    Sed non ligula a enim facilisis tincidunt. Integer ac felis vel justo facilisis commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam 
                    nec nisi facilisis aliquet. Sed non ligula a enim facilisis tincidunt. Integer ac felis vel justo facilisis commodo.
                </p>    

            </div>
        </div>
    </main>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at est vel quam facilisis aliquet.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at est vel quam facilisis aliquet.
                </p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at est vel quam facilisis aliquet.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at est vel quam facilisis aliquet.
                </p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at est vel quam facilisis aliquet.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at est vel quam facilisis aliquet.
                </p>
            </div>
        </div>
    </section>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <?php
        incluirTemplate('footer');
    ?>
