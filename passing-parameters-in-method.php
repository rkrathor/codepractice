<?php

class Myclass
{
	public $first;
	public $second;
	// passing parameter in method findsumTwo()
	public function findsumTwo($first,$second){
		$result=$first+$second;
		echo $result;
	}
}

$pr= new Myclass();
$pr->findsumTwo(20,30);//now passing value for method

?>