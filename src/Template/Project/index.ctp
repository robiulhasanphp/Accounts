<div class="content_inner">

<div class="inner_box small">

<h4 class="inner_title"> Project List</h4>


<h5 class="create_btn"><?php echo $this->Html->link("Create New Project",
array('controller' => 'Project', 'action' => 'add')); ?></h5>

<hr />
<br />
<table>
 <?php
		  //var_dump($CompanyRoot);
		  foreach($Project as $a):?>
<tr><td>
			<div class="main_group"">
                    <div class="block">&nbsp;</div>	
                    <div class="main_title">
                     Project : <b><?php echo $a->BAS_CODE?> [ <?php echo $a->BAS_NAME; ?>  ]</b>  : -   <?php echo $a->BAS_DESCRIPTION?>
                     </div>

                         <div class="action_link">
                      
                          
                               
                           <?= $this->Html->link('Edit',array ('action' => 'edit', $a->BAS_ID)); ?> &nbsp;|
                   <?= $this->Html->link('Delete',array ('action' => 'delete', $a->BAS_ID)); ?> 
                     </div>
         
         </div>
         
         
  
		                     
			</td></tr>
            
		  <?php endforeach;?>
		  		 
</table>          </div>