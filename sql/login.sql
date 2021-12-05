create database userdata;

use userdata;

create table users(

 id int NOT NULL AUTO_INCREMENT,
 username VARCHAR(50) NOT NULL,
 password VARCHAR(50) NOT NULL,
 
 PRIMARY KEY (id)
);



