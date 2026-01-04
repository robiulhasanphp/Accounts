<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Create Allowance/Deduction </h4>
<div style="clear:both"></div>
<div class="" style="padding:15px;">
<?= $this->Form->create($Allowance) ?>
    <fieldset>
       <hr/>  <div class="proj_dep">
        <?= $this->Form->input('LDG_CODE', array(
            'label'=>'Code',
			'type'=>'text',
			'style'=>'width:150px'
        )); ?>
		<?php
//		 $atype=['Allowance'=>'A',"Deduction'=>'D'];
		?>
		<?= $this->Form->input('LDG_TYPES', array(
            'label'=>'Type',
			'type'=>'select',
						'options' =>['ALW'=>'Allowance','DED'=>'Deduction']
        )); ?>

        <?= $this->Form->input('LDG_NAME', array(
            'label'=>'Allowance Name',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('LDG_DESCRICPTION', array(
            'label'=>'Description',
			'type'=>'text'
        )); ?>

    </div>
   </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div></div>