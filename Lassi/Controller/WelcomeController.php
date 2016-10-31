<?php

namespace Lassi\Controller;

use Lassi\Lassi;
use Lassi\App\Controller;

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
        return $this->getApp()->render('welcome.php');
    }
}
