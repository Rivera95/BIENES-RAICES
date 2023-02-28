<main class="contenedor seccion contenido-centrado">
           <h1>Iniciar Sesion</h1>

           <?php foreach($errores as $error): ?>
               <div class="alerta error">
                   <?php echo $error; ?>
               </div>
           <?php endforeach; ?>

           <form method="POST" class="formulario" action="/login">
           <fieldset>
                <legend>Email y Password</legend>
          
                <label for="email">E-mail:</label>
                <input type="email" placeholder="Ingresa el Email" id="email" name="email">

                <label for="password">Password:</label>
                <input type="password" placeholder="Ingresa el password" id="password" name="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
           </form>
</main>