# CRUD en Laravel con Artisan y Controller Resource

Como objetivo tenemos crear CRUD (Create,Read,Update and Delete data) para la base de datos de un colegio utilizando la herramienta de línea de comando de Laravel Artisan y aprovechando las ventajas de utilizar un controlador de tipo **resource**.
                    
## Creando la aplicación
Iniciamos creando la aplicación Laravel usando Composer, pero antes crea una base de datos en tu servidor MySQL/MariaDB y llámala **school**. Para crear la aplicación Laravel ejecutamos en una terminal desde la carpeta raíz web:

```
composer create-project --prefer-dist laravel/laravel school
```

Donde:

**school**: nombre de la carpeta donde instalaremos la aplicación.

Para ejecutar esta acción debes tener Composer instalado y colocado en el PATH de tu sistema si estas en Windows, o de instalarlo en el directorio /usr/local/bin si estas en Linux para instalar Composer de manera global, también en este caso es posible instalar Composer en su directorio actual y ejecutarlo de manera local a través del comando ./composer.phar.

Luego configuremos el archivo .env de la aplicación para hacer uso de la base de datos inicialmente creada. Listo todo lo anterior comenzamos creando el modelo Eloquent de la aplicación al que nombraremos **CrudSchool**, y para crearlo utilizamos la siguiente línea de comando:

```
php artisan make:model CrudSchool -m 
```

Con la opción -m le decimos a Laravel que además de crear el modelo nos genere al mismo tiempo la migración, seguido añade los campos que vamos a necesitar dentro del método Schema::create del archivo de migración que generó el sistema yyyy_dd_mm_134703_create_crud_schools_table.php de la siguiente forma:

```
public function up() 
{ 
  Schema::create('crud_schools', function (Blueprint $table) 
  { 
    $table->id();
    $table->string(‘name’); 
    $table->timestamps(); 
  }); 
}
```

También añadiremos los campos **protected** $table y $fillable en el archivo del modelo que nos generó el sistema app/Models/CrudSchool.php.

```
class CrudSchool extends Model
{
  use HasFactory;
  protected $table = 'crud_schools';
  protected $fillable = ['name'];	
}
```

Después de crear la definición de la migración, todo lo que tenemos que hacer es migrar para crear las tablas en nuestra base de datos. Para migrar, ejecuta:

```
php artisan migrate
```
Habiendo creado nuestra tabla de migración con la estructura de datos y el modelo, podemos entonces comenzar a crear operaciones CRUD, como lo que buscamos es probar acciones CRUD no es necesario que la tabla esté prellenada con datos de muestra por lo que no vamos a crear factories ni seeds.

Entonces nos vamos directo a crear el controlador. Para crear un controlador, usamos el comando make:controller seguido del nombre del controlador. Para asociar el controlador con un modelo, usa el indicador -m o --model seguido del nombre del modelo.

```
php artisan make:controller CrudSchoolController --resource --model=CrudSchool
```
Utilizamos la opción --resource para indicarle al sistema que nuestro controlador será de tipo **resource**.

Lo siguiente es registrar las rutas tipo **resource** en el archivo de rutas de la aplicación routes/web.php. Para registrar todas las rutas CRUD editamos el archivo anterior añadiendo.

Al inicio:

```
use App\Http\Controllers\CrudSchoolController;
```
Luego, al final:

Route::resource('crud_schools', CrudSchoolController::class);

## Diseñando vista del método Create

En este apartado nuestra filosofía de convención es crear una carpeta que nombraremos con el nombre del modelo, en nuestro caso crudschool.Esta carpeta estará ubicada dentro de resources/views, y en ella ubicaremos las vistas CRUD correspondientes a este modelo.

La vista para el método Create llevará por nombre create.blade.php y quedará así:

```
@extends('layouts.app')
@section("content")
	<div class="row">
		<div class="col-12">
			<form method="POST" action="{{route("crud_schools.store")}}">
				@csrf
				<div class="form-group">
					<label class="label fw-bold">Nombre</label>
					<input required autocomplete="off" name="nombre" class="formcontrol fw-light" type="text" placeholder="Escriba nombre">
				</div>
				</br>
				<button class="btn btn-success">Guardar datos</button>
				<a class="btn btn-primary" href="{{route("crud_schools.index")}}">Volver atrás</a>
			</form>
		</div>
	</div>
@endsection
```
Entonces actualizamos el método Create en el controlador para incorporar la llamada a la vista de la siguiente forma:

```
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      // 
      return view('crudschool.create'); 
   }
```
Dentro de nuestro CrudSchoolController.php en el método store() implementaremos el código para guardar la información directamente desde el formulario a la base de datos, es decir, a partir de los campos que tiene el formulario guardar el modelo en la base de datos en una sola línea.

```
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
      (new CrudSchool($request->input()))->saveOrFail();
      return redirect()->route("crudschool.index")->with(["mensaje" => "El grado ha sido creado",]); 
   }
```
Con el método index listaremos todos los registros almacenados en la base de datos y desde donde tendremos acceso a todas las operaciones CRUD que estamos creando. Como siempre primero vamos a diseñar la vista en index.blade.php para luego pasar a la definición del método en el controlador.

La vista la encontrarás en la carpeta resources/views/crudschool. La definición del método index quedaría así:

```
  /** 
  * Display a listing of the resource. 
  * 
  * @return \Illuminate\Http\Response 
  **/ 
  public function index() 
  { 
      return view(“crudschool.index”, [“crud_schools”=>CrudSchool::all()]); 
  }
```

Bien, hasta aquí hemos finalizado con el diseño y definición del método Create para añadir nuevos registros a la base de datos, así como el diseño y definición del método **Index** que como ya sabemos se encarga de leer (Read) y listar todos los registros almacenados en la base de datos.

Restaría diseñar vistas y definir métodos para las dos operaciones CRUD que nos quedan, **Update** y **Delete**. En ambos casos el proceso es exactamente el mismo que ya hicimos antes, y los archivos para las vistas los encontrarás en la carpeta resources/views/crudschool.

Para realizar la operación **Update** primero hay que ejecutar el método **Edit** que se encarga de mostrar el formulario para editar el registro objetivo de actualización, así que tendrás que diseñar la vista y definir el método en el controlador; luego hay que definir el método **Update** en el controlador que será el que realizará la actualización en sí en la base de datos.

## Instalación

Luego de crear la aplicación como ya hicimos en la primera parte de este tutorial, clone o descargue el proyecto y simplemente sustituya o cargue los archivos creados o modificados a sus respectivas ubicaciones. Recuerde que para visualizar la aplicación en local debe ejecutar en un terminal el comando php artisan serve el cual le entregará la URL y puerto que usará en su navegador.

