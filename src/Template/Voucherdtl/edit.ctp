
<h1>Edit Usergroup</h1>
<?php
    echo $this->Form->create($Voucherstatus);
    echo $this->Form->input('BAS_ID', array('type' => 'hidden'));
    echo $this->Form->input('BAS_CODE', array(
            'label'=>'Voucher Code',
			'type'=>'text'
        ));
	echo $this->Form->input('BAS_NAME', array(
            'label'=>'Voucher Name',
			'type'=>'text'
        ));
	echo $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'text'
        ));
    echo $this->Form->button(__('Save Voucher Status'));
    echo $this->Form->end();
?>