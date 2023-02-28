<main class="contenedor seccion">
        <h1>Información de la empresa</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                    Exercitationem expedita consequatur maxime voluptatem  
                    ullam in molestias, odit doloremque harum praesentium fuga 
                    corrupti porro?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                    Exercitationem expedita consequatur maxime voluptatem  
                    ullam in molestias, odit doloremque harum praesentium fuga 
                    corrupti porro?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                    Exercitationem expedita consequatur maxime voluptatem  
                    ullam in molestias, odit doloremque harum praesentium fuga 
                    corrupti porro?</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y departamentos en venta</h2>

        <?php 
          include 'listado.php';
        ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Información de la pagina</h2>
        <p>Aqui va la información que el cliente desea poner</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
       <section class="blog">
           <h3>Nuestro Blog</h3>

           <article class="entrada-blog">
               <div class="imagen">
                   <picture>
                       <source srcset="build/img/blog1.webp" type="image/webp">
                       <source srcset="build/img/blog1.jpg" type="image/jpeg">
                       <img loading="lazy" src="build/img/blog1.jpg" alt="texto entrada blog">
                   </picture>
               </div>

               <div class="texto-entrada">
                   <a href="entrada.php">
                       <h4>Terraza en la entrada de tu casa</h4>
                       <p class="informacion-meta">Escrito el: <span>06/06/2022</span> por: <span> Admin Pagina</span></p>
                       <p>Aqui el cliente debe poner un tema que quiere recomendarle al cliente</p>
                   </a>
               </div>
           </article>

           <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guia para la decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>06/06/2022</span> por: <span> Admin Pagina</span></p>
                    <p>Aqui el cliente debe poner un tema que quiere recomendarle al cliente</p>
                </a>
            </div>
        </article>
       </section>

       <section class="testimoniales">
           <h3>testimoniales</h3>
           <div class="testimonial">
               <blockquote>
                   El personal se comporto de buena manera, fuimos muy bien atendidos por todos
                   Muchas gracias.
               </blockquote>
               <p>- Cliente Angie</p>
           </div>
       </section>
    </div>