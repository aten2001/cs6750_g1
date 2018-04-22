-- fake user
insert into Users (UserID, Gender, State, Country) values(1, "M", "VA", "USA");
insert into Users (UserID, Gender, State, Country) values(2, "F", "VA", "USA");
insert into Users (UserID, Gender, State, Country) values(3, "M", "CA", "USA");
insert into Users (UserID, Gender, State, Country) values(4, "F", "CA", "USA");
insert into Users (UserID, Gender, State, Country) values(5, "F", "VA", "USA");
insert into Users (UserID, Gender, State, Country) values(6, "M", "TX", "USA");
insert into Users (UserID, Gender, State, Country) values(7, "F", "TX", "USA");
insert into Users (UserID, Gender, State, Country) values(8, "M", "VA", "USA");
insert into Users (UserID, Gender, State, Country) values(9, "F", "CO", "USA");
insert into Users (UserID, Gender, State, Country) values(10, "M", "WA", "USA");

insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (1, "Bianka", "Faunt", "bfaunt0@barnesandnoble.com", "622-299-0564", "444 David Plaza", "La Charité-sur-Loire", "58404");
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (2, "Marlon", "Forsyde", "mforsyde1@hc360.com", "277-251-1638", "6052 Lien Park", "Nyala", null);
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (3, "Christophe", "Slowly", "cslowly2@sohu.com", "671-777-2330", "52452 Lotheville Road", "Kiraman", null);
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (4, "Kathleen", "Bergen", "kbergen3@google.ca", "527-385-5324", "9 Utah Circle", "Uruguaiana", "97500-000");
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (5, "Gina", "Shubotham", "gshubotham4@oracle.com", "122-947-7718", "7 Elmside Place", "Ban Selaphum", "51130");
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (6, "Vergil", "Dives", "vdives5@stumbleupon.com", "738-935-4764", "989 Delaware Circle", "Si Bun Rueang", "39180");
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (7, "Rawley", "McNutt", "rmcnutt6@gnu.org", "301-104-3137", "2 Elgar Place", "Likhoy", "356501");
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (8, "Sybila", "Downey", "sdowney7@dailymail.co.uk", "858-886-2968", "8678 Bartelt Place", "Baoluan", null);
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (9, "Nita", "Leet", "nleet8@myspace.com", "468-974-8902", "04103 John Wall Park", "Cibunar", null);
insert into Profiles (UserID, FirstName, LastName, Email, Phone, Street, City, ZipCode) values (10, "Carrie", "Ridgway", "cridgway9@webs.com", "917-358-4201", "5 Mitchell Lane", "Buenos Aires", "83344");


-- fake category
insert into Categories value(1,"Electronics", "Electronic items fall under this category.");
insert into Categories value(2,"Grocery", "Grocery items fall under this category.");
insert into Categories value(3,"Clothes", "Clothing items fall under this category.");
insert into Categories value(4,"Home", "Home items fall under this category.");
-- fake item 
insert into Items value(1, "Apple iPhone X", 1, 999.99, NULL, 10);
insert into Items value(2, "Samsung Galaxy S8", 1, 799.99, NULL, 20);
insert into Items value(3, "Sharp UHD TV - 55\"", 1, 1199.99, NULL, 11);
insert into Items value(4, "Sobe Lifewater - Yumberry Pomegranate", 2, 1.99, NULL, 200);
insert into Items value(5, "Levi Jeans 511 - Size 30", 3, 29.99, NULL, 4);
insert into Items value(6, "Alpha Industries Slim Bomber - Black, Size Small", 3, 149.99, NULL, 5);
insert into Items value(7, "St. John's Bay Boots - Size 9", 3, 37.99, NULL, 18);
insert into Items value(8, "Kenneth Cole Suit", 3, 119.99, NULL, 25);
insert into Items value(9, "Dyson Pure Cool Oscillating Bladeless Fan/Purifier", 4, 549.99, NULL, 13);
insert into Items value(10, "Whirlpool Refridgerator 26 cu. ft.", 4, 2599.99, NULL, 5);

-- fake shipper
INSERT INTO shippers 
VALUES
(1, 'UPS','55 Glenlake Parkway NE, Atlanta, GA 30328', '1-800-PICK-UPS', NULL),
(2, 'USPS','475 Lenfant Plz SW (at Independence Ave., Washington, D.C. 20260', '1-800-ASK-USPS', NULL),
(3, 'FEDEX','FedEx Customer Relations 3875 Airways, Module H3 Department 4634 Memphis, TN38116', '1.800.Go.FedEx', NULL),
(4, 'USXPRESS','4080 Jenkins Rd Chattanooga, TN 37421', '1-866-646-5886', NULL),
(5, 'DHL','1210 South Pine Island Road., Fourth Floor., Plantation, FL 33324.', '1-800-225-5345', NULL),
(6, 'US Logistics Inc', '350 Benigno Blvd., Bellmawr, NJ 08031', '1-856-931-5500', NULL);


-- fake order & orderdetail
INSERT INTO ORDERS
VALUE
(11, 7, 3, DATE'2014-4-14', 11),
(12, 3, 1, DATE'2015-2-5', 12),
(13, 4, 2, DATE'2015-7-23', 13),
(14, 5, 2, DATE'2016-8-10', 14),
(15, 2, 6, DATE'2015-10-3',15);

INSERT INTO ORDERDETAILS
value
(11, 2, 1),
(12, 3, 1),
(13, 8, 2),
(13, 7, 1),
(14, 1, 1),
(15, 1, 1);

--

insert into Orders values
(6, 1, 4, DATE '2017-12-25', 1),
(7, 2, 5, DATE '2018-01-17', 2),
(8, 3, 6, DATE '2018-02-09', 3),
(9, 4, 1, DATE '2018-03-01', 4),
(10, 5, 2, DATE '2018-03-21', 5);

insert into Orders values
(1, 9, 4, DATE '2017-06-15', 0605),
(2, 8, 5, DATE '2018-02-27', 0227),
(3, 10, 6, DATE '2018-03-11', 0311),
(4, 6, 1, DATE '2018-01-01', 0101),
(5, 6, 2, DATE '2018-02-21', 0221);

insert into OrderDetails values
(6,1,1),
(6,3,1),
(7,2,1),
(8,4,3),
(9,5,3),
(10,6,2);

insert into OrderDetails values
(1,2,1),
(2,3,3),
(3,3,2),
(4,1,1),
(5,3,1),
(5,4,1);

insert into Orders values
(16, 9, 3, DATE '2017-10-14', 1023),
(17, 5, 4, DATE '2018-01-27', 1111),
(18, 4, 6, DATE '2018-03-29', 0789),
(19, 3, 1, DATE '2018-01-15', 0234),
(20, 10, 5, DATE '2017-09-18', 0576);

insert into OrderDetails values
(16,3,4),
(17,5,6),
(17,7,3),
(18,2,1),
(19,4,3),
(20,8,7);
