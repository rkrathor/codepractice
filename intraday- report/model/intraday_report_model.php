<?php
class Intraday_report_model extends CI_model
{

   function Intraday_report_model()
   {
   	parent::__construct();
   }

   function get_allreaport()
   {
 //   	SELECT COUNT(order_id) AS ototal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time FROM orders
 // WHERE DATE(order_date)='2014-06-11'
 // GROUP BY start_time
 // UNION
 // SELECT COUNT(cart_id) AS ctotal_order,HOUR(created_time) AS cstart_time,HOUR(DATE_ADD(created_time,INTERVAL 1 HOUR)) AS cend_time FROM carts
 // WHERE DATE(created_time)='2014-06-11'
 // GROUP BY cstart_time
   //echo "header";
   	$start_time=array();
   	$end_time=array();
   	$ototal_order=array();
   	$array_alltotall=array();
   	$array_cart_LY=array();
   	$i=0;
   	$date='2014-06-11';
   	$this->db->from('orders');
   	$this->db->SELECT('COUNT(order_id) AS ototal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time', false);
   	$this->db->WHERE('DATE(order_date)=',$date);
    $this->db->group_by('start_time');
   	$query=$this->db->get();
   	$q=$this->db->last_query();
   	$query=$query->result_array();
   	return $query;

   	/*foreach ($query as $key => $value) {
   		$start_time[$i]=$value['start_time'];
   		$end_time[$i]=$value['end_time'];
   		$ototal_order[$i]=$value['ototal_order'];

   		//print_r($value['start_time']);
   		//echo "key".$key."value".$value."<br>";
   		$array_alltotall[$i]['start_time']=$value['start_time'];
   		$i++;
   	}*/
   //	echo '<pre>';
   //	print_r($q);
   //	print_r($array_alltotall);
   	//print_r($start_time);
   //	print_r($query);
   //	die();
   }

   function get_cart_TY($thisYear)
   {
   	//$date='2015-06-11';
   	$this->db->from('carts');
   	$this->db->SELECT('COUNT(cart_id) AS ototal_order,HOUR(created_time) AS start_time,HOUR(DATE_ADD(created_time,INTERVAL 1 HOUR)) AS end_time', false);
   	$this->db->WHERE('DATE(created_time)=',$thisYear);
    $this->db->group_by('start_time');
   	$query=$this->db->get();
   	$q=$this->db->last_query();
   	 return $query=$query->result_array();
   }
   function get_cart_LY($lastYear)
   {
   	//$date='2014-06-11';
   	$this->db->from('carts');
   	$this->db->SELECT('COUNT(cart_id) AS ototal_order,HOUR(created_time) AS start_time,HOUR(DATE_ADD(created_time,INTERVAL 1 HOUR)) AS end_time', false);
   	$this->db->WHERE('DATE(created_time)=',$lastYear);
    $this->db->group_by('start_time');
   	$query=$this->db->get();
   	$q=$this->db->last_query();
  	$query=$query->result_array();
  	//$query=$query->result();
  	return $query;
 
   }
   function get_orders_TY($thisYear)
   {
   	//$date='2015-06-11';
   	$this->db->from('orders');
   	$this->db->SELECT('COUNT(order_id) AS ototal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time', false);
   	$this->db->WHERE('DATE(order_date)=',$thisYear);
    $this->db->group_by('start_time');
   	$query=$this->db->get();
   	$q=$this->db->last_query();
   	return $query=$query->result_array();
   }
   function get_orders_LY($lastYear)
   {
   	//$date='2014-06-11';
   	$this->db->from('orders');
   	$this->db->SELECT('COUNT(order_id) AS ototal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time', false);
   	$this->db->WHERE('DATE(order_date)=',$lastYear);
    $this->db->group_by('start_time');
   	$query=$this->db->get();
   	$q=$this->db->last_query();
   	return $query=$query->result_array();
   }

  function session_dataTY($dateTY,$start_time,$end_time)
  {
  	$dateTY='2014-06-11';
 // SELECT COUNT(order_id) AS total_order,(SELECT COUNT(cart_id) FROM carts WHERE DATE(created_time)='2015-06-11' AND HOUR(created_time)='4' AND HOUR(DATE_ADD(created_time,INTERVAL 1 HOUR))='5') AS ctotal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time FROM orders
 // WHERE DATE(order_date)='2015-06-11' AND HOUR(order_date)='4' AND HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR))='5'
  	$query = $this->db->query("SELECT COUNT(order_id) AS total_order,(SELECT COUNT(cart_id) FROM carts WHERE DATE(created_time)='$dateTY' AND HOUR(created_time)='$start_time' AND HOUR(DATE_ADD(created_time,INTERVAL 1 HOUR))='$end_time') AS ctotal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time FROM orders
      WHERE DATE(order_date)='$dateTY' AND HOUR(order_date)='$start_time' AND HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR))='$end_time'");
      //print_r($this->db->last_query()); print_r($query->row());
      // die();
        return $query->row_array();
  }

  function session_dataLY($dateLY,$start_time,$end_time)
  {	
  	$dateLY='2015-06-11';
 	  $query = $this->db->query("SELECT COUNT(order_id) AS total_order,(SELECT COUNT(cart_id) FROM carts WHERE DATE(created_time)='$dateLY' AND HOUR(created_time)='$start_time' AND HOUR(DATE_ADD(created_time,INTERVAL 1 HOUR))='$end_time') AS ctotal_order,HOUR(order_date) AS start_time,HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR)) AS end_time FROM orders
      WHERE DATE(order_date)='$dateLY' AND HOUR(order_date)='$start_time' AND HOUR(DATE_ADD(order_date,INTERVAL 1 HOUR))='$end_time'");
      //print_r($this->db->last_query()); print_r($query->row());
       //die();
        return $query->row_array();
  }



}