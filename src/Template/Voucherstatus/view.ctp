<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Voucherstatus",
array('controller' => 'Voucherstatus', 'action' => 'add')); ?></h5>


</div>
	<div class="scroll">

        
        <table class="table-bordered">
          <tr>
          <td>Department Code</td>
          	<td>Department Name</td>
            <td>Description</td>
        
    
       
		
         <tr align="center">
      
          
          <td><?php echo $Voucherstatus->BAS_CODE?></td>
          <td><?php echo $Voucherstatus->BAS_NAME?></td>
          <td><?php echo $Voucherstatus->BAS_DESCRIPTION?></td>
         
      
              
             </td>
          </tr> 
			
		