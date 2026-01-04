<!-- src/Template/Users/add.ctp -->


<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title">Create User </h4>



<p style="padding-left:14px; color:#030" align="right"><?php echo $this->Html->link("login your site",
array('controller' => 'Users', 'action' => 'login')); ?></p>


<div class="add_box">
<?= $this->Form->create('user',['type' => 'file']) ?>
<hr />
    <fieldset>
        
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
		 <?= $this->Form->input('USR_FULLNAME',array('label'=>'full name')) ?>
         
		 <?php echo $this->Form->input('Image', ['label' => 'Image','type' => 'file']);?>
		 
		 <?= $this->Form->input('USR_GROUP', array('options' => $Usergroups,'label'=>'User Group'));?>
		
		
		
		
   </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create User', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div></div>