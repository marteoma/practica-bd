CREATE KEYSPACE cassandra-model WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};
USE cassandra-model;

// Q1:
CREATE TABLE infracciones_placa_fecha (placa TEXT, velocidad INT, fecha TEXT, hora TEXT, lugar INT, PRIMARY KEY (placa,velocidad,fecha,hora,lugar)) WITH CLUSTERING ORDER BY (velocidad ASC, fecha ASC, hora ASC, lugar ASC);

/* SELECT fecha, hora, lugar FROM infracciones_placa_fecha WHERE placa=? and velocidad=? and fecha>? ORDER BY fecha ASC, hora ASC, lugar ASC; */

// Q2:
CREATE TABLE pasos_by_lugar (placa TEXT, fecha TEXT, lugar INT, hora TEXT, pasos COUNTER, PRIMARY KEY ((placa,fecha),lugar,hora)) WITH CLUSTERING ORDER BY (lugar ASC, hora ASC);

/* SELECT fotodeteccion_lugar, fotodeteccion_lugar FROM pasos_by_lugar WHERE placa=? and fecha=? ORDER BY fotodeteccion_lugar ASC; */

// Q3:
CREATE TABLE estadistica_lugar (lugar INT, fecha TEXT, hora TEXT, velocidad INT, placa TEXT, PRIMARY KEY ((lugar,fecha),hora,velocidad,placa)) WITH CLUSTERING ORDER BY (hora ASC, velocidad ASC, placa ASC);

/* SELECT hora, velocidad, placa FROM estadistica_lugar WHERE fecha=? and lugar=? ORDER BY hora ASC, velocidad ASC; */

// Q4:
CREATE TABLE fotodetecciones_by_fecha (fecha TEXT, velocidad INT, hora TEXT, lugar INT, placa TEXT, PRIMARY KEY (fecha,velocidad,hora,lugar,placa)) WITH CLUSTERING ORDER BY (velocidad ASC, hora ASC, lugar ASC, placa ASC);

/* SELECT hora, lugar, placa FROM fotodetecciones_by_fecha WHERE fecha=? and velocidad>? ORDER BY hora ASC, lugar ASC; */

