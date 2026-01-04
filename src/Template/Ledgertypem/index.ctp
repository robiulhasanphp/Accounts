<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title">Ledger Type</h4>
<div style="clear:both"></div>





<h5 class="create_btn"><?php echo $this->Html->link("Create New Type",
array('controller' => 'Ledgertypem', 'action' => 'add')); ?></h5>


<hr />

<table >
        
        
          <?php
		  //var_dump($CompanyRoot);
		  foreach($Ledgertypem as $a):
		  
		  if(($a->LTM_ID==LDG_TYPE_ALLOWANCES)|| ($a->LTM_ID==LDG_TYPE_DEDUCTION)){
		  }
		  else
		  {?>
		 
			 
               <tr><td>
	
			 
         <div class="main_group"">
                    <div class="block <?php 
					if($a->LTM_ID<10) 
					{echo  'gray'; } else { echo 'beig';} ?>">&nbsp;</div>	
                    <div class="main_title">
                      <b><?php echo  $a->LTM_SHORT ?> [ <?php echo $a->LTM_NAME; ?>  ]</b>  
                     </div>
              
                     <div class="action_link">
                      
                          
                               
                              <?php if($a->LTM_ID>9) { 
							  echo $this->Html->link('Edit',array ('action' => 'edit', $a->LTM_ID)); 
							  echo " &nbsp;|&nbsp;";
      
							   echo $this->Html->link('Delete',array ('action' => 'delete', $a->LTM_ID));} ?> 
                     </div>
         
         </div>
         
         
  
		                     
			</td></tr>
             
             
             
             
             
             
             
			
		  <?php }
		  endforeach;?>
		    </table>
          </div>