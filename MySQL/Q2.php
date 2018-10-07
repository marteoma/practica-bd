<?php
/*
	Creado por Juan Jose y Mateo
	Version 1.0 - 2018/10/06
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del pache*/
	$URL_HOME = 'http://localhost/practica-bd/';

	/*Se recuperan los argumentos*/
	 $año = htmlspecialchars($_GET["anio"]);
	 $mes = htmlspecialchars($_GET["mes"]);
	 $placa = htmlspecialchars($_GET["placa"]);


/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consulta Q2</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
<H1 class="blue">Consulta Q2 para MySQL</H1>
<td><td><H3>Año: <?php echo "$año"; ?></H3></td><td><H3>Mes: <?php echo "$mes"; ?><H3>Placa: <?php echo "$placa"; ?></H3></td></H3></td>
<div>
<table style="width:100%">
<tr>
	<th>#</th>
    <th>Lugar</th>
    <th>Numero de pasadas</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

	/*Ciclo*/
	for( $i= 1 ; $i <= 5 ; $i++ ) {	
		/*Genera los valores de forma aleatoria*/
		$lugar = rand ( 0 , 9 );
		$pasadas = rand ( 0 , 150 );
		/*Se imprime la fila de la tabla*/
		?>
		 <tr>
		 	<td><?php echo "$i"; ?></td>
		 	<td><?php echo "$lugar"; ?></td>
		 	<td><?php echo "$pasadas"; ?></td>
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