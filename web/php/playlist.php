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
        function lista_archivos($carpeta) {
                if (is_dir($carpeta)) {
                        if ($dir = opendir($carpeta)) {
                                while (($archivo = readdir($dir)) !== false) {
                                        if ($archivo != '.' && $archivo != '..') {
                                                $nuevaRuta = $carpeta.$archivo.'/';
                                                echo '<li>';
                                                if (is_dir($nuevaRuta)) {
                                                        echo '<b>'.$nuevaRuta.'</b>';
                                                        lista_archivos($nuevaRuta);
                                                } else {
                                                        echo "<li><a href=$carpeta/$archivo>$archivo</a></li>";
                                                }
                                                 '</li>';
                                        }
                                }
                                closedir($dir);
                        }
                }else{
                        echo 'No Existe la carpeta';
                }
        }

        lista_archivos("../grabaciones");
        ?>
    </ul>
</body>
</html>