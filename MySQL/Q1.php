<?php
/*
	Creado por Juan Jose y Mateo
	Version 1.0 - 2018/10/06
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del apache*/
	$URL_HOME = 'http://localhost/practica-bd/';
	date_default_timezone_set('America/Bogota');

	/*Se recuperan los argumentos*/
	$placa = htmlspecialchars($_GET["placa"]);
	$fedesde = htmlspecialchars($_GET["fedesde"]);
	$fehasta = htmlspecialchars($_GET["fehasta"]);

	$conn = new mysqli('localhost:3306', 'root', '', 'practica-bd');

	if ($conn->connect_error) {
    exit("Fallo al conectar a MySQL: " . $conn->connect_error);
	} 

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q1</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q1 para MySQL</H1>
<td><H3>Placa: <?php echo "$placa"; ?></H3></td><td><H3>Fecha desde: <?php echo "$fedesde"; ?></H3></td><td><H3>Fecha hasta: <?php echo "$fehasta"; ?></H3></td>
<div>
<table style="width:100%">
<tr>
	<th>Fecha</th>
	<th>hora</th>
	<th>Lugar</th>
</tr>
<?php
	$time_start = microtime(true); // Tiempo Inicial Proceso

	$rows = $conn -> query("SELECT DATE_FORMAT(fecha, '%y/%m/%d') fecha, DATE_FORMAT(fecha, '%H:%i:%s') hora, lugares_lugar FROM fotodetecciones
													WHERE fecha > '${fedesde}' AND fecha < '${fehasta}' AND velocidad > 80
													AND vehiculos_placa = '${placa}'");

	foreach ($rows as $row) {	
		?>
		<tr>
			<td><?php echo $row["fecha"]; ?></td>
			<td><?php echo $row["hora"]; ?></td>
			<td><?php echo $row["lugares_lugar"]; ?></td>
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
$conn -> close();
?>
</body>
</html>
