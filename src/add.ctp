

<!-- src/Template/Users/add.ctp -->


<div class="add_box_2">
<?= $this->Form->create($vouchers) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
    

        
        
        
                
		   <div class="check_radio">   
      <div class="custom_input2">
        
		<?=$this->Form->input('LDG_chk',               
            [   
          	'class'=>'dd',
            'type'     => 'text',
            'label'    => 'Project'
			
                    
        ]);   
        ?>
        
   </div>
   
   <div class="custom_input3">
                
		<?=$this->Form->input('LDG_rso',               
            [   
 
            'type'     => 'text',
'class'=>'dd',
			'label'	=> 'Department',

        ]);   
        ?>
   		
        
   </div>
</div>        




		   <div class="check_radio">   
      <div class="custom_input2">
        
		<?=$this->Form->input('LDG_chk',               
            [   
          	'class'=>'dd',
            'type'     => 'text',
            'label'    => 'Project'
			
                    
        ]);   
        ?>
        
   </div>
   
   <div class="custom_input3">
                
		<?=$this->Form->input('LDG_rso',               
            [   
 
            'type'     => 'text',
'class'=>'dd',
			'label'	=> 'Department',

        ]);   
        ?>
   		
        
   </div>
</div> 
      
      
      
      
      	<?=$this->Form->input('LDG_rso',               
            [   
 
            'type'     => 'text',
'class'=>'dd',
			'label'	=> 'Department',

        ]);   
        ?>
        
        
        
<?php /*?>        
         <div class="check_radio">   
      <div class="custom_input">
        
		<?=$this->Form->input('LDG_chk',               
            [   
          	'class'=>'dd',
            'options'  => $Ladgertypem,
            'type'     => 'select',
            'multiple' => 'checkbox',
            'label'    => 'Check types'
			
                    
        ]);   
        ?>
        
   </div>
   
   <div class="custom_input1">
                
		<?=$this->Form->input('LDG_rso',               
            [   
            'options'  => $Ladgertyp,
            'type'     => 'radio',
            'multiple' => 'radio',
			'onclick'  => 'demoShow("asda");',
			'label'	=> '',
			'value'  => 'OTH;0',
        ]);   
        ?>
   		<div class="custom_input1" id="trd_item">
                
		<?=$this->Form->input('INV_TYPE',               
            [   
            'options'  => ['1'=>'NON TRADE','2'=>'TRADE ITEM'],
            'type'     => 'radio',
            'multiple' => 'radio',
			'label'	=> '',
			'value' => '1',
				
        ]);   
        ?>
        
	   </div>
        
   </div>
</div> <?php */?> 








		   <div class="check_radio">   
      <div class="custom_input2">
        
		<?=$this->Form->input('LDG_chk',               
            [   
          	'class'=>'dd',
            'type'     => 'text',
            'label'    => 'Project'
			
                    
        ]);   
        ?>
        
   </div>
   
   <div class="custom_input3">
                
		<?=$this->Form->input('LDG_rso',               
            [   
 
            'type'     => 'text',
'class'=>'dd',
			'label'	=> 'Department',

        ]);   
        ?>
   		
        
   </div>
</div> 
      
      
      
      
	<?=$this->Form->input('LDG_rso',               
            [   
 
            'type'     => 'text',
'class'=>'dd',
			'label'	=> 'Department',

        ]);   
        ?>
        
        
        
        	<?=$this->Form->input('LDG_rso',               
            [   
 
            'type'     => 'text',
'class'=>'dd',
			'label'	=> 'Department',

        ]);   
        ?>








      
		
   </fieldset>
   
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Submit', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
   
   
   
<?= $this->Form->end() ?>

<script>
		  $('#trd_item').css('display','none');
		    var arrChkBox = document.getElementsByName("LDG_rso");
       
 $(arrChkBox).click(function()
{
	

		  $('#trd_item').css('display','none');
var vl=$(this).val();


	 if(vl=='INV;3')
	  {
		  $('#trd_item').css('display','block');
	  }	
	 

});


</script>
</div>