
<style type="text/css">
	.x td{ text-align:right;}
</style>


<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Purchase</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("New Purchase", array('controller' => 'Purchase', 'action' => 'add')); ?></li>
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
                
                

                           <style>
						   td{
							   font-size:11px;
						   }
						   .total_bottom {
							   color:#030;
							   font-size:12px !important;
							   font-weight:bold;
						   }
    						</style>



  <h4 class="small_h" style="color:#000099">&nbsp;Total Voucher & Amount</h4>
                   

<table class="table-bordered x" style="text-align:center">
    <tr style=" background-color:#F26522; color:#FFF">
          	<th style="text-align:center">type</th>
          	<th colspan="2" style="text-align:center">today</th>
            <th colspan="2" style="text-align:center">this month</th>
            <th colspan="2" style="text-align:center">last month</th>
        	<th colspan="2" style="text-align:center">this year</th>
         
          </tr>
        
        
    <tr align="center">
        <td>&nbsp;</td>

            
                    <td style="text-align:center">voucher</td>
                    <td style="text-align:center">Amount</td>
               
            
                    <td style="text-align:center">voucher</td>
                    <td style="text-align:center">Amount</td>
          
                    <td style="text-align:center">voucher</td>
                    <td style="text-align:center">Amount</td>
           
                    <td style="text-align:center">voucher</td>
                    <td style="text-align:center">Amount</td>
               
        
        
    </tr> 
    
	
	
<?php	

	$total_day_v=0;
	$total_day_a=0;
	$total_m_v=0;
	$total_m_a=0;
	$last_month_v=0;
	$last_month_a=0;
	$this_y_t_v=0;
	$this_y_t_a=0;
	

foreach ($VOUCHER_TYPE as $v_type): ?>

<tr >
<td style="text-align:left;"><?=$v_type->BAS_NAME;?></td>
<?php
	
	$vtype=$v_type->BAS_ID;
	
	$found=0;
	foreach($today_voucher as $today)
	{	//echo "<td>".$vtype."</td>";
		if ($vtype== $today->VCH_TYPE)
		{
		
		?>
			
			<td style="text-align:right; float:right;"><?php echo  $today->t_type;?></td>
            <td>
            <?php
            
            echo number_format($today->t_salary,2);
            ?>
            </td>
		
			<?php
			
			$total_day_v=$total_day_v+$today->t_type;
			$total_day_a=$total_day_a+$today->t_salary;

				$found=1;
				break;
			}
		
	}
	
	if 	($found==0)
	{
	?>
       <td align="right"> 
	   
	   <?php
		echo "0";
		?>
        
        </td>
        
        <td align="right">
        <?php
		echo "0";
	}
	    ?>
      </td>

<?php

	$found=0;
	foreach($Month_Voucher as $today)
	{	//echo "<td>".$vtype."</td>";
		if ($vtype== $today->VCH_TYPE)
		{
		
		?>
			
			<td style="float:right">
			<?php echo  $today->t_type;?>
           </td>
           
           <td style="text-align:right">
            <?php
            
            echo number_format($today->t_salary,2);
            ?>
            </td>
		
			<?php
			
			$total_m_v=$total_m_v+$today->t_type;
			$total_m_a=$total_m_a+$today->t_salary;

				$found=1;
				break;
			}
		
	}
	
	if 	($found==0)
	{
	?>
       <td align="right"> 
	   
	   <?php
		echo "0";
		?>
        
        </td>
        
        <td align="right">
        <?php
		echo "0";
	}
	    ?>
      </td>



<?php






	$found=0;
	foreach($last_m_trial_balance as $today)
	{	//echo "<td>".$vtype."</td>";
		if ($vtype== $today->VCH_TYPE)
		{
		?>
			
			<td align="right"><?php echo  $today->t_type;?></td>
            <td align="right">
            <?php
            
            echo number_format($today->t_salary,2);
            ?>
            </td>
		
			<?php
			
			$last_month_v=$last_month_v+$today->t_type;
			$last_month_a=$last_month_a+$today->t_salary;

				$found=1;
				break;
			}
		
	}
	
	if 	($found==0)
	{
	?>
       <td align="right"> 
	   
	   <?php
		echo "0";
		?>
        
        </td>
        
        <td align="right">
        <?php
		echo "0";
	}
	    ?>
      </td>



<?php





$found=0;
	foreach($this_y_trial_balance as $today)
	{	//echo "<td>".$vtype."</td>";
		if ($vtype== $today->VCH_TYPE)
		{
			?>
			
			<td align="right"><?php echo  $today->t_type;?></td>
            <td align="right">
            <?php
            
            echo number_format($today->t_salary,2);
            ?>
            </td>
		
			<?php
			
			$this_y_t_v=$this_y_t_v+$today->t_type;
			$this_y_t_a=$this_y_t_a+$today->t_salary;

				$found=1;
				break;
			}
		
	}
	
	if 	($found==0)
	{
	?>
       <td align="right"> 
	   
	   <?php
		echo "0";
		?>
        
        </td>
        
        <td align="right">
        <?php
		echo "0";
	}
	    ?>
      </td>






	   </tr>
	   

	
	<?php endforeach; ?>
	 <tr>
        <td style="text-align:left">Total Voucher & balance</td>

            
                    <td align="right" style="color:#F00"><?= $total_day_v;?></td>
                    <td align="right" style="color:#060"><?= number_format($total_day_a,2);?></td>
            
                    <td align="right" style="color:#F00"><?=$total_m_v;?></td>
                    <td align="right" style="color:#060"><?=number_format($total_m_a,2);?></td>
          
                    <td align="right" style="color:#F00"><?=$last_month_v;?></td>
                    <td align="right" style="color:#060"><?=number_format($last_month_a,2);?></td>
               
                    <td align="right" style="color:#F00"><?=$this_y_t_v;?></td>
                    <td align="right" style="color:#060"><?=number_format($this_y_t_a,2);?></td>
    
        
    </tr> 
	</table>
    
    
    
    

		    </table>
                                  

        </div></td></tr></table>

        
        </div>
        