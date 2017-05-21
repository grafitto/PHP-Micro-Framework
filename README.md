# PHP-Micro-Framework
A PHP Micro Framework i created to help me concentrate on the features of my PHP projects as rather than concentrating on PHP details.

Lets begin with the folder structure:

```
|--PHP-Micro-framework
    |--env.php
    |--routes.php
    |--app
        |--dirs.php
        |--init.php
        |--core
            |-- Core files needed by the framework
        |--handlers
            |--All controllers are found here
        |--views
            |--All views are found here
    |--public
        |--.htaccess
        |--index.php
        |--css
            |--All css files
        |--js
            |--All js files
        |--images
            |--All image files
        |--fonts
            |--All fonts
```

#### START THE SERVER

Let us use `php` built-in server to start  

`php -S localhost:8080 -t path\to\PHP-Micro-framework\public` will start a serve in the public folder  

### BASIC HTTP REQUEST LIFE-CYCLE

Assuming `localhost:8080\my\request` is made, it is converted to `localhost:8080\index.php?url="\my\request"`  
The application then uses the `ROUTES` variable in `/PHP-Micro-framework/routes.php` to find an array that its first value matches 
the `url GET` value in the request. The second value of the array found is then used to load a handler of the same name in the handlers 
folder. If the request was a `GET` request, the `get`method of that handler is called, likewise if the request was a `post` request, the post method is called.

**Example:** 

Assume there is `["^account\/login\/?$", "Login"]` array in `ROUTES`  
If a request `localhost:8080\account\login` is made, a file named *loginhandler.php* is required in the project from `/PHP-Micro-framework/app/handlers`, then an object of class
`LoginHandler` is created. This assumes that the file *loginhandler.php* contains a class called `LoginHandler`.  
If the request was a `GET` request then the method `get` is called in `Loginhandler` class, the same goes for `post` requests.

## CREATING CUSTOM HANDLERS

A handler handles the logic of the app.

### Create the handler file and class  
A handler is a class found in a file inside the `handlers` folder. The filename should be the name of the handler with word *handler* appended to it.

Example: Assuming you want to create a handler called 'user'
1. Create a file called `userhandler.php` in `handlers` folder
2. In the file `userhandler.php` create a class called `UserHandler`

```php
    class Userhandler extends requestHandler{
        public function get(){
            //This method is called incase of a get request
        }
        public function post(){
            //This method is called incase of a post request
        }
    }
```
**Notice:** The class extends a base class `requestHandler` which has base functions  
These functions include:

Method Name | Description
------------ | -------------
`getVar(name[,default])` | return `GET` variable named `name(String)`, optional `default` is the default value returned if the named value is not found 
`getAll([default])` | returns an Array of all `GET` variable if any, and optional `default` if none available.

A function `oncreate` is also called on all handlers before any other method is called. This `onCreate` method can be used for setup. For example, it can be used to restrict a handler to only a logged in user.
Actually there is a `loggedInHandler` in *core* folder used to restrict a handler from being accessed by a user who is not logged in.

```php
class Userhandler extends LoggedInHandler{
    //Code goes here
}
```
This redirects to login page if the user is not logged in before any action is performed on the handler.

### Register a URL to the handler

After creating a handler, you need to define the *URL* that is used by the handler.  
In *routes.php* add an Array `["^\/user\/?$","User"]`  
`"^\/user\/?$"` is a regular expression that the actual request Url is checked against, if the Url matches the expression, `"User"`
handler is loaded and the appropriate method is called either `post` or `get`

**Note:**
you can explicitly declare the method to be called using the _`@`_ notation i.e. _`User@handleRequest`_ calls the `handleRequest` method in `UserHandler` irregardless of the request method.

## CREATING MODELS

A model is a representation of the MySQL database table.  
**All the models should be in the *`models`* folder**

The `filename, classname` of a model should be the same as the name of the MySQL table its representing     

**Example:**
Assuming you have a MySQL table named `user` with fields `id, full_name, user_name, age, password`

A model representing that table should look like:

```php
class User extends Model{
    public $id;
    public $full_name;
    public $user_name;
    public $age;
    public $password;
}

```
Note:
 1. The file name and MySQL table name should have the same name as the model class.
 2. All attributes should have the same names as the column names of the MySQL table being represented.
 3. The MySQL table being represented **must** have a column named `id` which is a `primary key and auto increments` this column is used for query operations.
 4. The `id` attribute in a model **MUST NOT** be altered.

All user-defined models extend a base class `Model`. `Model` contains the necessary methods     
These methods include:

Method Name | Description
------------|------------
`find(id[,tablename])` | A static method. Finds a record by `id` provided and returns an Object based on the tablename(if provided) or the class name used to invoke the method.
`get(name,value)` | Gets a record where the value in the column `name` matches the `value` provided.
`clear()` | Deletes the record associated to that object from the database. This action is irreversible.
`hasOne(modelname)` | This is a one to one relationship where the object which this method was called has one relationship with the model having the model name provided. We will revisit this later.
`belongsTo(modelname)` | This returns an instance of the `modelname` provided that owns the object which this method is invoked. We will revisit this later.
`hasMany(modelname)` | This is a one to many relationship. Returns an Array of objects of type `modelname` which belongs to the Object this method was invoked. We will revisit this later.
`toArray()` | Returns an associative array of the attributes of `this` model as keys and value pairs with their values.
`toJSON()` | Returns a JSON string of the attributes of this object with their values.

### Revisit: hasOne method

**Example:**

Using the `user` model created earlier, lets assume that the user can only have a single article in their account.
then:

```php
class User extends Model{
    public $id;
    public $full_name;
    public $user_name;
    public $age;
    public $password;
    public $article_id;

    public function article(){
        //This returns an object of type article here article id == $this->article_id
        return $this->hasOne("Article");
    }
}
```
hasOne method uses the ***modelname**_id* attribute in the calling object to fetch the required model.

### Revisit: BelongsTo method

**Example:**
Using the user model created earlier, we assume that a user owns an article.
We wold have an article model:

```php
class Article extends Model{
    public $id;
    public $title;
    public $content;
    public $created_at;
    public $user_id;

    public function writer(){
        //This returns an object of type user where user id == $this->user_id
        return $this->belongsTo("User");
    }
}
```
### Revisit: hasMany method

**Example:**
Using the user model created earlier, we assume that a user can have many articles.
We wold have an article model:

```php
class User extends Model{
    public $id;
    public $full_name;
    public $user_name;
    public $age;
    public $password;

    public function writer(){
        //This returns an array of objects of type articles where articles user_id == $this->id
        return $this->hasMany("Article");
    }
}
```
### Still working on the documentation...

## Contribute?
Fork it!  
Create your feature branch: `git checkout -b my-new-feature`  
Commit your changes: `git commit -m 'Add some feature'`  
Push to the branch: `git push origin my-new-feature`  
Submit a pull request :D

