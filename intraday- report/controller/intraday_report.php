<?php

class Intraday_report extends CI_controller{

	function Intraday_report()
	{
		parent::__construct();

		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		
		if(!accessGrant('intraday_report'))
		{
			redirect('/siteadmin');
			exit;
		}
		$this->load->helper('url'); 
		$this->load->model('Intraday_report_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}



	function index()
	{	
		$thisYear=date('Y-m-d');
		$w=self::weekdays($thisYear);
		$data['show_date']=date('Y-m-d')." ".$w;
		$lastYear=date('Y-m-d',strtotime($thisYear.' -1 year'));
		$array_time=array();
		for ($i=0; $i <24 ; $i++) { 
			$array_time[$i]['start_time']=$i;
			$array_time[$i]['end_time']=$i+1;
			if($i==23)
			{
				$array_time[$i]['end_time']=0;
			}
			
		}
		//print_r($array_time);
		$array_reports=array();
		$array_reports_full=array();
		$array_cart=array();
		$array_cart_full=array();
		$array_orders=array();
		$array_orders_full=array();
		
		$data['cart_TY']=$this->Intraday_report_model->get_cart_TY($thisYear);
		$data['cart_LY']=$this->Intraday_report_model->get_cart_LY($lastYear);
		$data['orders_TY']=$this->Intraday_report_model->get_orders_TY($thisYear);
		$data['orders_LY']=$this->Intraday_report_model->get_orders_LY($lastYear);
		
			foreach ($data['cart_LY'] as $key => $value) {
				
				$key2=false;
				foreach ($data['cart_TY'] as $key1 => $val) {
					
					if($value['start_time']==$val['start_time'])
					{
						
						$array_cart['start_time']=$val['start_time'];
						$array_cart['end_time']=$val['end_time'];
						$array_cart['cartorderTY']=$val['ototal_order'];
						$array_cart['cartorderLY']=$value['ototal_order'];
						$array_cart_full[$key]=$array_cart;
						$key2=true;
						break;
					}

					$key2=false;
					
				}
					
						
					if($key2==false)
					{ 
						$array_cart['start_time']=$value['start_time'];
						$array_cart['end_time']=$value['end_time'];
						$array_cart['cartorderTY']=0;
						$array_cart['cartorderLY']=$value['ototal_order'];
						$array_cart_full[$key]=$array_cart;
					}
					
						
					
				
			}
			
			
		
		//}
		foreach ($data['cart_TY'] as $key3 => $value3) {
				# code...
			//echo "hellp";
				 $start_time=$value3['start_time'];
				 $val=self::myfunction($array_cart_full,"start_time",$value3['start_time']);

				 //in_multiarray(,,"start_time");
				if($val != $start_time && $val=='')
				{
							$array_cart['start_time']=$value3['start_time'];
							$array_cart['end_time']=$value3['end_time'];
							$array_cart['cartorderTY']=$value3['ototal_order'];
							$array_cart['cartorderLY']=0;
							$array_cart_full[]=$array_cart;
				}
			}
			foreach ($array_time as $k => $v) {
			$start_time=$v['start_time'];
			  $val1=self::myfunction($array_cart_full,"start_time",$v['start_time']);
			if($val1 != $start_time && $val1=='')
			{
						$array_cart['start_time']=$v['start_time'];
						$array_cart['end_time']=$v['end_time'];
						$array_cart['orderTY']=0;
						$array_cart['orderLY']=0;
						$array_cart_full[]=$array_cart;
			}
		}
		sort($array_cart_full);
		//print_r($array_cart_full);
		
		foreach ($data['orders_LY'] as $key => $value) {
				
				$key2=false;
				foreach ($data['orders_TY'] as $key1 => $val) {
					
					if($value['start_time']==$val['start_time'])
					{
						
						$array_orders['start_time']=$val['start_time'];
						$array_orders['end_time']=$val['end_time'];
						$array_orders['orderTY']=$val['ototal_order'];
						$array_orders['orderLY']=$value['ototal_order'];
						$array_orders_full[$key]=$array_orders;
						$key2=true;
						break;
					}

					$key2=false;
					
				}
					
						
					if($key2==false)
					{ 
						$array_orders['start_time']=$value['start_time'];
						$array_orders['end_time']=$value['end_time'];
						$array_orders['orderTY']=0;
						$array_orders['orderLY']=$value['ototal_order'];
						$array_orders_full[$key]=$array_orders;
					}
					
						
					
				
			}
			
			
		
		//}
		foreach ($data['orders_TY'] as $key3 => $value3) {
				# code...
			//echo "hellp";
			     $start_time=$value3['start_time'];
				 $val=self::myfunction($array_orders_full,"start_time",$value3['start_time']);

				 //in_multiarray(,,"start_time");
				if($val != $start_time && $val=='')
				{
							$array_orders['start_time']=$value3['start_time'];
							$array_orders['end_time']=$value3['end_time'];
							$array_orders['orderTY']=$value3['ototal_order'];
							$array_orders['orderLY']=0;
							$array_orders_full[]=$array_orders;
				}
			}
			
		foreach ($array_time as $k => $v) {
			$start_time=$v['start_time'];
			  $val1=self::myfunction($array_orders_full,"start_time",$v['start_time']);
			if($val1 != $start_time && $val1=='')
			{
						$array_orders['start_time']=$v['start_time'];
						$array_orders['end_time']=$v['end_time'];
						$array_orders['orderTY']=0;
						$array_orders['orderLY']=0;
						$array_orders_full[]=$array_orders;
			}
		}
		sort($array_orders_full);
		//print_r($array_orders_full);
		foreach ($array_orders_full as $k4 => $v4) {
			# code...
			foreach ($array_cart_full as $k5 => $v5) {
				# code...
				if($v4['start_time']==$v5['start_time'])
					{
						
						$array_reports['start_time']=$v5['start_time'];
						$array_reports['end_time']=$v5['end_time'];
						$array_reports['cartorderTY']=$v5['cartorderTY'];
						$array_reports['cartorderLY']=$v5['cartorderLY'];
						$array_reports['orderTY']=$v4['orderTY'];
						$array_reports['orderLY']=$v4['orderLY'];
						$array_reports_full[$k5]=$array_reports;
						//$key2=true;
						break;
					}
			}
		}
		sort($array_orders_full);
		//print_r($array_reports_full);
		$data['array_reports_full']=$array_reports_full;
		//print_r($data['array_reports_full']);
		$this->load->view('admin/intraday_report',$data);
	}

 		function myfunction($orders, $field, $value)
		{
		   foreach($orders as $key => $order)
		   {
		      if ( $order[$field] == $value )
		         return $value;
		   }
		   return false;
		}


	function search()
	{
		$thisYear=$this->input->post('search');
		$w=self::weekdays($thisYear);
		$data['show_date']=$thisYear." ".$w;
		//$thisYear=date('Y-m-d');
		$lastYear=date('Y-m-d',strtotime($thisYear.' -1 year'));
		//die();
		$array_time=array();
		for ($i=0; $i <24 ; $i++) { 
			$array_time[$i]['start_time']=$i;
			$array_time[$i]['end_time']=$i+1;
			if($i==23)
			{
				$array_time[$i]['end_time']=0;
			}
			
		}
		//print_r($array_time);
		$array_reports=array();
		$array_reports_full=array();
		$array_cart=array();
		$array_cart_full=array();
		$array_orders=array();
		$array_orders_full=array();
		
		$data['cart_TY']=$this->Intraday_report_model->get_cart_TY($thisYear);
		$data['cart_LY']=$this->Intraday_report_model->get_cart_LY($lastYear);
		$data['orders_TY']=$this->Intraday_report_model->get_orders_TY($thisYear);
		$data['orders_LY']=$this->Intraday_report_model->get_orders_LY($lastYear);
		
			foreach ($data['cart_LY'] as $key => $value) {
				
				$key2=false;
				foreach ($data['cart_TY'] as $key1 => $val) {
					
					if($value['start_time']==$val['start_time'])
					{
						
						$array_cart['start_time']=$val['start_time'];
						$array_cart['end_time']=$val['end_time'];
						$array_cart['cartorderTY']=$val['ototal_order'];
						$array_cart['cartorderLY']=$value['ototal_order'];
						$array_cart_full[$key]=$array_cart;
						$key2=true;
						break;
					}

					$key2=false;
					
				}
					
						
					if($key2==false)
					{ 
						$array_cart['start_time']=$value['start_time'];
						$array_cart['end_time']=$value['end_time'];
						$array_cart['cartorderTY']=0;
						$array_cart['cartorderLY']=$value['ototal_order'];
						$array_cart_full[$key]=$array_cart;
					}
					
						
					
				
			}
			
			
		
		//}
		foreach ($data['cart_TY'] as $key3 => $value3) {
				# code...
			//echo "hellp";
				 $start_time=$value3['start_time'];
				 $val=self::myfunction($array_cart_full,"start_time",$value3['start_time']);

				 //in_multiarray(,,"start_time");
				if($val != $start_time && $val=='')
				{
							$array_cart['start_time']=$value3['start_time'];
							$array_cart['end_time']=$value3['end_time'];
							$array_cart['cartorderTY']=$value3['ototal_order'];
							$array_cart['cartorderLY']=0;
							$array_cart_full[]=$array_cart;
				}
			}
			foreach ($array_time as $k => $v) {
			$start_time=$v['start_time'];
			  $val1=self::myfunction($array_cart_full,"start_time",$v['start_time']);
			if($val1 != $start_time && $val1=='')
			{
						$array_cart['start_time']=$v['start_time'];
						$array_cart['end_time']=$v['end_time'];
						$array_cart['orderTY']=0;
						$array_cart['orderLY']=0;
						$array_cart_full[]=$array_cart;
			}
		}
		sort($array_cart_full);
		//print_r($array_cart_full);
		
		foreach ($data['orders_LY'] as $key => $value) {
				
				$key2=false;
				foreach ($data['orders_TY'] as $key1 => $val) {
					
					if($value['start_time']==$val['start_time'])
					{
						
						$array_orders['start_time']=$val['start_time'];
						$array_orders['end_time']=$val['end_time'];
						$array_orders['orderTY']=$val['ototal_order'];
						$array_orders['orderLY']=$value['ototal_order'];
						$array_orders_full[$key]=$array_orders;
						$key2=true;
						break;
					}

					$key2=false;
					
				}
					
						
					if($key2==false)
					{ 
						$array_orders['start_time']=$value['start_time'];
						$array_orders['end_time']=$value['end_time'];
						$array_orders['orderTY']=0;
						$array_orders['orderLY']=$value['ototal_order'];
						$array_orders_full[$key]=$array_orders;
					}
					
						
					
				
			}
			
			
		
		//}
		foreach ($data['orders_TY'] as $key3 => $value3) {
				# code...
			//echo "hellp";
			     $start_time=$value3['start_time'];
				 $val=self::myfunction($array_orders_full,"start_time",$value3['start_time']);

				 //in_multiarray(,,"start_time");
				if($val != $start_time && $val=='')
				{
							$array_orders['start_time']=$value3['start_time'];
							$array_orders['end_time']=$value3['end_time'];
							$array_orders['orderTY']=$value3['ototal_order'];
							$array_orders['orderLY']=0;
							$array_orders_full[]=$array_orders;
				}
			}
			
		foreach ($array_time as $k => $v) {
			$start_time=$v['start_time'];
			  $val1=self::myfunction($array_orders_full,"start_time",$v['start_time']);
			if($val1 != $start_time && $val1=='')
			{
						$array_orders['start_time']=$v['start_time'];
						$array_orders['end_time']=$v['end_time'];
						$array_orders['orderTY']=0;
						$array_orders['orderLY']=0;
						$array_orders_full[]=$array_orders;
			}
		}
		sort($array_orders_full);
		//print_r($array_orders_full);
		foreach ($array_orders_full as $k4 => $v4) {
			# code...
			foreach ($array_cart_full as $k5 => $v5) {
				# code...
				if($v4['start_time']==$v5['start_time'])
					{
						
						$array_reports['start_time']=$v5['start_time'];
						$array_reports['end_time']=$v5['end_time'];
						$array_reports['cartorderTY']=$v5['cartorderTY'];
						$array_reports['cartorderLY']=$v5['cartorderLY'];
						$array_reports['orderTY']=$v4['orderTY'];
						$array_reports['orderLY']=$v4['orderLY'];
						$array_reports_full[$k5]=$array_reports;
						//$key2=true;
						break;
					}
			}
		}
		sort($array_orders_full);
		//print_r($array_reports_full);
		$data['array_reports_full']=$array_reports_full;
		//print_r($data['array_reports_full']);
		$this->load->view('admin/intraday_report',$data);
	}


	function get_interval_report()
	{	$thisYear=date('Y-m-d');
		$w=self::weekdays($thisYear);
		$data['show_date']=$thisYear." ".$w;
		$lastYear=date('Y-m-d',strtotime($thisYear.' -1 year'));

		if (isset($_POST) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
			//echo json_encode(array('result' => 'ok', 'message' => $message));
			$start_time=$_POST['start_time'];
			$end_time=$_POST['end_time'];
			$data['session_dataTY']=$this->Intraday_report_model->session_dataTY($thisYear,$start_time,$end_time);
			//print_r($data['session_dataTY']);
			$carts_TY=$data['session_dataTY']['ctotal_order'];
			$orders_TY=$data['session_dataTY']['total_order'];
			$data['session_dataLY']=$this->Intraday_report_model->session_dataLY($lastYear,$start_time,$end_time);
			//print_r($data['session_dataLY']);
			$carts_LY=$data['session_dataLY']['ctotal_order'];
			$orders_LY=$data['session_dataLY']['total_order'];

			  $FD1TY_conversion=round(((($orders_TY)*100)/$carts_TY),2);
              $FD1LY_conversion=round(((($orders_LY)*100)/$carts_LY),2);
              $FD1TY=$FD1TY_conversion*100;
              $FD1LY=$FD1LY_conversion*100;
               if($FD1TY > $FD1LY)
               {
                $dec=0;
                $FD1TY_FD1LY_diff=(($FD1TY)-($FD1LY));
               }
               else
               {
                $dec=1;
                $FD1TY_FD1LY_diff=(($FD1LY)-($FD1TY));
               }

			 echo json_encode(array('status' => 'ok','start_time'=>$start_time,'end_time'=>$end_time,'carts_TY'=>$carts_TY,'orders_TY'=>$orders_TY,'carts_LY'=>$carts_LY,'orders_LY'=>$orders_LY,'FD1TY_conversion'=>$FD1TY_conversion,'FD1LY_conversion'=>$FD1LY_conversion,'FD1TY_FD1LY_diff'=>$FD1TY_FD1LY_diff,'dec'=>$dec));
		}
		else
		{
			echo json_encode(array('status' => 'failed'));
		}
	}
	function weekdays($date)
	{
		$weekday = date('w', strtotime($date));
		//$weekday=date('w');
		if($weekday==0)
		{
			$w='Sunday';
		}
		else if($weekday==1)
		{
			$w='Monday';
		}
		else if($weekday==2)
		{
			$w='Tuesday';
		}
		else if($weekday==3)
		{
			$w='Wednesday';
		}
		else if($weekday==4)
		{
			$w='Thursday';
		}
		else if($weekday==5)
		{
			$w='Friday';
		}
		else
		{
			$w='Saturday';
		}
		return $w;
	}

}