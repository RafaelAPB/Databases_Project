DELIMITER //

DROP PROCEDURE IF EXISTS generate_time //
CREATE PROCEDURE generate_time ()
BEGIN
	DECLARE hour int DEFAULT 0;
	DECLARE minute int DEFAULT 0;
	WHILE hour <= 23 DO
		WHILE minute <= 59 DO
			INSERT INTO time_dimension(hora, minuto) VALUES(hour, minute);
			SET minute = minute + 1;
		END WHILE;
		SET minute = 0;
		SET hour = hour + 1;
	END WHILE;
END //

DELIMITER ;

TRUNCATE time_dimension; -- to remove all registers from table time_dimension
CALL generate_time;