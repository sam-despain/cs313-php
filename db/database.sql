CREATE DATABASE furnitureZone;

CREATE TABLE furniture (
SKU int PRIMARY KEY UNIQUE NOT NULL,
typeID int REFERENCES type(ID),
width float NOT NULL,
height float NOT NULL,
depth float NOT NULL
);

CREATE TABLE type (
ID SERIAL PRIMARY KEY,
name varchar(255),
image varchar(255)
);

INSERT INTO furniture (typeID, sku, width, height, depth)
VALUES ();

SELECT id, name FROM type
WHERE name = 'Console';