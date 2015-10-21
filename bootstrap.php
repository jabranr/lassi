<?php

/**
 * Bootstrap the boilerplate
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

/**
 * Restrict direct access
 */
defined('ROOT') or die('Unexpected request');

/**
 * Set datetime defaults
 */
date_default_timezone_set('UTC');


/**
 * Load configuration from .dev.env | .dist.env | .env
 */
Lassi\App\Util::setupEnvironment(ROOT);

/**
 * Set Lassi\Lassi instance
 */
$lassi = Lassi\Lassi::getInstance(ROOT);

/**
 * Set Slim\Slim instance
 */
$app = $lassi->getApp();

/**
 * Add base URL to all views for assets management
 */
$app->hook('slim.before', function() use ($app) {
	$app->view()->appendData(array(
		'baseUrl' => getenv('base_url')
		)
	);
});

/**
 * Load routes
 *
 * @throws Lassi\App\Exception\ResourceNotFoundException
 */
$routes = $lassi->getBase() . '/routes.php';
if (!file_exists($routes) || !is_readable($routes)) {
	throw new Lassi\App\Exception\ResourceNotFoundException('No routes file found.');
}

require_once $routes;

/**
 * Log file path
 */
$logFilePath = sprintf('%s/log/%s-%s.log', ROOT, getenv('mode'), date('Y-m-d', time()));
$lassi->setLogPath($logFilePath);

/**
 * Set default log writer
 */
$lassi->setLogger($lassi->getLogPath());

/**
 * Run Slim framework
 */
$app->run();

