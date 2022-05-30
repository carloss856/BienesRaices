<?php 
    //conexion db
    require 'includes/config/database.php';
    $db = conectarDB();

    //Autenticar el usuario

    //evaluar errores
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }
        
        if(!$password){
            $errores[] = "El password es obligatorio o no es valido";
        }

        if(empty($errores)){
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);
            
            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth){

                }else{
                    $errores[] = "Correo o clave invalido";
                }
            }else{
                $errores[] = "El usuario no existe o el correo no s valido";
            }
        }
    }


    //incluir el header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu email" required>
                
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Ingresa tu password" required>

            </fieldset>

            <input class="boton boton-verde" type="submit" value="Iniciar sesion">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>