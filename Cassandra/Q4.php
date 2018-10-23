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
	 $feconsulta  = strtotime($fecha)*1000;
	 $f = strtotime($fecha)+ 24*60*60;
	 $felimite = $f *1000;
	 $cluster   = Cassandra::cluster()
	 			->withContactPoints('127.0.0.1')
		 		->build();
	 $session   = $cluster->connect("practica_bd");	


/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q4</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q4 para Cassandra</H1>
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
$rows = "SELECT fecha,lugar, placa 
		 FROM infracciones_by_fecha
		 where  fecha > '${feconsulta}' and fecha < '${felimite}'
		 ALLOW FILTERING;";
$statement = new Cassandra\SimpleStatement($rows);
$result    = $session->execute($statement);
	/*Ciclo*/
	foreach($result as $row) {	
		/*Se imprime la fila de la tabla*/
		$fecha = $row['fecha'];
		$fechaftimestamp = date($fecha);
		$h = date('H:i:s',$fechaftimestamp/1000);
		?>
		 <tr>
		 	<td><?php echo $h; ?></td>
		 	<td><?php echo $row['lugar']; ?></td>
		 	<td><?php echo $row['placa'];?></td>
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