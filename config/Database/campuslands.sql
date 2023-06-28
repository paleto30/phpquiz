/*tabla de pais*/
CREATE TABLE pais(
    idPais INT PRIMARY KEY AUTO_INCREMENT,
    nombrePais VARCHAR(50) UNIQUE NOT NULL
);

/*tabla de departamento*/
CREATE TABLE departamento(
    idDep INT PRIMARY KEY AUTO_INCREMENT, 
    nombreDep VARCHAR(50) UNIQUE NOT NULL, 
    idPais INT NOT NULL,
    CONSTRAINT fk_departamento FOREIGN KEY (idPais) REFERENCES pais(idPais)
);

/*tabla de region*/
CREATE TABLE region(
    idReg INT PRIMARY KEY AUTO_INCREMENT,
    nombreReg VARCHAR (60) NOT NULL,
    idDep INT NOT NULL,
    CONSTRAINT fk_region FOREIGN KEY (idDep) REFERENCES departamento(idDep)
);

/*tabla campers*/
CREATE TABLE campers(
    idCamper INT PRIMARY KEY AUTO_INCREMENT, 
    nombreCamper VARCHAR (50) NOT NULL, 
    apellidoCamper VARCHAR(50) NOT NULL, 
    fechaNac DATE NOT NULL, 
    idReg INT NOT NULL, 
    CONSTRAINT fk_campers FOREIGN KEY (idReg) REFERENCES region(idReg)
);




INSERT INTO pasi(idPais, nombrePais) values
(1, "Colombia"),
(2, "Peru"),
(3, "Ecuador"),
(4, "Brazil");

INSERT INTO departamento (idDep, nombreDep, idPais) VALUES
(1,"Santander", 1),
(2,"Cundinamarca",1),
(3,"Antioquia",1);

INSERT INTO  region(idReg,nombreReg,idDep) VALUES
(1,"region 1",1),
(2,"region 2",2),
(3,"region 3",2),
(4,"region 4",3),

INSERT INTO  campers(idCamper,nombreCamper,apellidoCamper,fechaNac) VALUES
(1,"camper 1","apellido 1",'2000-02-02',1),
(2,"camper 2","apellido 2",'2000-02-02',2),
(3,"camper 3","apellido 3",'2000-02-02',3),
(4,"camper 4","apellido 4",'2000-02-02',4),