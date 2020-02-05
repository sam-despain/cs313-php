CREATE DATABASE furnitureZone;

CREATE TABLE furniture (
	SKU varchar(255) NOT NULL,
	collectionID int,
	typeID int,
	width float,
	height float,
	depth float,
	finishID int,
	doors int,
	drawers int,
	imageID int,
	PRIMARY KEY (SKU),
	FOREIGN KEY (collectionID) REFERENCES collection(ID),
	FOREIGN KEY (typeID) REFERENCES type(ID),
	FOREIGN KEY (finishID) REFERENCES finish(ID),
	FOREIGN KEY (imageID) REFERENCES images(ID)
);

CREATE TABLE collection (
	ID SERIAL UNIQUE,
	name varchar(255),
	PRIMARY KEY (ID)
);

CREATE TABLE type (
	ID SERIAL UNIQUE,
	name varchar(255),
	PRIMARY KEY (ID)
);

CREATE TABLE finish (
	ID SERIAL UNIQUE,
	name varchar(255),
	PRIMARY KEY (ID)
);

CREATE TABLE images (
	ID SERIAL UNIQUE,
	link varchar(255),
	PRIMARY KEY (ID)
);
