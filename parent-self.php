<?php
// parent: This refers to the super class of the current class.
// self:  This refers to the current class.

class Myclass{

	public $first;
	public $second;
	public function __construct($fr,$sc)
	{
		$this->first=$fr;
		$this->second=$sc;
	}
	public function findsumTwo()
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
		//parent:calling superclass constructor
		$this->third=$th;
	}
	public function findsumThree()
	{
		$result=parent::findsumTwo()+$this->third;
		return $result;
	}
	public function display()
	{
		echo self::findsumThree();
		// self: calling method or properties of current class
	}
}
$pr= new Newclass(10,20,30);
$pr->display();
?> 