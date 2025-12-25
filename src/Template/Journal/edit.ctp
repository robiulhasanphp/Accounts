<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title">  New Purchase</h4>
<div style="clear:both;"></div>

<script type="text/javascript">
        function CheckAndSubmit () {
		
var Value1 = document.getElementById('VCH_DR_AMOUNT').value
var Value2 = document.getElementById('DR_AMOUNT').value



var t_debit = Number(Value1) + Number(Value2);



var Value3 = document.getElementById('VCH_CR_AMOUNT').value
var Value4 = document.getElementById('CR_AMOUNT').value


var t_credit = Number(Value3) + Number(Value4);


		
		
			var tDr=t_debit;
			var tCr=t_credit;			
			if(tDr!=tCr)
			{
			alert("Debit and Credit Amount Is Not Correct");
            return false;
			}


			return true;
        }
    </script>

<div style="border:1px solid #ccc;margin:auto;padding-left:10px;">
<?= $this->Form->create('Createvoucher', ['onSubmit'=>"return CheckAndSubmit()"]);  ?>
			<div class="proj_dep">
					<?=$this->Form->input('VCH_PROJECT',               
					[   
					
					'options' => $department,
					'type'=>'select',
					'class'=>'dd',
					'label'	=> 'Department',
					
					]);   
					?>


					<?=$this->Form->input('VCH_DEPARTMENT',               
					[   
					'class'=>'dd',
					'label'    => 'Project',
					'options' => $project,
					'type'=>'select'
					
					
					
					]);   
					?>



			</div>
					<div class="h_border"></div>


				<div class="proj_dep">

							<div id="date">      
							
							<?=$this->Form->input('pdate',               
							[   
							'id' => 'birthday',
							'type'=>'text',
							'class'=>'dd',
							'dateFormat' => 'YMD',
							'minYear' => date('Y') - 80,
							'maxYear' => date('Y') - 18,
							'label'   => 'Date',
							'placeholder'=>'date',
							
							
							]);   
							?>
							
							</div>

				</div>      
						<div class="proj_dep" >  
									<?=$this->Form->input('VCH_NARRATION',               
									[   
									
									'type'     => 'text',
									'class'=>'dd',
									'rows' => 3,
									'style' => 'height:100px;',
									'label'	=> 'Description',
										'placeholder'=>'Description',
									]);   
									?> 



						</div>
						
						
	


<div class="ldg_box l_Vbig">
			<div style="width:220px;float:left">
			 	<?=$this->Form->input('VCH_CR_ACCOUNTS',               
					[   
					'class'=>'dd',
					'label'    => 'Cash',
					'options' => $LDG_name,
					'type'=>'select'
					
					
					
					]);   
					?>

			</div>
			
			<div style="width:220px;float:left">
			 <?=$this->Form->input('VCH_NARRATION_1',               
									[   
									
									'type'     => 'text',
									'class'=>'dd',
									'rows' => 3,
									'style' => 'height:50px;',
									'label'	=> 'Description',
										'placeholder'=>'Description',
									]);   
									?> 

					</div>
					
					
					
				
					
						<div style="width:150px;float:left">
			 <?= $this->Form->input('debit_amount', array(
						'label'=>'DR',
						'id' => 'VCH_DR_AMOUNT',
						'type'=>'text',
						'placeholder'=>'DR',
						'style'=>'width:120px'
					)); ?>
					</div>
					
					
							<div style="width:150px;float:left">
			 <?= $this->Form->input('credit_amount', array(
						'label'=>'CR',
						'id' => 'VCH_CR_AMOUNT',
						'type'=>'text',
						'placeholder'=>'CR',
						'style'=>'width:120px'
					)); ?>
					</div>
					
			

</div>

<div>







<div class="ldg_box l_Vbig">
			<div style="width:220px;float:left">
				<?=$this->Form->input('VCH_DR_ACCOUNTS',               
					[   
					'class'=>'dd',
					'label'    => 'Purchase',
					'options' => $LDG_name,
					'type'=>'select'
					
					
					
					]);   
					?>

			</div>
			
			<div style="width:220px;float:left">
			 <?=$this->Form->input('VCH_NARRATION_2',               
									[   
									
									'type'     => 'text',
									'class'=>'dd',
									'rows' => 3,
									'style' => 'height:50px;',
									'label'	=> '',
									'placeholder'=>'Description',
									]);   
									?> 

					</div>
					
								<div style="width:150px;float:left">
			 <?= $this->Form->input('debit_amount_2', array(
						'label'=>'',
						'id' => 'DR_AMOUNT',
						'type'=>'text',
						'placeholder'=>'DR',
						'style'=>'width:120px'
					)); ?>
					</div>
			
			
					
						<div style="width:150px;float:left">
			 <?= $this->Form->input('credit_amount_2', array(
						'label'=>'',
						'id' => 'CR_AMOUNT',
						'type'=>'text',
						'placeholder'=>'CR',
						'style'=>'width:120px'
					)); ?>
					</div>
					
					
			

</div>



<?php 
echo '<div class="button">';
echo $this->Form->button('Create Voucher', array('class'=>'custom_submit'));
echo '</div>';
?>



<?= $this->Form->end() ?>


<div class="proj_dep"></div>
<div class="clr"></div>
</div>
</div>


<script>
$(VCH_DR_AMOUNT).mousedown(function(){	change_drcr('D')});	
$(VCH_CR_AMOUNT).mousedown(function(){	change_drcr('C');});	
	
$(VCH_DR_AMOUNT).keypress(function(){	change_drcr('D')});
$(VCH_CR_AMOUNT).keypress(function(){	change_drcr('C')});

$(VCH_DR_AMOUNT).change(function(){	change_drcr('D')});
$(VCH_CR_AMOUNT).change(function(){	change_drcr('C')});


$(CR_AMOUNT).mousedown(function(){	change_drcr('C');});	

$(DR_AMOUNT).mousedown(function(){	change_drcr('D');});

$(DR_AMOUNT).keypress(function(){	change_drcr('D')});
$(CR_AMOUNT).keypress(function(){	change_drcr('C')});

$(DR_AMOUNT).change(function(){	change_drcr('D')});
$(CR_AMOUNT).change(function(){	change_drcr('C')});


		

function change_drcr(opt)
{

var dr=$(VCH_DR_AMOUNT).val();
var cr=$(VCH_CR_AMOUNT).val();

var debit=$(DR_AMOUNT).val();
var credit=$(CR_AMOUNT).val();


	if (opt=='C')
	{
		if (cr!='')
		{
			$(VCH_DR_AMOUNT).val('');
			$(VCH_DR_AMOUNT).attr('readonly', true);
			$(CR_AMOUNT).attr('readonly', true);
			$(CR_AMOUNT).val('');
		}
		else
		{
		$(VCH_DR_AMOUNT).attr('readonly', false);
		
		$(CR_AMOUNT).attr('readonly', false);
		
		}
	}
	else
	{
		if (dr!='')
		{
			$(VCH_CR_AMOUNT).val('');
		$(VCH_CR_AMOUNT).attr('readonly', true);
		
			$(DR_AMOUNT).attr('readonly', true);
			
			$(DR_AMOUNT).val('');
		}
		else
		{
		$(VCH_CR_AMOUNT).attr('readonly', false);
		
		
			$(DR_AMOUNT).attr('readonly', false);
		
		}
		
	}
	
	
	
	

}
	 
</script>




<script>
$(DR_AMOUNT).mousedown(function(){	change_debcre('Debit')});	
$(CR_AMOUNT).mousedown(function(){	change_debcre('Credit');});	
	
$(DR_AMOUNT).keypress(function(){	change_debcre('Debit')});
$(CR_AMOUNT).keypress(function(){	change_debcre('Credit')});

$(DR_AMOUNT).change(function(){	change_debcre('Debit')});
$(CR_AMOUNT).change(function(){	change_debcre('Credit')});

function change_debcre(op)
{

var deb=$(DR_AMOUNT).val();
var cre=$(CR_AMOUNT).val();

	if (op=='Credit')
	{
		if (cre!='')
		{
			$(DR_AMOUNT).val('');
			$(DR_AMOUNT).attr('readonly', true);
		}
		else
		{
		$(DR_AMOUNT).attr('readonly', false);
		}
	}
	else
	{
		if (deb!='')
		{
			$(CR_AMOUNT).val('');
		$(CR_AMOUNT).attr('readonly', true);
		}
		else
		{
		$(CR_AMOUNT).attr('readonly', false);
		}
	}
	
	

}
	 
</script>




