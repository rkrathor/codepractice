<?php 

class ParentClass {

function __construct() {

print "In ParentClass constructor\n";

}

}

class ChildClass extends ParentClass {

function __construct() {

parent::__construct();

print "In ChildClass constructor\n";

}

}

$obj = new ParentClass();

$obj = new ChildClass();

?>