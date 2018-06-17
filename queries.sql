-- query a)

SELECT DISTINCT esp.codigo, esp.morada
FROM espaco esp JOIN posto p1 ON esp.codigo = p1.codigo_espaco AND esp.morada = p1.morada
WHERE NOT EXISTS(
	SELECT DISTINCT p2.codigo, p2.morada
	FROM posto p2 NATURAL JOIN aluga a
		NATURAL JOIN estado e
	WHERE p2.codigo = p1.codigo
		AND e.estado = 'Aceite');

-- query b)

SELECT morada
FROM aluga a1
GROUP BY  a1.morada
HAVING COUNT(*) > (
	SELECT AVG(ac.reservas)
	FROM (SELECT a2.morada, COUNT(*) AS reservas 
		FROM aluga a2
		GROUP BY  a2.morada) ac);

-- query c)

SELECT DISTINCT a.nif
FROM arrenda a NATURAL JOIN fiscaliza f
GROUP BY  a.nif
HAVING COUNT(DISTINCT f.id) <= 1;

-- query d)
-- juntamos as 3 tabelas descritas nos comentarios e somamos todos os valores realizados por espaco, para ter o valor realizado total por espaco
SELECT res.morada, res.codigo, SUM(res.TotalEspaco) AS Total
FROM -- vemos os espacos com reserva paga em 2016 e calculamos o valor realizado para esse espaco
	(SELECT e.morada, e.codigo, SUM(oe.tarifa * datediff(oe.data_fim, oe.data_inicio)) AS TotalEspaco
	FROM espaco e NATURAL JOIN oferta oe
		NATURAL JOIN aluga ae
		NATURAL JOIN paga pge
	WHERE pge.data BETWEEN '2016-01-01' AND '2016-12-31'
	GROUP BY  e.morada, e.codigo
	UNION
	-- vemos os postos por espaco com reserva paga em 2016 e calculamos o valor realizado para esses postos agrupado por espaco
	SELECT p.morada, p.codigo_espaco, SUM(o.tarifa * datediff(o.data_fim, o.data_inicio)) AS TotalPosto
	FROM posto p NATURAL JOIN oferta o
		NATURAL JOIN aluga a
		NATURAL JOIN paga pg
	WHERE pg.data BETWEEN '2016-01-01' AND '2016-12-31'
	GROUP BY  p.morada, p.codigo_espaco
	UNION
	-- vemos os espacos que nao tem reserva paga em 2016 e pomos o valor realizado para esse espaco a zero
	SELECT ez.morada, ez.codigo AS codigo_espaco, 0
	FROM espaco ez
	WHERE (ez.morada, ez.codigo) NOT IN(
		SELECT az.morada, az.codigo
		FROM aluga az NATURAL JOIN paga pgz
		WHERE pgz.data BETWEEN '2016-01-01' AND '2016-12-31')
	) res
GROUP BY  res.morada, res.codigo;

-- query e)

SELECT DISTINCT esp.codigo, esp.morada
FROM espaco esp JOIN posto p1 ON esp.codigo = p1.codigo_espaco AND esp.morada = p1.morada
WHERE NOT EXISTS(
	SELECT p.codigo, p.morada
	FROM posto p
	WHERE p.codigo_espaco = esp.codigo
		AND NOT EXISTS(
			SELECT a.codigo, a.morada
			FROM aluga a NATURAL JOIN estado e
			WHERE p.codigo = a.codigo
				AND e.estado = 'Aceite'));

