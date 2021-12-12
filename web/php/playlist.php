<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar Archivos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
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
        <figcaption>
            <ul>
                <?php
                $directorio = "/home/recorder/grabaciones";
                //carpeta con archivos
                $contador = 0;

                $archivos = glob("$directorio/*");
                //introducir el código aquí

                foreach ($archivos as $archivo) {   
                     echo '<li><a href=/home/recorder/grabaciones/$archivo>$archivo</a></li>' ;
                    }
                ?>                
            </ul>
        </figcaption>
    </figure>
</body>
</html>