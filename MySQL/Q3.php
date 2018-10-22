<?php
/*
	Creado por Juan Jose y Mateo
	Version 1.0 - 2018/10/06
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del pache*/
	$URL_HOME = 'http://localhost:9090/practica-bd/';

	/*Se recuperan los argumentos*/
	$fecha = htmlspecialchars($_GET["fecha"]);
	$lugar = htmlspecialchars($_GET["lugar"]);
	$conn = new mysqli('localhost:3306', 'root', '', 'practica-bd');

	if ($conn->connect_error) {
		exit("Fallo al conectar a MySQL: " . $conn->connect_error);
	} 

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q3</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q3 para MySQL</H1>
<td><H3>Fecha: <?php echo "$fecha"; ?></H3></td><td><H3>Lugar: <?php echo "$lugar"; ?></H3></td>
<div>
<table style="width:100%">
<tr>
	<th>Hora</th>
	<th>Placa</th>
	<th>Velocidad</th>
</tr>
<?php
	$time_start = microtime(true); // Tiempo Inicial Proceso

	$rows = $conn -> query("SELECT TIME(fecha) hora, vehiculos_placa placa, velocidad
		FROM fotodetecciones
		WHERE DATE(fecha) > ${fecha} AND DATE(fecha) < '${fecha}'+ INTERVAL 1 DAY AND lugares_lugar = ${lugar}");

	echo $conn -> error;	
	
	foreach ($rows as $row) {	
	?>
		<tr>
		<td><?php echo $row["hora"]; ?></td>
		<td><?php echo $row["placa"]; ?></td>
		<td><?php echo $row["velocidad"]; ?></td>
		</tr>
	<?php
	}
	
?>
</table>
</div>
<?php
$time_end = microtime(true); // Tiempo Final
$time = $time_end - $time_start; // Tiempo Consumido
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>
