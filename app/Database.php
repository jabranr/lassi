<?php namespace Lassi\App;

/**
 * Database
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use Lassi\App\Exception\ResourceNotFound;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

	/* @var Illuminate\Database\Capsule\Manager */
	protected $capsule;

	/* @var Lassi\App\Database */
	protected static $instance;

	/**
	 * Setup Eloquent database
	 *
	 * @return Lassi\App\Database
	 */
	public function __construct() {
		$this->setupEloquent(new Capsule());
		return $this;
	}

	/**
	 * Get instance of current class
	 * @return Lassi\App\Database
	 */
	public static function getInstance() {
		if (! static::$instance instanceof Database) {
			static::$instance = new Database();
		}
		return static::$instance;
	}

	/**
	 * Set eloquent capsule
	 *
	 * @param Illuminate\Database\Capsule\Manager $capsule
	 * @return Lassi\App\Database
	 */
	public function setCapsule(Capsule $capsule) {
		$this->capsule = $capsule;
		return $this;
	}

	/**
	 * Get eloquent capsule
	 *
	 * @return Illuminate\Database\Capsule\Manager
	 */
	public function getCapsule() {
		return $this->capsule;
	}

	/**
	 * Setup eloquent database
	 *
	 * @param Illuminate\Database\Capsule\Manager $capsule
	 * @throws Lassi\App\Exception\ResourceNotFound
	 * @return Lassi\App\Database
	 */
	private function setupEloquent(Capsule $capsule) {

		// Throw exception if minimum requirements not met
		if (!getenv('db_driver') || !getenv('db_name'))
			throw new ResourceNotFound('Database configurations not found.');

		// Get capsule instance
		$this->setCapsule($capsule);

		// Cache db driver
		$db_driver = getenv('db_driver');

		// Setup connection defaults
		$configs = array(
			'driver' => $db_driver,
			'database' => getenv('db_name'),
			'prefix' => getenv('db_prefix'),
			'charset' => getenv('db_charset'),
			'collation' => getenv('db_collation'),
		);

		// Add extras depending on type of driver/connection
		if ( $db_driver !== 'sqlite' ) {
			if ( getenv('db_host') ) $configs['host'] = getenv('db_host');
			if ( getenv('db_username') ) $configs['username'] = getenv('db_username');
			if ( getenv('db_password') ) $configs['password'] = getenv('db_password');
		}

		// Setup connection
		$this->getCapsule()->addConnection($configs);

		// Set as global
		$this->getCapsule()->setAsGlobal();

		// Boot eloquent
		$this->getCapsule()->bootEloquent();
		return $this;
	}
}
