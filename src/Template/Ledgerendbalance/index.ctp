<style>
tr{
	border-bottom:1px solid #666;
	
}
td{
	vertical-align:text-top;
	font-size:10px;
	font-weight:bold;
	border-bottom:1px solid #666 !important;
	font-family:Tahoma, Geneva, sans-serif !important;
}
th{
	vertical-align:middle;
	text-align:center;
	font-size:12px;
	height:30px;
	padding:3px;
	background:url(img/bg_head_s2.png) repeat-x;
	border-bottom:1px solid #666 !important;
	
}
</style>
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Ledger Balance : </h1>
                                <ul>
<li class='plus'><?php echo $this->Html->link("Create Payment", array('controller' => 'Payment', 'action' => 'add')); ?></li>         

                           
</ul></div>
                                 <div class="box">         
                                <h1 class="bar_title small_h">&nbsp;</h1>
                                <!--<ul>
                                   
                                     <li class=''><?php //echo $this->Html->link("Supplier List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Customer List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Employee List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Bank List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Inventory List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>


                                     </ul>-->
                                     
                                     
                                     
                                </div>
                </td>
                <td style="vertical-align:top;" align="left">
                    <div class="dash_content">
                        <h1 class="bar_title small_h"  >
	    <span class="heading">Ledger Upto : </span><span class="valued"><?php echo date('D d-m-Y');?></span>

</h1>
                        <div style="padding-bottom:30px;"></div>
                               
<div style="padding:5px;width:100%;float:left">
			<?= $this->Form->create() ?>


<div class="proj_dep">
		  <?= $this->Form->input('date', array(
            'label'=>'Date',
			'type'=>'text',
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
        
        </div>
		
 


  <?=$this->Form->button('View Ledger', array('class'=>'custom_submit','style'=>'float:left;'));  ?>
  <?= $this->Form->end() ?>   
</div>

                                                  
    
<table class="table-bordered" >
    <tr >
                <th style="min-width:80px;">id</th>
                <th style="min-width:80px">Name</th>
				<th style="min-width:80px">OPening Dr</th>
               <th style="min-width:80px">OPening Cr</th>
                <th style="min-width:120px">Total Debit</th>
                <th style="min-width:120px">Total Credit</th>
                <th>Balance Dr</th>
				<th>Balance Cr</th>
                 
	<th></th>
          </tr>
          

       <?php 		  if (isset($end_balance))
		  {
?>
        
          <?php

			$total_dr=0;
		 $total_cr=0 ;
		 $t_balance_cr=0;
		$t_balance_dr=0;
		  foreach($end_balance as $a):
	// echo "<pre>";
		//	 var_dump($a);	 
		 
		  
		  $ldg_id=$a->LDG_ID;
		  $op_dr=$a->ledger_closing["LBL_BALANCE_DR"];
		  $op_cr=$a->ledger_closing["LBL_BALANCE_CR"];
		  
		
		  
		
		  $v_dr=0;
		  $v_cr=0;
		  
		  
		  
		  foreach($total_balance as $b):

			$v_id=$b["VDT_LDG_ID"];
			
			if($ldg_id==$v_id)
			{
				$v_dr=$b["t_debit"];
			
				$v_cr=$b["t_credit"];
				break;
			}
		endforeach;
			
		 
		 $name=$a->LDG_NAME;


		$balance_dr=$op_dr+$v_dr;
		$balance_cr=$op_cr+$v_cr;
		 
		 $total_dr=$total_dr+$v_dr;
		 $total_cr=$total_cr+$v_cr;
		 
		  
		 ?>
          
          

          	 
        
		 <tr >
             
 
           		<td class="ldg_desc" style=" color:#006"><?php echo $ldg_id;?></td>
               <td class="ldg_desc"><?php echo $name;?></td>
               
               <td class="ldg_amt"><?php echo number_format($op_dr,2,'.','')?></td>
               
               <td class="ldg_amt"><?php echo number_format($op_cr,2,'.','')?></td>
             
             
             <td class="ldg_amt"><?php echo number_format($v_dr,2,'.','')?></td>
               <td class="ldg_amt"><?php echo number_format($v_cr,2,'.','')?></td>
               <?php
			   
			   $final_balance=$balance_dr-$balance_cr;
			   $balance_dr=0;
			   $balance_cr=0;
			   if ($final_balance>0)
			   {
				   $balance_dr=$final_balance;
			   }
			   else
			   {
				      $balance_cr=-$final_balance;
			   }
			   
			   	$t_balance_cr=$t_balance_cr+$balance_cr;
				$t_balance_dr=$t_balance_dr+$balance_dr;
			   ?>
               
               
          <td class="ldg_amt"><?php echo number_format($balance_dr,2,'.','')?></td>
               <td class="ldg_amt"><?php echo number_format($balance_cr,2,'.','')?></td>
       			
            	
          </tr> 

         <?php endforeach;?>
        
    <tr >
                <th style="min-width:80px;"></th>
                <th style="min-width:80px"></th>
				<th style="min-width:80px"></th>
               <th style="min-width:80px"></th>
                <th style="min-width:120px"><?php echo number_format($total_dr,2,'.','')?></th>
                <th style="min-width:120px"><?php echo number_format($total_cr,2,'.','')?></th>
                <th><?php echo number_format($t_balance_dr,2,'.','')?></th>
				<th><?php echo number_format($t_balance_cr,2,'.','')?></th>
           
	<th></th>
          </tr>
        
        </table>
        
            <?php }?>   
   	</div>

         

                 </td>
             </tr>
        </table>
        
   	</div>


             

            
            


