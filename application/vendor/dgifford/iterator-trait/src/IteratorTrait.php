<?php
Namespace dgifford\Traits;

/*
	Methods for implementing the Iterator interface.

	Copyright (C) 2016  Dan Gifford

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */






trait IteratorTrait
{
	public function reset()
	{
		if( empty($this->container) )
		{
			$this->container = [];
		}

		$this->container = array_values( $this->container );
	}



	public function rewind()
	{
		// Reset item array and position
		$this->reset();
		$this->position = 0;
	}



	public function current()
	{
		return $this->container[ $this->position ];
	}



	public function key()
	{
		return $this->position;
	}



	public function next()
	{
		++$this->position;
	}



	public function valid()
	{
		return isset($this->container[ $this->position ]);
	}
}