# PHP LARAVEL TUTORIAL
- Laravel is an open source PHP Framework.
- PHP is Programming Language/ Laravel is Framework built in PHP.
- [ Youtube Link : <a>https://www.youtube.com/watch?v=AGE3wRKljkw</a> ]
## Laravel Advantages
1. Advantages - Login Authentication.
2. Simple API Drivers
3. Faster
4. Security Risk(sql Injection, crosshead)
## Disadvantage
- Good to use but not rly good as npm
- Bad support
- Bad updates.
#### Install Laravel on Composer
- composer global require laravel/installer
1. ```laravel new first-app ```
2. ```cd first-app ```
3. ``` composer i ```
#### PHP uses MVC Model
1. M- Model
2. V - view
3. C - controller.
#### Routes can return everything.
#### Query Strings
URL's
1. /store : general store landing page.
2. /store?category=guitars : A query String.
3. Never trust user input
#### Protection from injection.
```
Route::get('/store', function() {
    $category=request('category');
    return "you are viewing store".strip_tags($category);
    });
```
- Strip tags allow you to display text inside of strip tags that prohibit injecting scripts.
# TIP: Always sanitize inputs.
## PHP NOTES
### Query String Alternative.
-    Normally, routes are this ``` (Route::get('/store/{category}/{item}', function($category,$item) {' ``` but this will only apply if the category and item will show and has values. It will error when category or item is not defined. Instead make the routes have a default value and can catch null segment links(a segment is an instance of this /category, /item). ``` Route::get('/store/{category?}/{item?}', function($category=null,$item=null) { ```
- to access this you will ``` http://localhost:8000/store/shoes/lol ```
# Model View Controllers. Classes that have methods, action methods, handles request.
### Make A controller
- ```php artisan make:controller [controller_name] ```
- Create your controller different routes 
```
class HomeController extends Controller
{
   public function index(){
    return view('welcome');
   }
   public function about(){
    return view('about');
   }
   public function contact(){
    return view('contact');
   }
}
```
- In web.php import the controller in the top ``` use App\Http\Controllers\HomeController; ```
- And write the simple code in route. ``` Route::get('/',[HomeController::class,'index']); ```
### Stopped at 44:09
# Continued
#### Layouts
- allow the user to have a fixed template as a part of the html.
- lessens code and organizes sections.
- Specialized view that contains all the layout.
How?
1. Create a layout view in views folder.
2. Use a directive called ```@extends('layout') ```
```
//denote a section by doing 

@section('content')
<html files>
@endsection
```
3. Then indicate a target where the section will appear/insert using 
```
@yield('content') 
```
- and then in your php specific htmls, put a value by saying this
```  @section('title',"About Us") ```

#### VALID AND CORRECT URLS;
- ``` $app = require_once __DIR__.'/../bootstrap/app.php'; ``` isn't the bootstrap css framework but it is the bootstrapping the application. Index.php is the entry point of our application. Handling the file. VERY IMPORTANT FILE DONT SCREW IT UP.

#### PUBLIC FOLDER AND STATIC FILES
- Go to public folder and then css.
- Create file called site.css to organize css.
- Access public files using 
``` 
        <link rel="stylesheet" href="{{ url('css/site.css') }}"> 
```
- Always Use <b>url</b> in getting public files.

# <b> NOTE: PLEASE BE MINDFUL OF THE SPACES, NOTICE THE {{ HAS SPACES }} </b>

### For our routes = URL validation
1. Name your routes in web.php by using ``` -->name('home.index'); ```
- for instance, code from web.php
```
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/about/about',[HomeController::class,'about'])->name('home.about');
Route::get('/contact',[HomeController::class,'contact'])->name('home.contact');
```
2. In your html/php file. Call your named route by doing this on hrefs. 
<i> In navbar</i>
```
   <div class="relative p-4">
            <a href="
            {{ route('home.index') }}
            ">Home</a>
            <a href="  {{ route('home.about') }}">about</a>
            <a href="  {{ route('home.contact') }}">contact</a>
        </div>
```

- TIP: ROUTES NEED TO HAVE UNIQUE NAMES
### Resource Controllers
1. Create A Resource Controller by doing ``` php artisan make:controller GuitarsController --resource ```
2. Go to your HTTP Controllers File and you should see the controller file der.
- A resource is a single type of data where that your application is going to work with.
- Controller contains the action methods when acting on that resource.
- Examples: CRUD. A resource controller is responsible for CRUDDING a resource.
<i> Think of it like an object </i>

- PARTS OF A RESOURCE CONTROLLER
- INDEX : VIEW THE WEBSITE
- CREATE : GET REQ TO CREATE GUITARS
- STORE: POST REQUEST TO SAVE THE CREATE GUITARS
- EDIT: GET REQ TO EDIT GUITARS
- UPDATE: POST REQ TO STORE UPDATED GUITARS PUT OR PATCH AS WELL
- DESTROY: DELETE REQ
- SHOW : SHOW APPROPRIATE GUITAR WHICH IS GET

#### TO ORGANIZE VIEWS.
1. create a folder inside views. 
2. create blade.php file.
3. In the controller, dig deeper by indicating the folder and file for instance ```  return view('guitars.index'); ```
4. Route it by going to web.php
```
use App\Http\Controllers\GuitarsController;
// Dont forget to import your controller then

Route::resource('guitars',GuitarsController::class);

// so what resource does is that: guitars is its root link and function that 
// are on it will be /guitars/index , /guitars/create. It automatically do that
```
5. Go to your navbar which is in headers to add a link to bridge guitars page.
```  <a href="  {{ route('guitars.index') }}">Guitars</a> ```

### PASSING DATA TO VIEWS.
1. For now, use a static data, put it inside the resource controller. 
```
  private static function getData(){
        return [
            ['id' =>1, 'name' =>'American Standard Strat', 'brand' => 'Fender' ],
          ['id' =>1, 'name' =>'Starla', 'brand' => 'PRS' ],
          ['id' =>1, 'name' =>'Mer', 'brand' => 'kun' ],
          ['id' =>1, 'name' =>'Merhamdin', 'brand' => 'kon' ]
        ];
    }
```
2. To pass data do this
```
 return view('guitars.index',[
                'guitars' => self::getData() ,
                'userInput' => '<script>alert("hello")</script>' ]  );
```
3. Access array values in html. ``` @foreach () @endforeach ```
- Example 
```
@if (@isset($guitars))
    

<table>
    <tr>
        <th>Guitar</th>
        <th>brand</th>
    </tr>


@foreach ($guitars as $guitar)

    <tr>
      <td> {{ $guitar['name'] }} </td>
      <td> {{ $guitar['brand'] }} </td>
    </tr>

@endforeach
@else
<h1> No record currently</h1>
@endif  
```
- Code checks if record is found, if found, create a table else print an empty statement.
#### SHOW METHOD
1. Has a unique identifier, an integer value.
```
public function show($guitar)
    {
        // GET
        $guitars= self::getData();
        $index = array_search($guitar,array_column($guitars,'id'));
        if($index === false){
            abort(404);
        }else{
            return view('guitars.show',[
                'guitars' => $guitars[$index] ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        }
    }
```
2. Href the route by doing this on your button ``` {{ route('guitars.show',['guitar' => $guitar['id'] ]) }}```
### DATABASE CONNECTION.
1. Make sure db xampp is running. 
2. Go to vendor/.env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=first_app
DB_USERNAME=root
DB_PASSWORD=
```
3. It also handles other database connection by accesssing config/database.php to view what it needs to get.

#### Creating Tables in Php Artisan and run migrations.
- Versioning the database.
- Ability to make changes to db safely and rollback.
1. Create a migration, changing structure to db. 
``` 
php artisan make:migration --help
php artisan make:model --help
```
2. Do this. A class is a singular noun.
``` php artisan make:model Guitar --migration ```
3. Go to database folder and migraitons to see migrations files.
4. Only undo what you did from up. Up creates, down function is undoing = create_guitars_table
- ``` $table->timestamps(); ``` creates two tables. First table is datetime first created, second is when it was modified.
 5. Now create everything else for the table contents.
 6. Look at Models table to ensure that there is a class. Notice that it extends to model and has eloquent directory. Eloquent is working with data within a relational database. Eloquent is ORM to interact with our data.
7. In your Controller. If you need the model import it on the top using ``` use App\Models\Guitar; ``` in my case I have it inside GuitarController
8. Commit it by running migration.
 ```
  migrate
  migrate:fresh         Drop all tables and re-run all migrations     
  migrate:install       Create the migration repository
  migrate:refresh       Reset and re-run all migrations
  migrate:reset         Rollback all database migrations
  migrate:rollback      Rollback the last database migration
  migrate:status        Show the status of each migration
``` 
8. ```php artisan migrate ``` since it is a new project. Look at mysql to see changes.

### Forms 
1. Implement Create method in Guitar.
- ```  return view('guitars.create'); ```
2. Create the view and TAKE NOTE, add an action on the form which indicates the route of the current page. Enables to identify the target route for the post request ``` <form method="POST" action={{ route('guitars.store') }}> ``` 
3. Create new instance of guitar with properties assigned. In GuitarsController.store

```
  public function store(Request $request)
    {
        // POST
        $guitar=new Guitar();
        $guitar->name= $request->input('guitar-name');
        $guitar->brand= $request->input('brand');
        $guitar->year= $request->input('year-made');
        $guitar->save();
        return redirect()->route('guitars.index');
    }
```
4. Then change the static into a dynamic, reading the database by calling the model Guitar.
```
 public function index()
    {
        return view('guitars.index',[
                'guitars' => Guitar::all() ,
                'userInput' => '<script>alert("hello")</script>' ]   );

        // for displaying all of the guitars in database. GET
    }
```
#### PAGE EXPIRED 
1. Post request change something on server. 
2. Attackers might take advantage of the request to our aplication. If not careful, execute the request.( Cross Site Request Forgery, CSRF) is a fix. add this to every form . ``` @csrf ```
3. Change all instances that guitar refers to static and use ``` $guitars = Guitar::all(); ``` to be able to get the data from database.
```
  public function show($guitar)
    {
        // GET
        $guitars = Guitar::all()->toArray();
        $index = array_search($guitar,array_column($guitars,'id'));
        if($index === false){
            abort(404);
        }else{
            return view('guitars.show',[
                'guitars' => $guitars[$index] ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        }
    }
```
#### VALIDATE USER INPUT
<h1> Never Trust User Input</h1>
1. Put strip_tags in getting input from users.
<h1> Client side can easily be circumvated. Easy inspect element on inputs. </h1>

2. Laravel has easy validate methods
```
$request->validate([
    'guitar_name' =>'required',
    'brand' =>'required',
    'year' => ['required','integer']
// this will be located in store method of GuitarsController
])
```
3. Print the error whenever validation errors by going to the views file and adding a directive. Do this at any point in your views.
```
@error('guitar-name')
<div class="form-error">
{{ $message }}
@enderror
```
4. Use a function to get the old value by using old function ```       <input type="text" class="form-control" id="guitar-name" value="{{ old('guitar-name') }}" name="guitar-name" aria-describedby="emailHelp" placeholder="Enter name"> ```

### UPDATING VALUES
1. Go to show individual guitar view
```
    public function show($guitar)
    {
        // GET
      
            return view('guitars.show',[
                'guitars' => Guitar::findorFail($guitar)->toArray() ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        
    }
```
<h2> findorFail is an ez code for finding a id else error</h2>

2. Go to edit method and copy show method code. Then create a view directory.
3. In your view directory change values into the variable guitars['name'] etc. this ensures that the beginning text will be the value.
4. Edit the view route which you need to have it as a PUT request. But PUT isn't really used so there is a fix for laravel for this. 

```
<form method="POST" action={{ route('guitars.update',['guitar'=> $guitar->id]) }}>
    @csrf
    @method('PUT')
```

5. Put this on update method.
```
public function update(Request $request, $guitar)
    {
        // POST, PUT OR PATCH
        $record=Guitar::findorFail($guitar);
        echo var_dump($record);
        

        $request->validate([
            'guitar-name' =>'required',
            'brand' =>'required',
            'year-made' => ['required','integer']
        
        ]);
    
        $record->name= strip_tags($request->input('guitar-name'));
        $record->brand= strip_tags($request->input('brand'));
        $record->year_made= strip_tags($request->input('year-made'));
        $record->save();
        return redirect()->route('guitars.show',$guitar);
    }
```
### CLEAN UP CODE
1. Access GuitarController to find repetitive codes.
2. Use model guitar as type end for parameter. Laravel is gonna take the id from url and try to automatically find the db.
```
public function show(Guitar $guitar)
    {
        // GET
      
            return view('guitars.show',[
                'guitars' => $guitar->toArray() ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guitar $guitar)
    {
        // GET 
        return view('guitars.edit',[
            'guitars' =>  $guitar->toArray() ,
            'userInput' => '<script>alert("hello")</script>' ]   );
    }
    //Notice the show(Guitar $guitar), Guitar is defined having $guitar as it's variable.
```
3. Doing stripping tags in one place and eliminate repetiton.
- Request type in ```  public function store(Request $request) ``` Request allows us to handle custom request that will be used to handle guitar form request.
- Do this by making a request form ``` php artisan make:request GuitarFormRequest ``` that will generate a new class for us that will allow us to validate info and work with request data before we validate it.
- Access Request folder in App/Http/Requests
#### RequestForm
- By default, there are two methods
1. Authorize - edit return to True to authorize yourself
2. Rules - exact same rules that we do in this code 
```   
$request->validate([
    'guitar-name' =>'required',
    'brand' =>'required',
    'year-made' => ['required','integer']
        
        ]); 
```

3. Strip out tags by implementing a method called ```    
protected function prepareForValidation(){
        $this->merge([
            'guitar-name'=>strip_tags($this['guitar-name']),
            'brand' => strip_tags($this->brand),
            'year_made' => strip_tags($this['year-made']),

        ]);
    }

 } ```

4. Put a type end ``` GuitarFormRequest ``` in request and create a variable that contains the GuitarFormRequest validated data ``` $data = $request->validated(); ```
- Validate is a method that we just replaced. Validated and validate is different.
5. In GuitarFormRequest, addd prepareForValidation, this ensures that request input with the name guitar-name, brand and year-made are cleaned.
```
    protected function prepareForValidation(){
        $this->merge([
            'guitar-name'=>strip_tags($this['guitar-name']),
            'brand' => strip_tags($this->brand),
            'year-made' => strip_tags($this['year-made']),

        ]);
    }
```
6. Don't forget to use typend in the form requests. 
```    public function update(GuitarFormRequest $request, Guitar $guitar) // notice the GuitarFormRequest ```
7. Update the code of Controller 
```
    public function store(GuitarFormRequest $request)
    {
        $data = $request->validated();
        // POST
     
        $guitar=new Guitar();
        $guitar->name= $data['guitar-name'];
        $guitar->brand= $data['brand'];
        $guitar->year_made= $data['year-made'];
        $guitar->save();
        return redirect()->route('guitars.index');
    }
```
### MASS ASSIGNMENT
- Doing assignments all at once.
- PREREQUISITES: KEYS NEED TO BE THE SAME AS COLUMNS IN THE DATABASE.
- What this does is that shrinks the code but form names and database names must be same.
- NOTE: Very Dangerous
- Before mass assignment 
```
    public function store(GuitarFormRequest $request)
    {
        $data = $request->validated();
        // POST
        Guitar::create($data);
        $guitar=new Guitar();
        $guitar->name= $data['guitar-name'];
        $guitar->brand= $data['brand'];
        $guitar->year_made= $data['year-made'];
        $guitar->save();
        return redirect()->route('guitars.index');
    }
```
- After 
```

```
- Didn't Finish The Mass Assignment as it is dangerous.
# PHP Artisan Manual
Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output      
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under  
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  clear-compiled        Remove the compiled class file
  completion            Dump the shell completion script
  db                    Start a new database CLI session
  down                  Put the application into maintenance / demo mode
  env                   Display the current framework environment     
  help                  Display help for a command
  inspire               Display an inspiring quote
  list                  List commands
  migrate               Run the database migrations
  optimize              Cache the framework bootstrap files
  serve                 Serve the application on the PHP development server
  test                  Run the application tests
  tinker                Interact with your application
  up                    Bring the application out of maintenance mode 
 auth
  auth:clear-resets     Flush expired password reset tokens
 cache
  cache:clear           Flush the application cache
  cache:forget          Remove an item from the cache
  cache:table           Create a migration for the cache database table
 config
  config:cache          Create a cache file for faster configuration loading
  config:clear          Remove the configuration cache file
 db
  db:seed               Seed the database with records
  db:wipe               Drop all tables, views, and types
 event
  event:cache           Discover and cache the application's events and listeners
  event:clear           Clear all cached events and listeners
  event:generate        Generate the missing events and listeners based on registration
  event:list            List the application's events and listeners   
 key
  key:generate          Set the application key
 make
  make:cast             Create a new custom Eloquent cast class       
  make:channel          Create a new channel class
  make:command          Create a new Artisan command
  make:component        Create a new view component class
  make:controller       Create a new controller class
  make:event            Create a new event class
  make:exception        Create a new custom exception class
  make:factory          Create a new model factory
  make:job              Create a new job class
  make:listener         Create a new event listener class
  make:mail             Create a new email class
  make:middleware       Create a new middleware class
  make:migration        Create a new migration file
  make:model            Create a new Eloquent model class
  make:notification     Create a new notification class
  make:observer         Create a new observer class
  make:policy           Create a new policy class
  make:provider         Create a new service provider class
  make:request          Create a new form request class
  make:resource         Create a new resource
  make:rule             Create a new validation rule
  make:scope            Create a new scope class
  make:seeder           Create a new seeder class
  make:test             Create a new test class
 migrate
  migrate:fresh         Drop all tables and re-run all migrations     
  migrate:install       Create the migration repository
  migrate:refresh       Reset and re-run all migrations
  migrate:reset         Rollback all database migrations
  migrate:rollback      Rollback the last database migration
  migrate:status        Show the status of each migration
 model
  model:prune           Prune models that are no longer needed        
 notifications
  notifications:table   Create a migration for the notifications table optimize
  optimize:clear        Remove the cached bootstrap files
 package
  package:discover      Rebuild the cached package manifest
 queue
  queue:batches-table   Create a migration for the batches database table
  queue:clear           Delete all of the jobs from the specified queue
  queue:failed          List all of the failed queue jobs
  queue:failed-table    Create a migration for the failed queue jobs database table
  queue:flush           Flush all of the failed queue jobs
  queue:forget          Delete a failed queue job
  queue:listen          Listen to a given queue
  queue:monitor         Monitor the size of the specified queues      
  queue:prune-batches   Prune stale entries from the batches database 
  queue:prune-failed    Prune stale entries from the failed jobs table  queue:restart         Restart queue worker daemons after their current job
  queue:retry           Retry a failed queue job
  queue:retry-batch     Retry the failed jobs for a batch
  queue:table           Create a migration for the queue jobs database table
  queue:work            Start processing jobs on the queue as a daemon route
  route:cache           Create a route cache file for faster route registration
  route:clear           Remove the route cache file
  route:list            List all registered routes
 sail
  sail:install          Install Laravel Sail's default Docker Compose 
file
  sail:publish          Publish the Laravel Sail Docker files
 schedule
  schedule:clear-cache  Delete the cached mutex files created by scheduler
  schedule:list         List the scheduled commands
  schedule:run          Run the scheduled commands
  schedule:test         Run a scheduled command
  schedule:work         Start the schedule worker
 schema
  schema:dump           Dump the given database schema
 session
  session:table         Create a migration for the session database table
 storage
  storage:link          Create the symbolic links configured for the application
 stub
  stub:publish          Publish all stubs that are available for customization
 vendor
  vendor:publish        Publish any publishable assets from vendor packages
 view
  view:cache            Compile all of the application's Blade templates
  view:clear            Clear all compiled view files