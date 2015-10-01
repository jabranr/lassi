# Lassi
PHP boilerplate for quick projects based on Slim and Eloquent.

Lassi is a small PHP boilerplate to use <a href="http://www.slimframework.com/" target="_blank">Slim Framework</a> with <a href="https://github.com/illuminate/database" target="_blank">Illuminate Database</a> components &ndash; enabling you to quickly start building your PHP apps with a MVC design pattern and datastore in no time.

> Warnning: Project is in alpha status. Use at your own risk. Best to not use for any production project yet.

# Installation and Setup
Install with [composer](http://getcomposer.org) as `create-project` command. This will install the Lassi and all of it's dependencies i.e. Slim Framework and Illuminate Database.

```shell
$ composer create-project jabranr/lassi --pref-dist
```

#### Configuration
Lassi uses `.env` files to setup it's configuration. There is such sample file `.sample.env` packaged with it. The Lassi will look for `.dev.env`, `.dist.env` or `.env` respectively at run time or throws `NotFoundException`.


#### Charset & Collation
By default Lassi's `.sample.env` file has charset and collation set to `UTF-8 mb4` to support the maximum type of character encodings. You can update it with your own choice, of course. For more on best encoding practices, read [Working with UTF-8 at PHP: The Right Way](http://www.phptherightway.com/#php_and_utf8).

#### Structure

**Routing:** Use the `routes.php` in root directory to setup routes. You would setup routes as you do in Slim Framework. Afterall it is using Slim Framework in background. For more on setting up routes, see [Slim Framework Documentation](http://docs.slimframework.com/routing/overview/)

**Controllers:** The Controllers are to be saved in `lassi/controller` directory. All Controllers shall extend the base controller as `\Lassi\App\Controller` and pass the Lassi instance to its constructor using `\Lassi\Lassi::getInstance()` method. You can also add relevant Model(s) using `useModel(string|array $model)` method. You can name the controller anything but do keep up with best practices.

**Models:** All relevant Models are saved in `lassi/model` directory and should extend the `\Illuminate\Database\Eloquent\Model` class. There is an example controller and model in mentioned directories for you to get started with.

**Views:** All views/templates are saved in `lassi/view` directory.

# Issue tracking
Please report any issues to [repository issue tracker](https://github.com/jabranr/lassi/issues).

# Contribution
I would love to get some help and extend this boilerplate further so it can be useful to a vast audience. If you think you can improve the boilerplate then fork the project and submit pull request at your convenience.

# License
MIT License
&copy; 2015 Jabran Rafique | [@jabranr](https://twitter.com/jabranr)