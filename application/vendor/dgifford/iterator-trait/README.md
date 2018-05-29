# Iterator Trait #

Provides methods for implementing the iterator interface allowing objects to be iterated with a foreach loop.

The trait adds a private property $container to hold the items that are iterated and a private property $position which hold the current position in $container.

Classes must implement the iterator interface.

```
class Foo implements \Iterator
{
	Use IteratorTrait;

	public function add( $item = '' )
	{
		$this->container[] = $item;
	}
}


$this->foo = new Foo;

$this->foo->add( 'zero' );
$this->foo->add( 'one' );
$this->foo->add( 'two' );

foreach( $this->foo as $key => $value )
{
	echo "$key => $value";
}

// 0 => zero
// 1 => one
// 2 => two
```
