<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title">Edit Recieve</h4>
<div style="clear:both;"></div>


<h5 style='color:green;float:right;background:#ddd;padding:5px;margin-top:-35px;border-radius:3px'><?= $this->Flash->render() ?></h5>

<div style="border:1px solid #ccc;margin:auto;padding: 20px 10px;">
    <?php
        echo $this->Form->create($Recieve);
		
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
			
			
			?> <div class="proj_dep"><?php
					echo $this->Form->input('pay_date', array(
						'value' => $pay_date,
						'label' => 'Payment Date',
						'id' => 'birthday',
						'class'=>'inp_select',
						'Placeholder' => 'Payment Date',
					));
					echo $this->Form->input('VCH_MR_NO', array(
						'label' => 'MR No',
						'class'=>'inp_select',
						'Placeholder' => 'MR No'						
					));?>
				</div>
               
			
<div class="clr"></div>
		 <div class="proj_dep">
         
			 <?php echo $this->Form->input('VCH_CR_ACCOUNTS',               
				[   
				  'style'=>'width:400px;float:left',
				 'label' => 'Reciept From',
				 'options' => $paid_to,
				 'type'=>'select',
				 'selected'=>'selected'
						
			]);  
			
		?>
        </div>

			<div class="clr"></div>

		
		 <div class="proj_dep">
		 <?php
					echo $this->Form->input('VCH_CHALLAN_NO', array(
						'label' => 'Check No',
						'class'=>'inp_select',
						'Placeholder' => 'Cheque Nos'
					));
										
					
					echo $this->Form->input('check_date', array(
						//'type' => 'select',
						'value' => $ck_date,
						'label' => 'Date',
						'class'=>'inp_select',
						'id' => 'chalan_date',
						'Placeholder' => 'Chueque Dates',
						
					));
			?>
			</div>

		
			<div class="clr"></div>
		
		
<?php		echo '<div class="radio_all">';
				echo '<p>Payment Mode :</p>';
				//echo $Payment->VCH_CR_ACCOUNTS;
				if( $Recieve->VCH_DR_ACCOUNTS==ACC_CASH){
				echo $this->Form->radio(
					'payment_mode', 						
					[
						['value' => '0', 'checked'=>'checked', 'text' => 'Cash', 'id' => 'pmode_c','style' => 'color:blue; margin-top:-2px;width:100px;float:left']
					,
						['value' => '2', 'text' => 'Check', 'id' => 'pmode','style' => 'color:blue; margin-top:-2px;width:100px;float:left']
					
					]
				);
				}
				else{
					echo $this->Form->radio(
					'payment_mode', 						
					[
						['value' => '0', 'text' => 'Cash', 'id' => 'pmode_c', 'style' => 'color:blue; margin-top:-2px;width:100px;float:left'],
						['value' => '2', 'checked'=>'checked', 'text' => 'Check', 'id' => 'pmode','style' => 'color:blue; margin-top:-2px;width:100px;float:left'],
					]
				);
				}
				
			echo '</div>';
?>			
 <div id="bank_list" class="proj_dep">
	   <?php echo $this->Form->input('VCH_DR_ACCOUNTS',               
				[   
				 'style'=>'width:400px;float:left',
				 'label' => 'Recieved To',
				 'options' => $paid_to,
				 'type'=>'select',
				 'selected'=>'selected'
			]);  
		?>
        </div>
<div class="clr"></div>				
<?php		
            echo $this->Form->input('VCH_AMOUNT', array(
				'label' => 'Recieved Amount'				
			));
?>
	<div class="clr"></div>
<?php			
			
            echo $this->Form->input('VCH_NARRATION', 
					[
						'type' => 'text',
						'label'=> 'Narration'
					]
				);
?>
	<div class="clr"></div>
<?php			
echo $this->Form->input('VCH_ID', array(
				'type' => 'hidden'				
			));	
			
			echo '<div class="button">';
				echo $this->Form->button('Update Voucher', array('class'=>'custom_submit'));
			echo '</div>'; 
			
			
        echo $this->Form->end();
    ?>
   <div class="clr"></div>
</div>
</div>
</div>

<script>
$('#bank_list').css('display','none');
<?php 

	if( $Recieve->VCH_DR_ACCOUNTS!=ACC_CASH){
?>
	$('#bank_list').css('display','block');
	<?php  }?>
	
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