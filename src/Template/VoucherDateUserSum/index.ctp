<div class="dash_board">
<table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
		<div class="dash_left">
            <div class="box">         
            <h1 class="bar_title small_h">Voucher Summery</h1>
            <ul>
            <!--        <li class='plus'><?php echo $this->Html->link("New Purchase", array('controller' => 'Purchase', 'action' => 'add')); ?></li>
            <li class='plus'> <?php echo $this->Html->link("Search your Voucher", array('controller' => 'Dashboard', 'action' => 'search')); ?></li>
                                               
            </ul></div>
            <div class="box">         
            <h1 class="bar_title small_h"></h1>
                                            
            <!--<ul>
            <li class=''><?php echo $this->Html->link("Supplier List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
            <li class=''><?php echo $this->Html->link("Customer List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
            <li class=''><?php echo $this->Html->link("Employee List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
            <li class=''><?php echo $this->Html->link("Bank List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
            <li class=''><?php echo $this->Html->link("Inventory List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
            </ul>-->
            </div>
                        
                             

 </div>
                </td><td style="vertical-align:top" align="left">
                <div class="dash_content">
                
                
 <h4 class="small_h">&nbsp;Voucher Summery <?php echo "<span id='balance' style='float:right;padding-right:10px;'></span>"; ?> &nbsp;&nbsp;</h4>
                           <style>
						  .table-bordered td{
							   font-size:12px;
							   text-align:right;
						   }
						   .total_bottom {
							   color:#030;
							   font-size:12px !important;
							   font-weight:bold;	
						   }
						   
						   .a
						   {
							   float:left;
							   width:200px;
						   }
						   
						   
    						</style>
                            
         <h4 style="color:#BF0000">Today Summery</h4>                    

		<?php  foreach($today_report as $a):?>
        
        <p>Total Voucher:<?php echo $a->TOTAL_VOUCHER?> </p>
        <p>Total Amount:<?php echo $a->TOTAL_CREDIT?> </p>
        
        <?php endforeach;?>



  <h4 style="color:#BF0000">yesterday  Summery</h4>                    

		<?php  foreach($yesterday_report as $a):?>
        
        <p>Total Voucher:<?php echo $a->TOTAL_VOUCHER?> </p>
        <p>Total Amount:<?php echo $a->TOTAL_CREDIT?> </p>
        
        <?php endforeach;?>



 <h4 style="color:#BF0000">This Month  Summery</h4>                    

		<?php  foreach($this_m_report as $a):?>
        
        <p>Total Voucher:<?php echo $a->t_voucher?> </p>
       
        <p>Total Amount:<?php echo $a->t_amount?> </p>
        
        <?php endforeach;?>
        
        
         <h4 style="color:#BF0000">last Month  Summery</h4>                    

		<?php  foreach($last_m_report as $a):?>
        
       <p>Total Voucher:<?php echo $a->t_voucher?> </p>
        <p>Total Amount:<?php echo $a->t_amount?> </p>
        
        <?php endforeach;?>
        
        
        
           <h4 style="color:#BF0000">This Year  Summery</h4>                    

		<?php  foreach($this_y_report as $a):?>
        
          <p>Total Voucher:<?php echo $a->t_voucher?> </p>
        <p>Total Amount:<?php echo $a->t_amount?> </p>
        
        <?php endforeach;?>


   
        </div></td></tr></table>

        <script>
		/*		document.write('asdasdasd');*/
		bln=document.getElementById('balance');
/*				document.write('<?php echo $balance_str;?>');*/
		bln.innerHTML='<?php echo "Balannce Upto : ".$bl_date." &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;".$balance_str;?>';


        </script>        
        </div>
        
        
        
