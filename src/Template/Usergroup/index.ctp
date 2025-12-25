<div class="content_inner">

<div style="padding-top:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User Group List</h5>


<div class="create_btn" ><?php echo $this->Html->link("Create New User Group",
array('controller' => 'Usergroup', 'action' => 'add')); ?></div>
<div class="create_btn"><?php echo $this->Html->link("Create New User",
array('controller' => 'Users', 'action' => 'add')); ?></div>

</div>


<table class="table-bordered" style="text-align:center">
          <?php		  foreach($Usergroup as $a): ?>
		 
			 
         <tr >
             
              <td>
              		<div style="padding:3px;width:450px;text-align:left;margin-left:10px;float:left;margin-right:10px;">
                    <div style="width:10px;float:left;background:#390;">&nbsp;</div>	
                    <div style="width:300px;float:left;margin-left:10px;">
                     Group : <b><?php echo $a->BAS_CODE?> [ <?php echo $a->BAS_NAME; ?>  ]</b>  : -   <?php echo $a->BAS_DESCRIPTION?>
                     </div>
			 <div style="width:100px;float:left">
          
              
                   
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->BAS_ID)); ?> &nbsp;|
       <?= $this->Html->link('Delete',array ('action' => 'delete', $a->BAS_ID)); ?> 
         </div></div></td>
              

          </tr>
          <tr><td colspan="2" style="text-align:left;padding-left:150px;"> 
          <div style="margin-bottom:-20px;"><i>Users</i></div>
          <?php //echo "<pre>"; var_dump($a->users); ?>

 				<?php  foreach ($a->users as $d){ ?>
                <div style="clear:both"></div>
					<div style="padding:3px;width:450px;text-align:left;margin-left:100px;float:left;margin-right:10px;">
                    <div style="width:10px;float:left;background:#F60;">&nbsp;</div>
						<div style="width:300px;float:left;border-bottom:1px solid #CCC;margin-left:10px;">
                        
                          <?php echo "<span style='width:80px;float:left'>".$d->username . " </span> [ <span style='color:green'>".$d->USR_FULLNAME."</span> ]"; ?></div>
                          <div style="width:100px;float:left"><?php
							echo $this->Html->link("Edit", array('controller' => 'Users', 'action' => 'edit', $d->USR_ID)); 
							echo " &nbsp;|&nbsp;";
							echo $this->Html->link("Delete", array('controller' => 'Users', 'action' => 'delete', $d->USR_ID));?>
                            
                            </div>
                            
                            </div>
                          


		  <?php }?>
			<div style="clear:both"></div>
            <br /><br />
		  <?php endforeach;?>
		  </table>
          </div>