<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
	
	Nota: En Archivo donde no hay que contabilizar los tiempos
*/

/*Se recuperan los argumentos*/
$lugar		= htmlspecialchars($_GET["lugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"]) * 1000;
$velocidad	= htmlspecialchars($_GET["velocidad"]);

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

$batch -> add(
	"INSERT INTO datos_by_lugar (fecha, lugar, hora, placa, velocidad) VALUES(${tiempo}, ${lugar}, ${tiempo}, '${placa}', ${velocidad})"
);
$batch -> add(
	"INSERT INTO infracciones_in_rango (placa, velocidad, fecha, hora, lugar) VALUES('${placa}', ${velocidad}, ${tiempo}, ${tiempo}, ${lugar})"
);
$batchCounter -> add(
	"UPDATE pasos_by_mes SET pasos = pasos + 1 WHERE placa = '${placa}' AND fecha = ${tiempo} AND lugar = ${lugar}"
);
$batch -> add(
	"INSERT INTO infracciones_by_fecha (fecha, velocidad, hora, lugar, placa) VALUES(${tiempo}, ${velocidad}, ${tiempo}, ${lugar}, '${placa}')"
);

if ($velocidad > 80) {
	$batchCounter -> add(
		"UPDATE infracciones_by_placa SET infracciones = infracciones + 1 WHERE placa = '${placa}'"
	);
	$batchCounter -> add(
		"UPDATE infracciones_by_lugar SET infracciones = infracciones + 1 WHERE lugar = ${lugar}"
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