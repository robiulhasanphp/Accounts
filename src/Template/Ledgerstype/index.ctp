<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 class="create_btn"><?php echo $this->Html->link("Add new Project",
array('controller' => 'Ledgerstype', 'action' => 'add')); ?></h5>


</div>


<table class="table-bordered" style="text-align:center">
    <tr align="center">
          	<td>Ltm id</td>
          	<td>Ldt id</td>
            <td>edit by</td>
        
       <!--     <td>bas create by</td>
            <td>bas crete date</td>
            <td>bas last edit by</td>
            <td>bas last edit date</td>
            <td>Bas remarks</td>
            <td>Company id</td>-->
    
            <td>Action</td>
          </tr>
        
        
          <?php
		  //var_dump($CompanyRoot);
		  foreach($Ledgertypes as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php echo $a->LTM_ID?></td>
			 
              <td><?php 
			 
			 
			  echo $this->Html->link($a->LDG_ID,array ('action' => 'view', $a->LDT_ID)); ?>



			  
			</td>
              
                 <td><?php echo $a->LDT_EDIT_BY?></td>
			 
  
              
                   <td align="center">
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->LDT_ID)); ?> &nbsp;|
       <?= $this->Html->link('Delete',array ('action' => 'delete', $a->LDT_ID)); ?> 
         
              
             </td>
          </tr> 
			
		  <?php endforeach;?>
		  		  </table>
          </div>