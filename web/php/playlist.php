<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar Archivos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <figure id="video_player">
        <video controls width="700px">
            <source src="/home/recorder/grabaciones/javibot00-20211208-020655.avi" type="video/avi">
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
                     echo "<li><a href=$archivo>$archivo</a></li>" ;
                    }
                ?>
            </ul>
        </figcaption>
    </figure>
</body>
</html>

<script type="text/javascript">
    var video_player=document.getElementById("video_player"),
    links=video_player.getElementByTagName('a');
    for (var i=0; i<links.length; i++) {
        links[i].onlclick=handler;
    }

    function handler(e) {
        e.preventDefault();
        videotarget=this.getAttribute("href");
        filename=videotarget.substr(0,videotarget.lastIndexOf('.'))||videotarget;
        video=document.querySelector("#video_player video");
        video.removeAttribute('poster');
        source=document.querySelectorAll("#video_player video source");
        source.src=filename + ".avi";
        video.load();
        video.play():
    }
</script>