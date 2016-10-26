<?php

namespace Lassi\Controller;

use Lassi\App\Controller;
use \Lassi\Lassi;

/**
 * Welcome controller
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */
class WelcomeController extends Controller
{

    public function __construct()
    {
        /**
         * Set app instance for parent class
         */
        parent::__construct(Lassi::getInstance());

        /**
         * Set a single model or an array of models
         */
        $this->useModel('user');
    }

    public function welcome()
    {
        return $this->app->render('welcome.php');
    }
}
