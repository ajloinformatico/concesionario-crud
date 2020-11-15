drop database if exists  concesionario;
create database concesionario;

USE concesionario;
CREATE TABLE usuarios (id int primary key auto_increment, username varchar(15) NOT NULL, email varchar(40) NOT NULL, contrasena varchar(25) NOT NULL);
CREATE TABLE coches (
    matricula varchar(7) primary key,
    precio decimal (7,2),
    marca varchar(15) NOT NULL, 
    modelo varchar(15) NOT NULL, 
    n_puertas int(1) NOT NULL, 
    color varchar(10) default 'negro', 
    edad date NOT NULL
);
    