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
$tiempo		= htmlspecialchars($_GET["tiempo"]);
$velocidad	= htmlspecialchars($_GET["velocidad"]);

/*Validación de argumentos*/
/*
echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';
*/

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/
/*
$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
// Seleccionar la base de datos
$session   = $cluster->connect("CAMBIAR_ESTE_NOMBRE");
*/

/* ==--> Se arma el Batch*/
/*
$q = "BEGIN BATCH	
	Insert into ……. Values( 1,4,'Sensor CUATRO',2,'Medida BB',57);
	Insert into ……. Values( 1,4,'Sensor CUATRO',2,'Medida BB',57);	
      APPLY BATCH;"; 
*/

/* ==--> insertar el o los registros*/
/*
$statement = new Cassandra\SimpleStatement($q);
$session->execute($statement);
$session->close();
/*retornar el texto con resultado*/
echo "OK";
?>