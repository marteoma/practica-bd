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
	 $lugar = htmlspecialchars($_GET["lugar"]);
	 $cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
	 $session   = $cluster->connect("practica_bd");	


/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q6</title>
	<link rel="stylesheet" type="text/css" href="../home.css">
</head>
<body>
<H1 class="blue">Consulta Q6 para Cassandra</H1>
<td><H3>Lugar: <?php echo "$lugar"; ?></H3></td>
<div>
<table style="width:100%">
<tr>

	<th>Lugar</th>
    <th>Cantidad de infracciones</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$rows = "SELECT lugar, infracciones 
		 FROM infracciones_by_lugar 
		 where    lugar = ${lugar};";

$statement = new Cassandra\SimpleStatement($rows);
$result    = $session->execute($statement);
	/*Ciclo*/
	foreach($result as $row) {	
		/*Se imprime la fila de la tabla*/
		?>
		 <tr>
		 	
		 	<td><?php echo $row['lugar']; ?></td>
		 	<td><?php echo $row['infracciones']; ?></td>
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
