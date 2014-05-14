<?php

namespace yuki;

class nodeList implements \IteratorAggregate, \ArrayAccess{
	public $nodes = [];
	public function __toString(){
		return \implode('', $this->nodes);
	}
	// -------------- ArrayAccess
	public function offsetExists($i) {
		return \array_key_exists($i, $this->nodes);
	}
	public function offsetUnset($i) {
		unset($this->nodes[$i]);
	}
	public function offsetGet($i) {
		return $this->nodes[$i];
	}
	public function offsetSet($i, $value) {
		if (null === $i){
			return $this->append($value);
		}
		$this->nodes[$i] = $value;
	}
	public function append($html){
		if (\is_array($html) || $html instanceof \Traversable){
			foreach ($html as $node){
				$this->nodes[] = $node;
			}
		}else{
			$this->nodes[] = $html;
		}
	}
	public function getIterator(){
		return new \ArrayIterator($this->nodes);
	}
}
