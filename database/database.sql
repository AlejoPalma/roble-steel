CREATE TABLE usuarios(
    id              int auto_increment not null,
    nombre          varchar(50) not null,
    apellidos       varchar(50) not null,
    email           varchar(100) not null,
    password        varchar(100) not null,
    rol             varchar(20)  not null,
    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE = InnoDb;

CREATE TABLE servicios(
    id              int auto_increment not null,
    nombre          varchar(100) not null,
    descripcion     text,
    imagen          varchar(100),
    CONSTRAINT pk_servicios PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE galeria_servicio(
    id              int auto_increment not null,
    id_servicio     int not null,
    nombre          varchar(255) not null,
    imagen          varchar(255),
    CONSTRAINT pk_galeria_servicio PRIMARY KEY (id),
    CONSTRAINT fk_servicios FOREIGN KEY(id_servicio)
    REFERENCES servicios(id)
)ENGINE = InnoDb;

CREATE TABLE galeria_imagenes(
    id              int auto_increment not null,
    nombre          varchar(255) not null,
    imagen          varchar(255),
    CONSTRAINT pk_galeria_imagenes PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE galeria_videos(
    id              int auto_increment not null,
    nombre          varchar(255) not null,
    video           varchar(255),
    miniatura       varchar(255),
    CONSTRAINT pk_galeria_imagenes PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE recuperar(
    email varchar(100) not null,
    clave_nueva int not null,
    token int not null,
    fecha_alta date,
    CONSTRAINT pk_recuperar PRIMARY KEY (email)
)ENGINE = InnoDb;