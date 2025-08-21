DELIMITER //

CREATE PROCEDURE llenar(in limite INT, in unidad INT)
BEGIN 
    Declare i INT DEFAULT 1;
    While i<= limite DO
        INSERT INTO sat(unit, lesson, hecho) VALUES (unidad, i, 0);
        SET i=i+1;
    END while;


END //


DELIMITER ;

CALL llenar(5,2);
CALL llenar(4,3);
CALL llenar(5,4);
CALL llenar(5,5);
CALL llenar(4,6);
CALL llenar(5,7);
CALL llenar(5,8);
CALL llenar(4,9);
CALL llenar(5,10);
CALL llenar(12,11);