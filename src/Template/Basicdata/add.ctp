<!-- src/Template/Users/add.ctp -->


<div class="add_box">
<?= $this->Form->create($Basicdata) ?>
    <fieldset>
        <legend><?= __('Add Usergroup') ?></legend>
        <?= $this->Form->input('BAS_CODE', array(
            'label'=>' Code',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('BAS_NAME', array(
            'label'=>'Name',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'text'
        )); ?>
    
   </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Submit', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div>