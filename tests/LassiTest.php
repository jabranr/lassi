<?php namespace Lassi\Test;

/**
 * Lassi unit test suite
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @version 0.0.5
 * @license MIT License
 */

class LassiTest extends \PHPUnit_Framework_TestCase {
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

	public function testExample() {
		$this->assertTrue(true, true);
	}
}




