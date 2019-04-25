# Manual de instalacion docker

### Puntos a seguir para una correcta instalación

#### Descargas

  * Descargar e instalar Docker [Click aquí](https://docs.docker.com/install/)

#### Instrucciones


Crear una carpeta llamada logs dentro de la raiz del proyecto

    mkdir logs
    
Ejecutar el siguiente comando:

    $ docker-compose up -d --build

Revisar .env donde dice como se llama nuestro docker, en este caso se llaman

    mapfre_cotizador_fully_app
    mapfre_cotizador_fully_mysql
    mapfre_cotizador_fully_myadmin

Copiar las bases de datos descomprimidas dentro de la raiz de la carpeta

Cuando se termine la instalación y creación de los contenedores entrar a admin_mexa_app:

    $ docker exec -it mapfre_cotizador_fully_app bash


Una vez conectado ejecutar la siguiente instrucción

    $ sh postinstall.sh

Entar a mysql con el siguiente comando y crear las base de Datos

    $ mysql -u root -proot -h database
    mysql> create database mapfre_cotizador_full;
    mysql> exit;


Ahora importamos las bases que compiamos anteriormente en la raíz:

    $ mysql -u root -proot -h database mapfre_cotizador_full < mapfre_cotizador_full.sql


Finalmente abrir navegador como:

    http://localhost:8084


Para poder crear archivos para SSL

    $ sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout localhost.key -out localhost.crt
    * Guardarlos en la carpeta certificados_ssl
    * hacer la copia a la máquina de docker
    - LISTO  A DISFRUTA DE NUESTRA CONEXION POR SSL
