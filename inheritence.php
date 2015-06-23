<?php
// Inheritance allows a class to extend
// another class and inherit all its methods,
// properties and behaviors.

// Creating super class
class Myclass
{
	public $first;
	public $second;

	public function __construct($fr,$sc)
	{
		$this->first=$fr;
		$this->second=$sc;
	}
	public function findSumTwo()
	{
		$result=$this->first+$this->second;
		echo $result;
	}
}
// creating sub class
class Newclass extends Myclass
{
	public $third;
    public function __construct($fr,$sc,$th)
    {
    	// calling super class constructor
    	// using parent
    	parent::__construct($fr,$sc);
    	$this->third=$th;
    }
    public function findSumThree()
    {
    	$result=$this->first+$this->second+$this->third;
    	echo $result;
    }

}
 // creating sub class object and calling subclass constructor
 // eventually, sub class constructor call parent constructor
$pr= new Newclass(20,30,40);
$pr->findSumThree();
?>