CREATE KEYSPACE practica_bd WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};
USE practica_bd;

// Q1:
CREATE TABLE infracciones_in_rango (placa TEXT, velocidad INT, fecha TIMESTAMP, lugar INT, PRIMARY KEY ((placa),fecha)) WITH CLUSTERING ORDER BY (fecha ASC);

/* SELECT fecha, lugar FROM infracciones_in_rango WHERE placa=? and velocidad=? and fecha>?; */

// Q2:
CREATE TABLE pasos_by_mes (mes TEXT, placa TEXT, lugar INT, pasos COUNTER, PRIMARY KEY ((mes,placa),lugar)) WITH CLUSTERING ORDER BY (lugar ASC);

/* SELECT lugares_lugar, lugares_lugar FROM pasos_by_mes WHERE fecha=? and placa=? ORDER BY lugares_lugar ASC; */

// Q3:
CREATE TABLE datos_by_lugar (fecha TIMESTAMP, lugar INT, placa TEXT, velocidad INT, PRIMARY KEY ((lugar),fecha)) WITH CLUSTERING ORDER BY (fecha ASC);


/* SELECT fecha, placa, velocidad FROM datos_by_lugar WHERE fecha=? and lugar=?; */

// Q4:
CREATE TABLE infracciones_by_fecha (id INT,fecha TIMESTAMP, velocidad INT, lugar INT, placa TEXT, PRIMARY KEY ((id),fecha)) WITH CLUSTERING ORDER BY (fecha ASC);

/* SELECT lugar, placa FROM infracciones_by_fecha WHERE fecha=? and velocidad>?; */

// Q5:
CREATE TABLE infracciones_by_placa (placa TEXT, infracciones COUNTER, PRIMARY KEY (placa));

/* SELECT vehiculos_placa, vehiculos_placa FROM infracciones_by_placa WHERE vehiculos_placa=?; */

// Q6:
CREATE TABLE infracciones_by_lugar (lugar INT, infracciones COUNTER, PRIMARY KEY (lugar));

/* SELECT lugares_lugar, lugares_lugar FROM infracciones_by_lugar WHERE lugares_lugar=?; */

