<?php
// Method Overriding: if a method of superclass is implemented in
// subclass then it is called method overriding

// to stop method overrriding we have to use final keyword
// in the same way to stop inheritence we have to use final keyword
// in front of class
// final class Myclass // fatal error
class Myclass
{
	public $first;
	public $second;
	public function __construct($fr,$sc)
	{
		$this->first=$fr;
		$this->second=$sc;
	}
	//final public function findSum() // to stop overriding // fatal error
	public function findSum() // findsum method
	{
		$result=$this->first+$this->second;
		return $result;
	}
}

class Newclass extends Myclass
{
	public $third;
	public function __construct($fr,$sc,$th)
	{
		parent::__construct($fr,$sc);
		$this->third=$th;
	}
	public function findsum()
	{
		// here we use superclass method having same name
		$result=parent::findsum()+$this->third;
		return $result;
	}
	public function display()
	{
		echo self::findsum();	
	}
}
$pr= new Newclass(20,10,30);
$pr->display();   

?>