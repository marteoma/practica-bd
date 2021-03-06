<?php
/*
	Creado por Juan Jose , Mateo y mcMEJIA 
	Version 1.0 - 2018/10/06
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del apache*/
	$URL_HOME = 'http://localhost:9090/practica-bd/';
	date_default_timezone_set('America/Bogota');

	/*Se recuperan los argumentos*/
	$año = htmlspecialchars($_GET["anio"]);
	$mes = htmlspecialchars($_GET["mes"]);
	$placa = htmlspecialchars($_GET["placa"]);

	$conn = new mysqli('localhost:3306', 'root', '', 'practica-bd');

	if ($conn->connect_error) {
		exit("Fallo al conectar a MySQL: " . $conn->connect_error);
	} 

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q2</title>
	<link rel="stylesheet" type="text/css" href="../home.css">
</head>
<body>
<H1 class="blue">Consulta Q2 para MySQL</H1>
<td><td><H3>Año: <?php echo "$año"; ?></H3></td><td><H3>Mes: <?php echo "$mes"; ?><H3>Placa: <?php echo "$placa"; ?></H3></td></H3></td>
<div>
<table style="width:100%">
<tr>
    <th>Lugar</th>
    <th>Numero de pasadas</th>
</tr>
<?php
	$time_start = microtime(true); // Tiempo Inicial Proceso
	$nmes = $mes + 1;
	$query = "SELECT lugares_lugar, COUNT(*) pasadas 
	FROM fotodetecciones
	WHERE fecha >= '${año}/${mes}/01' AND fecha < '${año}/${nmes}/01'
		AND vehiculos_placa = '${placa}'
	GROUP BY lugares_lugar";
	$rows = $conn -> query($query);
	
	foreach ($rows as $row) {	
	?>
		<tr>
		<td><?php echo $row["lugares_lugar"]; ?></td>
		<td><?php echo $row["pasadas"]; ?></td>
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