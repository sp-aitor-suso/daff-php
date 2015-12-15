<?php

class coopy_PhpCellView implements coopy_View {
  public function toString($d) {
    return is_bool($d) ? var_export($d, true) : strval($d);
  }
  public function equals($d1,$d2) {
      return "".$d1 == "".$d2;
  }
  public function toDatum($d) { return $d; }
  public function makeHash() { return array(); }
  public function isHash($d) { return is_array($d); }
  public function hashSet(&$d,$k,$v) { $d[$k] = $v; }
  public function hashGet($d,$k) { return $d[$k]; }
  public function hashExists($d,$k) { return array_key_exists($k,$d); }
}
