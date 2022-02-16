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