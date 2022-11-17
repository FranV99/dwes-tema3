<!DOCTYPE html>
<?php
//Indicamos que es necesario el fichero idioma para que funcione la página
require 'lengua.php';
//Por defecto, vamos a tener un array con los errores a null, porque por defecto asumimos que no hay errores
$errores = [
    'nombre' => null,
    'fichero' => null
];
//Extensiones de archivos permitidos
$permitido = array('pdf','gif','png','jpeg');

//Si hay post
if ($_POST) {
    //Sanea el texto quitando los espacios en blanco y los caracteres especiales
    $nombre = htmlspecialchars(trim($_POST['nombre_fichero']));
    //Si el nombre no esta vacío
    if (mb_strlen($nombre) > 0) {
        // Si hay un archivo, si se ha seleccionado un archivo, si no da error y hay mas de 0 archivos
            if ($_FILES && isset($_FILES['fichero_usuario']) &&
                $_FILES['fichero_usuario']['error'] === UPLOAD_ERR_OK &&
                $_FILES['fichero_usuario']['size'] > 0) {
                //Se establece la ruta del fichero junto con el nombre dado
                $rutaFicheroDestino = './ficheros/' . $nombre . "." . pathinfo($_FILES['fichero_usuario']['name'], PATHINFO_EXTENSION);
                //Si el archivo tiene la extensión adecuada
                if (in_array(pathinfo($_FILES['fichero_usuario']['name'], PATHINFO_EXTENSION),$permitido) && strpos($nombre,'.') == false) {
                    //Si el nombre no está repetido
                    if (!file_exists($rutaFicheroDestino)) {
                        //Mueve el archivo a la ruta especificada
                        $seHaSubido = move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $rutaFicheroDestino);
                            if (!$seHaSubido) {
                                $errores['fichero'] = 'errfich';
                            } 
                        //Si el nombre está repetido
                        } else {
                            $errores['nombre'] = 'nomrep';
                        }
                //Si el archivo no tiene la extensión adecuada       
                } else {
                    $errores['fichero'] = 'errext';
                }
                
        //Si no hay fichero da error     
            } else {
                $errores['fichero'] = 'errnofich';
            }
        
    //Si el nombre está vacío da error
    } else {
        $errores['nombre'] = 'nonombre';
    }
}
?>
<!--Especificamos el idioma de la página-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Enlazamos la hoja de estilos al documento html-->
    <link rel="stylesheet" href="styles.css"/>
    <title>Subir</title>
</head>
<body>
<div class="menu_idiomas">
    <h1>Softonic©</h1>
    <!--Menu principal-->
    <nav>
        <ul>
            <li><a href="index.php?idioma=<?= $idioma ?>"><?php echo getCadena('home')?></a></li>
            <!--Estilo que cambia el color del apartado del menu en el que estamos-->
            <li style="background-color: rgb(27, 125, 189); border-radius: 30px;"><a href="subir.php?idioma=<?= $idioma ?>"><?php echo getCadena('subir')?></a></li>
            <li><a href="cloud.php?idioma=<?= $idioma ?>"><?php echo getCadena('ficheros')?></a></li>
        </ul>
    </nav>
    <!--Menu del idioma-->
    <form action="#" method="get">
        <p>
            <select name="idioma">
                <option value="es" <?php if ($idioma == 'es') { echo 'selected'; }?>>Español</option>
                <option value="en" <?php if ($idioma == 'en') { echo 'selected'; }?>>English</option>
            </select>
        </p>
        <input type="submit" value="Ok">
    </form>
</div>
<div class="formulario">
<?php
    echo "<h1>" . getCadena('subir') . "</h1>";
    ?>
    <!--Si no hay post, o hay post con errores en el nombre o el fichero-->
    <?php if (!$_POST ||  ($_POST && ($errores['nombre'] != null || $errores['fichero'] != null))) { ?>
    <form action="#" method="POST" enctype="multipart/form-data">
        <p>
            <!--Errores del nombre del fichero-->
            <label for="nombre_fichero"> <?php echo "<b>" . getCadena('nomfich') . "</b>" ?> </label>
            <input type="text" name="nombre_fichero" id="nombre_fichero" value="<?php echo $_POST && isset($_POST['nombre_fichero']) ? $_POST['nombre_fichero'] : '' ?>">
            <?php if($errores['nombre'] == 'nonombre'){
                echo "<p class='error_fichero'>" . getCadena('nonombre') . "</p>";
                } elseif ($errores['nombre'] == 'nomrep') {
                    echo "<p class='error_fichero'>" . getCadena('nomrep') . "</p>";
                }
            ?>
        </p>
        <p>
            <!--Errores del fichero-->
            <label for="fichero_usuario"> <?php echo "<b>" . getCadena('selfich') . "</b>" ?> </label>
            <input type="file" name="fichero_usuario" id="fichero_usuario">
            <?php if($errores['fichero'] == 'errfich'){
                echo "<p class='error_subir_fichero'>" . getCadena('errfich') . "</p>";
                } elseif ($errores['fichero'] == 'errext') {
                    echo "<p class='error_subir_fichero'>" . getCadena('errext') . "</p>";
                } elseif ($errores['fichero'] == 'errnofich') {
                    echo "<p class='error_subir_fichero'>" . getCadena('errnofich') . "</p>";
                }
            ?>

        </p>
        <p>
            <input class="boton_submit" type="submit" value="Enviar fichero">
        </p>
    </form>
    <?php
    } else {
        echo "<p class='fichcorrecto'>". $rutaFicheroDestino . "  " . "<p style='color: green;'>" . getCadena('ficorrect') . "<p>" . "</p>";
        echo "<a href='subir.php?idioma=<?= $idioma ? class='botonsubir'>Subir otro fichero</a>";
    }
    ?>
</div>
</body>
</html>