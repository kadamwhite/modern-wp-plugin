<?php
/**
 * PHPUnit "hello world".
 */

namespace Testbed\Tests\Inc;

use WP_Mock;

/**
 * Class TestTestSuite
 *
 * @group inc
 */
class TestTestSuite extends WP_Mock\Tools\TestCase {
	public function setUp() : void {
		WP_Mock::setUp();
	}

	public function tearDown() : void {
		WP_Mock::tearDown();
	}

	public function testTestsAreRunning() : void
	{
		$this->assertTrue(true);
	}
}
