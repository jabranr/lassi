<?php

namespace Lassi\Tests\Unit;

use Lassi\Lassi;
use Lassi\App\Util;

class LassiTest extends \PHPUnit_Framework_TestCase {

	public function testGetInstanceReturnsLassiInstance() {
		Util::setEnvVariables('.');
		$this->assertInstanceOf('Lassi\Lassi', Lassi::getInstance());
	}
}
