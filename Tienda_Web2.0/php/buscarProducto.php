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
$sql="SELECT * from productos WHERE";

if ($_GET["tipo"]=="cod")
{

	$sql = $sql." cod like '%$busqueda%'";


} elseif ($_GET["tipo"]=="desc") {
	$sql = $sql." descripcion like '%$busqueda%'";


} elseif ($_GET["tipo"]=="desc") {
	$sql = $sql." precio like '%$busqueda%'";


} elseif ($_GET["tipo"]=="stock") {
	$sql = $sql." stock like '%$busqueda%'";

 }



$result = $conn->query($sql);


if($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){
		echo " <br> Codigo Producto : " . $row["cod"] . " <br> Descripcion: " . $row["descripcion"] . " <br> Precio: " . $row["precio"] . "<br> Stock : " . $row["stock"];

	}
}

else {
	echo "Hay 0 resultados";
}

$conn->close();
?>
