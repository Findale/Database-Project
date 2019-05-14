/*
	Group #5
	Members: Mitchell Alvarado, Sean Fontes, Rodrigo Ortiz
	Creates the user and database for our project.
*/

CREATE USER delivery SUPERUSER PASSWORD 'frozen';

CREATE DATABASE delivery with OWNER = delivery;
