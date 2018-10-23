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
	 $cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
	 $session   = $cluster->connect("practica_bd");	
	 $mess = $mes + 1;
	 $fecha = $año.'-'.$mes;
	 $fechalim = $año.'-'.$mess;
	 $timestamp = strtotime($fecha)*1000;
	 $timestampf = strtotime($fechalim)*1000;
	
	 
/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q2</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q2 para Cassandra</H1>
<td><td><H3>Año: <?php echo "$año"; ?></H3></td><td><H3>Mes: <?php echo "$mes"; ?><H3>Placa: <?php echo "$placa"; ?></H3></td></H3></td>
<div>
<table style="width:100%">
<tr>
	
    <th>Lugar</th>
    <th>Numero de pasadas</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$rows = "SELECT lugar, pasos 
		 FROM pasos_by_mes 
		 where    placa = '${placa}' and fecha > '${timestamp}' and fecha < '${timestampf}'
		 ALLOW FILTERING;";

$statement = new Cassandra\SimpleStatement($rows);
$result    = $session->execute($statement);
	/*Ciclo*/
	foreach($result as $row){		
		?>
		 <tr>
		
			<td><?php echo $row['lugar'];?></td>
			<td><?php echo $row['pasos'];?></td>
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