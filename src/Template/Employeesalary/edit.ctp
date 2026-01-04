

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


   
    
		   <div class="newbox">   
                      
					  


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
						'value'=>$empsalary_id
						
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
</div>	
            
</fieldset>



         <?php 
           echo '<div class="button" style="float:Left">';
          echo $this->Form->button('Add', array('class'=>'custom_submit'));
		  echo $this->Form->end();
		  
        echo '</div>';
      ?>   


</div> 