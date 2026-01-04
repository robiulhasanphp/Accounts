<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Usergroup",
array('controller' => 'Usergroup', 'action' => 'add')); ?></h5>


</div>

<table class="table-bordered" style="text-align:center">
    <tr align="center">
          <td>Username</td>
          	<td>Full name</td>
            <td>Designation</td>
     			<td>Group</td>
       
		
         <tr align="center">
      
          
          <td><?php echo $user->username?></td>
          <td><?php echo $user->USR_FULLNAME?></td>
          <td><?php echo $user->USR_DESIGNATION?></td>
           <td><?php echo $user->USR_GROUP?></td>
      
              
             </td>
          </tr> 
</table>
          </div>