<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Usergroup",
array('controller' => 'Usergroup', 'action' => 'add')); ?></h5>


</div>
	<div class="scroll">

        
       

<table class="table-bordered" style="text-align:center">
    <tr align="center">
          <td>Code</td>
          	<td>Name</td>
            <td>Description</td>
     			<td>Types</td>
       			<td>Phone</td>
		
         <tr align="center">
      
          
   			<td><?php echo $Ledgers->LDG_CODE?></td>
             <td><?php echo $Ledgers->LDG_NAME?></td>
              <td><?php echo $Ledgers->LDG_FULL_DESCRIPTION?></td>
               <td><?php echo $Ledgers->LDG_TYPES?></td>
               <td><?php echo $Ledgers->LDG_PHONE?></td>
      
              
             </td>
          </tr> 
	    </table>
          </div>	