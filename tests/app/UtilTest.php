<?php namespace Lassi\Test\App;

/**
 * Util Test Suite
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */

require ROOT . '/app/Util.php';
require ROOT . '/app/exception/LassiException.php';
require ROOT . '/app/exception/ResourceNotFoundException.php';

use \Lassi\App\Util;

class UtilTest extends \PHPUnit_Framework_TestCase {

	/* @var string Base path */
	public $root;

	/* @var array Configurations */
	public $config;

	/**
	 * Default setUp method
	 */
	public function setUp() {
		$this->root = dirname(dirname(__FILE__));
		$this->config = array();
	}

	/**
	 * Default tearDown method
	 */
	public function tearDown() {
		Util::setupEnvironment($this->root, true);
		unset($this->config);
		$this->root = null;
	}

	/**
	 * Test environment setup with incorrect base root
	 *
	 * @expectedException \Lassi\App\Exception\ResourceNotFoundException
	 */
	public function testSetupEnvironmentWithoutRoot() {
		Util::setupEnvironment();
	}

	/**
	 * Test environment setup with correct base root
	 */
	public function testSetupEnvironmentWithRoot() {
		Util::setupEnvironment($this->root);
		return $this->assertEquals(getenv('mode'), 'development');
	}

	/**
	 * Test environment configurations without setting
	 *
	 * @dataProvider environmentSampleDataToMatch
	 */
	public function testSetupEnvironmentWithoutConfig($input, $expected) {
		return $this->assertNotEquals($expected, getenv($input));
	}

	/**
	 * Test environment configurations with setting
	 *
	 * @dataProvider environmentSampleDataToMatch
	 */
	public function testSetupEnvironmentWithConfig($input, $expected) {
		Util::setupEnvironment($this->root);
		return $this->assertEquals($expected, getenv($input));
	}

	/**
	 * Expected environment data to test
	 */
	public function environmentSampleDataToMatch() {
		return array(
			array('db_driver', 'mysql'),
			array('db_host', 'localhost'),
			array('db_name', 'lassi'),
			array('db_prefix', 'lassi_'),
			array('db_username', 'foo'),
			array('db_password', 'bar'),
			array('db_charset', 'utf8mb4'),
			array('db_collation', 'utf8mb4_unicode_ci'),
			array('debug', 'true'),
			array('mode', 'development'),
			array('base_url', '/'),
			array('url', 'http://localhost')
		);
	}

}