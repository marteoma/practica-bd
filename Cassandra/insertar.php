<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
	
	Nota: En Archivo donde no hay que contabilizar los tiempos
*/
date_default_timezone_set('America/Bogota');

/*Se recuperan los argumentos*/
$lugar		= htmlspecialchars($_GET["lugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"])*1000;
$velocidad	= htmlspecialchars($_GET["velocidad"]);
$fechaftimestamp = date($tiempo);
$f = date('Y/m',$fechaftimestamp/1000);

//$registros = htmlspecialchars($_GET["registros"]);
//include 'masivo_insertar.php';
//include 'http://localhost:9090/practica-bd/masivo_insertar.php?$registros';
/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
// Seleccionar la base de datos
$session = $cluster->connect("practica_bd");

/* ==--> Se arma el Batch*/

// Insertar con batchStatement
$batchCounter = new Cassandra\BatchStatement(Cassandra::BATCH_COUNTER);
$batch = new Cassandra\BatchStatement(Cassandra::BATCH_UNLOGGED);

if ($velocidad >= 80) {
	$batchCounter -> add(
		"UPDATE infracciones_by_placa SET infracciones = infracciones + 1 WHERE placa = '${placa}'"
	);
	$batchCounter -> add(
		"UPDATE infracciones_by_lugar SET infracciones = infracciones + 1 WHERE lugar = ${lugar}"
	);
	$batch -> add(
		"INSERT INTO infracciones_in_rango (placa, fecha, lugar) VALUES('${placa}', ${tiempo}, ${lugar})"
	);
	$batch -> add(
		"INSERT INTO datos_by_lugar (fecha, lugar,placa, velocidad) VALUES(${tiempo}, ${lugar}, '${placa}', ${velocidad})"
	);
	
	$batchCounter -> add(
		"UPDATE pasos_by_mes SET pasos = pasos + 1 WHERE mes ='${f}' AND placa = '${placa}' AND lugar = ${lugar}"
	);
	$batch -> add(
		"INSERT INTO infracciones_by_fecha (id,fecha, lugar, placa) VALUES(1,${tiempo} , ${lugar}, '${placa}')"
	);
}

$session -> execute($batch);
$session -> execute($batchCounter);
$session -> close();


/* ==--> insertar el o los registros*/
/*
$statement = new Cassandra\SimpleStatement($q);
$session->execute($statement);
$session->close();

/*retornar el texto con resultado*/
echo "OK";
?>