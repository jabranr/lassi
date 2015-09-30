<?php namespace Lassi\App;

/**
 * Database
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use \Lassi\App\Exception\NotFoundException;
use \Illuminate\Database\Capsule\Manager as Capsule;

class Database {

	/** @var \Illuminate\Database\Capsule\Manager */
	protected $capsule;

	/** @var Lassi\App\Database */
	protected static $instance;

	/**
	 * @return \Lassi\App\Database
	 */
	public function __construct() {
		$this->_makeEloquent(new Capsule());
		return $this;
	}

	/**
	 * Get instance of current class
	 * @return \Lassi\App\Database
	 */
	public static function getInstance() {
		if (! static::$instance instanceof Database) {
			static::$instance = new Database();
		}
		return static::$instance;
	}

	/**
	 * Get instance of capsule
	 * @return \Illuminate\Database\Capsule\Manager
	 */
	public function capsule() {
		return $this->capsule;
	}

	/**
	 * Setup eloquent database
	 * @param \Illuminate\Database\Capsule\Manager $capsule
	 * @return \Lassi\App\Database
	 */
	private function _makeEloquent(Capsule $capsule) {
		if (!getenv('db_name') || !getenv('db_user'))
			throw new NotFoundException('App configurations not found.');

		$this->capsule = $capsule;
		$this->capsule->addConnection(array(
				'host' => getenv('db_host'),
				'driver' => getenv('db_driver'),
				'database' => getenv('db_name'),
				'prefix' => getenv('db_prefix'),
				'username' => getenv('db_user'),
				'password' => getenv('db_password'),
				'charset' => getenv('db_charset'),
				'collation' => getenv('db_collation')
			)
		);

		$this->capsule->setAsGlobal();
		$this->capsule->bootEloquent();
		return $this;
	}
}
