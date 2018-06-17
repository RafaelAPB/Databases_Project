DROP TRIGGER IF EXISTS data_check;
DROP TRIGGER IF EXISTS pagamento_check;
-- -- -- -- -- -- -- -- -- -- --  Restricao de Integridade 1: -- -- -- -- -- -- -- -- -- 
-- verificamos se nao ha sobreposicao de datas de ofertas entre o alugavel e ele proprio 
-- e entre ele e os seus postos, se for um espaco, e entre ele e o espaco onde esta contido, se for um posto
DELIMITER	// 
CREATE TRIGGER	data_check
BEFORE INSERT ON oferta 
FOR EACH ROW
BEGIN
	IF EXISTS (SELECT ofertaPostoEspaco.morada, ofertaPostoEspaco.codigo
				FROM (SELECT op.morada, op.codigo, pp.codigo_espaco, op.data_inicio, op.data_fim
					FROM oferta op NATURAL JOIN posto pp
					UNION
					SELECT oe.morada, pe.codigo, oe.codigo, oe.data_inicio, oe.data_fim
					FROM oferta oe LEFT JOIN posto pe ON oe.codigo = pe.codigo_espaco AND oe.morada = pe.morada) ofertaPostoEspaco
				WHERE NEW.morada = ofertaPostoEspaco.morada 
					AND (NEW.codigo = ofertaPostoEspaco.codigo
						OR NEW.codigo = ofertaPostoEspaco.codigo_espaco)
					AND ((NEW.data_inicio BETWEEN ofertaPostoEspaco.data_inicio AND ofertaPostoEspaco.data_fim)
						OR (NEW.data_fim BETWEEN ofertaPostoEspaco.data_inicio AND ofertaPostoEspaco.data_fim)
						OR (ofertaPostoEspaco.data_inicio BETWEEN NEW.data_inicio AND NEW.data_fim)
						OR (ofertaPostoEspaco.data_fim BETWEEN NEW.data_inicio AND NEW.data_fim))
				) THEN
		CALL oferta_datas_sobrepostas;
	END IF;
END //
DELIMITER ;
-- -- -- -- -- -- -- -- -- -- --  Restricao de Integridade 2: -- -- -- -- -- -- -- -- -- 
DELIMITER	// 
CREATE TRIGGER	pagamento_check
BEFORE INSERT ON paga 
FOR EACH ROW
BEGIN
	SET @estado_mais_recente = (SELECT MAX(e1.time_stamp)
								FROM estado e1
								WHERE e1.numero = NEW.numero);
	SET @nova_data_pag = NEW.data;
	IF (@nova_data_pag < @estado_mais_recente) THEN
		CALL paga_data_maior_timestamp_estado;
	END IF; 
END //
DELIMITER ;
