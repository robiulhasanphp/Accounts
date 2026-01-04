
<div class="add_box">

    <fieldset>
<?php
    echo $this->Form->create($Allowance);
    echo $this->Form->input('BAS_ID', array('type' => 'hidden'));
    echo $this->Form->input('BAS_CODE', array(
            'label'=>'Allowance Code',
			'type'=>'text'
        ));
	echo $this->Form->input('BAS_NAME', array(
            'label'=>'Allowance Name',
			'type'=>'text'
        ));
	echo $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'text'
        ));
		?>
        </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Submit', array('class'=>'custom_submit'));
  	echo '</div>';

    echo $this->Form->end();
?>
</div>