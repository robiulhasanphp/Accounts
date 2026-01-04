<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 class="create_btn"> User List</h5>


<h5 class="create_btn" align="right"><?php echo $this->Html->link("Add new vouchers",
array('controller' => 'vouchers', 'action' => 'add')); ?></h5>


</div>


<table class="table-bordered" style="text-align:center">
    <tr align="center">
          	<td>Date</td>
          	<td>Type</td>
            <td>Project</td>
            <td>Department</td>
        	<td>Voucher NO</td>
         
            <td>Action</td>
          </tr>
        
        
          <?php
		  //var_dump($CompanyRoot);
		  foreach($vouchers as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php echo $a->VCH_DATE?></td>
			 
              <td><?php  echo $this->Html->link($a->VCH_TYPE,array ('action' => 'view', $a->VCH_ID)); ?> </td>
              
              <td><?php echo $a->VCH_PROJECT?></td>
               <td><?php echo $a->VCH_DEPARTMENT?></td>
               <td><?php echo $a->VCH_NO_FULL?></td>
              
                   <td align="center">
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->VCH_ID)); ?> &nbsp;|
       <?= $this->Html->link('Delete',array ('action' => 'delete', $a->VCH_ID)); ?> 
         
             	 </td>
          </tr> 
			
		  <?php endforeach;?>
		    </table>
          </div>