<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User  List</h5>


<h5 class="create_btn" ><?php echo $this->Html->link("Create New User",
array('controller' => 'Users', 'action' => 'add')); ?></h5>


</div>


<table class="table-bordered" style="text-align:center">
    <tr align="center">
       
          <td>User Name</td>
          	<td>Full Name</td>
            <td>Group</td>
     
    
            <td>Action</td>
          </tr>
        
        
          <?php
		  //var_dump($CompanyRoot);
		  foreach($userlist as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php //echo "<pre>";
//			  var_dump($a);
			   echo $a->username?></td>
			 
              <td><?php echo $a->USR_FULLNAME; ?> </td>
              
                 <td><?php echo ($a->usergroup->BAS_NAME); ?></td>
                 
                 
                    
              <?php $USR_STATUS= $a->USR_STATUS;
	
	
								if($USR_STATUS=='0')
								{
								$status="Inactive";
								
								}
							
											
								else
								{
								$status="Active";
								
								}
								
								
								
						
				?>		
                 
                 
                 
		
                   <td align="center">
                   
                  
        
                   
                   
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->USR_ID)); ?> &nbsp;|
	 <?= $this->Html->link($status,array ('action' => 'status', $a->USR_ID)); ?>
         
         
              
             </td>
          </tr> 
			
		  <?php endforeach;?>
		  </table>
          </div>
          
          
          
          
          

