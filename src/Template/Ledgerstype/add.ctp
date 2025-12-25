	<div class="container">
            	<div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title_tx">

            		</div>
        		</div>

            	<div class="row">
               


                        
                            <div class="content_right" ><!--start the content_right-->
                            
                               
                                    <div class="content_inner">
                                    <h1 class="cnt_title">Add New Ledger Type</h1>
                                    </div>
<!-- src/Template/Users/add.ctp -->

<div class="add_box">
<?= $this->Form->create($Ledgerstype) ?>
    <fieldset>
        <legend><?= __('Add Ledgerstype') ?></legend>
		
		
        <?= $this->Form->input('LTM_ID', array(
            'label'=>'ltm id',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('LDG_ID', array(
            'label'=>'ldg id',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('LDT_EDIT_BY', array(
            'label'=>'edit by',
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