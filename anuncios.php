<?php 

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>

        <?php 

            $limite = 30;
            include 'includes/templates/anuncios.php'
        ?>

    </main>

<?php 
    //Cerrar conexion
    mysqli_close($db);
    incluirTemplate('footer');
?>