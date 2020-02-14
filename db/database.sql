CREATE DATABASE furnitureZone;

CREATE TABLE furniture (
SKU varchar(255) PRIMARY KEY UNIQUE,
collectionID int REFERENCES collection(ID),
typeID int REFERENCES type(ID),
width float,
height float,
depth float,
finishID int REFERENCES finish(ID),
doors int,
drawers int,
imageID int REFERENCES images(ID)
);

CREATE TABLE collection (
ID SERIAL PRIMARY KEY,
name varchar(255),
);

CREATE TABLE type (
ID SERIAL PRIMARY KEY,
name varchar(255),
image varchar(255)
);

CREATE TABLE finish (
ID SERIAL PRIMARY KEY,
name varchar(255),
);

CREATE TABLE images (
ID SERIAL PRIMARY KEY,
link varchar(255),
);

INSERT INTO type (name, image) VALUES ('Bookcase', 'bookcase.jpg');
INSERT INTO type (name, image) VALUES ('Chair', 'chair.jpg');
INSERT INTO type (name, image) VALUES ('Coffee table', 'coffee_table.jpg');
INSERT INTO type (name, image) VALUES ('Console', 'console.jpg');
INSERT INTO type (name, image) VALUES ('Desk', 'desk.jpg');
INSERT INTO type (name, image) VALUES ('Dresser', 'dresser.jpg');
INSERT INTO type (name, image) VALUES ('End table', 'end_table.jpg');
INSERT INTO type (name, image) VALUES ('File cabinet', 'file_cabinet.jpg');
INSERT INTO furniture (typeID, finishID, collectionID, sku, width, height, depth)
VALUES ();

SELECT id, name FROM type
WHERE name = 'Console';