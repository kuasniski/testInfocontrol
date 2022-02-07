CREATE DATABASE IF NOT EXISTS infocontrol;

USE infocontrol;

CREATE TABLE IF NOT EXISTS usuarios(
id                      int(255) auto_increment not null,
nombre                  varchar(40),
apellido                varchar(60),
username                varchar(100),
password                varchar(255),
id_provincia            varchar(10),
numero                  int(10),
fecha                   date,
acepta_terminos         int(1),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(username)
)ENGINE=InnoDb;