DELIMITER //

DROP PROCEDURE IF EXISTS generate_date //
CREATE PROCEDURE generate_date ()
BEGIN
	DECLARE dia int DEFAULT 1;
	DECLARE semana int DEFAULT 0;
	DECLARE mes int DEFAULT 1;
	DECLARE semestre int DEFAULT 1;
	DECLARE ano int DEFAULT 2016;
	DECLARE diaMax int DEFAULT 30;
	DECLARE diaAno int DEFAULT 1;
	WHILE ano <= 2017 DO
		WHILE mes <= 12 DO
			IF (mes IN (1, 3, 5, 7, 8, 10, 12)) THEN
				SET diaMax = 31;
			ELSEIF (mes IN (4, 6, 9, 11)) THEN
				SET diaMax = 30;
			ELSEIF (mes = 2 && ano = 2016) THEN
				SET diaMax = 29;
			ELSEIF (mes = 2 && ano = 2017) THEN
				SET diaMax = 28;
			END IF;
			WHILE dia <= diaMax DO
				IF (diaAno % 7 = 1) THEN
					SET semana = semana + 1; 
				END IF;
				IF (mes <= 6) THEN
					SET semestre = 1;
				ELSE
					SET semestre = 2;
				END IF;
				INSERT INTO date_dimension(dia, semana, mes, semestre, ano) VALUES(dia, semana, mes, semestre, ano);
				SET dia = dia + 1;
				SET diaAno = diaAno + 1;
			END WHILE;
			SET dia = 1;
			SET mes = mes + 1;
		END WHILE;
		SET semana = 0;
		SET mes = 1;
		SET ano = ano + 1;
		SET diaAno = 1;
	END WHILE;
END //

DELIMITER ;

TRUNCATE date_dimension; -- to remove all registers from table date_dimension
CALL generate_date;