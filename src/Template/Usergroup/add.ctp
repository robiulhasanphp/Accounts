<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Creat New User Group </h4>
<div style="clear:both"></div>

<div class="add_box">

<?= $this->Form->create($Usergroup) ?>
    <fieldset>
<hr/>
        <?= $this->Form->input('BAS_CODE', array(
            'label'=>'Group Code',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('BAS_NAME', array(
            'label'=>'User Group',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'text'
        )); ?>
    
   </fieldset>

<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
     <div style="clear:boath"></div>
	 <br><br><br>
<?= $this->Form->end() ?>
</div>
   <div style="clear:boath"></div>