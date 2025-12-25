<div class="content_inner">

<div class="inner_box big" style="width:900px;" >

  <?php
		$run_sum=0;
		$balance=0;
//		echo $not_authorize;
		foreach($vdt_id as $a):
		$date=$a->VDT_DATE;
		endforeach;
		
		?>	

<h4 class="inner_title">  Voucher Information : </h4>
<div style="clear:both;"></div>
<h5 style='color:green;float:right;background:#ddd;padding:5px;margin-top:-35px;border-radius:3px'><?php 
	$noform=false;

if ($a->voucher->VCH_STATUS==STS_SENT)
{
	//echo "STATUS : WAITING FOR APPROVAL " ;
	//$noform = true;
}
elseif ($a->voucher->VCH_STATUS==STS_APPROVED)
{
	echo "ALREADY APPROVE";
	$noform=true;
}
if(isset($Approve))
{
	if($Approve==1) $noform=true;
}



echo $this->Flash->render(); ?></h5>


<div style="border:1px solid #ccc;margin:5px;padding-left:10px;width:600px;float:left">
     <table style="width:100%;font-size:12px;font-weight:bold;padding:5px;line-height:25px"><tr><td style="width:100px;">
        
        
                Voucher Date </td><td>:&nbsp<?php 
                echo $date->format('d-m-Y');?></td>
                
                
                
                <td style="text-align:right;font-weight:bold">
           &nbsp Voucher No&nbsp </td><td>:&nbsp<?php echo $a->voucher->VCH_NO_FULL?></td>
            </tr>
            <tr>
            <td>Poject</td><td>:&nbsp<?php echo $a->project->BAS_CODE;?></td>
            <td style="text-align:right;">Department&nbsp </td><td>:&nbsp<?php  echo $a->department->BAS_CODE; ?></td>
            </tr>
            <tr>
            <td>Notes</td><td colspan="3">:&nbsp<?php echo $a->voucher->VCH_NARRATION?></td>
            
            </tr>
            </table>
<br /><br />
<table class="table-bordered" >
<tr align="center">
<td>A/C Code</td>
<td>A/C Name</td>


<td>Debit</td>
<td>Credit</td>



</tr>



       <?php
	$run_sum=0;
	$balance=0;
	$credit=0;
	$debit=0;
	
		  foreach($vdt_id as $a):
		  ?>
          







<tr >

<td><?php echo $a->ledger->LDG_CODE?></td>
<td><?php echo $a->ledger->LDG_NAME?></td>




<td style="text-align:right;"><?php echo number_format( $a->VDT_DEBIT,2); $debit=$debit+ $a->VDT_DEBIT;?></td>
<td style="text-align:right;"><?php echo number_format($a->VDT_CREDIT,2); $credit=$credit+$a->VDT_CREDIT;?></td>

</tr> 



 <?php endforeach;?>	
	
	

          <tr >
              <td colspan="2" style="text-align:right;font-weight:bold">               Total:</td>
              <td style="text-align:right;font-weight:bold"> <?php echo number_format($debit,2);?>              </td>
              <td style="text-align:right;font-weight:bold"><?php echo number_format($credit,2)?></td>
          
          </tr>

 	</table>
<?php 

$type=$a->voucher->VCH_TYPE;


?>	
 
      <table class="table-bordered" style="text-align:center; border:none !important;">     
          <tr style="border:none !important;">
              <td style="border:none !important; width:16%;"></td>
              <td style="border:none !important; width:52%;"></td>
              <td style="border:none !important; width:13%;"></td>
              
                <?php

				if (isset($not_authorize))
				{
					if($not_authorize==1) $noform=true;
				}
if ($noform==false)
			{
			if($type==6)
						{
							
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => 'jurnal', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => 'jurnal', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			
			}
			?>
            
            
              <?php
			
			if($type==7)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
          
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => 'Purchase', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => 'Purchase', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			
			}
			?>
            
            
            
            
             <?php
			
			if($type==8)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => 'Sales', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => 'Sales', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			
			}
			?>
            
            
            
               <?php
			
			if($type==9)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => 'Payment', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => 'Payment', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
	           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
            
              </td>
              
            <?php
			
			}
			?>
            
            
              <?php
			
			if($type==10)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => 'Recieve', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => 'Recieve', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			
			}
			?>
            
              
              
               
              <?php
			
			if($type==11)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			
			}
			?>
            
              
               
              <?php
			
			if($type==12)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => '', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => '', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			
			}
			?>
            
           
             
              <?php
			
			if($type==13)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => '', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => '', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           	
              
              </td>
              
            <?php
			}
			}
			?>
            
               
              
          
          </tr>

 </table>
 
	   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
 
 <script>


function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>


</div>
<div style="border:1px solid #ccc;padding-left:5px;width:250px;float:left;margin:5px;">
<?php 
if ($noform==false){?>
			<h3 style="border-bottom:1px solid #060;padding:6px;background:#060;color:#FFF;">Approval</h3>
			<?= $this->Form->create() ?>



	
        
        
        
        <div style="font-size:14px;float:left">	
        
        
        	  <?= $this->Form->input('VCH_ID', array(
            'label'=>'Voucher ID',
			'value'=>$vch_id,
			'type'=>'hidden',

        )); ?>

        	  <?= $this->Form->input('DESC', array(
            'label'=>'Notes',
			'style'=>'width:90%',
			'type'=>'textarea',

        )); ?>
<br /><br /><br /><br />
<div style="border-bottom:1px solid #ddd;margin-top:12px;width:100%">&nbsp;</div>

         
         <?= $this->Form->button('APPROVE', array(
			'value'=>STS_APPROVED,
			'name'=>'APPROVE',
			'label'=>'',
			
			'style'=>'font-size:14px;float:left;width:100px;margin:3px;margin-bottom:10px;'
        )); ?>
		



        <?= $this->Form->button('DENIED', array(
			'value'=>STS_DENIED,
			'name'=>'DENIED',
			'label'=>'',
			
			'style'=>'font-size:14px;float:left;width:100px;margin:3px'

        )); ?></div>

<!--  <?=$this->Form->button('APPROVE', array('class'=>'custom_submit','style'=>'float:left;margin-bottom:10px;'));  ?>--><br />
  <?= $this->Form->end() ?>   
  <br /><div style="height:8px;">&nbsp;</div>
  <?php }?>
</div>

</div>




</div>