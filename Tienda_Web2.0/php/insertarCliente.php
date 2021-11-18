<?php
$servername = "localhost";
$username = "php";
$password = "1234";
$database = "pruebas";

$DNI = $_POST['DNI'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];


// Create connection
$mysqli_link = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$mysqli_link) {
        die("Connection failed: " . mysqli_connect_error());
} else {
        echo "Connected successfully<br>";
}

$insert_query = "INSERT INTO clientes(DNI, nombre, apellidos, email, fecha_nacimiento) VALUES ('$DNI', '$nombre', '$apellidos', '$email', '$fecha_nacimiento');";

// run the insert query
If ($mysqli_link->query($insert_query) === TRUE) {
    echo 'Record inserted successfully.';
} else {
  echo "Connection failed: " .$insert_query. "<br>" . $mysqli_link->error;
}

// close the db connection
mysqli_close($mysqli_link);
?>