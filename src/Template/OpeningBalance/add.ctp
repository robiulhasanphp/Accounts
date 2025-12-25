<script>
	$(function() {
		$( "#balance_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange:'-90:+0',
			dateFormat: 'dd-mm-yy'
		});
	});
</script>
<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Creat Ledger Balance</h4>
<div style="clear:both"></div>
<div class="add_box">
<hr />
	<?php 
		echo $this->Form->create($OpeningBalance);
		
		
		
            echo  $this->Form->input('LDG_ID', array(
				'label'=>'Ledger Name',
				'options' => $LDG_name,
				'type'=>'select',
				'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
			)); 
		
		
		
		
             echo $this->Form->input('balance_date', array(
                    'label' => 'Balance Date',
					'id' => 'balance_date',
             )); 
            
            echo $this->Form->input('LBL_BALANCE_DR', array(
                    'label' => 'Balance DR',
					'id' => 'LBL_BALANCE_DR',
					'type'=>'text',
					'onkeyup' => 'showHint(this.value)'
             )); 
            
            echo $this->Form->input('LBL_BALANCE_CR', array(
                    'label' => 'Balance CR',
					'id' => 'LBL_BALANCE_CR',
					'type'=>'text',
             )); 
			
?>			
			
			
			
			
	
		  <script>
			 /* $(VCH_DR_AMOUNT).mousedown(function(){	change_drcr('D')});	
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
			  }*/
			  
		  </script>
		  		  
		  <script>
			 /* $(DR_AMOUNT).mousedown(function(){	change_debcre('Debit')});	
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
			  
			  }*/
		  </script>

		  <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
          
          <script type="text/javascript">
			  $(document).ready(function()
			  {
				  $('#button').toggle(
					  function()
					  {
						  $('#div1').css({'display':'none'});
						  $('#div2').slideDown(); // or try "fadeIn()"
						  $('#button').attr;
					  }, 
					  function() 
					  {
						  $('#div2').css({'display':'none'});
						  $('#div1').slideDown(); // or try "fadeIn()"
						  $('#button').attr;
					  }
				  );
			  });
          </script>
			
			
			
			
			
			
			
			
			
			
			
			
	<?php			
			echo '<div style="clear:both"></div>';

			echo '<div class="button">';
				echo $this->Form->button('Create', array('class'=>'custom_submit'));
			echo '</div>'; 
			
		echo $this->Form->end();
	?>
</div></div></div></div>