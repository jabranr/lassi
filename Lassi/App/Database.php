<?php

namespace Lassi\App;

use Lassi\App\Exception\NotFoundException;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Database
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */
class Database
{

    /**
     * @var Capsule
     */
    private $capsule;

    /**
     * @var $this
     */
    protected static $instance;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->makeEloquent(new Capsule());
    }

    /**
     * Get instance of current class
     *
     * @return $this
     */
    public static function getInstance()
    {
        if (!static::$instance instanceof Database) {
            static::$instance = new Database();
        }

        return static::$instance;
    }

    /**
     * Get instance of capsule
     *
     * @deprecated since 0.0.5
     *
     * @return Capsule
     */
    public function capsule()
    {
        return $this->getCapsule();
    }

    /**
     * Setup eloquent database
     *
     * @param Capsule $capsule
     *
     * @throws NotFoundException
     *
     * @return $this
     */
    private function makeEloquent(Capsule $capsule)
    {
        // Throw exception if minimum requirements not met
        if (!getenv('db_driver') || !getenv('db_name')) {
            throw new NotFoundException('App configurations not found.');
        }

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
        if ($db_driver !== 'sqlite') {
            if (getenv('db_host')) {
                $configs['host'] = getenv('db_host');
            }
            if (getenv('db_username')) {
                $configs['username'] = getenv('db_username');
            }
            if (getenv('db_password')) {
                $configs['password'] = getenv('db_password');
            }
        }

        // Setup connection
        $this->getCapsule()->addConnection($configs);

        // Set as global
        $this->getCapsule()->setAsGlobal();

        // Boot eloquent
        $this->getCapsule()->bootEloquent();

        return $this;
    }

    /**
     * @return Capsule
     *
     * @codeCoverageIgnore
     */
    public function getCapsule()
    {
        return $this->capsule;
    }

    /**
     * @param Capsule $capsule
     *
     * @return $this
     *
     * @codeCoverageIgnore
     */
    public function setCapsule(Capsule $capsule)
    {
        $this->capsule = $capsule;
        return $this;
    }
}
