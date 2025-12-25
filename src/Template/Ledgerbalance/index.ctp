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
.table-bordered td{font-size:10px;font-family:Tahoma, Geneva, sans-serif;text-align:left}
.table-bordered td.amount{font-size:11px;text-align:right; /*letter-spacing:0.5px*/}

</style>
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr>
            
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

<?php 

 if (isset($type))
{

 $ldg_acc_type=$type;
}


?>
                
                                                  
    
<?php 		  if (isset($vdt_id))
		  {
?>

	<div class="dashboard" style="float:right;margin-top:-110px;">
    <table class="attn_box"  style="margin:auto;padding:5px;" cellspacing="2"><tr>
    <td style="padding:5px;">
     <div class="datadiv" style="float:right;border-right:1px solid #CCC;">
   <p style="color:#F00; font-size:18px"><?php 
	$prbalance=$up_to_lastbalance_debit-$up_to_lastbalance_credit;
	//echo $prbalance;
	$bl='';
	if($prbalance<0)
	{
		$bl=number_format(abs($prbalance),2). " Cr";
	}
	else
	{
		$bl=number_format(abs($prbalance),2). " dr";
	}
	
	echo $bl;//,".",'');  ?>
   
    </td>
    <td style="padding:5px;">

    <div class="datadiv" style="float:right;border-right:1px solid #CCC;">
    <span class="heading">Total Debit: </span><span class="value"><?php echo number_format($total_voucher_debit,2);//,".",'');  ?>
     </span>

    <br/>    
 

    <span class="heading">Total Credit: </span><span class="value"><?php echo number_format($total_voucher_credit,2);//,".",'');  ?>  	</span>
</div>
	</td><td style="padding:5px;">
    
        <div class="datadiv" style="float:left;margin-top:10px;">
    <span class="heading" > Balance: </span><span class="value green_c size16">
    
    
    
    
	
	<?php 
	
	
	$total=($prbalance+($total_voucher_debit-$total_voucher_credit));
	
	?>
    
    <?php
	
		  if($total<0)
		  {
			  if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: red;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:red !important">'; 
		   echo  number_format(abs($total),2).'<span style="color: red;" /> Cr </span></div>';
				 
			  
		  		  }
		  }
		  
		  
		 
				  
				  
		if($total>0)
		  {
			  if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: green;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:green !important">'; 
		   echo  number_format(abs($total),2).'<span style="color: green;" /> Dr </span></div>';
				 
			  
		  		  }
		  }
				  

		 
		 
		  



  if($total<0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: green;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
		  }
				  
				  
		  if($total>0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: red;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  number_format(abs($total),2).'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
		  }
		 
	
	
	
	 ?>
     </span>
	</div>
    </td>
    </tr></table>


        		</div>
                

        
</div>
<table class="table-bordered" align="left" >
    <tr >
                <th style="min-width:70px;max-width:70px;">Date</th>
                <th style="min-width:80px;max-width:80px">VCH NO</th>
				<th style="min-width:40px;max-width:40px">Type</th>
                <th style="min-width:60px;max-width:62px">PRJ</th>
                <th style="min-width:40px;max-width:42px">DEPT</th>
        		<th style="max-width:100px">Account</th>
                <th style="max-width:150px;">Description</th>
               
                <th style="min-width:80px;max-width:100px">Debit</th>
                <th style="min-width:80px;max-width:100px">Credit</th>
                <td class="amount" style="min-width:100px;max-width:100px">Balance</td>
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
               

               
             <td class="amount"><?php //echo number_format($up_to_lastbalance_debit,2);   ?></td>
               <td class="amount"><?php //echo number_format($up_to_lastbalance_credit,2);   ?></td>
          
                 
          <?php $last_balance=$up_to_lastbalance_debit-$up_to_lastbalance_credit;?>
                  
          <td class="amount">
		  
		  
		  <?php
          
		  
		    
		  if($last_balance<0)
		  {
			  
			 echo '<div style="color:red !important">'; 
		   echo  number_format(abs($last_balance),2).'<span style="color: red;" /> Cr </span></div>';
		   
		  }
		  
		  else
		  {
			    echo number_format(abs($last_balance),2).'<span style="color: green;" /> Dr </span>';
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
	
			  
			  $date=$a->VCH_DATE;
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
								case 43: echo 'BNK';break;								
								case 42: echo 'EXP';break;								
								default: echo ' ';break;								

							}
							$row_num=$row_num+1;
							?></td>
               <td ><?php echo $a->VCH_PROJ_CODE;?></td>
               <td><?php  echo $a->VCH_DEPT_NAME; ?></td>
               <td ><?php echo $a->VCH_LDG_NAME;?></td>
             
               <td ><?php echo $a->voucher->VCH_NARRATION?></td>
               

                <td class="amount"><?php echo number_format($a->VCH_DEBIT,2);//,'.','')?></td>
             <td class="amount"><?php echo number_format($a->VCH_CREDIT,2);//,'.','')?></td>
              
          
                  <?php 
				  
			
				 
				  $balance=$a->VCH_DEBIT-$a->VCH_CREDIT;
          
                  $run_sum=$run_sum+$balance;
				  
				 
                  ?>
                  
          
          <td  class="amount" >
		  
		  <?php
		  
		  if($run_sum<0)
		  {
		    if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: red;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:red !important">'; 
		   echo  number_format(abs($run_sum),2).'<span style="color: red;" /> Cr </span></div>';
				 
			  
		  		  }
		  }
		  
		  
		  
		  
		  if($run_sum>0)
		  {
		    if($ldg_acc_type==1)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: green;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==5)
				  {
					  echo '<div style="color:green !important">'; 
		   echo number_format(abs($run_sum),2).'<span style="color: green;" /> Dr </span></div>';
				 
			  
		  		  }
		  }
		  
		  
		  
		  
		  
		  
		  
		  
		  
  if($run_sum<0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:green !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: green;" /> Cr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:green !important">'; 
			   echo number_format(abs($run_sum),2).'<span style="color: green;" /> Cr </span></div>';
			  
		  		  }
		  }
				  
				  
		  if($run_sum>0)
		  {
			  if($ldg_acc_type==2)
				  {
					 
			
			 echo '<div style="color:red !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: red;" /> Dr </span></div>';
					 
					 
				  }
			  
			  
			   elseif ($ldg_acc_type==3)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: red;" /> Dr </span></div>';
			  
		  		  }
				  
				  
				   elseif ($ldg_acc_type==4)
				  {
					  echo '<div style="color:red !important">'; 
			   echo  number_format(abs($run_sum),2).'<span style="color: red;" /> Dr </span></div>';
			  
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

             

            
            
