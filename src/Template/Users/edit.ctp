<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Edit User</h4>
<div style="clear:both"></div>

<div class="add_box">
<fieldset>
       
<?php
    echo $this->Form->create($Users);?>
	<hr />
	<?php
	
    echo $this->Form->input('USR_ID', array('type' => 'hidden'));
    echo $this->Form->input('username', array('label'=>'User name'));
	echo $this->Form->input('USR_FULLNAME', array('label'=>'Full name'));
	echo $this->Form->input('USR_GROUP', array('options' => $Usergroups,'label'=>'User Group'));
	
	?>
    
  </fieldset>
  <?php
  	echo '<div class="button">';
      echo $this->Form->button('Update', array('class'=>'custom_submit'));
  	echo '</div>';

    echo $this->Form->end();
?>

</div>