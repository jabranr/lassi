<?php

namespace Lassi\Tests;

use PHPUnit_Framework_TestCase;
use Lassi\Lassi;

/**
 * Lassi Test
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @version 0.0.4
 * @license MIT License
 */

class LassiTest extends PHPUnit_Framework_TestCase
{
	public function testGetInstanceReturnsLassiInstance()
	{
		// Setup
		\Lassi\App\Util::setEnvVariables(__DIR__.'/../config');

		$this->assertInstanceOf('\Lassi\Lassi', Lassi::getInstance());
	}
}
