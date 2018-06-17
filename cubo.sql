-- Data Warehouse, ex 2
-- cubo com valor medio pago sobre as dimensoes 
-- localizacao (espaco, posto) e data (dia, mes)
SELECT espaco, posto, dia, mes, AVG(pago)
FROM reserva_facts
	NATURAL JOIN location_dimension
	NATURAL JOIN date_dimension
GROUP BY espaco, posto, dia, mes WITH ROLLUP

UNION

SELECT espaco, posto, dia, mes, AVG(pago)
FROM reserva_facts
	NATURAL JOIN location_dimension
	NATURAL JOIN date_dimension
GROUP BY posto, dia, mes, espaco WITH ROLLUP

UNION

SELECT espaco, posto, dia, mes, AVG(pago)
FROM reserva_facts
	NATURAL JOIN location_dimension
	NATURAL JOIN date_dimension
GROUP BY dia, mes, espaco, posto WITH ROLLUP

UNION

SELECT espaco, posto, dia, mes, AVG(pago)
FROM reserva_facts
	NATURAL JOIN location_dimension
	NATURAL JOIN date_dimension
GROUP BY mes, espaco, posto, dia WITH ROLLUP;






-----------------
-- A, B, C

-- B, C, A

-- C, A, B


-- ABC
-- AB
-- A
-- BC
-- B
-- CA
-- C