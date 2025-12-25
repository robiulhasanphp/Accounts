<!-- src/Template/Users/add.ctp -->


<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title">Create User </h4>



<p style="padding-left:14px; color:#030" align="right"><?php echo $this->Html->link("login your site",
array('controller' => 'Users', 'action' => 'login')); ?></p>


<div class="add_box">

<?php
	
	//var_dump($Users[0]->USR_ID);
?>

<?= $this->Form->create($Users) ?>
<hr />
    <fieldset>
        
        
        <?= $this->Form->input('old_pass', array('value' => '', 'label' => 'Old Password')) ?>
        <?= $this->Form->input('new_pass', array('label' => 'New Password')) ?>
        <?= $this->Form->input('retype_pass', array('label' => 'Re-type Password')) ?>
		<?= $this->Form->input('USR_ID') ?>
		 
		
		
		
		
		
   </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create User', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div></div>