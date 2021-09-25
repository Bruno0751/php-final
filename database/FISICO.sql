CREATE DATABASE bd_php_final;

USE bd_php_final;

CREATE TABLE bd_php_final.clientes(
	id_cliente BIGINT(5) ZEROFILL NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	sexo ENUM('masculino','feminino') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	peso FLOAT(10.2) NULL,
	altura FLOAT(10.2) NULL,
	idade INT NULL,
	CONSTRAINT pkid_cliente PRIMARY KEY(id_cliente));

CREATE TABLE bd_php_final.funcionarios(
	id_funcionario bigint(5) ZEROFILL NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	idade INT NULL,
	sexo ENUM('masculino','feminino') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	rg varchar(15) UNIQUE NULL,
	cpf VARCHAR(15) UNIQUE NULL,
	cnpj VARCHAR(15) UNIQUE NULL,
	CONSTRAINT pkid_funcionario PRIMARY KEY(id_funcionario));

CREATE TABLE bd_php_final.professores(
	id_professor BIGINT(5) ZEROFILL NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	sexo ENUM('masculino','feminino') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	idade INT NULL,
	cpf varchar(15) UNIQUE NULL,
	data_contrato VARCHAR(20) NULL,
	CONSTRAINT pkid_professor PRIMARY KEY(id_professor));

CREATE TABLE bd_php_final.usuarios(
	id_user BIGINT(5) ZEROFILL NOT NULL AUTO_INCREMENT,
  	nome VARCHAR(50) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	login VARCHAR(50) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	senha VARCHAR(50) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	tipo ENUM('adm','visitante') CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
	CONSTRAINT pkid_user PRIMARY KEY(ID_USER));

INSERT INTO bd_php_final.clientes (id_cliente, nome, sexo,peso, altura, idade)
	VALUES(null, 'Bruno Gressler', 'masculino', 40.1, 1.5, 22),
	(null, 'Clarissa Nunes', 'feminino', 40.213, 1.6, 24),
	(null, 'Hugo Henrique', 'masculino', 80.123, 1.5, 20);

INSERT INTO bd_php_final.funcionarios (id_funcionario,nome,idade,sexo,rg,cpf,cnpj)
	VALUES(null, 'Gustavo Santos', 30, 'masculino', 11111111,44444444444, null),
	(null, 'Thiago Santos' , 31 , 'masculino' , 22222222 , 55555555555, 111111111111),
	(null, "Priscila Réus" , 29 , "feminino" , 33333333 , 66666666666 , null);

INSERT INTO bd_php_final.professores (id_professor,nome,sexo,idade,cpf,data_contrato)
	VALUES(null, "Jessica Terra" , "feminino" , 25 , 11111111111 , "10/10/2010"),
	(null, "Miguel Santos" , "masculino" , 30,22222222222 , "10/03/2000"),
	(null, "Herique Passo" , "masculino" , 33,33333333333 , "04/09/2001");

INSERT INTO bd_php_final.usuarios
VALUES(NULL, "Bruno", "123", "123", 'adm');