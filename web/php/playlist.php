<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar Archivos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <figure id="video_player">
        <video id="videoarea" controls="controls" poster="" src=""></video>
        <figcaption>
            <ul id="playlist">
                <?php
                $directorio = "../grabaciones";
                //carpeta con archivos
                $contador = 0;

                $archivos = glob("$directorio/*");
                //introducir el código aquí

                foreach ($archivos as $archivo) {
                     echo "<li movieurl=$archivo>$archivo</li>" ;
                    }
                ?>
            </ul>
        </figcaption>
    </figure>
</body>
</html>

<script type="text/javascript">
$(function() {
    $("#playlist li").on("click", function() {
        $("#videoarea").attr({
            "src": $(this).attr("movieurl"),
            "poster": "",
            "autoplay": "autoplay"
        })
    })
    $("#videoarea").attr({
        "src": $("#playlist li").eq(0).attr("movieurl"),
        "poster": $("#playlist li").eq(0).attr("moviesposter")
    })
})
</script>