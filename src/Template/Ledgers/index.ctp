
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Ledgers</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("Create Ledgers", array('controller' => 'Ledgers', 'action' => 'add')); ?></li>
                                    <li class='plus'><?php echo $this->Html->link("Create Ledger Types", array('controller' => 'Ledgertypem', 'action' => 'index')); ?></li>
</ul></div>
                                 <div class="box">         
                                <h1 class="bar_title small_h">List</h1>
                                <ul>
                                   
                                     <li class=''><?php echo $this->Html->link("Supplier List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Customer List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Employee List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Bank List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>

                                     <li class=''><?php echo $this->Html->link("Inventory List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>


                                     </ul>
                                     
                                     
                                     
                                </div>

        		</div>
                </td><td style="vertical-align:top" align="left">
                <div class="dash_content">
                
        		                                <h1 class="bar_title small_h">Ledgers</h1>
                                  
    


<div style="padding-bottom:30px;">






</div>


<table class="table-bordered" >
    <tr >
          	<td>Ledger Code</td>
          	<td>Ledger Name</td>
          	 <td>Description</td>
            <td>Ledger Group</td>
        	<td>Phone</td>
         
            <td>Action</td>
          </tr>
        
        
          <?php
		  //var_dump($CompanyRoot);
		  foreach($Ledgers as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php echo $a->LDG_CODE?></td>
			 
              <td><?php  echo $this->Html->link($a->LDG_NAME,array ('action' => 'view', $a->LDG_ID)); ?> </td>
              
              <td><?php echo $a->LDG_FULL_DESCRIPTION?></td>
               <td><?php echo $a->LDG_TYPES?></td>
               <td><?php echo $a->LDG_PHONE?></td>
              
                   <td align="center">
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->LDG_ID)); ?> &nbsp;|
       <?= $this->Html->link('Delete',array ('action' => 'delete', $a->LDG_ID)); ?> 
         
             	 </td>
          </tr> 
			
		  <?php endforeach;?>
		    </table></div></td></tr></table></div>
