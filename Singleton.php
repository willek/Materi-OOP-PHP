<?php

Class A {
  private static $instance;

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  public $nilai = 10;

  public function ubahNilai() {
    $this->nilai = 100;
  }
}

$test = A::getInstance();
print $test->nilai;
print PHP_EOL;

 ?>
