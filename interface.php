<?php
// An interface is similar to an abstract class, but it has no
// properties and cannot define how methods are to be implemented.

interface Myinterface
{
	public function findsum();
	public function display();
}

class MyClass implements Myinterface
{
	public $first;
	public $second;
	public function __construct($fr,$sc)
	{
		$this->first=$fr;
		$this->second=$sc;
	}
	public function findsum() // method from interface
	{
		$result=$this->first+$this->second;
		echo $result;
	}
	public function display()// method from interface
	{
		echo self::findsum();
	}
}
$pr=new MyClass(20,10);
$pr->display();
?>