<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Edit Ledger Category </h4>
<div style="clear:both"></div>
<hr/>
<div class="add_box">

    <fieldset>
<?php
    echo $this->Form->create($Ledgertypem);
    echo $this->Form->input('LTM_ID', array('type' => 'hidden'));
    echo $this->Form->input('LTM_NAME', array(
            'label'=>'Nane',
			'type'=>'text'
        ));
	echo $this->Form->input('LTM_SHORT', array(
            'label'=>'Short',
			'type'=>'text'
        ));
	echo $this->Form->input('LTM_FLAG', array(
            'label'=>'Flag',
			'type'=>'text'
        ));
		
		?>
     </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Update', array('class'=>'custom_submit'));
  	echo '</div>';

    echo $this->Form->end();
?>