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
	<title>Home Practica - Cassandra</title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>

<body> 
<H1 class="mi_color">Cassandra</H1>
<!-- Formularios para la vista del usuario -->
<div>
<table>
<tr><th colspan="3"><H1>Usuario</H1></th></tr>
<tr>
	<td><H3>Consulta Infracciones</H3></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><H3>Estadistica Mensual</H3></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><H3>Cantidad Infracciones Por Placa</H3></td>
</tr>
<tr>
	<td>
		<!-- Consulta Infracciones -->
		<form name="q1" action="Q1.php">
		<table>
		  <tr><td>Placa:</td><td><input type="text" name="placa" value="AAA111"  maxlength="6"></td></tr>
		  <tr><td>Fecha desde:</td><td><input type="text" name="fedesde" value="2018/10/01"  maxlength="10"></td></tr>
		  <tr><td>Fecha hasta:</td><td><input type="text" name="fehasta" value="2018/11/01"  maxlength="10"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Consulta Infracciones</button></td></tr>
		</table>  
		</form>
	</td>
	<td></td>
	<td>
		<!-- Estadistica Mensual -->
		<form name="q2" action="Q2.php">
		<table>
		  <tr><td>Año:</td><td><input type="text" name="anio" value="2018"  maxlength="4"></td></tr>
		  <tr><td>Mes:</td><td><input type="text" name="mes" value="10"  maxlength="2"></td></tr>
		  <tr><td>Placa:</td><td><input type="text" name="placa" value="AAA111"  maxlength="6"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Estadistica Mensual</button></td></tr>
		</table>  
		</form>
	</td>
	<td></td>
	<td>
		<!-- Cantidad Infracciones -->
		<form name="q5" action="">
		<table>
		  <tr><td>Placa:</td><td><input type="text" name="placa" value="AAA111"  maxlength="6"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Cantidad Infracciones</button></td></tr>
		</table>  
		</form>
	</td>
</tr>
</table>
</div>
</br>
<!-- Formularios para la vista del transito -->
<div>
<table>
<tr><th colspan="3"><H1>Agente del transito</H1></th></tr>
<tr>
	<td><H3>Consulta Velocidades Por Sitio</H3></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><H3>Infracciones Velocidad</H3></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><H3>Cantidad Infracciones Por Zona</H3></td><td>
</tr>
<tr>
	<td>
		<!-- Consulta velocidades por sitio - Recuerde cambiar la acción para llamar su programa -->
		<form name="q3" action="Q3.php">
		<table>
		  <tr><td>Fecha:</td><td><input type="text" name="fecha" value="2018/10/01"  maxlength="10"></td></tr>
		  <tr><td>Lugar:</td><td><input type="text" name="lugar" value="1"  maxlength="1"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Consulta Velocidades Por Sitio</button></td></tr>
		</table>  
		</form>
	</td>
	<td></td>
	<td>
		<!-- Infracciones Velocidad - Recuerde cambiar la acción para llamar su programa -->
		<form name="q4" action="Q4.php">
		<table>
		  <tr><td>Fecha:</td><td><input type="text" name="fecha" value="2018/10/01"  maxlength="10"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Infracciones Velocidad</button></td></tr>
		</table>  
		</form>
	</td>
	<td></td>
	<td>
		<!-- Cantidad Infracciones Por Zona-->
		<form name="q6" action="">
		<table>
		   <tr><td>Lugar:</td><td><input type="text" name="lugar" value="1"  maxlength="1"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Cantidad Infracciones Por Zona</button></td></tr>
		</table>  
		</form>
	</td>
</tr>
</table>
</div>

</body>
</html>