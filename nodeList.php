<?php

namespace yuki;

class nodeList implements \IteratorAggregate{
	public $nodes = [];
	public function __toString(){
		return \implode('', $this->nodes);
	}
	public function getIterator(){
		return new \ArrayIterator($this->nodes);
	}
}
