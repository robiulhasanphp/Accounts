<div class="content_inner">

<div class="inner_box small">

<h4 class="inner_title"> Salary And Allowances</h4>



<h5 class="create_btn"><?php echo $this->Html->link("Create new Allowance",
array('controller' => 'Allowance', 'action' => 'add')); ?></h5>
<hr />
<br />
<table>





<table class="table-bordered" >
    <tr >
      
          	<td>Code</td>
          	<td>Name</td>
            <td>Description</td>
                        <td>Type</td>
        
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
		  foreach($Allowance as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php echo $a->LDG_CODE?></td>
			 
              <td><?php 
			 
			 
			  echo $a->LDG_NAME; ?>



			  
			</td>
              
                 <td><?php echo $a->LDG_DESCRIPTION?></td>
				<td><?php 

				echo $a->LDG_TYPES?></td>
			 
          
              

              
                   <td align="center">
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->LDG_ID)); ?> &nbsp;|
       <?= $this->Html->link('Delete',array ('action' => 'delete', $a->LDG_ID)); ?> 
         
              
             </td>
          </tr> 
			
		  <?php endforeach;?>
		  	  </table>
          </div>