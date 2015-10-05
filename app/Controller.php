<?php namespace Lassi\App;

/**
 * Base Controller
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use \Lassi\Lassi;

class Controller {

	protected $lassi;
	protected $app;

	/**
	 * @param string|aray $model
	 * @return \Lassi\App\Controller
	 */
	public function __construct(Lassi $lassi = null, $models = null) {
		if ($lassi !== null) {
			$this->lassi = $lassi;
			$this->setApp($lassi->getApp());
		}

		if ( $models !== null )
			$this->useModel($models);
		return $this;
	}

	/**
	 * @param string|array $models
	 * @return \Lassi\App\Controller
	 */
	public function useModel($models) {
		if (is_array($models))
			return array_map(array($this, 'useModel'), $models);

		if (is_scalar($models)) {
			$name = strtolower($models);
			$class = sprintf('\Lassi\Model\%s', ucwords($name));
			$this->{$name} = new $class;
			$this->{$name}->setConnection($this->lassi->getEloquent());
		}
	}

	/**
	 * @return \Slim\Slim
	 */
	public function getApp() {
		return $this->app;
	}

	/**
	 * @param \Slim\Slim $app
	 * @return \Lassi\App\Controller
	 */
	public function setApp(\Slim\Slim $app) {
		$this->app = $app;
		return $this;
	}
}
