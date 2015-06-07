	<?php

class MyClass {

function __construct() {

print "In constructor\n";

$this->name = "MyClass";

}

function __destruct() {

print "Destroying " . $this->name . "\n";

}

}

$obj = new MyClass();

?>