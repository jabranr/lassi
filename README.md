# Lassi [![Build Status](https://travis-ci.org/jabranr/lassi.svg?branch=master)](https://travis-ci.org/jabranr/lassi) [![Latest Stable Version](https://poser.pugx.org/lassi/lassi/v/stable.svg)](https://packagist.org/packages/jabranr/lassi) [![Total Downloads](https://poser.pugx.org/lassi/lassi/downloads.svg)](https://packagist.org/packages/jabranr/lassi) [![Analytics](https://ga-beacon.appspot.com/UA-50688851-1/lassi)](https://github.com/igrigorik/ga-beacon)

PHP boilerplate for quick projects using Slim Framework and Eloquent database.

![Lassi](https://cloud.githubusercontent.com/assets/2131246/10229125/66ff122e-686e-11e5-9351-d6e840c1917b.png)

Lassi is a small PHP boilerplate to use <a href="http://www.slimframework.com/" target="_blank">Slim Framework</a> with <a href="https://github.com/illuminate/database" target="_blank">Eloquent database</a> components &ndash; enabling you to quickly start building your PHP projects with an MVC design pattern and datastore in no time.

> Warnning: Project is in alpha status. For more see [issues tracker](https://github.com/jabranr/lassi/issues).

# Installation and Setup
Install with [composer](http://getcomposer.org) `create-project` command. This will install Lassi and all of it's dependencies i.e. Slim Framework and Eloquent database.

```shell
$ composer create-project jabranr/lassi
```

#### Configuration
Lassi uses `.env` files to setup it's configuration. There is such sample file `.sample.env` packaged with it. Lassi will look for `.dev.env`, `.dist.env` or `.env` respectively at the run time or throws `NotFoundException`.

#### Charset & Collation
By default `.sample.env` file has charset and collation configurations set to `UTF-8 mb4` to support various type of characters encoding. You can update it with your own choice, of course. For more on best encoding practices, read [Working with UTF-8 at PHP: The Right Way](http://www.phptherightway.com/#php_and_utf8).

#### Routing
Use the `routes.php` in root directory to setup routes. You would setup routes as you do in Slim Framework. Afterall it is using Slim Framework in background. For more on setting up routes, see [Slim Framework Documentation](http://docs.slimframework.com/routing/overview/).

#### Structure
**Controllers:** The Controllers are to be saved in `controller/` directory. All Controllers must extend `\Lassi\App\Controller` base controller class and pass the `\Lassi\Lassi` instance to its constructor using `\Lassi\Lassi::getInstance()` method. You can also add relevant Model(s) using `useModel(string|array $model)` method. You can name the controller as you like but do keep up with best practices.

**Models:** All relevant Models are saved in `model/` directory and must extend the `\Illuminate\Database\Eloquent\Model` class. You would use models as you do in Eloquent. For more on setting up models and use other options, see [Eloquent database quick start guide](https://github.com/illuminate/database).

There is an example controller and model in mentioned directories for you to get started with.

**Views:** All views/templates are saved in `view/` directory.

**Assets:** All assets are saved in `public/` directory.

#### Example:

**Create project**

Create a project using Composer `create-project` command and `cd` into project directory.
```shell
$ composer create-project jabranr/lassi
$ cd path/to/lassi
```

**Update configuration**

Update configurations as required in `.dev.env` file.

**Start server**

Start the PHP built-in server and navigate browser to `http://localhost:8000`.
```shell
$ php -S localhost:8000 -t public
```

**Setup routes**

* Add `hello` route

Add a new route `hello` in `routes.php` and try it in browser by navigating to `http://localhost:8000/hello`
```php
$app->get('/hello', function() use ($app) {
	$app->response->write('Hello World');
});
```

* Add `goodbye` route

Add a new route `goodbye` in `routes.php` to render a template. Create a new file `goodbye.php` with basic HTML and save in `/view` directory.

```html
<!DOCTYPE html>
<html>
	<head>
		<title>Lassi goodbye template</title>
	</head>
	<body>
		<h1>Goodbye!</h1>
	</body>
</html>
```

Call this template to render directly from a route's definition or by using a `Controller`.

**Directly from a route's definition**

```php
$app->get('/goodbye', function() use ($app) {
	return $app->render('goodbye.php');
});
```

**Using a controller**

Add a new public method `goodbye()` to `WelcomeController.php` in `/controller` directory.

```php
class WelcomeController extends \Lassi\App\Controller {
	...

	public function goodbye() {
		return $this->app->render('goodbye.php');
	}
}
```

Modify the route's definition to use controller.

```php
$app->get('/goodbye', '\Lassi\Controller\WelcomeController:goodbye');
```

For complete reference, see [Slim Framework documentation](http://docs.slimframework.com/)

#### Using Eloquent

To setup any database connection fill in the required information in relevant `*.env` file.

**Setup SQLite database**

At minimum it requires an absolute URL to SQLite file and `db_driver` value set to `sqlite`.

```shell
db_driver	 = sqlite				(Required)
db_name		 = path/to/foo.sqlite	(Required)
db_prefix	 = lassi_				(Optional)
```

**Setup MySQL, SQL, MSSQL or Sybase database**

```shell
db_driver	 = mysql		(Required)
db_host		 = localhost	(Required)
db_name		 = lassi		(Required)
db_username	 = root			(Required)
db_password	 = p@ssword		(Required)
db_prefix	 = lassi_		(Optional)
```
Using Eloquent is straight forward after a connection is established. To learn more on how to use Eloquent, see [Official Eloquent Documentation](http://laravel.com/docs/5.1/eloquent).

**Create a table using Eloquent**

You can use the `\Illuminate\Database\Capsule\Manager::schema()` method to setup database migrations. Here is an example to create a `lassi_users` table.

```php
class WelcomeController extends \Lassi\App\Controller {
	...

	public function makeUserTable() {
		\Illuminate\Database\Capsule\Manager::schema()->create('users', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamps();
		});
	}
}
```

Calling `\Lassi\Controller\WelcomeController->makeUserTable()` will create a new table in database.

A model can be added to a controller using `useModel()` method in controller's constructor i.e.

```php
class WelcomeController extends \Lassi\App\Controller {
	public function __construct() {
		parent::__construct(\Lassi\Lassi::getInstance());
		$this->useModel('user');
	}
}
```

or it can directly be accessed using `\Lassi\Model` namespace i.e.

```php
class WelcomeController extends \Lassi\App\Controller {
	...

	public function create() {
		$user = new \Lassi\Model\User;
		$user->name = 'Jabran Rafique';
		$user->email = 'hello@jabran.me';
		$user->save();
	}
}
```

Getting info from Eloquent and pass it to template.

```php
class WelcomeController extends \Lassi\App\Controller {
	...

	public function goodbye() {
		$user = \Lassi\Model\User::find(1);
		return $this->app->render('goodbye.php', array('user' => $user));
	}
}
```

# Issue tracking
Please report any issues to [repository issue tracker](https://github.com/jabranr/lassi/issues).

# Contribution
I would love to get some help and extend this boilerplate further so it can be useful to a vast audience. If you think you can improve the boilerplate then fork the project and submit pull request at your convenience.

# License
MIT License
&copy; 2015 Jabran Rafique | [@jabranr](https://twitter.com/jabranr)
