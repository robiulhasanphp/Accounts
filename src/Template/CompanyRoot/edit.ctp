<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Edit Company Group </h4>
<div style="clear:both"></div>
<div class="add_box">

    <h1>Edit Company</h1>
    
    <?php
        echo $this->Form->create('CompanyRoot');
		
        echo $this->Form->input('RT_CODE', array(
            'label' => 'Group Code'
        ));
        echo $this->Form->input('RT_NAME', array(
                    'label' => 'Group Name'
            )); 
            
            echo $this->Form->input('RT_WB', array(
                    'label' => 'Web Address'
            )); 
		echo $this->Form->input('RT_ID', array('type' => 'hidden'));
		echo '<div class="button">';
				echo $this->Form->button('Update', array('class'=>'custom_submit'));
			echo '</div>'; 
			
        echo $this->Form->end('Save Post');
        
    ?>
</div>


