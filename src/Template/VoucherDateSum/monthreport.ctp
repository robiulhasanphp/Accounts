

<div class="dash_board">
<table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
		<div class="dash_left">
            <div class="box">         
            <h1 class="bar_title small_h">Cash Summery</h1>
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
                
                
 <h4 class="small_h">&nbsp;Cash Summery <?php echo "<span id='balance' style='float:right;padding-right:10px;'></span>"; ?> &nbsp;&nbsp;</h4>
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
						   
						   
						   .c {
											float: left;
											font-size: 14px;
											font-weight: normal;
											min-width: 0px;;
											padding-top: 8px;
											width: auto;
									  }
						   
    						</style>



     <?php                 
		$year = array('2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020',
		'2021' => '2021');

$this->set(compact('year')); 

$month = array('01' => 'JAN', '02' => 'FEB', '03' => 'MARCH', '04' => 'APRIL', '05' => 'MAY',
 '06' => 'JUN', '07' => 'JULY', '08' => 'AUG', '09' => 'SEP', '10' => 'OCT','11' => 'NOV','12' => 'DEC',);

$this->set(compact('month')); 

?>

    <div class="mini_box">

<?= $this->Form->create() ?>
		 
        
  
      
      <p style="float:left">FROM</p>
 
        
         <?=$this->Form->input('from_month',               
							[   
							'id' => 'birthday',
							'type'=>'select',
							'class'=>'dd',
							'options' => $month,
							'dateFormat' => 'YMD',
							'minYear' => date('Y') - 80,
							'maxYear' => date('Y') - 18,
							'label'   => '',
							'Placeholder' => 'MONTH',
							'style'=>'border:1px solid #ccc;width:100px;'
							
									
						]);   
						?>
                      
		
                           <?=$this->Form->input('from_year',               
                        [   
             
                        'id' => 'employ_date',
						'type'=>'select',
						'class'=>'dd',
						'options' => $year,
						'dateFormat' => 'YMD',
						'minYear' => date('Y') - 80,
						'maxYear' => date('Y') - 18,
						'Placeholder' => 'YEAR',
						'label'   => '',
						'style'=>'border:1px solid #ccc;width:100px;'
            
                    ]);   
                    ?>
                    
                    
                    
                       
  <?=$this->Form->button('View Ledger', array('class'=>'custom_submit','style'=>'float:left;'));  ?>
  <?= $this->Form->end() ?>   
        
        </div>
        
        




<?php



if (isset($from_month))
{


?>


    <?php 
				$sql = "SELECT general_ledger.VCH_LDG_ID,general_ledger.VCH_LDG_NAME,Sum(general_ledger.VCH_DEBIT) AS TOTAL_IN FROM
general_ledger WHERE Month(VCH_DATE)= ".$from_month." AND YEAR(VCH_DATE)= ".$from_year." AND LDG_ID = 12 AND VCH_DEBIT > 0 
GROUP BY general_ledger.VCH_LDG_ID,general_ledger.VCH_LDG_NAME ORDER BY general_ledger.VCH_LDG_NAME ASC";
					
$TOTAL_IN = $conn->execute($sql);//->fetch('assoc');
										
										
					$sql = "SELECT general_ledger.VCH_LDG_ID,general_ledger.VCH_LDG_NAME,Sum(general_ledger.VCH_CREDIT) AS TOTAL_OUT FROM
general_ledger WHERE Month(VCH_DATE)= ".$from_month." AND YEAR(VCH_DATE)= ".$from_year." AND LDG_ID = 12 AND
 VCH_DEBIT > 0 GROUP BY general_ledger.VCH_LDG_ID,general_ledger.VCH_LDG_NAME ORDER BY general_ledger.VCH_LDG_NAME ASC";
							
$TOTAL_OUT = $conn->execute($sql);//->fetch('assoc');					

										
		?> 




   
                            
<table class="table-bordered" >
   		
        <tr>
        <td style="text-align:center; background-color:#FF681A; color:#FFF">Total in </td>
        <td style="text-align:center; background-color:#FF681A; color:#FFF">Total out</td>
        </tr>
        
      
      <tr>
      
            <td>
                    <table class="table-bordered" >
                                <tr>
                                
                                <td>Ledger Code</td>
                                <td>Ledger Name</td>
                                <td>Total</td>
                                
                                </tr>
                                
                                <?php
		//  var_dump($Ledgers);
			$total = 0;
		  foreach($TOTAL_IN as $a):?>
                                
                                
                                 <tr>
                
                <td><?php echo $a['VCH_LDG_ID']?></td>
                <td><?php echo $a['VCH_LDG_NAME']?></td>
                <td><?php  echo number_format(abs($a['TOTAL_IN']),2)?></td>
              
              <?php $total=$total+$a['TOTAL_IN']?>
		 
                                </tr>
                                
                 <?php endforeach;?>
                 
                 
                  <tr>
          	 <th colspan="2" >Total</th><th style="text-align:right; font-weight:bold; letter-spacing:1px;"><?php  if($total<0){
				   
				   
				   
				   echo number_format(abs($total),2)." Cr";
			   }
			   else{echo number_format($total,2)." Dr";} ?>
               </th>
          </tr>
                    
                    </table>
            </td>
            
            
            
             <td>
                    <table class="table-bordered" >
                                <tr>
                                
                                 <td>Ledger Code</td>
                                <td>Ledger Name</td>
                                <td>Total</td>
                                
                                </tr>
                               
                               
                                                     <?php
		//  var_dump($Ledgers);
			$total = 0;
		  foreach($TOTAL_OUT as $a):?> 
                                
                                <tr>
           
  
              <td><?php echo $a['VCH_LDG_ID']?></td>
			  <td><?php echo $a['VCH_LDG_NAME']?></td>
              <td><?php  echo number_format(abs($a['TOTAL_OUT']),2)?></td>
            
                <?php $total=$total+$a['TOTAL_OUT']?>
    
		          
                                </tr>
                                
                    <?php endforeach;?>                  
                   <tr>
          	 <th colspan="2" >Total</th><th style="text-align:right; font-weight:bold; letter-spacing:1px;"><?php  if($total<0){
				   
				   
				   
				   echo number_format(abs($total),2)." Cr";
			   }
			   else{echo number_format($total,2)." Dr";} ?>
               </th>
          </tr>
                    
                    
                    </table>
            </td>
            
      </tr>  
      
        
        
         
</table>

  
<?php
}
?>

    

        </div></td></tr></table>

        <script>
		/*		document.write('asdasdasd');*/
		bln=document.getElementById('balance');
/*				document.write('<?php echo $balance_str;?>');*/
		bln.innerHTML='<?php echo "Balannce Upto : ".$bl_date." &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;".$balance_str;?>';


        </script>        
        </div>
        
        
        
