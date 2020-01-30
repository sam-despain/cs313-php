CREATE DATABASE furnitureZone;

CREATE TABLE furniture (
	SKU varchar(255),
	collectionID int,
	typeID int,
	width float,
	height float,
	depth float,
	finishID int,
	doors int,
	drawers int,
	PRIMARY KEY (SKU),
	FOREIGN KEY (collectionID) REFERENCES collection(ID),
	FOREIGN KEY (typeID) REFERENCES type(ID),
	FOREIGN KEY (finishID) REFERENCES finish(ID)
);

CREATE TABLE collection (
	ID int,
	name varchar(255),
	PRIMARY KEY (ID)
);

CREATE TABLE type (
	ID int,
	name varchar(255),
	PRIMARY KEY (ID)
);

CREATE TABLE finish (
	ID int,
	name varchar(255),
	PRIMARY KEY (ID)
);