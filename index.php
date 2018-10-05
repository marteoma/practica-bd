<?PHP
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home Practica - SQL VS NoSQL</title>
<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<div>
<H1>Seleccione la base de datos</H1><br />
	<a href="Cassandra/index.php" class="button orange">Cassandra</a> 
	<a href="Mongo/index.php" class="button gray">MongoDB</a> 
	<a href="MySQL/index.php" class="button rosy">MySQL o MariaDB</a> 
	<br /><br />
</div>
<div>
<H1>Inserci&oacute;n Masiva de datos</H1><br />
	<form action="masivo_insertar.php">
		<fieldset id="bd">
			<input type="radio" name="bd" value="Cassandra" checked > Cassandra </input>
			<input type="radio" name="bd" value="MongoDB"> MongoDB</input>
			<input type="radio" name="bd" value="MySQL"> MySQL o MariaDB</input>
		</fieldset> 
		Cantidad de registros:<br />
		<input type="text" name="registros" value="100"  maxlength="7">
		
		<button class="button blue">Generar</button>
	</form>
</div>
</body>
</html>