<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title">Voucher Type</h4>
<div style="clear:both"></div>





<h5 class="create_btn"><?php echo $this->Html->link("Create New Voucher Type",
array('controller' => 'Vouchertype', 'action' => 'add')); ?></h5>

<hr />



        
<table>
        
        
          <?php
		  //var_dump($CompanyRoot);
		  foreach($Vouchertype as $a):?>
		 
			  <tr><td>
	
			 
         <div class="main_group"">
                    <div class="block gray">&nbsp;</div>	
                    <div class="main_title">
                      <b><?php echo $a->BAS_CODE?> [ <?php echo $a->BAS_NAME; ?>  ]</b>  : -   <?php echo $a->BAS_DESCRIPTION?>
                     </div>
              
                     <div class="action_link">
                      
                          
                               
                           <?= $this->Html->link('Edit',array ('action' => 'edit', $a->BAS_ID)); ?> &nbsp;|
                   <?= $this->Html->link('Delete',array ('action' => 'delete', $a->BAS_ID)); ?> 
                     </div>
         
         </div>
         
         
  
		                     
			</td></tr>
            
              
		  <?php endforeach;?></table></div></div>