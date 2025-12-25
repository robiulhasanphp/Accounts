<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Creat Company Group </h4>
<div style="clear:both"></div>
<div class="add_box">
<hr />
	<?php 
		echo $this->Form->create($CompanyRoot);
		
		
             echo $this->Form->input('RT_CODE', array(
                    'label' => 'Group Code'
             )); 
            
            echo $this->Form->input('RT_NAME', array(
                    'label' => 'Group Name'
            )); 
            
            echo $this->Form->input('RT_WB', array(
                    'label' => 'Web Address'
            )); 
			
			
			
			
			
			echo '<div style="clear:both"></div>';
			/*rashed test*/
			
						/*echo $this->Form->input('RadioGroup', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Personal ', 2 => 'Company')
));*/
	
	
	/*end */
			
			
			
			
			
			
			
           
			echo '<div class="button">';
				echo $this->Form->button('Create', array('class'=>'custom_submit'));
			echo '</div>'; 
			
			
		
        
        
		echo $this->Form->end();
	?>
</div></div></div></div>