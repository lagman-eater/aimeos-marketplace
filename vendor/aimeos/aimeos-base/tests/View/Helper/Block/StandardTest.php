<?php

/**
 * @license LGPLv3, https://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2024
 */


namespace Aimeos\Base\View\Helper\Block;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $object;


	protected function setUp() : void
	{
		$view = new \Aimeos\Base\View\Standard();
		$this->object = new \Aimeos\Base\View\Helper\Block\Standard( $view );
	}


	protected function tearDown() : void
	{
		$this->object = null;
	}


	public function testTransform()
	{
		$this->assertInstanceOf( \Aimeos\Base\View\Helper\Iface::class, $this->object->transform() );
	}


	public function testTransformGetSet()
	{
		$this->object->transform()->set( 'test', 'value' );
		$this->assertEquals( 'value', $this->object->transform()->get( 'test' ) );
	}


	public function testTransformStartStop()
	{
		$this->object->transform()->start( 'test' );
		echo 'value';
		$this->object->transform()->stop();

		$this->assertEquals( 'value', $this->object->transform()->get( 'test' ) );
	}
}
