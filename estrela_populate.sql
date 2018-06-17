
INSERT INTO user_dimension(nif, nome, telefone) SELECT nif, nome, telefone FROM user;

INSERT INTO location_dimension(posto, espaco, edificio) SELECT codigo, codigo_espaco, morada FROM posto;

INSERT INTO location_dimension(espaco, edificio) SELECT codigo, morada FROM espaco;

INSERT INTO location_dimension(edificio) SELECT morada FROM edificio;

INSERT INTO reserva_facts(pago, duracao, uid, lid, tid, did) 
	SELECT o.tarifa*DATEDIFF(o.data_fim, o.data_inicio), DATEDIFF(o.data_fim, o.data_inicio), ud.uid, ld.lid, td.tid, dd.did 
	FROM paga p NATURAL JOIN aluga a NATURAL JOIN oferta o
		JOIN user_dimension ud ON ud.nif = a.nif
		JOIN location_dimension ld ON ld.espaco = a.codigo AND ld.edificio = a.morada
		JOIN time_dimension td ON td.hora = hour(p.data) AND td.minuto = minute(p.data)
		JOIN date_dimension dd ON dd.dia = day(p.data) 
								AND dd.mes = month(p.data) 
								AND dd.ano = year(p.data)
		WHERE ld.posto IS NULL;

INSERT INTO reserva_facts(pago, duracao, uid, lid, tid, did) 
	SELECT o.tarifa*DATEDIFF(o.data_fim, o.data_inicio), DATEDIFF(o.data_fim, o.data_inicio), ud.uid, ld.lid, td.tid, dd.did 
	FROM paga p NATURAL JOIN aluga a NATURAL JOIN oferta o NATURAL JOIN posto po
		JOIN user_dimension ud ON ud.nif = a.nif
		JOIN location_dimension ld ON ld.posto = a.codigo AND ld.espaco = po.codigo_espaco AND ld.edificio = a.morada
		JOIN time_dimension td ON td.hora = hour(p.data) AND td.minuto = minute(p.data)
		JOIN date_dimension dd ON dd.dia = day(p.data) 
								AND dd.mes = month(p.data) 
								AND dd.ano = year(p.data);