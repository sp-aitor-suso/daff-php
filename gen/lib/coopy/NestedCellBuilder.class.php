<?php

class coopy_NestedCellBuilder implements coopy_CellBuilder{
	public function __construct() {}
	public $view;
	public function needSeparator() {
		if(!php_Boot::$skip_constructor) {
		return false;
	}}
	public function setSeparator($separator) {}
	public function setConflictSeparator($separator) {}
	public function setView($view) {
		$this->view = $view;
	}
	public function update($local, $remote) {
		$h = $this->view->makeHash();
		$this->view->hashSet($h, "before", $local);
		$this->view->hashSet($h, "after", $remote);
		return $h;
	}
	public function conflict($parent, $local, $remote) {
		$h = $this->view->makeHash();
		$this->view->hashSet($h, "before", $parent);
		$this->view->hashSet($h, "ours", $local);
		$this->view->hashSet($h, "theirs", $remote);
		return $h;
	}
	public function marker($label) {
		return $this->view->toDatum($label);
	}
	public function negToNull($x) {
		if($x < 0) {
			return null;
		}
		return $x;
	}
	public function links($unit, $row_like) {
		$h = $this->view->makeHash();
		if($unit->p >= -1) {
			$this->view->hashSet($h, "before", $this->negToNull($unit->p));
			$this->view->hashSet($h, "ours", $this->negToNull($unit->l));
			$this->view->hashSet($h, "theirs", $this->negToNull($unit->r));
			return $h;
		}
		$this->view->hashSet($h, "before", $this->negToNull($unit->l));
		$this->view->hashSet($h, "after", $this->negToNull($unit->r));
		return $h;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'coopy.NestedCellBuilder'; }
}
