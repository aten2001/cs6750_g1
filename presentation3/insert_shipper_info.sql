
-- test update

UPDATE  Items i JOIN
(
SELECT itemid, SUM(quantity) AS sum_quantity
FROM orderdetails
GROUP BY itemid
) o
ON i.itemid = o.itemid
set i.inventory = GREATEST(0, i.inventory - o.sum_quantity);





DELIMITER $$
	
CREATE TRIGGER canBuyItemsTrigger 
BEFORE INSERT ON OrderDetails
FOR EACH ROW 
BEGIN
    IF (NEW.quantity <= (Select Inventory from Items where New.ItemID = Items.ItemID)) THEN
	UPDATE  Items i set i.inventory = i.inventory - NEW.quantity where i.ItemID = NEW.ItemID;
	END IF;
END$$

DELIMITER ;



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


DELIMITER $$
	
CREATE TRIGGER cannotBuyItemsTrigger3
BEFORE INSERT ON OrderDetails
FOR EACH ROW 
BEGIN
    IF (NEW.quantity > (Select Inventory from Items where New.ItemID = Items.ItemID)) THEN
		DELETE FROM Orders WHERE Orders.OrderID = New.OrderID;
	END IF;
END$$

DELIMITER ;


DROP TRIGGER canBuyItemsTrigger;
DROP TRIGGER cannotBuyItemsTrigger;
DROP TRIGGER cannotBuyItemsTrigger2;


insert into orders
values (21,1,1,DATE'2012-12-12',355);

insert into orderdetails
values (21,1,1);



insert into orders
values (27,1,1,DATE'2014-12-12',3154);

insert into orderdetails
values (27,3,1);


insert into orders
values (28,1,1,DATE'2014-12-12',31541);

insert into orderdetails
values (28,3,1);



insert into orders
values (29,1,1,DATE'2014-12-12',311541);

insert into orderdetails
values (29,1,1);

insert into orders
values (31,1,1,DATE'2014-12-12',123123);

insert into orderdetails
values (31,1,1);

insert into orders
values (33,1,1,DATE'2014-12-12',456516);

insert into orderdetails
values (33,1,5);