<?php namespace Lassi;

/**
 * Lassi
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use \Slim\Slim;
use \Lassi\App\Util;
use \Lassi\App\Database;
use \Lassi\App\Exception\NotFoundException;

class Lassi {

	/** @var \Slim\Slim */
	protected $app;

	/** @var \Lassi\App\Database */
	protected $eloquent;

	/** @var \Lassi\Lassi */
	protected static $instance;

	/**
	 * @param \Slim\Slim $app
	 * @return \Lassi\Lassi
	 */
	public function __construct(Slim $app = null) {
		$this->setApp($app, array('templates.path' => './view'));
		$this->setEloquent();
		return $this;
	}

	/**
	 * @return \Lassi\Lassi
	 */
	public static function getInstance() {
		if (! static::$instance instanceof \Lassi\Lassi)
			static::$instance = new \Lassi\Lassi;
		return static::$instance;
	}

	/**
	 * Bootstrap the framework
	 * @return void
	 */
	public static function bootstrap() {

		/* Load configuration from .dev.env | .dist.env | .env */
		Util::setEnvVariables(dirname(__FILE__));

		/* Get instances */
		$lassi = static::getInstance();
		$slim = $lassi->getApp();

		/* Add base URL to all views for assets management */
		$slim->hook('slim.before', function() use ($slim) {
			$slim->view()->appendData(array('baseUrl' => getenv('base_url')));
		});

		/* Load routes */
		static::loadRoutes();

		/* Run Slim framework */
		$slim->run();
	}

	/**
	 * Load framework app routes
	 * @return void
	 */
	private static function loadRoutes() {
		$routes = dirname(__FILE__) . '/routes.php';
		if (!file_exists($routes) || !is_readable($routes))
			throw new NotFoundException('Routes not found.');

		// Get Slim instance
		$app = \Lassi\Lassi::getInstance()->getApp();
		require_once $routes;
	}

	/**
	 * Set eloquent database
	 * @return \Lassi\Lassi
	 */
	public function setEloquent() {
		$this->eloquent = Database::getInstance();
		return $this;
	}

	/**
	 * Get eloquent database instance
	 * @return \Lassi\App\Database
	 */
	public function getEloquent() {
		return $this->eloquent;
	}

	/**
	 * Set app instance
	 * @param \Slim\Slim $app
	 * @param array $args
	 * @return \Lassi\Lassi
	 */
	public function setApp(Slim $app = null, $args = array()) {
		$this->app = $app ? $app : new Slim($args);
	}

	/**
	 * Get app instance
	 * @return \Slim\Slim;
	 */
	public function getApp() {
		return $this->app;
	}
}
