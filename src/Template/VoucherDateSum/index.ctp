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
						   
						   
    						</style>



     <?php                 
		$year = array('2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020');

$this->set(compact('year')); 

$month = array('01' => 'JAN', '02' => 'FEB', '03' => 'MARCH', '04' => 'APRIL', '05' => 'MAY',
 '06' => 'JUN', '07' => 'JULY', '08' => 'AUG', '09' => 'SEP', '10' => 'OCT','11' => 'NOV','12' => 'DEC',);

$this->set(compact('month')); 

?>



<div class="proj_dep">

<?= $this->Form->create() ?>
		  <?= $this->Form->input('name', array(
            'label'=>'Ledger name',
			'options' => $LDG_name,
			'type'=>'select',
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
        
 </div>
        
      <div class="small_box">
      
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
        
        </div>
        
        
     
        
         <div class="small_box">
          
          <p style="float:left">TO</p>
        
         <?=$this->Form->input('to_month',               
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

		
                 <?=$this->Form->input('to_year',               
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
                    
  
        
        </div>
        
        
        
		
   
  <?=$this->Form->button('View Ledger', array('class'=>'custom_submit','style'=>'float:left;'));  ?>
  <?= $this->Form->end() ?>   

                            
<table class="table-bordered " >


    <tr align="left">
              	<th colspan="6" style="text-align:center;font-weight:700">Cash Summery Of This Year [ <span style="color:#060;font-size:12px;"><?php echo date('Y'); ?> </span> ]</th></tr><tr>
                
          	<th>Date</th>
          	<th>voucher</th>
            <th>Opening</th>
            <th>Debit</th>
        	<th>Credit</th>
         
            <th>Balance</th>
          </tr>
        
       <?php
	   if (isset($cash_data))
	   {
	   ?> 
        
        
		<?php
        $last_balance=$last_dr-$last_cr+$voucher_between;
        ?>

		<?php
        $run_sum=0;
        $run_sum=$last_balance;
        
        if ($run_sum<0)
        $balance_str= '<span style="color: red;font-weight:bold" />'. number_format(abs($run_sum),2).' Cr </span>';
        else
        $balance_str= '<span style="color: green;font-weight:bold" />'. number_format(abs($run_sum),2).' Dr </span>';
        
        
        foreach($cash_data as $a):?>
        <tr align="center">
        
        <td><?php $date=$a->VDT_DATE;
        $bl_date= $date->format('d-m-Y');
        echo $bl_date;?></td>
        <td><?php echo $a->TOTAL_VOUCHER?></td>
        <td><?php echo $balance_str;?></td>
        <td><?php echo number_format($a->TOTAL_DEBIT,2);//,'.','')?></td>
        <td><?php echo number_format($a->TOTAL_CREDIT,2);//,'.','')?></td>
			<?php
					$balance=$a->TOTAL_DEBIT-$a->TOTAL_CREDIT;
					$run_sum=$run_sum+$balance;
    		?>


		<td align="center">
			<?php
            if ($run_sum<0)
            $balance_str= '<span style="color: red;font-weight:bold" />'. number_format(abs($run_sum),2).' Cr </span>';
            else
            $balance_str= '<span style="color: black;font-weight:bold" />'. number_format(abs($run_sum),2).' Dr </span>';
            
            echo $balance_str;
            
            ?>



</td>
</tr>



<?php endforeach;?>


			<?php
                   }
            ?>
		    </table>

        </div></td></tr></table>

        <script>
		/*		document.write('asdasdasd');*/
		bln=document.getElementById('balance');
/*				document.write('<?php echo $balance_str;?>');*/
		bln.innerHTML='<?php echo "Balannce Upto : ".$bl_date." &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;".$balance_str;?>';


        </script>        
        </div>
        
        
        
