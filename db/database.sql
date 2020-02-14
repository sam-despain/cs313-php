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


INSERT INTO furniture (typeID, sku, width, height, depth)
VALUES ();

SELECT id, name FROM type
WHERE name = 'Console';