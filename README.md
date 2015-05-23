## MPWAR Framework

### Pasos para instanciar:

1. Clonar repositorio
2. Configurar VirtualHost para entornos de desarrollo y producción (Apache 2.4.7):

  **Desarrollo**
```
<VirtualHost *:80>
  ServerName framework.dev
  
  ServerAdmin webmaster@localhost
  DocumentRoot /path/a/proyecto/public/app_dev.php

  <Directory />
    Require all granted
  </Directory>

  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
  RewriteEngine On
   #Allowed media extensions (includes .txt files for robots or .html, e.g: Google hosted HTMLs):
   RewriteCond %{REQUEST_FILENAME} !^(.+)\.(js|css|gif|png|jpg|swf|ico|txt|html)$
   RewriteRule ^/(.+) /index.php [QSA,L]
</VirtualHost>
```

  **Producción**
```
<VirtualHost *:80>
  ServerName framework.prod
  
  ServerAdmin webmaster@localhost
  DocumentRoot /path/a/proyecto/public/app.php

  <Directory />
    Require all granted
  </Directory>

  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
  RewriteEngine On
   #Allowed media extensions (includes .txt files for robots or .html, e.g: Google hosted HTMLs):
   RewriteCond %{REQUEST_FILENAME} !^(.+)\.(js|css|gif|png|jpg|swf|ico|txt|html)$
   RewriteRule ^/(.+) /index.php [QSA,L]
</VirtualHost>
```
3. Habilitar página para Apache (`a2ensite framework.dev.conf y a2ensite framework.prod.conf`)
4. Reiniciar Apache
5. Agregar en /etc/hosts (o archivo host de su sistema operativo) los dominios `framework.dev` y `framework.prod` para 127.0.0.1.
6. Ejecutar `composer update` en la carpeta del proyecto.
7. Crear base de datos `framework`, crear usuario llamado `framework` en base de datos MySQL con password vacío y darle permisos para la base de datos creada.

  **Comandos:**
```
create database framework;
create user 'framework'@'localhost';
grant all on framework.* to 'framework'@'localhost';

```
8. Ejecutar el script `dump.sql` encontrado en el proyecto en la base de datos `framework`.

Listo!

## Pruebas a realizar

* `http://framework.dev/Home/addItem/:{item}`:agregar un item a la base de datos. `item` es el nombre del item a agregar. Se pueden agregar elementos vacíos.
* `http://framework.dev/Home/getItem/{:id}?extra={:extra}`: obtiene un item de la base de datos a través de su id. Adicionalmente, puedes pasar una variable por la URL llamada extra con algún valor y ésta se renderizará en la página web.
* `http://framework.dev/Home/updateItem/{:oldName}/{:newName}`: actualiza los nombres de los items (oldName) por uno nuevo (newName) de la base de datos. Actualiza todos los que hagan match.
* `http://framework.dev/Home/deleteItem/{:name}`: elimina los items de la base de datos con el nombre name. Elimina todos los elementos que hagan match.
* `http://framework.dev/JsonHome/getJsonItem/{:id}`: obtiene un item de la base de datos con su id y lo devuelve en formato Json. Si no encuentra el item, devuelve false.
* `http://framework.dev/Home/getSmartyItem/{:id}`: obtiene un item de la base de datos con su id y lo devuelve renderizando con Smarty.
* Todas las vistas se renderizan con Twig menos la última que indica que se renderiza con Smarty.
* Si alguna página no se encuentra, el framework dará una página de error personalizada.
