    <?php

         //incluye un template
        require '../include/funciones.php';
        $auth = estaAutenticado();

        if(!$auth){
            header('Location: /');
        }

        // importarconexion
        require '../include/config/database.php';
        $db = conectarDB();

        // Escribir el Query
        $query = "SELECT * FROM propiedades";

        // Consulta la BD
        $resultadoConsulta = mysqli_query($db, $query);

        //muestra mensaje condicional
        // var_dump($_GET);
        $resultado = $_GET["resultado"] ?? null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                // Eliminar el archivo
                $query = "SELECT imagen FROM propiedades WHERE id = $id";
                $resultado = mysqli_query($db, $query);
                $propiedad = mysqli_fetch_assoc($resultado);

                unlink('../imagenes/' . $propiedad['imagen']);

                 // Eliminar la propiedad
                $query = "DELETE FROM propiedades WHERE id = $id";

                $resultado = mysqli_query($db, $query);

                if($resultado) {
                    header('location: /admin?resultado=3');
                }
            }
        }

        //incluye un template
        incluirTemplate('header');
    ?>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <main class="contenedor seccion contenido-centrado">

        <h1>Administrador de BienesRaices</h1>

        <?php  if( intval($resultado) === 1): ?>
            <P class="alerta success"> Anuncio creado correctamente</P>
        <?php elseif(intval($resultado) === 2):?>
            <P class="alerta success-actualizado"> Anuncio Actualizado correctamente</P>
        <?php elseif(intval($resultado) === 3):?>
            <P class="alerta success-delecte"> Anuncio Eliminado correctamente</P>
        <?php endif; ?>

    

        <a href="/admin/propiedades/crear.php" Class="boton boton-verde"> Nueva Propiedad </a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!----. Mostrar los Resultados---->
                <?php while( $propieda = mysqli_fetch_assoc($resultadoConsulta) ) : ?>
                <tr>
                    <td><?php echo $propieda["id"] ?></td>
                    <td><?php echo $propieda["titulo"] ?></td>
                    <td> <img src="../imagenes/<?php echo $propieda["imagen"] ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propieda["precio"] ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propieda['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
            
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propieda["id"] ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <?php
        //Cerrar la Conexion
        mysqli_close($db);

        incluirTemplate('footer');
    ?>
    