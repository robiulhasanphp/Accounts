


<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Create Designation </h4>
<div style="clear:both"></div>
<div class="content_inner">
<?= $this->Form->create($Designation) ?>
    <fieldset>
        <legend></legend>
        <?= $this->Form->input('BAS_CODE', array(
            'label'=>' Code',
			'style'=>'width:150px;float:left',
			
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('BAS_NAME', array(
            'label'=>' Name',
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
<?= $this->Form->end() ?>
</div></div>