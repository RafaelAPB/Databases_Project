DROP TABLE IF EXISTS reserva_facts;
DROP TABLE IF EXISTS date_dimension;
DROP TABLE IF EXISTS time_dimension;
DROP TABLE IF EXISTS location_dimension;
DROP TABLE IF EXISTS user_dimension;


CREATE TABLE user_dimension(
	uid int AUTO_INCREMENT,
	nif varchar(9) NOT NULL UNIQUE,
	nome varchar(80) NOT NULL,
    telefone varchar(26) NOT NULL,
	PRIMARY KEY(uid));

CREATE TABLE location_dimension(
	lid int AUTO_INCREMENT,
	posto varchar(255),
	espaco varchar(255),
	edificio varchar(255) NOT NULL,
	PRIMARY KEY(lid));

CREATE TABLE time_dimension(
	tid int AUTO_INCREMENT,
	hora int NOT NULL,
	minuto int NOT NULL,
	PRIMARY KEY(tid));

CREATE TABLE date_dimension(
	did int AUTO_INCREMENT,
	dia int NOT NULL,
	semana int NOT NULL,
	mes int NOT NULL,
	semestre int NOT NULL,
	ano int NOT NULL,
	PRIMARY KEY(did));

CREATE TABLE reserva_facts(
	pago numeric(19,4) NOT NULL, 
	duracao int NOT NULL, 
	uid int NOT NULL,
	lid int NOT NULL,
	tid int NOT NULL,
	did int NOT NULL,
	PRIMARY KEY(uid, tid, did), -- assumindo que um utilizador não paga duas ou mais reservas na mesma hora e minuto do mesmo dia
	FOREIGN KEY(uid) REFERENCES user_dimension(uid), 
	FOREIGN KEY(lid) REFERENCES location_dimension(lid), 
	FOREIGN KEY(tid) REFERENCES time_dimension(tid), 
	FOREIGN KEY(did) REFERENCES date_dimension(did));