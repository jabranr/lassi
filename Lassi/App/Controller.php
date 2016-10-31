<?php

namespace Lassi\App;

use Slim\Slim;
use Lassi\Lassi;

/**
 * Base Controller
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */
class Controller
{
    /**
     * @var Lassi
     */
    private $lassi;

    /**
     * @var Slim
     */
    private $app;

    /**
     * Controller constructor.
     *
     * @param Lassi|null $lassi
     * @param null|array|string $models
     */
    public function __construct(Lassi $lassi = null, $models = null)
    {
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
     *
     * @return $this
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

        return $this;
    }


    /**
     * @return Slim
     *
     * @codeCoverageIgnore
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * @param Slim $app
     *
     * @return $this
     *
     * @codeCoverageIgnore
     */
    public function setApp(Slim $app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return Lassi
     *
     * @codeCoverageIgnore
     */
    public function getLassi()
    {
        return $this->lassi;
    }


    /**
     * @param Lassi $lassi
     *
     * @return $this
     *
     * @codeCoverageIgnore
     */
    public function setLassi(Lassi $lassi)
    {
        $this->lassi = $lassi;
        return $this;
    }
}
