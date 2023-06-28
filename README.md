# Comandos para la creacion de la base de datos 

Se deben agregar las siquientes tablas en un archivo llamado   " campuslands.sql "

```sql
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
    fechaNac DATE NOT NULL, idReg INT NOT NULL, 
    CONSTRAINT fk_campers FOREIGN KEY (idReg) REFERENCES region(idReg)
);
```



para este proyecto es necesario tener instalado composer. una vez dentro de la carpeta principal ,

se debe ejecurar el siguiente comando en la terminal: 

```bash
composer i
```

para instalar las dependencias necesarias :

```bash
composer update
```



se debe crear un archivo  .env en la ruta    ./config/env/  ( esta ruta es dentro del proyecto)

en esta ruta se debe colocar la siguientes variables de entorno

```.env
HOST= #Aqui va la maquina en la que este la base de datos
DATABASE= # aqui va el nombre de la base de datos
USERNAME= # aqui va el nombre del usuario
PASSWORD= # aqui va el password 
```



para las rutas se esta usando la libreria  bramus/router:  link https://github.com/bramus/router

intalacion

```bash
composer require bramus/router 1.6
```



para las variables de entorno se esta usando la libreria  -> link : 

intalacion: 

```bas
composer require vlucas/phpdotenv
```

