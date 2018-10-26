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
	$año = htmlspecialchars($_GET["anio"]);
	$mes = htmlspecialchars($_GET["mes"]);
	$placa = htmlspecialchars($_GET["placa"]);

	$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q2</title>
	<link rel="stylesheet" type="text/css" href="../home.css">
</head>
<body>
<H1 class="blue">Consulta Q2 para Mongo</H1>
<td><td><H3>Año: <?php echo "$año"; ?></H3></td><td><H3>Mes: <?php echo "$mes"; ?><H3>Placa: <?php echo "$placa"; ?></H3></td></H3></td>
<div>
<table style="width:100%">
<tr>
  <th>Lugar</th>
  <th>Numero de pasadas</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

	/* Revisada y funcionando */
	$nextm = $mes + 1;

	$command = new MongoDB\Driver\Command([
		'aggregate' => 'fotodetecciones',
		'pipeline' => [
			[
				'$match' => [
					'placa' => $placa, 
					'fecha' => [
						'$gte' => strtotime("{$año}/${mes}/01"),
						'$lt' => strtotime("{$año}/${nextm}/01"),
					]
				]
			],
			[
				'$group' => [
					'_id' => '$lugar',
					'pasos' => ['$sum' => 1]
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
			<td><?php echo $row -> pasos; ?></td>
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