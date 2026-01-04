<style>
table{
	border:none !important;
	
}
td,th{
	border:none !important;
/*	border-bottom:1px solid #CCC !important; */
}
.total1{
	text-align:right;
	font-weight:bold;
	border-top:1px solid #999 !important;
}
form{
	border:1px solid #036;
	width:700px;
	margin:auto;
	padding:5px;
	height:150px;
	
}
form table td{
	vertical-align:middle !important;
	padding:5px;
	max-width:150px;
}
</style>

<div class="content_inner">


<?php
$months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
$transposed = array_slice($months, date('n'), 12, true) + array_slice($months, 0, date('n'), true);
$month = array_reverse(array_slice($transposed, -12, 12, true), true);


$current_year = date('Y');
$range = range($current_year, $current_year-10);
$years = array_combine($range, $range);

$this->set(compact('years')); 

?>


			<?= $this->Form->create() ?>

<h4> Monthly Cash Bank Reports</h4>
<hr />
    <table style="width:650px" border="1" style="border:1px solid #000 !important"><tr><td style="text-align:right;vertical-align:top"> Month</td>
    <td style="width:100px;">
        
         <?=$this->Form->input('month',               
							[   
							'id' => 'birthday',
							'type'=>'select',
							'class'=>'dd',
							'options' => $month,
							'dateFormat' => 'YMD',
							'minYear' => date('Y') - 80,
							'maxYear' => date('Y') - 18,
							'label'   => '',
							'style'=>'border:1px solid #ccc;width:100px;'
							
									
						]);   
						?>
                      
		</td><td style="width:100px;">
                           <?=$this->Form->input('year',               
                        [   
             
                        'id' => 'employ_date',
						'type'=>'select',
						'class'=>'dd',
						'options' => $years,
						'dateFormat' => 'YMD',
						'minYear' => date('Y') - 80,
						'maxYear' => date('Y') - 18,
						'Placeholder' => 'YEAR',
						'label'   => '',
						'style'=>'border:1px solid #ccc;width:100px;'
            
                    ]);   
                    ?>
</td><td>&nbsp;
  <?=$this->Form->button('View Report', array('class'=>'custom_submit','style'=>'min-width:150px'));  ?></td></tr></table>
  <?= $this->Form->end() ?>   
</div>

<?php 
	$bank_amount=$up_to_lastbalance_bank_debit-$up_to_lastbalance_bank_credit;
	//echo $prbalance;
	$bl='';
	if($bank<0)
	{
		$bl=number_format(abs($bank_amount),2). " Cr.";
	}
	else
	{
		$bl=number_format(abs($bank_amount),2). " Dr.";
	}
	
	$cash_amount=$up_to_lastbalance_cash_debit-$up_to_lastbalance_cash_credit;
	//echo $prbalance;
	$bln='';
	if($cash_amount<0)
	{
		$bln=number_format(abs($cash_amount),2). " Cr.";
	}
	else
	{
		$bln=number_format(abs($cash_amount),2). " Dr.";
	}
	
	//echo $bln;//,".",'');
	//,".",'');  ?>
    
<div  style="padding-right:15px;float:right;color:#97004B; font-size:15px; font-family:Tahoma, Geneva, sans-serif">Openning Balance [ Bank ] : &nbsp;<span><?=$bl;?></span></div>
<div style="clear:both"></div>
<div  style="padding-right:15px;float:right;color:#97004B; font-size:15px; font-family:Tahoma, Geneva, sans-serif">Openning Balance [ Cash ] : &nbsp;<span><?=$bln;?></span></div>
<div style="clear:both"></div>
<div  style=";border-top:1px solid #000;padding-right:15px;float:right;color:#97004B; font-size:15px; font-family:Tahoma, Geneva, sans-serif"><b>Openning Balance [ Total ] : &nbsp;<span><?php
$ttl=$bank_amount+$cash_amount;
if($ttl>0)
{
	
echo number_format($ttl,2)." Dr.";
}
else
{
	echo number_format(abs($ttl),2)." Cr.";
}?></span></b></div>
   
     
     
   


   

    

<br /><br /><br /><br />
<table class="table-bordered" >
    <tr>
        <td colspan="2" style="text-align:center;width:50%"><b>AMOUNT - IN</b></td>
        <td colspan="2" style="text-align:center;width:50%"><b>AMOUNT - OUT</b></td>
    </tr>
 
 
    <tr style="vertical-align:top">
    
        <td colspan="2">
       		 <table class="table-bordered" align="left" >
                  <tr>
                      <td><b>A/C Name</b></td>
                      <td><b>Amount</b></td>
                  </tr>
     
                   <tr>
                        
                           <?php
						  
						 
						   $run_sum=0;
                            foreach($general_ledger as $a):
							
                            ?>
                        		
                           <?php
						   $found=false;
                            foreach($bank as $b):
								
									if($b==$a["GeneralLedger__VCH_LDG_ID"])
									{
										
										$found=true;
										break;
									}
							endforeach;
						 
							if( ($a["GeneralLedger__VCH_LDG_ID"]!=12) && ($found!=true) )
							{
                            ?>
                        		
                   
                           
                                   <?php
                                if($a["TOTAL_DEBIT"]>0)
                                {
                                ?>
                                      <td><?php echo $a["GeneralLedger__VCH_LDG_NAME"].'  '.$found.'&nbsp;'.$a["GeneralLedger__VCH_LDG_ID"];?> </td>
                                        <td style="text-align:right"> <?php echo number_format($a["TOTAL_DEBIT"],2);?></td>
                                <?php
								$run_sum=$run_sum+$a["TOTAL_DEBIT"];
								
                                }
							}
                                ?>
                       
                  </tr>
                 			
                  
        				<?php endforeach;?> 
                        
                        <tr>
                        
                  		
                        </tr>
                        
                      
        
        </td>
        
        </table>
        
        
        
        
        
        <td colspan="2" style="border-left:1px solid #666 !important">
                    <table class="table-bordered"  >
                          <tr>
                      <td><b>A/C Name</b></td>
                      <td><b>Amount</b></td>
                          </tr>
                  
                  
                           <tr>
                           
                            <?php
							
							$sum=0;
                            foreach($general_ledger as $a):
                            ?>
                            
                            
                             <?php
						   $found=0;
						 
                            foreach($bank as $b):
							
							if($b==$a["GeneralLedger__VCH_LDG_ID"])
							{
								
								$found=1;
								break;
							}
						 endforeach;

							if(($found!=true) && ($a["GeneralLedger__VCH_LDG_ID"]!=12))
							{
                            ?>
                        		
                          
                                   <?php
                                if($a["TOTAL_CREDIT"]>0)
                                {
                                ?>
                                      <td><?php echo $a["GeneralLedger__VCH_LDG_NAME"]?> </td>
                                       <td style="text-align:right"> <?php echo number_format($a["TOTAL_CREDIT"],2);?></td>
                                      
                                <?php
								$sum=$sum+$a["TOTAL_CREDIT"];
								
                                }
							}
                                else
                                {
                                ?>
                                
                                <?php
                                }
                                ?>
                            
                          </tr>
                			
               			 <?php endforeach;?> 
                         
                         
                           
                </table>
       		 </td>
            
      
   
  
</tr>
<tr>
<td style="border:1px solid #666 !important;font-weight:bold">Total In</td>
                         <td style="text-align:right;border:1px solid #666 !important;font-weight:bold"> <?php echo number_format($run_sum,2);?></td>
                         <td style="border:1px solid #666 !important;font-weight:bold"> Total Out</td>
                          <td style="text-align:right;border:1px solid #666 !important;font-weight:bold"> <?php echo number_format($sum,2);?></td>
                          
                         </tr>
</table>



<div  style="padding-right:15px;float:right;color:#97004B; font-size:15px; font-family:Tahoma, Geneva, sans-serif">Balance [ Bank ] : &nbsp;<span><?php
if ($cash_bank_in>0)
{
	echo number_format($cash_bank_in,2)." Dr.";
}
else
{	echo number_format(abs($cash_bank_in),2)." Cr.";
}?></span></div>
<div style="clear:both"></div>
<div  style="padding-right:15px;float:right;color:#97004B; font-size:15px; font-family:Tahoma, Geneva, sans-serif">Balance [ Cash ] : &nbsp;<span>
<?php
if ($cash_bank_out>0)
{
	echo number_format($cash_bank_out,2)." Dr.";
}
else{
	echo number_format(abs($cash_bank_out),2)." Cr.";

}?></span></div>
<div style="clear:both"></div>
<div  style=";border-top:1px solid #000;padding-right:15px;float:right;color:#97004B; font-size:15px; font-family:Tahoma, Geneva, sans-serif"><b>Balance [ Total ] : &nbsp;<span><?php
$ttl_r=$run_sum+$sum;
//echo $ttl-$ttl_r;
$ttl2=$cash_bank_in+$cash_bank_out;
if($ttl2>0)
{
	
echo number_format($ttl2,2)." Dr.";
}
else
{
	echo number_format(abs($ttl2),2)." Cr.";
}?></span></b></div>
   



        </div>
    </div>
        
