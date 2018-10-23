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
	 $placa = htmlspecialchars($_GET["placa"]);

	 $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q5</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q5 para Mongo</H1>
<td><H3>Placa: <?php echo "$placa"; ?></H3></td>
<div>
<table style="width:100%">
<tr>
	<th>Placa</th>
    <th>Cantidad de infracciones</th>
</tr>
<?php
	$time_start = microtime(true); // Tiempo Inicial Proceso

	/* Revisada y funcionando */
	$command = new MongoDB\Driver\Command([
		'aggregate' => 'fotodetecciones',
		'pipeline' => [
			[
				'$match' => [
					'placa' => $placa,
					'velocidad' => [
						'$gt' => 80
					]
				]
			],
			[
				'$group' => [
					'_id' => '$placa', 
					'total' => ['$sum' => 1]
				]
			]
		],
		'cursor' => new stdClass,
	]);

	$cursor = $mongo->executeCommand('practica_bd', $command);

	foreach($cursor as $row) {
		?>
		<tr>
			<td><?php echo $row -> _id; ?></td>
			<td><?php echo $row -> total; ?></td>
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