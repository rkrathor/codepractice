<?php
class Myclass
{
	public $first;
	public $second;

	public function __construct($fr, $sc)
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

class  Newclass extends Myclass
{
	public $third;
	public function __construct($fr,$sc,$th)
	{
		parent::__construct($fr,$sc);
		$this->third=$th;
	}
	public function findSumThree()
	{
		$result=$third->first+$this->second+$this->third;
		echo $result;
	}
}
/**
* 
*/
class Mynewclass extends Newclass
{
	public $fourth;
	function __construct($fr,$sc,$th,$fo)
	{
		parent::__construct($fr,$sc,$th);
		$this->fourth=$fo;
	}
	public function findSumfour()
	{
		$result=$this->first+$this->second+$this->third+$this->fourth;
		echo $result;
	}
}
$pr=new Mynewclass(10,20,30,40);
$pr->findSumfour();
?>