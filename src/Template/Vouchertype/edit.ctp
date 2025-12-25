<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Edit Voucher Type</h4>
<div style="clear:both"></div>

<?php
    echo $this->Form->create($Vouchertype);?>
	<hr />
	<?php
	
    echo $this->Form->input('BAS_ID', array('type' => 'hidden'));
    echo $this->Form->input('BAS_CODE', array(
            'label'=>'Voucher code',
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
    echo $this->Form->button(__('Save Vouchertype'));
    echo $this->Form->end();
?>