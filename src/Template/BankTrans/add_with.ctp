<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title">Cash Withdraw From Bank</h4>
<div style="clear:both;"></div>



<div style="border:1px solid #ccc;margin:auto;padding: 20px 10px;">
    <?php
        echo $this->Form->create($BankTrans);
		
                  ?> <div class="proj_dep">
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
				</div>
                <?php
			
			
			echo '<div class="clr"></div>';
			
			
			?><div class="proj_dep"><?php
					echo $this->Form->input('pay_date', array(
						'label' => 'Payment Date',
						'id' => 'birthday',
						'class'=>'inp_select',
						'Placeholder' => 'Payment Date'
					));
			?></div>
               
               
               
 			<div class="clr"></div>
		
        
        
<div class="clr"></div>
		 <div class="proj_dep">
         
			 <?php echo $this->Form->input('VCH_CR_ACCOUNTS',               
				[   
				  'style'=>'width:400px;float:left',
				 'label' => 'Bank Name',
				 'options' => $bank_name,
				 'type'=>'select',
				 'selected'=>'selected'
						
			]);
			
		?>
        </div>
        
        
        
        
        
        
        
		
<?php		echo '<div class="radio_all" id="pay_type">';
				echo '<p>Receive Mode :</p>';
				echo $this->Form->radio(
					'BankTrans_mode',
					[
						['value' => '0', 'checked'=>'checked', 'text' => 'Cash', 'id' => 'pmode_c', 'style' => 'color:red; float:left;'],
						['value' => '2', 'text' => 'Withdraw To', 'id' => 'pmode', 'style' => 'color:blue; float:left;'],
					]
				);
			echo '</div>';
?>			
 <div id="bank_list" class="proj_dep">
	   <?php echo $this->Form->input('VCH_DR_ACCOUNTS',               
				[   
				 'style'=>'width:400px;float:left',
				 'label' => 'Withdraw To',
				 'options' => $bank_name,
				 'type'=>'select',
				 'selected'=>'selected'
			]);  
		?>
        </div>
              
               

<div class="clr"></div>				
<?php		
            echo $this->Form->input('VCH_AMOUNT', array(
				'label' => 'Withdraw Amount',
				'type' => 'text'			
			));
?>
	<div class="clr"></div>
<?php			
			
            echo $this->Form->input('VCH_NARRATION', 
					[
						'rows' => '3',
						'label'=> 'Remarks'
					]
				);
?>
	<div class="clr"></div>
<?php			

			echo '<div class="button">';
						echo '<div style="width:70px;float:right;height:50px;">Continue Add';
	  echo $this->Form->checkbox('CONTINUE',['checked'=>'checked']);
echo '</div>';

				echo $this->Form->button('Create Voucher', array('class'=>'custom_submit'));
			echo '</div>'; 
			
			
        echo $this->Form->end();
    ?>
   <div class="clr"></div>
</div>
</div>
</div>

<script>
$('#pay_type').css('display','none');
	$('#bank_list').css('display','none');
	$(pmode_c).click(function()
	{
		//alert("cash");
		  $('#bank_list').css('display','none');
	}
	);
	 $(pmode).click(function()
	{
		//alert("check");
	  $('#bank_list').css('display','block');
	
	});
</script>