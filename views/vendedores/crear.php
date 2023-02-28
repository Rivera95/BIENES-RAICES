
<main class="contenedor seccion">
          <h1>Registrar Vendedor(a)</h1>
          <a href="/admin" class="boton boton-verde">Volver</a>

          <!-- CODIGO PARA IMPRIMIR LOS ERRORES QUE SE PRESENTEN -->
          <?php foreach($errores as $error): ?>
            <div class="alerta error">
               <?php echo $error ?>
            </div>
          <?php endforeach; ?>

          <form class="formulario" method="POST" action="/vendedores/crear">
           
            <?php include 'formulario.php'; ?>
            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
          </form>
</main>