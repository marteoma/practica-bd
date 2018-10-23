<?php
/*
	Creado por Juan Jose y Mateo
	Version 1.0 - 2018/10/06
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del pache*/
	$URL_HOME = 'http://localhost/practica-bd/';
	date_default_timezone_set('America/Bogota');

	/*Se recuperan los argumentos*/
	$fecha = htmlspecialchars($_GET["fecha"]);

	$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");


/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q4</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q4 para Mongo</H1>
<td><H3>Fecha: <?php echo "$fecha"; ?></H3></td>
<div>
<table style="width:100%">
<tr>
	<th>Hora</th>
	<th>Lugar</th>
	<th>Placa</th>
</tr>
<?php
	$time_start = microtime(true); // Tiempo Inicial Proceso
	
	/* Revisado y funcionando */
	$query = new MongoDB\Driver\Query([
		'fecha' => [
			'$gte' => strtotime($fecha),
			'$lt' => (strtotime($fecha)+86400),
		],
		'velocidad' => [
			'$gt' => 80
		]
	]);

	$rows = $mongo -> executeQuery('practica_bd.fotodetecciones', $query);

	foreach($rows as $row) {
		?>
		<tr>						
			<td><?php echo date('H:i:s', $row -> fecha); ?></td>
			<td><?php echo $row -> lugar; ?></td>
			<td><?php echo $row -> placa ?></td>
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