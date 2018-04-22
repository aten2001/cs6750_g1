CREATE DATABASE IF NOT EXISTS Group1_database;
DROP DATABASE Group1_database;
CREATE DATABASE IF NOT EXISTS Group1_database;

use Group1_database;
-- user, item, category, shipper, order, orderdetail 

CREATE TABLE Users(
UserID INT NOT NULL,
Gender VARCHAR(2),
State VARCHAR(20),
Country VARCHAR(20),
PRIMARY KEY (UserID)
);

CREATE TABLE Profiles(
UserID INT NOT NULL,
FirstName VARCHAR(255) NOT NULL,
MiddleName VARCHAR(255),
LastName VARCHAR(255) NOT NULL,
Email VARCHAR(255),
Phone VARCHAR(20),
Street VARCHAR(255),
City VARCHAR(50),
ZipCode VARCHAR(10),
primary key(UserID),
foreign key(UserID) references Users(UserID)
);

CREATE TABLE Categories(
CategoryID INT NOT NULL,
CategoryName VARCHAR(20) NOT NULL,
Description VARCHAR(75),
PRIMARY KEY(CategoryID)
);

CREATE TABLE Items(
ItemID INT NOT NULL,
ItemName VARCHAR(255) NOT NULL,
CategoryID INT NOT NULL,
Price NUMERIC(10,2) NOT NULL,
DiscountRate NUMERIC (3,3),
Inventory INT NOT NULL,
PRIMARY KEY (ItemID),
FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID),
CHECK(Inventory >= 0)
);

CREATE TABLE Shippers(
ShipperID INT NOT NULL,
ShipperName VARCHAR(255) NOT NULL,
Address VARCHAR(255) NOT NULL,
Phone VARCHAR(20) NOT NULL,
Email VARCHAR(255),
PRIMARY KEY (ShipperID)
);

CREATE TABLE Orders(
OrderID INT NOT NULL,
UserID INT NOT NULL,
ShipperID INT NOT NULL,
OrderDate DATE NOT NULL,
TrackingNumber INT NOT NULL,
PRIMARY KEY (OrderID),
FOREIGN KEY (UserID) REFERENCES Users(UserID),
FOREIGN KEY (ShipperID) REFERENCES Shippers(ShipperID)
);

ALTER TABLE Orders
ADD CONSTRAINT UNI_TRAK_NUM UNIQUE(TrackingNumber);

CREATE TABLE OrderDetails(
OrderID INT NOT NULL,
ItemID INT NOT NULL,
Quantity INT NOT NULL,
PRIMARY KEY (OrderID, ItemID),
FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
FOREIGN KEY (ItemID) REFERENCES Items(ItemID)
);







