CREATE DATABASE bdphp;

USE bdphp;


CREATE TABLE cliente(
	id_cliente BIGINT(5) ZEROFILL NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	sexo ENUM('masculino','feminino') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	peso FLOAT NOT NULL,
	altura FLOAT NOT NULL,
	idade INT NOT NULL,
	CONSTRAINT pkid_cliente PRIMARY KEY(id_cliente));

CREATE TABLE funcionario(
	id_funcionario bigint(5) ZEROFILL NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	idade INT NOT NULL,
	sexo ENUM('masculino','feminino') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	rg BIGINT UNIQUE NOT NULL,
	cpf BIGINT UNIQUE NOT NULL,
	cnpj BIGINT UNIQUE NULL,
	CONSTRAINT pkid_funcionario PRIMARY KEY(id_funcionario));

CREATE TABLE professor(
	id_professor BIGINT(5) ZEROFILL NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	sexo ENUM('masculino','feminino') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	idade INT NOT NULL,
	cpf BIGINT UNIQUE NOT NULL,
	data_contrato VARCHAR(20) NOT NULL,
	CONSTRAINT pkid_professor PRIMARY KEY(id_professor));

CREATE TABLE usuario(
	id_user BIGINT(5) ZEROFILL NOT NULL AUTO_INCREMENT,
  	nome VARCHAR(50) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	login VARCHAR(50) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	senha VARCHAR(50) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	tipo ENUM('adm','visitante') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NOT NULL,
	CONSTRAINT pkid_user PRIMARY KEY(ID_USER));

INSERT INTO cliente (id_cliente, nome, sexo,peso, altura, idade)
	VALUES(null, 'Bruno Gressler', 'masculino', 40.1, 1.5, 22),
	(null, 'Clarissa Nunes', 'feminino', 40.213, 1.6, 24),
	(null, 'Hugo Henrique', 'masculino', 80.123, 1.5, 20);

INSERT INTO funcionario (id_funcionario,nome,idade,sexo,rg,cpf,cnpj)
	VALUES(null, 'Gustavo Santos', 30, 'masculino', 11111111,44444444444, null),
	(null, 'Thiago Santos' , 31 , 'masculino' , 22222222 , 55555555555, 111111111111),
	(null, "Priscila Réus" , 29 , "feminino" , 33333333 , 66666666666 , null);

INSERT INTO professor (id_professor,nome,sexo,idade,cpf,data_contrato)
	VALUES(null, "Jessica Terra" , "feminino" , 25 , 11111111111 , "10/10/2010"),
	(null, "Miguel Santos" , "masculino" , 30,22222222222 , "10/03/2000"),
	(null, "Herique Passo" , "masculino" , 33,33333333333 , "04/09/2001");