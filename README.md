# Frontend Blog Laravel

## Diseñando homepage para blog Laravel 8
Un diseño minimalista pero elegante de página frontend para blog, construído en Laravel 8 con PHP 7.x y base de datos MySQL 5.7. Una forma rápida y sencilla de diseñar de manera funcional nuestra página de inicio para proyectos Laravel. Antes de comenzar, asegúrese de configurar una conexión de base de datos en el archivo de configuración config/database.php de su aplicación en los apartados usuario y contraseña.          

![homepage laravel](imgs/home_laravel.jpg) {.figure}
                    
## Creando la aplicación
Comencemos configurando nuestra aplicación Laravel, previamente debemos haber creado nuestra base de datos MySQL que para nuestro proyecto la llamaremos “Blog”. Para configurar vamos a editar el archivo .env que encontrarás en la carpeta raíz de instalación de Laravel, editaremos APP_NAME para que contenga el nombre de nuestra aplicación, y además DB_DATABASE con el nombre de nuestra base de datos, con estos elementos configurados podemos iniciar la codificación.

Como primer paso vamos a crear un modelo Eloquent ORM , los modelos en Laravel normalmente residen en la carpeta app\Models y extienden la clase Illuminate\Database\Eloquent\Model, así que vamos a esta ubicación y creamos un archivo php con el nombre del modelo, para nuestro proyecto le llamaremos BlogPost.

Desde una terminal usaremos el comando php artisan make:model BlogPost para crear el modelo. No olvidemos que cada modelo que nosotros creamos en Laravel  permite interactuar con una tabla de la base de datos, usando para esto funciones predefinidas en el framework, es decir, es posible recuperar registros, insertar, actualizar y borrar, nosotros no tenemos que construir funciones para estas tareas, solo crear el modelo y listo.

Seguido vamos a crear una migración, la migración es la forma de definir el esquema de la base de datos de la aplicación. Para crear la tabla de migración usaremos el comando php artisan make:migration seguido de la acción “create” más guión bajo y el nombre de la tabla de migración y terminando con **_table**. Por convención si nuestro modelo se nombra BlogPost, entonces el nombre de la tabla de migración la llamaremos **blog_posts**. En cuyo caso el comando quedaría así:

```
php artisan make:migration create_blog_spots_table
```

Este comando creará el archivo create_blog_posts_table.php con un prefijo que va a corresponder con la fecha del día actual. Este archivo en sí lo que va a contener en el método create los campos a definir en la tabla de nuestra base de datos y lo vas a encontrar dentro de la carpeta database/migrations. Para nada es obligatorio realizar este proceso de migración, pero es una forma fácil y muy práctica de definir y compartir la estructura de la base de datos.

El siguiente paso también es opcional, al ser un ejemplo práctico y demostrativo lo que estamos realizando, nosotros lo vamos a requerir, pero es importante que conozca que también es opcional. En cuestión lo que vamos hacer es poblar nuestra tabla con datos, para realizar esta tarea, es necesario hacer una factory y ejecutar un sembrador o seeder. Para realizar una factory usamos el comando make:factory seguido del nombre que le daremos a la clase contenida en el archivo de factory. El archivo resultante lo encontrará dentro de la carpeta database/factory.

Por su parte para crear un sembrador lo haremos ejecutando la herramienta de línea de comandos “Tinker” que creará en nuestro caso las publicaciones de ejemplo y los respectivos usuarios autores o editores de estas publicaciones.

Finalmente nos toca crear el controlador de nuestra aplicación que contendrá los métodos de definición para las acciones que realizará nuestra aplicación, esto lo podemos realizar usando la herramienta de línea de comando make:controller, luego debemos crear las rutas web que se almacenan en el archivo route/web.php, y seguido trabajaremos con las vistas que nos permitirán diseñar nuestra interface de usuario donde desarrollaremos haciendo uso de Blade, el potente motor de plantilla de Laravel.

Hasta aquí un esbozo general del proceso de creación del proyecto diseño de página frontend para blog basado en el framework Laravel. Siéntase libre de descargar, instalar y experimentar.

##Instalación

La forma más simple y cómoda de instalar la aplicación en servidor local de desarrollo es instalando el paquete de Laravel en la carpeta de publicación de su servidor LAMP o WAMP usando  composer y el comando de creación de proyecto de la siguiente forma:

```
Composer create-project --prefer-dist laravel/laravel folder_name
```

Donde:

**folder_name**: nombre de la carpeta donde instalaremos la aplicación.

Luego descargue el proyecto y simplemente sustituya o cargue los archivos creados o modificados a sus respectivas ubicaciones. Recuerde que para visualizar la aplicación en local debe ejecutar en un terminal el comando php artisan serve el cual le entregará la URL y puerto que usará en su navegador.

![homepage laravel](imgs/blog_laravel.jpg) {.figure}
