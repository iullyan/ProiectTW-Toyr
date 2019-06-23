
SET GLOBAL event_scheduler = ON;

CREATE EVENT IF NOT EXISTS `deleteSpecialOffers`
    ON SCHEDULE EVERY 4 SECOND STARTS CURRENT_TIMESTAMP
    ON COMPLETION PRESERVE
    DO CALL DeleteSpecialOffers();


DELIMITER //
CREATE PROCEDURE  DeleteSpecialOffers()
BEGIN
    delete from promotions where valid_from < CURRENT_TIMESTAMP AND  valid_until < CURRENT_TIMESTAMP;
    delete from special_event where starting_date < CURRENT_TIMESTAMP AND ending_date < CURRENT_TIMESTAMP;
    delete from discounts   where valid_from < CURRENT_TIMESTAMP AND  valid_until < CURRENT_TIMESTAMP;
END //
DELIMITER ;