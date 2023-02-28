<main class="contenedor seccion">
    <h1>Crear</h1>

    <!-- CODIGO PARA IMPRIMIR LOS ERRORES QUE SE PRESENTEN -->
    <?php foreach($errores as $error): ?>
            <div class="alerta error">
               <?php echo $error ?>
            </div>
    <?php endforeach; ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
    
</main>