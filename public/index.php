<?php

/**
 * Lassi - Small PHP framework for quick apps based on Slim and Eloquent
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

/**
 * Define app root path
 */
define('ROOT', dirname(dirname(__FILE__)));

/**
 * Set datetime defaults
 */
date_default_timezone_set('UTC');

/**
 * Load dependencies
 */
require ROOT . '/vendor/autoload.php';

/**
 * Bootstrap boilerplate
 */
require ROOT . '/bootstrap.php';

