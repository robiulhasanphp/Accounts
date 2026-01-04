

<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;">Employee salary</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Select Employee",
array('controller' => 'Employeesalary', 'action' => 'EmployeeSelect')); ?></h5>


</div>






<div class="add_box_2">
		<?= $this->Form->create($emp_salary) ?>
		<fieldset>
		<legend><?= __('Add salary') ?></legend>

                
           <div
            <?php 
			/*if (isset($emp_id))
			 {
				 
				 
			   
					   if ((int)($emp_id)>0)
					   {
						   echo "style='Display:block'";
					   }
					   else
					   {
						   echo "style='Display:none'";
					   }
			   
		   }
		   else
					   {
						   echo "style='Display:none'";
					   }
					   
		   */
		   ?>>
           
          
		   <div class="newbox">
           
           
           <?php


	  foreach($name as $c):?>
		 
			 
         <tr align="center">
           
              <td><p style="font-size:18px; color:#009; text-transform:uppercase;"><?php echo $c["LDG_NAME"];?>   information</p></td>
			  

        </tr> 
			
		  <?php endforeach;?>   
                      
					  	
					  <div class="custom_input2">
                  
                     <h6>Monthly total salary</h6><p style="width:200px; padding:10px; border:solid #C10000; font-size:16px;"><?php echo $monthly_salary;?></p>
						
						 
                   <?php 
        echo '<div class="button">';
          echo $this->Form->button('Add', array('class'=>'custom_submit'));
		  echo $this->Form->end();
		  
        echo '</div>';
      ?>
                         
           			</div>


			<div class="check_radio">   
							<div class="custom_input">
							
							
							<?=$this->Form->input('EMS_SALARY',               
							[   
							'class'=>'dd',
							'label'    => 'Allowances',
							'options' =>$allowance,
							'type'=>'select'
							
							
							]);   
							?>
							
						<?=$this->Form->input('EMPLOYEE_ID',               
						[   
						'class'=>'dd',
						'label'    => 'EMP_ID',
						'type'=>'hidden',
						'value'=>$EMS_ID
						
						
						
						]);   
						?>
			
						
						<?=$this->Form->input('EMS_AMOUNT',               
						[   
						'class'=>'dd',
						'label'    => 'Amount',
						'type'=>'text'
						
						
						
						]);   
						?>

       
		</div>


                                    						          
  <?php 
  	echo $this->Form->end();
	
  ?>
   
		</div>	
            
  			
						
<table class="table-bordered" style="text-align:center">
    	<tr align="center">
          	<td>Allowance</td>
          	<td>Amount</td>
      		<td width="30%">Action</td>
          </tr>
        
        
          <?php
		
		  foreach($emp_salary_data as $a):?>
		 
			 
         <tr align="center">
           
              <td><?php echo $a->basicdata->BAS_NAME;?></td>
			  
              <td><?php echo $a->EMS_AMOUNT?></td>
              
			 <td><?= $this->Html->link('Edit',array ('action' => 'edit', $a->EMS_ID)); ?> &nbsp;|
           	 <?= $this->Html->link('Delete',array ('controller' => 'Employeesalary', 'action' => 'delete', $a->EMS_ID)); ?> </td>
        </tr> 
			
		  <?php endforeach;?>
		    </table>

</fieldset>


</div> 