<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title">Edit Company  </h4>
<div style="clear:both"></div>
    

<div class="add_box">
<hr />
	<?php
    	echo $this->Form->create($CompanyInfo);
			
          
			echo $this->Form->input('CMP_ROOT_ID', array(
					'label'=>'Group Name',
					'type'=>'select',
					'options'=>$CompanyRoot
				)
			);
         
			/*echo $this->Form->input('CMP_ROOT_ID', array(
				'options' => $CompanyInfo,
				'label' => 'Company Root Id',
				'type' => 'select',
				'selected'=>'selected'
			));*/
           
			echo $this->Form->input('CMP_CODE', array(
				'label' => 'Company Code'
			));
         
			echo $this->Form->input('CMP_NAME', array(
				'label' => 'Company Name'
			));
      
			echo $this->Form->input('CMP_ADDRESS', array(
				'label' => 'Address'
			));
			echo $this->Form->input('CMP_PHONE', array(
				'label' => 'Phone'
			));
			echo $this->Form->input('CMP_FAX', array(
				'label' => 'Fax'
			));
			echo $this->Form->input('CMP_EMAIL', array(
				'label' => 'Email'
			));
			
			echo $this->Form->input('CMP_ACTIVE', array(
				'label' => 'Active Status',
				'type' => 'checkbox',
				'class' => 'check'
			));
			/*
			echo $this->Form->input('CMP_LOGO', array(
			  'label' => 'Logo'
			));*/
			echo $this->Form->input('CMP_ID', array(
			  'type' => 'hidden'
			));
		
		
		echo $this->Form->button('Update', array('class'=>'custom_submit'));
		echo $this->Form->end();
	?>
    <div style='clear:both'></div>
</div>
</div></div>