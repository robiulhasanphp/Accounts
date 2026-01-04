<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Creat New Branch Office</h4>
<div style="clear:both"></div>
<div class="add_box">
<hr />
	<?php
        echo $this->Form->create($CompanyBranch);
		
		
			echo $this->Form->input('CMP_ID', array(
					'label'=>'Company ID',
					'type'=>'select',
					'options'=>$CompanyInfo
				)
			);
			
			echo $this->Form->input('BRN_NAME', array(
					'label'=>'Branch Name'
				)
			);
			echo $this->Form->input('BRN_ADDRESS1', array(
					'label'=>'Address1'
				)
			);
			echo $this->Form->input('BRN_ADDRESS2', array(
					'label'=>'Address2'
				)
			);
			echo $this->Form->input('BRN_PHONE', array(
					'label'=>'Phone'
				)
			);
			echo $this->Form->input('BRN_FAX', array(
					'label'=>'Fax'
				)
			);
			echo $this->Form->input('BRN_TEL', array(
					'label'=>'Tel'
				)
			);
			echo $this->Form->input('BRN_EMAIL', array(
					'label'=>'Email'
				)
			);
			echo $this->Form->input('BRN_CODE', array(
					'label'=>'Code'
				)
			);
			echo $this->Form->input('BRN_ACTIVE', array(
					'label'=>'Active',
					'type'=>'checkbox',
					'label'=>'Active',
					'class' => 'check'
				)
			);
			echo $this->Form->input('BRN_ACTIVE_CODE', array(
					'label'=>'Active Code'
				)
			);
					
			echo "<div style='clear:both'></div>";
			echo $this->Form->button('Create', array('class'=>'custom_submit'));
			
		
		echo $this->Form->end();
        
    ?>
</div></div></div>