<!-- src/Template/Users/add.ctp -->

<div class="add_box">
<?= $this->Form->create($Voucherstatus) ?>
    <fieldset>
        <legend><?= __('Add Usergroup') ?></legend>
        <?= $this->Form->input('VCH_ID', array(
            'label'=>'vcd id',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('VDT_DATE', array(
            'label'=>'date',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('VDT_VOUCHER_NO', array(
            'label'=>'voucher no',
			'type'=>'text'
        )); ?>
		
			<?= $this->Form->input('VDT_LOT', array(
            'label'=>'lot',
			'type'=>'text'
        )); ?>
		
			<?= $this->Form->input('VDT_SR', array(
            'label'=>'sr',
			'type'=>'text'
        )); ?>
		
		
			<?= $this->Form->input('VDT_LDG_ID', array(
            'label'=>'ldg id',
			'type'=>'text'
        )); ?>
		
		
		
			<?= $this->Form->input('VDT_DEBIT', array(
            'label'=>'debit',
			'type'=>'text'
        )); ?>
		
		
			<?= $this->Form->input('VDT_CREDIT', array(
            'label'=>'credit',
			'type'=>'text'
        )); ?>
    
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>