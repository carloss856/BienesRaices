<?php 

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="src/img/destacada3.webp" type="image/webp">
            <source srcset="src/img/destacada3.jpg" type="image/jpeg">
            <img src="src/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" placeholder="Ingresa tu nombre">

                
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu email">

                
                <label for="telefono">Telefono: </label>
                <input type="tel" name="telefono" id="telefono" placeholder="Ingresa tu telefono">


                <label for="mensaje">Mensaje: </label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o Compra: </label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-- Selecciones --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto: </label>
                <input type="number" name="presupuesto" id="presupuesto" placeholder="Ingresa tu precio o presupuesto">
            </fieldset>

            
            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" name="contacto" id="contactar-telefono">

                    <label for="contactar-whatsapp">Whatsapp</label>
                    <input type="radio" name="contacto" id="contactar-whatsapp">

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" name="contacto" id="contactar-email">
                </div>

                <p>Si eligio telefono, elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha: </label>
                <input type="date" name="fecha" id="fecha">

                <label for="hora">Hora: </label>
                <input type="time" name="hora" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input class="boton-verde" type="submit" value="Enviar">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>