# Lassi
PHP boilerplate for quick apps based on Slim and Eloquent.

Lassi is a small PHP boilerplate to use <a href="http://www.slimframework.com/" target="_blank">Slim Framework</a> with <a href="https://github.com/illuminate/database" target="_blank">Illuminate Database</a> components &ndash; enabling you to quickly start building your PHP apps with a MVC design pattern and datastore in no time.

> Warnning: Project is in alpha status. Use at your own risk.

# Installation
Install with [composer](http://getcomposer.org) as `create-project` command. This will install the Lassi and all of it's dependencies i.e. Slim Framework and Illuminate Database.

```shell
$ composer create-project jabranr/lassi --pref-dist
```

# Configuration
Lassi uses `.env` files to setup it's configuration. There is such sample file `.sample.env` packaged with it. The Lassi will look for `.dev.env`, `.dist.env` or `.env` respectively at run time or throws `NotFoundException`.


# Charset & Collation
By default Lassi's `.sample.env` file has charset and collation set to `UTF-8mb4` to support the maximum type of character encodings. You can update it with your own choice, of course.


# License
MIT License
&copy; 2015 Jabran Rafique | [@jabranr](https://twitter.com/jabranr)