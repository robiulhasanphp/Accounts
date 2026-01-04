<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Edit User Group </h4>
<div style="clear:both"></div>


<div class="add_box">
<hr />
<fieldset>
<?php
    echo $this->Form->create($Usergroup);
    echo $this->Form->input('BAS_ID', array('type' => 'hidden'));
    echo $this->Form->input('BAS_CODE', array(
            'label'=>'User code',
			'type'=>'text'
        ));
	echo $this->Form->input('BAS_NAME', array(
            'label'=>'User Name',
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
  	echo '</div>';?>
  <div style="clear:boath"></div>
  <?php
    echo $this->Form->end();
?>

  <div style="clear:boath"></div>
	 <br><br><br>
<?= $this->Form->end() ?>
</div>
   <div style="clear:boath"></div></div></div>