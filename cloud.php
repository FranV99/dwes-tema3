<!DOCTYPE html>

<?php
require 'lengua.php';


$todosFicheros = scandir('./ficheros');
$ficheros = [];
$imagenes = [];
if ($todosFicheros !== false) {
    foreach ($todosFicheros as $fic) {
        if (pathinfo($fic, PATHINFO_EXTENSION) == 'pdf'){
            $ficheros[] = "$fic";
        }
        
    }
    foreach ($todosFicheros as $img) {
        if (pathinfo($img, PATHINFO_EXTENSION) == 'png' || pathinfo($img, PATHINFO_EXTENSION) == 'gif' || pathinfo($img, PATHINFO_EXTENSION) == 'jpeg') {
            $imagenes[] = "$img";
        }
    }
} 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css"/>
    <title>Cloud</title>
</head>
<body>
<div class="menu_idiomas">
<h1>Softonic©</h1>
    <nav>
        <ul>
            <li><a href="index.php?idioma=<?= $idioma ?>"><?php echo getCadena('home')?></a></li>
            <li><a href="subir.php?idioma=<?= $idioma ?>"><?php echo getCadena('subir')?></a></li>
            <li style="background-color: rgb(27, 125, 189); border-radius: 30px;"><a href="cloud.php?idioma=<?= $idioma ?>"><?php echo getCadena('ficheros')?></a></li>
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
<div class="formulario_cloud">
    
<?php 
echo "<h1>" . getCadena('cloud') . "</h1>";
if ($ficheros == null) {
    echo "<p>No hay ficheros</p>";
} else {
    foreach ($ficheros as $fic) {
        echo "<li> <a href='./ficheros/$fic' target='_blank' class='ficherospdf'>$fic\n</a></li>";
    }
}

echo "<h1>" . getCadena('imgs') . "</h1>";
if ($imagenes == null) {
    echo "<p>No hay imagenes</p>";
} else {
    foreach ($imagenes as $img) {
        
        echo "<img src='./ficheros/$img '>";
    }
}

?>


</div>
</body>
</html>