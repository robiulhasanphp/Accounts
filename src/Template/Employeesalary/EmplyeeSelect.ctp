



<div class="add_box_2">
		<?= $this->Form->create($emp_salary) ?>
		<fieldset>
		<legend><?= __('Add salary') ?></legend>


            <div class="newbox">   
    
    
                        <?=$this->Form->input('EMPLOYEE_ID',               
                        [   
                        
                        'options' => $name,
                        'type'=>'select',
                        'class'=>'dd',
                        'label'	=> 'Employee',
                        
                        ]);   
                        ?>
    
    
            
               
      <?php 
        echo '<div class="button">';
          echo $this->Form->button('show', array('class'=>'custom_submit'));
		  echo $this->Form->end();
		  
        echo '</div>';
      ?>
       
            
            
            </div>


                                
           <div
         








</div> 