<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Allowance",
array('controller' => 'Allowance', 'action' => 'add')); ?></h5>


</div>
	<div class="scroll">


<table class="table-bordered" style="text-align:center">
    <tr align="center">
          <td>Allowance Code</td>
          	<td>Allowance Name</td>
            <td>Description</td>
        
    
       
		
         <tr align="center">
      
          
          <td><?php echo $Allowance->BAS_CODE?></td>
          <td><?php echo $Allowance->BAS_NAME?></td>
          <td><?php echo $Allowance->BAS_DESCRIPTION?></td>
         
      
              
             </td>
          </tr> 
		  </table>
          </div>	