<?php

/**
 * Lassi unit test suite
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @version 0.0.5
 * @license MIT License
 */

require __DIR__ . '/../vendor/autoload.php';

use \Lassi\Lassi;

class LassiTest extends PHPUnit_Framework_TestCase {
	public $lassi;
	public $config;

	/**
	 * Constructor method
	 */
	public function setUp() {
		$this->lassi = null;
		$this->config = array();
	}

	/**
	 * TearDown method
	 */
	public function tearDown() {
		unset($this->lassi);
	}

	/**
	 * Initalize Lassi without setting configuration options
	 *
	 * @expectedException \Lassi\App\Exception\ResourceNotFoundException
	 */
	public function testException() {
		$this->lassi = new Lassi;
	}
}