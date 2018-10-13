CREATE KEYSPACE practica_bd WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};
USE practica_bd;

// Q1:
CREATE TABLE infracciones_in_rango (placa TEXT, velocidad INT, fecha TIMESTAMP, hora TIMESTAMP, lugar INT, PRIMARY KEY (placa,velocidad,fecha,hora)) WITH CLUSTERING ORDER BY (velocidad ASC, fecha ASC, hora ASC);

/* SELECT fecha, hora, lugar FROM infracciones_in_rango WHERE velocidad=? and placa=? and fecha>? ORDER BY fecha ASC, hora ASC; */

// Q2:
CREATE TABLE pasos_by_mes (placa TEXT, fecha TIMESTAMP, lugar INT, pasos COUNTER, PRIMARY KEY ((placa,fecha),lugar)) WITH CLUSTERING ORDER BY (lugar ASC);

/* SELECT lugares_lugar, lugares_lugar FROM pasos_by_mes WHERE placa=? and fecha=? ORDER BY lugares_lugar ASC; */

// Q3:
CREATE TABLE datos_by_lugar (fecha TIMESTAMP, lugar INT, hora TIMESTAMP, placa TEXT, velocidad INT, PRIMARY KEY ((fecha,lugar),hora)) WITH CLUSTERING ORDER BY (hora ASC);

/* SELECT hora, placa, velocidad FROM datos_by_lugar WHERE lugar=? and fecha=? ORDER BY hora ASC; */

// Q4:
CREATE TABLE infracciones_by_fecha (fecha TIMESTAMP, velocidad INT, hora TIMESTAMP, lugar INT, placa TEXT, PRIMARY KEY (fecha,velocidad,hora)) WITH CLUSTERING ORDER BY (velocidad ASC, hora ASC);

/* SELECT hora, lugar, placa FROM infracciones_by_fecha WHERE fecha=? and velocidad>? ORDER BY hora ASC; */

// Q5:
CREATE TABLE infracciones_by_placa (placa TEXT, infracciones COUNTER, PRIMARY KEY (placa));

/* SELECT vehiculos_placa, vehiculos_placa FROM infracciones_by_placa WHERE vehiculos_placa=?; */

// Q6:
CREATE TABLE infracciones_by_lugar (lugar INT, infracciones COUNTER, PRIMARY KEY (lugar));

/* SELECT lugares_lugar, lugares_lugar FROM infracciones_by_lugar WHERE lugares_lugar=?; */

