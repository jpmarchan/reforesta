<?php

$fecha="2020-04-02";
$date = new DateTime($fecha);
print_r($date);
print_r($date->getTimestamp());



$usuario = "user_desarrollo";
$contrasena = "drucadomin10";  
$servidor = "localhost";
$basededatos = "desarrollo";

$conexion = mysqli_connect( "localhost","bruno",'Ohv7plb5B<zq',"bruno_reforesta_desarrollo" ) or die ("No se ha podido conectar al servidor");

$link = mysqli_connect("localhost","bruno",'Ohv7plb5B<zq',"bruno_reforesta_desarrollo"); 
if (!$link) { 
    die('Could not connect to MySQL: ' . mysqli_error($link));
} 

$consulta = "SELECT * FROM arboles";


$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

echo "<table borde='2'>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Edad</th>";
echo "</tr>";

while ($columna = mysqli_fetch_array( $resultado ))
{
	echo "<tr>";
	echo "<td>" . $columna['campania'] . "</td><td>" . $columna['codigo'] . "</td>";
	echo "</tr>";
}

echo "</table>";

mysqli_close( $conexion );

?>
