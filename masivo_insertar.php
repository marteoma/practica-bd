<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
*/


	$URL_HOME = 'http://localhost:9090/practica-bd/';

	/*Se recuperan los argumentos*/
	$bd = htmlspecialchars($_GET["bd"]);
	$registros = htmlspecialchars($_GET["registros"]);


	if( $registros < 1 or $registros > 9999999 ){
		echo "Error en el número de registros a generar. Valor=".$registros;
		exit(0);
	}

	/*Lista de Placas*/
	$listaPlacas = array(	
					"AAA111", "BBB111", "CCC111",
					"AAA222", "BBB222", "CCC222",
					"AAA333", "BBB333", "CCC333",
					"AAA444", "BBB444", "CCC444",
					"AAA555", "BBB555", "CCC555");
	$nroPlacas = count( $listaPlacas )-1;				
	/*Tiempo de Inicio*/
	$tiempo = time() - ($registros/2);

/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Generación registros - NoSQL</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<H1 class="blue">Insertar Masivo para <?=$bd;?>(registros:<?=$registros;?>)</H1>
<div>
<table style="width:100%">
<tr>
	<th>#</th>
    <th>URL</th>
    <th>Resultado</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

	/*Ciclo*/
	$i = 0;
	while ($i < $registros) {	
		/*Genera los valores de forma aleatoria*/
		$lugar = rand ( 0 , 9 );
		$placa = $listaPlacas[ rand ( 0 , $nroPlacas ) ];
		$tiempo = $tiempo + rand ( 0 , 1 );
		$velocidad = rand ( 30 , 90 );
		/*Arma la cadena del llamado*/
		$url = 		$URL_HOME .
					$bd . '/insertar.php'.
					'?lugar='. $lugar .
					'&placa='. $placa .
					'&tiempo='. $tiempo .
					'&velocidad='. $velocidad;
		if ($velocidad >= 80) {
			/*Se hace el llamado*/			
			$contents = file_get_contents( $url );
			/*Se imprime la fila de la tabla*/
			echo "<tr><td>$i</td><td>".$url . "</td><td>" . $contents . "</td></tr>\n";
			$i++;
		}
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
