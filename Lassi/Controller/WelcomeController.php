<?php

namespace Lassi\Controller;

/**
 * Welcome controller
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

use Lassi\Lassi;
use Lassi\Model\User;
use Lassi\App\Controller;

class WelcomeController extends Controller {

	public function __construct() {

		/**
		 * Set app instance for parent class
		 */
		parent::__construct(Lassi::getInstance());

		/**
		 * Set a single model or an array of models
		 */
		$this->useModel('user');
	}

	public function welcome() {
		return $this->app->render('welcome.php');
	}
}