<?php

/**
 * Lassi - Small PHP framework for quick apps based on Slim and Eloquent
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @version 0.0.2
 * @license MIT License
 */

/**
 * Define app root path
 */
define('ROOT', dirname(__FILE__));

/**
 * Set datetime defaults
 */
date_default_timezone_set('UTC');

/**
 * Load dependencies
 */
require ROOT . '/vendor/autoload.php';

/**
 * Setup Lassi with Slim framework and Eloquent
 */
\Lassi\Lassi::bootstrap();

