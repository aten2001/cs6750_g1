SET SQL_SAFE_UPDATES = 0;


SELECT itemid, SUM(quantity) AS sum_quantity
FROM orderdetails
GROUP BY itemid;



SELECT * FROM Items;
UPDATE  Items i JOIN
(
SELECT itemid, SUM(quantity) AS sum_quantity
FROM orderdetails
GROUP BY itemid
) o
ON i.itemid = o.itemid
set i.inventory = GREATEST(0, i.inventory - o.sum_quantity);
SELECT * FROM Items;

