<?php

/**
 * Application routes
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

/** Restrict direct access */
defined('ROOT') or die('Unexpected request');

/** Define routes below */
$app->get('/', '\Lassi\Controller\WelcomeController:welcome');
