DROP TRIGGER IF EXISTS cannotBuyItemsTrigger;

DELIMITER $$
	
CREATE TRIGGER cannotBuyItemsTrigger2
BEFORE INSERT ON OrderDetails
FOR EACH ROW 
BEGIN
    IF (NEW.quantity > (Select Inventory from Items where New.ItemID = Items.ItemID)) THEN
		SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'Warning: No inventory left!';
	END IF;
END$$

DELIMITER ;



-- Show OrderDetails & Items

-- valid one
SELECT * FROM orderdetails;
SELECT * FROM Items;

-- Show OrderDetails & Items
INSERT INTO orders
values (21,1,1,DATE'2012-12-12',355);

INSERT INTO orderdetails
VALUES(21, 1, 1);

SELECT * FROM orderdetails;


-- invalid one
INSERT INTO orders
values (22,1,1,DATE'2012-12-12',3552);

INSERT INTO orderdetails
VALUES(22, 1, 15);

SELECT * FROM orderdetails;

SELECT
Quantity, SUM(Quantity) OVER (ORDER BY OrderID) AS running_sum
FROM Orderdetails;

SELECT SUM(quantity) OVER () AS running_sum
FROM Orderdetails;
