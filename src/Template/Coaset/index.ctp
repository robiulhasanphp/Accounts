<div class="content_inner">

<div class="inner_box small">

<h4 class="inner_title"> Coaset List</h4>


<h5 class="create_btn"><?php echo $this->Html->link("Create New Coaset",
array('controller' => 'Coaset', 'action' => 'add')); ?></h5>

<hr />
<br />
<table>
 <?php
		  //var_dump($CompanyRoot);
		  foreach($Coaset as $a):?>
<tr><td>
			<div class="main_group"">
                    <div class="block">&nbsp;</div>	
                    <div class="main_title">
       Coaset : <b><?php echo $a->SET_NAME?> [ <?php echo $a->SET_DESCRIPTION; ?>  ]</b>  : - <?php echo $a->SET_CODE?>
                     </div>

                         <div class="action_link">
                      
                          
                               
                       <p style="width:150px; font-size:10px; font-family:Georgia, 'Times New Roman', Times, serif">    <?= $this->Html->link('Edit',array ('action' => 'edit', $a->SET_ID)); ?> &nbsp;|
               
 <?= $this->Html->link('ADD LEDGER AND CHART OF ACCOUNTS',array ('action' => 'chartof_acc', $a->SET_ID)); ?> </p>
 
 
 
                     </div>
         
         </div>
         
         
  
		                     
			</td></tr>
            
		  <?php endforeach;?>
		  		 
</table>          </div>