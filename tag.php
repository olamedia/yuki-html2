<?php

namespace yuki;

class tag implements \ArrayAccess{
	public $name = '';
	public $attributes = [];
	public $innerHtml = null;
	private static $_selfClosing = ['img', 'br', 'hr', 'input', 'link', 'meta', 'param'];
	public function __construct($name){
		$this->name = $name;
		$this->innerHtml = new nodeList();
	}
	// -------------- ArrayAccess
	public function offsetExists($i) {
		return \array_key_exists($i, $this->attributes);
	}
	public function offsetUnset($i) {
		unset($this->attributes[$i]);
	}
	public function offsetGet($i) {
		return $this->attributes[$i];
	}
	public function offsetSet($i, $value) {
		if (null === $i){
			return $this->append($value);
		}
		$this->attributes[$i] = $value;
	}
	public function append($html){
		if (\is_array($html) || $html instanceof \Traversable){
			foreach ($html as $node){
				$this->innerHtml->nodes[] = $node;
			}
		}else{
			$this->innerHtml->nodes[] = $html;
		}
	}
	public function text($text = null){
		if (null === $text){
			// FIXME filter tags, leave text only and concatenate then
			return $this->_innerHtml;
		}
		$this->innerHtml->nodes[] = \htmlspecialchars($text);
	}
	public function html($html = null){
		if (null === $html){
			return $this->innerHtml;
		}
		$this->innerHtml = new nodeList();
		$this->append($html);
	}
	public function __toString(){
		$a = [];
		$a[] = $this->name;
		foreach ($this->attributes as $k => $v){
			$a[] = $k.'="'.\htmlspecialchars($v).'"';
		}
		$op = '<'.\implode(' ', $a);
		if (\in_array($this->name, self::$_selfClosing)){
			return $op.' />';
		}
		$close = '</'.$this->name.'>';
		return $op.'>'.$this->innerHtml.$close;
	}
}
