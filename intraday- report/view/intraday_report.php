<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
<style type="text/css">
  #intraday table{
    border-style: solid; border-width: 1px; border-color: #CCCCCC;
  }
  #intraday td{
    border-right-style:solid; border-width: 1px; border-color: #CCCCCC;
  }
  #intraday td{
    border-bottom-style:solid; border-width: 1px; border-color: #CCCCCC;
  }
 #intraday tr td:last-child {
    border-right-style: none;

}
#intraday tr:last-child td {
    border-bottom-style: none;
    
}
#FDtime {
  border-right-style:solid; border-width: 1px; border-color: #CCCCCC;
}
</style>
  <div id="contents-wrapper">
    <h2>Intraday Report <!-- <a href="<?php echo $this->config->base_url()."siteadmin/customers";?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a> -->    </h2>
        <div id="shadow">
	<?php if(count($array_reports_full)): ?>
    <div id="intraday_search">
      <?php echo form_open('/siteadmin/intraday_report/search');?>
        Change start date: <input type="text" placeholder='yyyy-mm-dd' name="search" id="search" /> (e.g. YYYY-MM-DD)
        <input type="submit"  id="report" name="submit" value="View from Date" />
        
      </form>      
    </div>
    <div >
    <table id="intraday" align="center" cellpadding="5" cellspacing="1" style="border-style: solid; border-width: 1px; border-color: #CCCCCC; margin-top:10px;" >
      <tr>
      <td bgcolor="#65b960" style="font-size:18px; color: #000 !important; text-shadow:none!important;" colspan="9"><center><?php echo $show_date; ?></center></td>
      </tr>
      <tr>
      <td colspan="3" bgcolor="#65b960">&nbsp;</td>
      <td colspan="2" style="font-size:14px; background-color:#00CC33 !important; border-bottom:none !important; color: #000 !important; text-shadow:none!important;"><center>Conversion Monitor</center></td>
      <td style="text-shadow:none!important;" colspan="2" bgcolor="#CCCCCC"> TY Data</td>
      <td style="text-shadow:none!important;"  colspan="2" bgcolor="#CCCCCC"> LY Data</td>
      </tr>
      <tr>
      <td style="text-shadow:none!important;" width="110" scope="col" colspan="2" bgcolor="#CCCCCC">Time</td>
      <td style="text-shadow:none!important;" width="120" bgcolor="#CCCCCC"> TY Conversion TY</td>
      <td style="text-shadow:none!important;" width="120" bgcolor="#CCCCCC"> LY Conversion TY</td>
      <td style="text-shadow:none!important;" width="130" bgcolor="#CCCCCC"> TY v. LY Differential</td>
      <td style="text-shadow:none!important;" width="60" bgcolor="#CCCCCC">Sessions</td>
      <td style="text-shadow:none!important;" width="60" bgcolor="#CCCCCC">Orders</td>
      <td style="text-shadow:none!important;" width="60" bgcolor="#CCCCCC">Sessions</td>
      <td style="text-shadow:none!important;" width="60" bgcolor="#CCCCCC">Orders</td>
      </tr>
      
      <?php
     //echo '<pre>';
    // print_r($array_reports_full);
      $start_time='';
      $end_time='';
      $cartTY=0;
      $cartLY=0;
      $ordersTY=0;
      $ordersLY=0;
      $FD1TY_conversion=0;
      $FD1LY_conversion=0;
      $dec='';
      $FD1TY_FD1LY_diff=0;
      $sign='';


      foreach ($array_reports_full as $key => $value) :
        if($value['start_time']< 12)
          { 
                  if($value['start_time']==0)
                  {
                     $start_time="12 AM";
                     $end_time=$value['end_time']." AM";
                  }
                  else
                  {
                     $start_time=$value['start_time']." AM";
                     $end_time=$value['end_time']." AM";
                  }
                  if($value['start_time']==11)
                  {
                    $start_time=$value['start_time']." AM";
                    $end_time="12 PM";
                  }

              }
               
              if($value['start_time']>=12 && $value['end_time']<24)
              {
                 
                  $start_time=($value['start_time']-12)." PM";
                  $end_time=($value['end_time']-12)." PM";
                  if($value['start_time']==12)
                    {
                      $start_time=$value['start_time']." PM";
                      $end_time="1 PM";
                    }
                  if($value['end_time']==0)
                    {
                      $start_time=($value['start_time']-12)." PM";
                      $end_time="12 AM";
                    }
                }

              $cartTY=$value['cartorderTY'];
              $cartLY=$value['cartorderLY'];
              $ordersTY=$value['orderTY'];
              $ordersLY=$value['orderLY'];
              /*$cartTY=288;
              $cartLY=390;
              $ordersTY=24;
              $ordersLY=36;*/
             /* $cartTY=204;
              $cartLY=230;
              $ordersTY=18;
              $ordersLY=17;*/
              $FD1TY_conversion=round(((($ordersTY)*100)/$cartTY),2);
              $FD1LY_conversion=round(((($ordersLY)*100)/$cartLY),2);
              $FD1TY=$FD1TY_conversion*100;
              $FD1LY=$FD1LY_conversion*100;
               if($FD1TY > $FD1LY)
               {
                $dec=0;
                $sign='';
                $FD1TY_FD1LY_diff=(($FD1TY)-($FD1LY));
               }
               else
               {
                $dec=1;
                $sign='-';
                $FD1TY_FD1LY_diff=(($FD1LY)-($FD1TY));
               }
              ?>
      <tr>
      <td id="FDtime1" ><?php echo $start_time;?> </td>
      <td id="FDtime2" > <?php echo $end_time;?></td>
      <td id="FD1TY_conversion_<?php echo $value['start_time']."-".$value['end_time'];?>"><?php echo $FD1TY_conversion; ?>%</td>
      <td id="FD1LY_conversion_<?php echo $value['start_time']."-".$value['end_time'];?>"><?php echo $FD1LY_conversion; ?>%</td>
      <td id="FD1TY_FD1LY_diff_<?php echo $value['start_time']."-".$value['end_time'];?>" <?php if ($dec==1) {?>style="color:#FF0000;"<?php } else{?>style="color:#00FF00;"<?php }?>><?php echo $sign.$FD1TY_FD1LY_diff; ?></td>
      <td id="cartTY_<?php echo $value['start_time']."-".$value['end_time'];?>"><?php echo $cartTY; ?></td>
      <td id="ordersTY_<?php echo $value['start_time']."-".$value['end_time'];?>"><?php echo $ordersTY; ?></td>
      <td id="cartLY_<?php echo $value['start_time']."-".$value['end_time'];?>"><?php echo $cartLY; ?></td>
      <td id="ordersLY_<?php echo $value['start_time']."-".$value['end_time'];?>"><?php echo $ordersLY; ?></td>
      </tr>
      
       <?php endforeach;  ?>
      
    </table>

    <?php else: ?>
    <p class="notfound">Sorry No <?php echo $this_class; ?> Found.</p>
    <?php endif; ?>
        </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>


  <script>
  $(document).ready(function () {
      // alert('hello');
  // function to poll the server and get the new users from your script
      $("#report").click(function(){
        if($("#search").val()==''){
          alert("search field can't be empty");
          $("#search").focus();
          return false;
        }
        
        var s = $("#search").val();
        console.log(s);
        if(s.match(/^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/))
         {
         
         }
         else
         {
         alert("Invalid Date, Please use YYYY-MM-DD fomat!");
         }
       
      });

    var CheckNewOrders = function () {

      var d = new Date();
      //var ndt=<?php echo date('H'); ?>;
      //console.log("ndt"+ndt);
      //var start_time = d.getHours() ;
      var start_time=<?php echo date('H'); ?>
      // var current_hour=new Date().getTime();
      //var start_time=current_hour+':00:00';
      //var end_time=current_hour +':59:59';
      console.log(d);
      var end_time=start_time + 1;
      if(end_time==24)
      {
        end_time=0;
      }
      //console.log('current_hour '+start_time);
      console.log('start_time '+start_time);
      console.log('end_time '+end_time);
      //console.log('date ' + d);
       /*$.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . 'siteadmin/intraday_report/get_interval_report' ?>',
                    dataType: 'json',
                    cache: false,
                    data: {start_time: start_time,end_time:end_time},
                    success: function (response) {
                      if(data.result == 'ok')
                      {
                     },
                    error: function (x, s, e) {
                        alert('Error occured in report section');
                    }
                });*/
              $.post("<?php echo base_url(); ?>siteadmin/intraday_report/get_interval_report",{start_time: start_time,end_time:end_time}, function(data) { 
                var obj = jQuery.parseJSON(data);
                console.log(data);

               if(obj.status=='ok')
               {
                
                var start_time=obj.start_time;
                var end_time=obj.end_time;
                var cartTY=obj.carts_TY;
                var cartLY=obj.carts_LY;
                var ordersTY=obj.orders_TY;
                var ordersLY=obj.orders_LY;
                var FD1TY_conversion=obj.FD1TY_conversion+'%';
                var FD1LY_conversion=obj.FD1LY_conversion+'%';
                var dec=obj.dec;
                var FD1TY_FD1LY_diff=obj.FD1TY_FD1LY_diff;
                
                if(dec=='1')
                {
                //  console.log('red');
                  FD1TY_FD1LY_diff='-'+FD1TY_FD1LY_diff;
                  $("#FD1TY_FD1LY_diff_"+start_time+'-'+end_time).css({color:'#FF0000'});
                }
                else
                {
                  FD1TY_FD1LY_diff=FD1TY_FD1LY_diff;
                  $("#FD1TY_FD1LY_diff_"+start_time+'-'+end_time).css({color:'#00FF00'});
                 // console.log('green');
                }
                $("#FD1TY_conversion_"+start_time+'-'+end_time).html(FD1TY_conversion);
                $("#FD1LY_conversion_"+start_time+'-'+end_time).html(FD1LY_conversion);
                $("#FD1TY_FD1LY_diff_"+start_time+'-'+end_time).html(FD1TY_FD1LY_diff);
                $("#cartTY_"+start_time+'-'+end_time).html(cartTY);
                $("#ordersTY_"+start_time+'-'+end_time).html(ordersTY);
                $("#cartLY_"+start_time+'-'+end_time).html(cartLY);
                $("#ordersLY_"+start_time+'-'+end_time).html(ordersLY);
               }
         
         });
      };
  // and set the function to run every 5 minutes
  // 1000 * 60= 1 min
  setInterval(CheckNewOrders, 60000);  // 300000 milli = 5 minutes

});</script>
<script src="<?php echo theme_url(); ?>/js/jquery.js"></script>
  <?php include_once("footer.php");?>
  
