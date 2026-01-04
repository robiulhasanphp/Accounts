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

  <?= $this->Form->create() ?>


<div class="proj_dep">
		  <?= $this->Form->input('date', array(
            'label'=>'Year&Month',
			'type'=>'text',
			'value'=>$cur_period,
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
     

  <?=$this->Form->button('Close balance', array('class'=>'custom_submit','style'=>'float:left;'));  ?>
  <?= $this->Form->end() ?>   
                        
          
        </div>
	                      

  <h4 class="small_h" style="color:#D54500" >&nbsp;Total balance</h4>
  <br />
                   
                                     
<table class="table-bordered" style="text-align:center">
    <tr align="center">
          	<td>LDG ID</td>
            <td>LDG NAME</td>
            <td>op/B</td>
            <td>op/B</td>
            <td>Debit</td>
        	<td>Credit</td>
         
            <td>Balance Dr</td>
                        <td>Balance Cr</td>
          </tr>
        
        
        
        
          <?php
		  
		
		  
		  
		  foreach($closing_balance as $a):?>
		 
			 
         <tr align="center">
         
        
              <td><?php 
			  
			  		 
/*echo "<pre>";	
var_dump($a->ledger_closing);*/


				
			  
			  echo $a->VDT_LDG_ID?></td>
              
              
              
               <td align="left"><?php echo $a->ledger->LDG_NAME;?></td>
               
				<td align="right"><?php  if(!empty($a->ledger_closing)){echo number_format($a->ledger_closing->LBL_BALANCE_DR,2);}?></td>
            	<td align="right"><?php if(!empty($a->ledger_closing)){echo  number_format($a->ledger_closing->LBL_BALANCE_CR,2);}?></td>
              
              
                <td align="right"><?php echo number_format($a->T_DEBIT,2)?></td>
             <td align="right"><?php echo number_format($a->T_CREDIT,2)?></td>
             
             
               <?php 
				  
			
				  if(!empty($a->ledger_closing)){
				  $balance=($a->ledger_closing->LBL_BALANCE_DR-$a->ledger_closing->LBL_BALANCE_CR)+($a->T_DEBIT-$a->T_CREDIT);
				  }
				  else
				  {
					  $balance=($a->T_DEBIT-$a->T_CREDIT);
				  }
                 
                  ?>
                  
              
                   <td align="right">
                   <?php if ($balance>0){  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($balance),2).'<span style="color: red;" /></span></div>';
				   }
				   ?>
         
             	 </td>
                                    <td align="right">
                   <?php if ($balance<=0){  echo '<div style="color:green !important">'; 
			   echo  number_format(abs($balance),2).'<span style="color: red;" /></span></div>';
				   }
				   ?>
</td>
          </tr> 
			
		  <?php
		//  exit();

		   endforeach;?>
		    </table>

        </div></td></tr></table>

        
        </div>
        
        
        
        
        