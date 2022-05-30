<?php 

    // validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Base de datos

    require '../../includes/config/database.php';
    $db = conectarDB();

    //consulta para obtener todos los datos
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);
    //var_dump($propiedad);

    //Consulta para obtener los vendedores
    $consulta = " SELECT * FROM vendedores ";
    $resultado = mysqli_query($db, $consulta);


    //Arreglo con mensajes de errores 
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorid'];
    $imagenPropiedad = $propiedad['imagen'];

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        
            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";

            // echo "<pre>";
            // var_dump($_FILES);
            // echo "</pre>";

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        // echo "<pre>";
        //     var_dump($imagen['size']);
        // echo "</pre>";


        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descipcion es obligatoria y debe contener más de 50 caracteres.";
        }

        if(!$habitaciones){
            $errores[] = "Debes añadir un numero valido de habitaciones";
        }

        if(!$wc){
            $errores[] = "Debes añadir un numero valido de baños";
        }

        if(!$estacionamiento){
            $errores[] = "Debes añadir un numero valido de lugares de estacionamiento";
        }

        if(!$vendedorId){
            $errores[] = "Debes añadir un vendedor";
        }

        //Validar por tamaño 1Mb maximo
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida){
            $errores[] = "La imagen es muy pesada";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){

            // crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            /* Subida de archivos */

            if($imagen['name']){
                //Eliminar imagen anterior
                unlink($carpetaImagenes . $propiedad['imagen']);
                // generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

                // Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else{
                $nombreImagen = $propiedad['imagen'];
            }


        
            //Insertar en la base de datos
    
            $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorid = ${vendedorId} WHERE id = ${id} ";
    
            // echo $query;
    
            $resultado = mysqli_query($db, $query);

            // echo "<pre>";
            // var_dump($resultado);
            // echo "</pre>";
    
            if($resultado){
                // Redireccionar al usuario

                header("Location: /admin?resultado=2");
            }
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data"> <!-- action="/admin/propiedades/actualizar.php" -->
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input name="titulo" type="text" id="titulo" placeholder="Titulo Popiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input name="precio" type="number" id="precio" placeholder="Precio Popiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen Propiedad" class="imagen-small">

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion de la propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input name="habitaciones" type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input name="wc" type="number" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" >
                    <option value="" selected>--- Seleccione ---</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>