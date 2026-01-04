<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Create Voucher Type </h4>
<div style="clear:both"></div>

<div class="Usergroup form">
<?= $this->Form->create($Vouchertype) ?>
    <fieldset>
        <hr/>
        <?= $this->Form->input('BAS_CODE', array(
            'label'=>'Voucher code',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('BAS_NAME', array(
            'label'=>'Voucher Name',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Desccription',
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