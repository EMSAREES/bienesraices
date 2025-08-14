
<?php

    //incluye un template
    require '../../include/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /');
    }



    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id){
        header('Location: /admin');
    }

    //Base de datos
    require '../../include/config/database.php';

    $db = conectarDB();

    // echo "<pre>";
    // var_dump($_SERVER);
    // echo "</pre>";

    //Obtener los datos de la propiedad
    $consultar = "SELECT * FROM propiedades WHERE id = $id";
    $resultado = mysqli_query($db, $consultar);
    $propiedad = mysqli_fetch_assoc($resultado);

    //consultar para obtener los vendedores
    $consultar = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consultar);

    // Areglos con mensajes de errores
    $errores = [];

    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $wc = $propiedad["wc"];
    $estacionamiento = $propiedad["estacionamiento"];
    $vendedor_id = $propiedad["vendedor_id"];
    $imagenPropiedad = $propiedad["imagen"];

    //Ejecutar el codigo despues de que el usuario envie el formulario
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        // echo "<pre>";
        // var_dump( $_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump( $_FILES);
        // echo "</pre>";


        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $wc = mysqli_real_escape_string($db, $_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
        $vendedor_id = mysqli_real_escape_string($db, $_POST["vendedor"]);
        $creado = date("Y-m-d");

        // Asignar files hacia una variable
        $imagen = $_FILES["imagen"];


        if(!$titulo ){
            $errores[] = "Debes de añadir un titulo";
        }
        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }
        if(strlen($descripcion) < 50 ){ 
            $errores[] = "EL descripcion es obligatoria y debe tener almenos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "EL habitacion es obligatorio";
        }
        if(!$wc){
            $errores[] = "EL nummero de baño es obligatorio";
        }
        if(!$estacionamiento){
            $errores[] = "EL nummero de estacionamiento es obligatorio";
        }
        if(!$vendedor_id){
            $errores[] = "ELige un vendedor";
        }

        //validar por tamaño (1mb maximo)
        $medida = 1000 * 1000;
        if($imagen["size"] > $medida ){
            $errores[] = "La imagen es muy Pesada";
        }


        // echo "<pre>";
        // var_dump( $errores);
        // echo "</pre>";

        //Revisar si el areglo de errroes esta basio
        if(empty($errores)){

            // SUBIDA DE ARCHIVO     
            //Crear carpeta
            $carpetaimagenes = '../../imagenes/';

            if(!is_dir($carpetaimagenes)){
                mkdir($carpetaimagenes);
            }

            $nombreImagen = '';

            if  ($imagen['name']){
                // Eliminar la imagen previa

                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                //subir imagenes
                 move_uploaded_file($imagen['tmp_name'], $carpetaimagenes . $nombreImagen );
            }else
            {
                $nombreImagen = $propiedad['imagen'];
            }


            //insertar en la base de dato
            $query = "UPDATE propiedades SET 
                titulo = '$titulo',
                precio = '$precio',
                descripcion = '$descripcion',
                habitaciones = '$habitaciones',
                wc = '$wc',
                estacionamiento = '$estacionamiento',
                vendedor_id = '$vendedor_id',
                creado = '$creado',
                imagen = '$nombreImagen'
            WHERE id = $id";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                // echo"Insertado correctamente";
                //Redireccionar el usuario

                header( "Location: /admin?resultado=2");
            }

        }
        
    }

    incluirTemplate('header');
?>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <main class="contenedor seccion contenido-centrado">
        <h1>Actualizar</h1>

        <a href="/admin/index.php" class="boton boton-verde"> Volver </a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach ?>

        <form class="formulario" method="POST"  enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">
            
                <label for="precio">Precio</label>
                <input type="text" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small" >

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones"
                    placeholder="Ej: 3"
                    min="1"
                    max="9"
                    value="<?php echo $habitaciones ?>"
                    >

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc"  placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccione--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedor_id == $vendedor["id"] ? "selected" : ""; ?>   value=" <?php echo $vendedor["id"] ?> ">
                            <?php echo $vendedor["nombre"]. " " . $vendedor["apellido"] ?>
                        </option>
                    <?php endwhile; ?>

                    <!-- <?php //foreach($resultado as $result): ?>
                        <option value=" <?php //echo $result["id"] ?> ">
                            <?php //echo $result["nombre"] ?>
                        </option>
                    <?php //endforeach ?> -->
                </select>

            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php
    incluirTemplate('footer');
?>
