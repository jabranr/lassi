<?php

/**
 * Application routes
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 *
 *
 *
 * This is an example route that uses a Controller.
 * Update this route or define new routes below.
 * See Slim documentation to learn more about routes
 * @link http://docs.slimframework.com/routing/overview/
 */

$app->get('/', '\Lassi\Controller\WelcomeController:welcome');
