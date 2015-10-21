<?php

/**
 * Lassi unit test suite
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @version 0.0.5
 * @license MIT License
 */

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use \Lassi\Lassi;

class LassiTest extends PHPUnit_Framework_TestCase {
	public $lassi;
	public $config;

	public function setUp() {
		$this->lassi = null;
		$this->config = array();
	}

	public function tearDown() {
		unset($this->lassi);
	}

	public function testException() {
		return true;
	}
}