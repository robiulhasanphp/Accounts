<!-- src/Template/Users/add.ctp -->

<div class="Usergroup form">
<?= $this->Form->create($Voucherstatus) ?>
    <fieldset>
        <legend><?= __('Add Usergroup') ?></legend>
        <?= $this->Form->input('BAS_CODE', array(
            'label'=>'Voucher Code',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('BAS_NAME', array(
            'label'=>'Voucher Name',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'text'
        )); ?>
    
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>