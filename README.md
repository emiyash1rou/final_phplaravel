# PHP LARAVEL TUTORIAL
- Laravel is an open source PHP Framework.
- PHP is Programming Language/ Laravel is Framework built in PHP.
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
- YOUTUBE LINK <a>https://www.youtube.com/watch?v=AGE3wRKljkw</a>
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
public function show($id)
    {
        // GET
        $guitars= self::getData();
        $index = array_search($id,array_column($guitars,'id'));
        if($index === false){
            abort(404);
        }else{
            return view('guitars.show',[
                'guitars' => $guitars[$index] ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        }
    }
```
