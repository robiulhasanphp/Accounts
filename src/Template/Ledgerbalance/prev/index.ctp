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
		  <?= $this->Form->input('name', array(
            'label'=>'Ledger name',
			'options' => $LDG_name,
			'type'=>'select',
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
        
        </div>
		
   <div class="proj_de">
        
        <?=$this->Form->input('date_from',               
							[   
							'id' => 'birthday',
							'type'=>'text',
							'class'=>'dd',
							'dateFormat' => 'YMD',
							'minYear' => date('Y') - 80,
							'maxYear' => date('Y') - 18,
							'label'   => 'Date from',
							'style'=>'border:1px solid #ccc;width:200px;'
							
									
						]);   
						?>
		
		
		
                           <?=$this->Form->input('date_to',               
                        [   
             
                        'id' => 'employ_date',
						'type'=>'text',
						'class'=>'dd',
						'dateFormat' => 'YMD',
						'minYear' => date('Y') - 80,
						'maxYear' => date('Y') - 18,
						'label'   => 'Date to',
						'style'=>'border:1px solid #ccc;width:200px;'
            
                    ]);   
                    ?>


  <?=$this->Form->button('View Ledger', array('class'=>'custom_submit','style'=>'float:left;'));  ?>
  <?= $this->Form->end() ?>   
</div>

        		</div>
                
<?php 

 if (isset($type))
{

 $ldg_acc_type=$type;
}


?>
                
                                                  
    
<?php 		  if (isset($vdt_id))
		  {
?>

	<div class="dashboard" style="float:right;">
    <table class="attn_box"  style="margin:auto;padding:5px;" cellspacing="2"><tr><td style="padding:5px;">

    <div class="datadiv" style="float:right;border-right:1px solid #CCC;">
    <span class="heading">Total Debit: </span><span class="value"><?php echo number_format($total_voucher_debit,2,".",'');  ?>
     </span>

    <br/>    
 

    <span class="heading">Total Credit: </span><span class="value"><?php echo number_format($total_voucher_credit,2,".",'');  ?>  	</span>
</div>
	</td><td style="padding:5px;">
    
        <div class="datadiv" style="float:left;margin-top:10px;">
    <span class="heading" > Balance: </span><span class="value green_c size16">
    
    
    
    
	
	<?php 
	
	
	$total=($total_voucher_debit-$total_voucher_credit);
	
	?>
    
    <?php
	
		  if($total<0)
		  {
			  if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: red;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:red !important">'; 
		   echo  number_format(abs($total),2,'.','').'<span style="color: red;" /> Cr </span></div>';
				 
			  
		  		  }
		  }
		  
		  
		 
				  
				  
		if($total>0)
		  {
			  if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: green;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:green !important">'; 
		   echo  number_format(abs($total),2,'.','').'<span style="color: green;" /> Dr </span></div>';
				 
			  
		  		  }
		  }
				  

		 
		 
		  



  if($total<0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: green;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
		  }
				  
				  
		  if($total>0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: red;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2,'.','').'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
		  }
		 
	
	
	
	 ?>
     </span>
	</div>
    </td>
    </tr></table>

        
</div>

<table class="table-bordered" >
    <tr >
                <th style="min-width:80px;">Date</th>
                <th style="min-width:80px">VCH NO</th>
				<th style="min-width:30px">Type</th>
                <th style="min-width:30px">PRJ</th>
                <th style="min-width:30px">DEPT</th>
        		<th>Account</th>
                <th>Description</th>
               
                <th style="min-width:100px">Debit</th>
                <th style="min-width:100px">Credit</th>
                <th style="min-width:100px">Balance</th>
                <td>Action</td>
	<th></th>
          </tr>
          

          
          <tr>
          
          
           		<td></td>
                <td></td>
				<td></td>
                <td ></td>
                <td></td>
              
               <td class="ldg_desc"></td>
               
               

             
               <td class="ldg_desc"> Up To :<?php echo $before_last_date;   ?></td>
               

               
             <td class="ldg_amt"><?php echo $up_to_lastbalance_debit;   ?></td>
               <td class="ldg_amt"><?php echo $up_to_lastbalance_credit;   ?></td>
          
                 
          <?php $last_balance=$up_to_lastbalance_debit-$up_to_lastbalance_credit;?>
                  
          <td style="text-align:right;background:#ddd">
		  
		  
		  <?php
          
		  
		    
		  if($last_balance<0)
		  {
			  
			 echo '<div style="color:red !important">'; 
		   echo  abs(number_format($last_balance,2,'.','')).'<span style="color: red;" /> Cr </span></div>';
		   
		  }
		  
		  else
		  {
			    echo abs(number_format($last_balance,2,'.','')).'<span style="color: green;" /> Dr </span>';
		  }
		  
		  
		  
		  
		  
		  ?>
          
          
          
          </td>
          <td></td>
          
      
          </tr> 
          
          
          
    
        
        
          <?php
	
	
	$run_sum=0;
	  $run_sum=$last_balance;
	$balance=0;
	$row_num=0;
		  
		  foreach($vdt_id as $a):
	//	 echo "<pre>";
//			 var_dump($a->Ledgers->LDG_NAME);	 
		 
		  
		  ?>
          
          
		 
			 
         <tr align="center"
         
         <?php if ($row_num % 2==0){
			 echo 'style="background:#FFC"';
		 }
			 else
			 {
				 			 echo 'style="background:#fff"';
				 
		 }?>
         >
             
             <td><?php
	
			  
			  $date=$a->VDT_DATE;
			   echo $date->format('d-m-Y');?></td>
               <td><?php echo $a->voucher->VCH_NO_FULL?></td>
				<td><?php switch($a->voucher->VCH_TYPE)
							{
								case 6: echo 'JUR';break;
								case 7: echo 'PUR';break;								
								case 8: echo 'SLS';break;								
								case 9: echo 'PAY';break;								
								case 10: echo 'RCV';break;								
								case 11: echo 'SAL';break;								
								case 12: echo 'ADJ';break;								
								default: echo 'EXP';break;								

							}
							$row_num=$row_num+1;
							?></td>
               <td ><?php if (!empty($a->project->BAS_CODE)){echo $a->project->BAS_CODE;}?></td>
               <td><?php if (!empty($a->department->BAS_CODE)){ echo $a->department->BAS_CODE; }?></td>
               <td class="ldg_desc"><?php echo $a->Ledgers["LDG_NAME"];?></td>
             
               <td class="ldg_desc"><?php echo $a->voucher->VCH_NARRATION?></td>
               

               
             <td class="ldg_amt"><?php echo number_format($a->VDT_CREDIT,2,'.','')?></td>
               <td class="ldg_amt"><?php echo number_format($a->VDT_DEBIT,2,'.','')?></td>
          
                  <?php 
				  
			
				 
				  $balance=$a->VDT_CREDIT-$a->VDT_DEBIT;
          
                  $run_sum=$run_sum+$balance;
				  
				 
                  ?>
                  
          
          <td style="text-align:right;background:#ddd">
		  
		  <?php
		  
		  if($run_sum<0)
		  {
		    if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: red;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:red !important">'; 
		   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: red;" /> Cr </span></div>';
				 
			  
		  		  }
		  }
		  
		  
		  
		  
		  if($run_sum>0)
		  {
		    if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: green;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:green !important">'; 
		   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: green;" /> Dr </span></div>';
				 
			  
		  		  }
		  }
		  
		  
		  
		  
		  
		  
		  
		  
		  
  if($run_sum<0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: green;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
		  }
				  
				  
		  if($run_sum>0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: red;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  abs(number_format($run_sum,2,'.','')).'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
		  }
		 
	
		  
		  
		  
		  
		  
		  
		  
		  ?>
          
          
          
          </td>
            <td>
				   <?= $this->Html->link('view',array ('action' => 'view', $a->VCH_ID)); ?> 
         
             	 </td>
          
          </tr> 
			
		  <?php endforeach;?>
		    </table>

 

        
        <?php }?>            
        
        
        
        
   	</div>








                 </td>
             </tr>
        </table>
   	</div>

             

            
            
