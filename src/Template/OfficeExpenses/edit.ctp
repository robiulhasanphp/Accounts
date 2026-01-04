<div class="content_inner">
<div class="inner_box big" style="width:900px;" >


<h4 class="inner_title"> Edit Expenses </h4>
<div style="clear:both;"></div>



<div style="border:1px solid #ccc;margin:auto;padding-left:10px;">
<?= $this->Form->create($OfficeExpenses) ?>


<div class="ldg_box l_mdeium" >
                     
                  <div class="proj_dep">
                          <?=$this->Form->input('VCH_PROJECT',               
                        [   
             
                        'options' => $project,
                        'type'=>'select',
                        'class'=>'inp_select',
                        'label'	=> 'Project',
            
                    ]);   
                    ?>
						<?=$this->Form->input('VCH_DEPARTMENT',               
                        [   
             
                        'options' => $department,
                        'type'=>'select',
                        'class'=>'inp_select',
                        'label'	=> 'Department',
            
                    ]);   
                    ?>

</div>		                  <div class="proj_dep">
		  <?= $this->Form->input('from_date', array(
            'label'=>'Expense Date',
			'id' => 'birthday',
			'type'=>'text',
			'class'=>'dd',
			'value'=>$from_date,
			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
			'style'=>'width:150px'
        )); ?>
		  
		
</div>
<div  style="width:100%">
		  <?= $this->Form->input('VCH_DR_ACCOUNTS', array(
            'label'=>'Ledger name',
			'options' => $LDG_name,
			'type'=>'select',
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
		<br/>
		<div class="clr"></div>

		
		 <?= $this->Form->input('VCH_NARRATION', array(
            'label'=>'Narration',
			'type'=>'text'
        )); ?>
		 <?= $this->Form->input('VCH_ID', array(
			'type'=>'hidden'
        )); ?>

</div>

<div class="ldg_box l_Vbig">
<div style="width:350px;float:left">
 <?= $this->Form->input('VCH_AMOUNT', array(
            'label'=>'Amount',
			'type'=>'text',
			'style'=>'width:150px'
        )); ?>
</div>
<!--<div style="width:350px;float:left">
 <?= $this->Form->input('VCH_CR_ACCOUNTS', array(
            'label'=>'Credit From',
			'options' => $cash_name,
			'type'=>'select',
			'style'=>'width:150px'
        )); ?>
		</div>

</div>-->


       

      
		
	
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Update Voucher', array('class'=>'custom_submit'));
	  
  	echo '</div>';

  ?>
  
  
   

   
<?= $this->Form->end() ?>
<div style='font-size:20px'><?=$this->Html->link("Cancel", array('controller' => 'OfficeExpenses', 'action' => 'index')) ;?> Or</div>    </div></div><div style="clear:both;"></div></div>

</div>