<?php
// Multiple inheritence: we can implement multiple inheritence in 
// php by extending one class and creating another as interface

interface Myinterface  
{
// creating interface
	public function findsum();
	public function display();
}

class MyClass
{
	public $first;
	public $second;
	function __construct($fr,$sc)
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

class MyNewClass extends MyClass implements Myinterface
// now implementing interface and extending class in another class
{
	public $third;
	function __construct($fr,$sc,$th)
	{
		parent::__construct($fr,$sc);// from class myclass
		$this->third=$th;
	}
	public function findsum()
	{
		$result=parent::findsumTwo()+$this->third;
		return $result;
	}
	public function display()
	{
		echo self::findsum();
	}
}
$pr= new MyNewClass(10,20,30);
$pr->display();
?>