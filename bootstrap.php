<?php

use Lassi\Lassi;

/**
 * Bootstrap the boilerplate
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

/** Restrict direct access */
defined('ROOT') or die('Unexpected request');

/**
 * Setup Lassi with Slim framework and Eloquent
 */
Lassi::bootstrap();

