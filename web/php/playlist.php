<?php
echo '<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar Archivos</title>
    <meta charset="UTF-8">
</head>
<script type="text/javascript">
    var video_player=document.getElementById("video_player"),
    links=video_player.getElementByTagName('a');
    for (var i = 0; i < links.length; i++) {
        links[i].onlclick=handler;
    }

    function handler(e) {
        e.preventDefault();
        videotarget=this.getAttribute("href");
        filename=videotarget.substr(0,videotarget.lastIndexOf('.'))||videotarget;
        video=document.querySelector("#video_player video");
        video.removeAttribute('poster');
        source=document.querySelectorAll("#video_player video source");
        source[0].src=filename + ".mkv";
        video.load();
        video.play():
    }
</script>
<body>
    <figure id="video_player">
        <video controls width="700px">
            <source src="video1.mkv" type="video/mkv">
        </video>
        <figcaption>'
//Creamos Nuestra Función
function lista_archivos($carpeta) { //La función recibira como parametro un carpeta
    $carpeta='/home/recorder/grabaciones/';
    if (is_dir($carpeta)) { //Comprovamos que sea un carpeta Valido
       if ($dir = opendir($carpeta)) {//Abrimos el carpeta
           echo '<ul>';
           while (($archivo = readdir($dir)) !== false) { //Comenzamos a leer archivo por archivo
               if ($archivo != '.' && $archivo != '..') {
                   $nuevaRuta = $carpeta.$archivo.'/';
                   echo '<li>'; //Abrimos un elemento de lista
                   if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un carpeta entonces:
                       echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
                       lista_archivos($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese carpeta.
                   } else { //si no es un carpeta:
//                     echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
                       echo "<li><a href=$archivo>$archivo</a></li>" //simplemente imprimimos el nombre del archivo actual
                   }
                   '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
                }
            }//finaliza
            echo '</ul>';//Se cierra la lista
            closedir($dir);//Se cierra el archivo
        }
    } else {//Finaliza el If de la linea 12, si no es un carpeta valido, muestra el siguiente mensaje
        echo 'No Existe la carpeta';
    }
}//Fin de la Función
//Llamamos a la función
lista_archivos("./ARCHIVOS/");
echo '      </figcaption>
    </figure>
</body>
</html>'
?>