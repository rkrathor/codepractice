<?php
class Myclass
{
 
 public $first;//properties
 public $second;

 public function __construct($fr,$sc)
 {
 	// any values passed to constructor as arguments can be
 	// assigned to properties by using $this
 	 $this->first=$fr;
 	 $this->second=$sc;
 }
 public function findsumTwo()
 {
   $result=$this->first+$this->second;
   echo $result;	
 }
}

$pr=new Myclass(40,50);
// a constructor create the object, applying default values
$pr->findsumTwo();
?>