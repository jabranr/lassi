# Lassi
PHP boilerplate for quick projects using Slim Framework and Illuminate Database.

![Lassi](https://cloud.githubusercontent.com/assets/2131246/10229125/66ff122e-686e-11e5-9351-d6e840c1917b.png)

Lassi is a small PHP boilerplate to use <a href="http://www.slimframework.com/" target="_blank">Slim Framework</a> with <a href="https://github.com/illuminate/database" target="_blank">Illuminate Database</a> components &ndash; enabling you to quickly start building your PHP projects with an MVC design pattern and datastore in no time.

> Warnning: Project is in alpha status. For more see [issues tracker](https://github.com/jabranr/lassi/issues).

# Installation and Setup
Install with [composer](http://getcomposer.org) `create-project` command. This will install Lassi and all of it's dependencies i.e. Slim Framework and Illuminate Database.

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

**Models:** All relevant Models are saved in `model/` directory and must extend the `\Illuminate\Database\Eloquent\Model` class. You would use models as you do in `Illuminate/Database`. For more on setting up models and use other options, see [Illuminate Database Documentation](https://github.com/illuminate/database).

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

1. Add `hello` route

Add a new route `hello` in `routes.php` and try it in browser by navigating to `http://localhost:8000/hello`
```php
$app->get('/hello', function() use ($app) {
	$app->response->write('Hello World');
});
```

2. Add `goodbye` route

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

# Issue tracking
Please report any issues to [repository issue tracker](https://github.com/jabranr/lassi/issues).

# Contribution
I would love to get some help and extend this boilerplate further so it can be useful to a vast audience. If you think you can improve the boilerplate then fork the project and submit pull request at your convenience.

# License
MIT License
&copy; 2015 Jabran Rafique | [@jabranr](https://twitter.com/jabranr)
