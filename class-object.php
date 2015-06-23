<?php
// class normally contains both properites and methods.
//
class Myclass
{
	public $first=10; // Here we declare properites
	public $second=20;// this is too properties

	public function findSumTwo()	
	{
		$result= $this->first+$this->second;
		//$result= $first+$second; // will give error undefined variables $first and $second
		echo $result;
	}
}
$pr= new Myclass(); // create object of class
$pr->findSumTwo();
?>