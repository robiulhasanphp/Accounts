<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Create Ledger Category </h4>
<div style="clear:both"></div>
<hr/>
<div class="add_box">
<?= $this->Form->create($Ledgertypem) ?>
    <fieldset>
        
        <?= $this->Form->input('LTM_NAME', array(
            'label'=>'Category Name',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('LTM_SHORT', array(
            'label'=>'Short Name',
			'type'=>'text'
        )); ?>
		
    
   </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div></div></div>