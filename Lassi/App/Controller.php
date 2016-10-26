<?php

namespace Lassi\App;

/**
 * Base Controller
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use Slim\Slim;
use Lassi\Lassi;

class Controller {

	/**
	 * @var Lassi\Lassi
	 */
	private $lassi;

	/**
	 * @var Slim\Slim
	 */
	private $app;

	/**
	 * Default constructor
	 *
	 * @param string|aray $model
	 * @return Lassi\App\Controller
	 */
	public function __construct(Lassi $lassi = null, $models = null) {
		if ($lassi !== null) {
			$this->setLassi($lassi);
			$this->setApp($this->getLassi()->getApp());
		}

		if ($models !== null) {
			$this->useModel($models);
		}
	}

	/**
	 * Set model(s) to use
	 *
	 * @param string|array $models
	 * @return Lassi\App\Controller
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

		return $this;
	}

	/**
     * @codeCoverageIgnore
	 */
	public function getApp() {
		return $this->app;
	}

	/**
     * @codeCoverageIgnore
	 */
	public function setApp(Slim $app) {
		$this->app = $app;
		return $this;
	}

    /**
     * @codeCoverageIgnore
     */
    public function getLassi() {
       return $this->lassi;
    }

    /**
     * @codeCoverageIgnore
     */
    public function setLassi(Lassi $lassi) {
        $this->lassi = $lassi;
        return $this;
    }
}
