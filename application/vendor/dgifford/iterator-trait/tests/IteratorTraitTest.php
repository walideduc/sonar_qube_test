<?php
Namespace dgifford\Traits;



/**
 * Auto Loader
 * 
 */
require_once(__DIR__ . '/../vendor/autoload.php');



class Foo implements \Iterator
{
	Use IteratorTrait;



	public function add( $item = '' )
	{
		$this->container[] = $item;
	}
}



class IteratorTraitTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->foo = new Foo;

		$this->foo->add( 0 );
		$this->foo->add( 1 );
		$this->foo->add( 2 );
	}



	public function testIterator()
	{
		foreach( $this->foo as $key => $value )
		{
			$this->assertSame( $key, $value );
		}
	}



	public function testIteratorBreakInMiddle()
	{
		foreach( $this->foo as $key => $value )
		{
			$this->assertSame( $key, $value );

			if( $key == 1 )
			{
				break;
			}
		}

		$this->testIterator();
	}
}