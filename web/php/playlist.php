<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar Archivos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Bienvenido a JaviBot's Gameplays</h1>
    <h2>Elija un video para descargar1</h2>
    <ul>
        <?php
            $directorio = "../grabaciones";
            $contador = 0;
            $archivos = glob("$directorio/*");

            foreach ($archivos as $archivo) {
                echo "<li><a href=$archivo>$archivo</a></li>" ;
            }
        ?>
    </ul>
    <h2>Elija un video para descargar2</h2>
    <ul>
<?php
$carpeta="/var/www/html/grabaciones"
function lista_archivos($carpeta){ 
if (is_dir($carpeta)) { 
if ($dir = opendir($carpeta)) {
echo '<ul>';
 while (($archivo = readdir($dir)) !== false){ 
if ($archivo != '.' && $archivo != '..'){ 
$nuevaRuta = $carpeta.$archivo.'/';
echo '<li>';
if (is_dir($nuevaRuta)) { 
echo '<b>'.$nuevaRuta.'</b>';
lista_archivos($nuevaRuta);
} else { 
echo 'Archivo: '.$archivo; 
}
 '</li>';
}
}
echo '</ul>';
closedir($dir);
}
}else{
echo 'No Existe la carpeta';
}               
}  

lista_archivos("./ARCHIVOS/");
?>
    </ul>
</body>
</html>