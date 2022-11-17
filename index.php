<!DOCTYPE html>

<?php
require 'lengua.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css"/>
    <title>Index</title>
</head>
<body>
<div class="menu_idiomas">
<h1>Softonic©</h1>
    <nav>
        <ul>
            <li style="background-color: rgb(27, 125, 189); border-radius: 30px;"><a href="index.php?idioma=<?= $idioma ?>"><?php echo getCadena('home')?></a></li>
            <li><a href="subir.php?idioma=<?= $idioma ?>"><?php echo getCadena('subir')?></a></li>
            <li><a href="cloud.php?idioma=<?= $idioma ?>"><?php echo getCadena('ficheros')?></a></li>
        </ul>
    </nav>
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
    echo "<h1>" . getCadena('index') . "</h1>";
    echo "<p>" . getCadena('adminfich') . "</p>";
    ?>
    <a href="subir.php?idioma=<?= $idioma ?>"><?php echo  getCadena('subirfich') ?></a>
</div>
</body>
</html>