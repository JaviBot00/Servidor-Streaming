<?php
$servername = "localhost";
$username = "php";
$password = "1234";
$database = "pruebas";




$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die("Ha habido un fallo " . $conn->connect_error);
}

$op=$_GET["tipo"];
$busqueda=$_GET["busqueda"];
$sql="SELECT * from clientes WHERE";

if ($_GET["tipo"]=="DNI")
{

	$sql = $sql." DNI like '%$busqueda%'";


} elseif ($_GET["tipo"]=="nom") {
	$sql = $sql." nombre like '%$busqueda%'";

} elseif ($_GET["tipo"]=="apell") {
	$sql = $sql." apellidos like '%$busqueda%'";

} elseif ($_GET["tipo"]=="email") {
	$sql = $sql." email like '%$busqueda%'";
	
} elseif ($_GET["tipo"]=="fecha") {
	$sql = $sql." fecha_nacimiento like '%$busqueda%'";
 }



$result = $conn->query($sql);


if($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){
		echo "  <br> DNI: " . $row["DNI"] . " <br> Nombre : " . $row["nombre"] . " <br> Apellido: " . $row["apellidos"] . " <br> Email : " . $row["email"] . "<br> Fecha : " . $row["fecha_nacimiento"];

	}
}

else {
	echo "Hay 0 resultados";
}

$conn->close();
?>
