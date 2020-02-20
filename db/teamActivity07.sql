CREATE TABLE accounts (
	id SERIAL PRIMARY KEY NOT NULL,
	username varchar(255) NOT NULL UNIQUE,
	password varchar(255) NOT NULL
);