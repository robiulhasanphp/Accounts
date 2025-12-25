<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Ledgertypem",
array('controller' => 'Ledgertypem', 'action' => 'add')); ?></h5>


</div>
<table class="table-bordered" style="text-align:center">
    <tr align="center">
          <td>Name</td>
          	<td>Short</td>
            <td>Flag</td>
        
    
       
		
         <tr align="center">
      
          
          <td><?php echo $Ledgertypem->LTM_NAME?></td>
          <td><?php echo $Ledgertypem->LTM_SHORT?></td>
          <td><?php echo $Ledgertypem->LTM_FLAG?></td>
         
      
              
             </td>
          </tr> 
			
 </table>
 </div>		