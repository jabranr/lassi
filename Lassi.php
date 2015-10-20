<?php namespace Lassi;

/**
 * Lassi
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @version 0.0.5
 * @license MIT License
 */

use Slim\Slim;
use Slim\LogWriter;
use Lassi\App\Util;
use Lassi\App\Database;
use Lassi\App\Exception\InvalidResourcePath;
use Lassi\App\Exception\ResourceAccessError;
use Lassi\App\Exception\ResourceNotFound;


class Lassi {

	/* @var string Base URL of Lassi */
	protected $base;

	/* @var string Application routes file path */
	protected $routePath;

	/* @var string Application log file path */
	protected $logPath;

	/* @var array Slim configuration */
	protected $config;

	/* @var Slim\Slim */
	protected $app;

	/* @var \Lassi\Lassi */
	protected static $instance;

	/**
	 * Setup Lassi with Slim and Eloquent
	 *
	 * @param Slim\Slim $app
	 * @param string $root
	 * @return Lassi\Lassi
	 */
	public function __construct($root = __DIR__) {
		$this->setBase($root);
		$this->setConfig('templates.path', '../view');
		$this->setApp();
		$this->add('eloquent', new Database);
		return $this;
	}

	/**
	 * Get a singleton class instance
	 *
	 * @param string $root
	 * @return Lassi\Lassi
	 */
	public static function getInstance($root = __DIR__) {
		if (! static::$instance instanceof \Lassi\Lassi)
			static::$instance = new \Lassi\Lassi($root);
		return static::$instance;
	}

	/**
	 * Set configurations
	 *
	 * @param string|array $key
	 * @param string $value
	 * @return Lassi\Lassi
	 */
	public function setConfig($key, $value = null) {
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				$this->config[$k] = $v;
			}
		}
		else {
			$this->config[$key] = $value;
		}
		return $this;
	}

	/**
	 * Get confguration by key
	 * Get all configurations by passing no parameters
	 *
	 * @param string|null $key
	 * @return string|array|boolean
	 */
	public function getConfig($key = null) {
		if ($key === null) {
			return $this->config;
		}
		elseif (array_key_exists($key, $this->config)) {
			return $this->config[$key];
		}
		return false;
	}

	/**
	 * Set root of application
	 *
	 * @param string $base
	 * @return Lassi\Lassi
	 */
	public function setBase($base) {
		$this->base = $base;
		return $this;
	}

	/**
	 * Get root fo application
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Setup a custom Slim\LogWriter logger
	 *
	 * @param string $path
	 * @uses Slim\LogWriter
	 * @throws Lassi\App\Exception\InvalidResourcePath
	 * @throws Lassi\App\Exception\ResourceAccessError
	 * @return Lassi\Lassi
	 */
	public function setLogger($path) {
		if (!is_scalar($path)) {
			throw new InvalidResourcePath('Invalid resource path for logs.');
		}

		if ($resource = fopen($path, 'a')) {
			$this->setLogPath($path);
			$this->getApp()->config('log.writer', new LogWriter($resource));
		}
		else {
			throw new ResourceAccessError('Unable to create a resource at ' . $path);
		}
		return $this;
	}

	/**
	 * Get instance of Slim\LogWriter
	 * @return Slim\LogWriter|null
	 */
	public function getLogger() {
		return $this->getApp()->config('log.writer');
	}

	/**
	 * Initiate and setup Slim
	 *
	 * @param array $args
	 * @return Lassi\Lassi
	 */
	public function setApp($args = array()) {
		$this->setConfig(array_merge($args, $this->getConfig()));
		$this->app = new Slim($this->getConfig());
		return $this;
	}

	/**
	 * Get Slim instance
	 * @return Slim\Slim;
	 */
	public function getApp() {
		return $this->app ? $this->app : Slim::getInstance();
	}

	/**
	 * Add a class/module as singleton
	 *
	 * @param string $name
	 * @param object|class $class
	 * @return Lassi\Lassi
	 */
	public function add($name, $class) {
		$this->getApp()->container->singleton($name, $class);
		return $this;
	}

	/**
	 * Set path to log file
	 *
	 * @param string $path
	 * @return Lassi\Lassi
	 */
	public function setLogPath($path) {
		$this->logPath = $path;
		return $this;
	}

	/**
	 * Get path to log file
	 *
	 * @return string
	 */
	public function getLogPath() {
		return $this->logPath;
	}

	/**
	 * Set path to route file
	 *
	 * @param string $path
	 * @return Lassi\Lassi
	 */
	public function setRoutePath($path) {
		$this->routePath = $path;
		return $this;
	}

	/**
	 * Get path to route file
	 *
	 * @return string
	 */
	public function getRoutePath() {
		return $this->routePath;
	}

}

