
<div class="dash_board">
	<table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
		<div class="dash_left">
			<div class="box">         
				<h1 class="bar_title small_h">Purchase</h1>
				<ul>
<li class='plus'><?php echo $this->Html->link("Create Purchase", array('controller' => 'Purchase', 'action' => 'add')); ?></li>
<li class='plus'><?php echo $this->Html->link("Create Ledger Types", array('controller' => 'Ledgertypem', 'action' => 'index')); ?></li>
				</ul>
            </div>
			<div class="box">         
                <h1 class="bar_title small_h">List</h1>
                <ul>
                
                <li class=''><?php echo $this->Html->link("Supplier List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                <li class=''><?php echo $this->Html->link("Customer List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                <li class=''><?php echo $this->Html->link("Employee List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                <li class=''><?php echo $this->Html->link("Bank List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                
                <li class=''><?php echo $this->Html->link("Inventory List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                
                
                </ul>

			</div>

		</div>
</td><td style="vertical-align:top" align="left">
<div class="dash_content">

		<h1 class="bar_title small_h">Purchase</h1>




            <div style="padding-bottom:30px;">
            
            </div>



<div style="padding:5px;border:1px solid #CCC;margin:10px">
            
            
            
            
                <table style=" padding:10px" cellpadding="5" width="500px">

                    <tr>
                    <td width="150"><strong>Accounts</strong></td>
                    <td class="td_class"><?php echo $Purchase->VCH_FULL_DESCRIPTION?></td>
                    </tr>
                      <tr>
                    <td width="150"><strong>Narration</strong></td>
                    <td class="td_class"><?php echo $Purchase->VCH_NARRATION?></td>
                    </tr>
                    <tr>
                    <td width="150"><strong>Voucher Date:</strong></td>
                    <td class="td_class"><?php echo date('d-m-Y',strtotime($Purchase->VCH_DATE))?></td>
                    </tr>
                    <tr>
                    <td width="150"><strong>Voucher Amount:</strong></td>
                    <td class="td_class"><?php echo number_format($Purchase->VCH_AMOUNT,2)?></td>
                    </tr>




			</table>

<br /><br />
<div class="schdulebox">
<?= $this->Form->create($Purchase) ?>
<fieldset>
<legend><?= __('Delete Purchase') ?></legend>




<?=$this->Form->input('VCH_STATUS_DESC',               
[   

'type'     => 'textarea',
'class'=>'dd',
'cols'=>'200',
'rows' => 3,
'style' => 'height:100px;',
'label'	=> 'Delete reason',

]);   
?> 







</fieldset>


<?php 
echo '<div class="button">';
echo $this->Form->button('Delete', array('class'=>'custom_submit'));
echo '</div>';
?>



<?= $this->Form->end() ?>

</div></td></tr></table></div>



<!-- src/Template/Users/add.ctp -->


