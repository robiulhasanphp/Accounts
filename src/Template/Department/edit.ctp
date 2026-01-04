<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Edit Department </h4>
<div style="clear:both"></div>
<div class="add_box">

    <fieldset>
<?php
    echo $this->Form->create($Department);
    echo $this->Form->input('BAS_ID', array('type' => 'hidden'));
    echo $this->Form->input('BAS_CODE', array(
            'label'=>'Department Code',
			'type'=>'text'
        ));
	echo $this->Form->input('BAS_NAME', array(
            'label'=>'Department Name',
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
      echo $this->Form->button('Update', array('class'=>'custom_submit'));
  	echo '</div>';

    echo $this->Form->end();
?>