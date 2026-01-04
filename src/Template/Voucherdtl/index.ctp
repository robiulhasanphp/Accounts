<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Voucherdtl",
array('controller' => 'Voucherdtl', 'action' => 'add')); ?></h5>


</div>
	<div class="scroll">

        
        <table class="table-bordered">
          <tr>
          	<td>Voucher Code</td>
          	<td>Voucher Name</td>
            <td>Description</td>
        
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
		  foreach($Voucherstatus as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php echo $a->BAS_CODE?></td>
			 
              <td><?php 
			 
			 
			  echo $this->Html->link($a->BAS_NAME,array ('action' => 'view', $a->VCH_ID)); ?>



			  
			</td>
              
                 <td><?php echo $a->VDT_DATE?></td>
			 
          
              
           <?php /*?>      <td><?php echo $a->BAS_CREATE_BY?></td>
			 
              <td><?php echo $a->BAS_CREATE_DATE?></td>
              
                 <td><?php echo $a->BAS_LAST_EDIT_BY ?></td>
			 
              <td><?php echo $a->BAS_LAST_EDIT_DATE ?> </td>
              
                <td><?php echo $a->BAS_REMARKS?></td>
			 
              <td><?php echo $a->COMPANY_ID?></td><?php */?>
              
                   <td align="center">
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->BAS_ID)); ?> &nbsp;|
       <?= $this->Html->link('Delete',array ('action' => 'delete', $a->BAS_ID)); ?> 
         
              
             </td>
          </tr> 
			
		  <?php endforeach;?>