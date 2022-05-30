<?php 

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    require 'includes/config/database.php';
    $db = conectarDB();

    //consulta para obtener todos los datos
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    if(!$resultado->num_rows){
        header('Location: /');
    }
    $propiedad = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
<!-- 
        <picture>
            <source srcset="src/img/destacada.webp" type="image/webp">
            <source srcset="src/img/destacada.jpg" type="image/jpeg"> -->
        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad" loding="lazy">
        <!-- </picture> -->

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="src/img/icono_wc.svg" alt="Icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="src/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="src/img/icono_dormitorio.svg" alt="Icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad['descripcion']; ?></p>

        </div>
    </main>

<?php 
    // cerrar conexion
    mysqli_close($db);

    incluirTemplate('footer');
?>