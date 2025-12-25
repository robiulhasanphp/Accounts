<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Usergroup",
array('controller' => 'Usergroup', 'action' => 'add')); ?></h5>


</div>

<table class="table-bordered" style="text-align:center">
    <tr align="center">
          <td>Group Code</td>
          	<td>Group Name</td>
            <td>Description</td>
        
    
       
		
         <tr align="center">
      
          
          <td><?php echo $Usergroup->BAS_CODE?></td>
          <td><?php echo $Usergroup->BAS_NAME?></td>
          <td><?php echo $Usergroup->BAS_DESCRIPTION?></td>
         
      
              
             </td>
          </tr> 

</table>
</div>