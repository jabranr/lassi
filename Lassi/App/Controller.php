<?php

namespace Lassi\App;

use \Lassi\Lassi;
use Slim\Slim;

/**
 * Base Controller
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */
class Controller
{
    protected $lassi;
    protected $app;

    /**
     * @param Lassi $lassi
     * @param string|array $models
     *
     * @return \Lassi\App\Controller
     */
    public function __construct(Lassi $lassi = null, $models = null)
    {
        if ($lassi !== null) {
            $this->lassi = $lassi;
            $this->setApp($lassi->getApp());
        }

        if ($models !== null) {
            $this->useModel($models);
        }
        return $this;
    }

    /**
     * @param string|array $models
     *
     * @return \Controller
     */
    public function useModel($models)
    {
        if (is_array($models)) {
            return array_map(array($this, 'useModel'), $models);
        }

        if (is_scalar($models)) {
            $name = strtolower($models);
            $class = sprintf('\Lassi\Model\%s', ucwords($name));
            $this->{$name} = new $class;
            $this->{$name}->setConnection($this->lassi->getEloquent());
        }
    }

    /**
     * @return Slim
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param Slim $app
     * @return Controller
     */
    public function setApp(Slim $app)
    {
        $this->app = $app;
        return $this;
    }
}
