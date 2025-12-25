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
<!--<form action="#" method="post">
	<select>
    	<option>1</option>
        <option selected="selected">2</option>
        <option>3</option>
        <option>4</option>
    </select>
</form>-->


<h4 class="inner_title">Edit Ledger End Balance</h4>
<div style="clear:both"></div>
<div class="add_box">
<hr />
	<?php 
		echo $this->Form->create($OpeningBalance);

			echo $this->Form->input('LDG_ID',[   
             'label'    => 'Ledger Name',
             'options' => $lgd_name1,
			 //'selected' => 'selected',
             'type'=>'select',			 
			 'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
			]);   
        
			
		
             echo $this->Form->input('balance_date', array(
                    'label' => 'Balance Date',
					'id' => 'balance_date',
					'type'=>'text',
					'style' => 'color:#f26522; font-weight:600;',
             )); 
            
            echo $this->Form->input('LBL_BALANCE_DR', array(
                    'label' => 'Balance DR',
										'type'=>'text'
             )); 
            
            echo $this->Form->input('LBL_BALANCE_CR', array(
                    'label' => 'Balance CR',
					'type'=>'text'
             )); 
			
			
			echo '<div style="clear:both"></div>';
			
			echo $this->Form->input('LDG_BAL_ID', array(
            	'type' => 'hidden'
            )); 

			echo '<div class="button">';
				echo $this->Form->button('Update', array('class'=>'custom_submit'));
			echo '</div>'; 
			
		echo $this->Form->end();
	?>
</div></div></div></div>