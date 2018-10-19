<?php
/*
	Creado por Juan Jose y Mateo
	Version 1.0 - 2018/10/06
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del pache*/
	$URL_HOME = 'http://localhost/practica-bd/';

	/*Se recuperan los argumentos*/
	 $placa = htmlspecialchars($_GET["placa"]);
	 $fedesde = htmlspecialchars($_GET["fedesde"]);
	 $fehasta = htmlspecialchars($_GET["fehasta"]);
	 $fdesde = strtotime($fedesde)*1000;
	 $fhasta = strtotime($fehasta)*1000;
	 $cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
	 $session   = $cluster->connect("practica_bd");
	 

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q1</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q1 para Cassandra</H1>
<td><H3>Placa: <?php echo "$placa"; ?></H3></td><td><H3>Fecha desde: <?php echo "$fedesde"; ?></H3></td><td><H3>Fecha hasta: <?php echo "$fehasta"; ?></H3></td>
<div>
<table style="width:100%">
	
    <th>Fecha</th>
    <th>Hora</th>
    <th>Lugar</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso



$rows = "SELECT fecha, lugar 
		 FROM infracciones_in_rango 
		 where    placa = '${placa}' and fecha >= '${fdesde}' and fecha <= '${fhasta}'and velocidad >= 80
		 ALLOW FILTERING;";

$statement = new Cassandra\SimpleStatement($rows);
$result    = $session->execute($statement);

/*Ciclo*/

	foreach($result as $row){
		$fecha = $row['fecha'];
		$fechaftimestamp = date($fecha);
		$f = date('Y/m/d',$fechaftimestamp/1000);
		$h = date('H:i:s',$fechaftimestamp/1000);
		
		?>
		 <tr>
		 	<td><?php echo $f; ?></td>
		 	<td><?php echo $h;?></td>
			<td><?php echo $row['lugar'];?></td>
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
