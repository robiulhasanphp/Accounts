


<div id="printableArea">

<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Purchase</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("New Purchase", array('controller' => 'Purchase', 'action' => 'add')); ?></li>
                                   
</ul></div>
                                 <div class="box">         
                                <h1 class="bar_title small_h"></h1>
                                <!--<ul>
                                   
                                     <li class=''><?php echo $this->Html->link("Supplier List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Customer List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Employee List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Bank List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>

                                     <li class=''><?php echo $this->Html->link("Inventory List", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>

                                     </ul>-->
                                     
                                </div>

        		</div>
                </td><td style="vertical-align:top" align="left">
                <div class="dash_content">
                
        		                                <h1 class="bar_title small_h">Voucher List</h1>
                                  
    


<div style="padding-bottom:30px;">






</div>



          <?php
	$run_sum=0;
	$balance=0;
		  foreach($vdt_id as $a):
		  ?>
          
		  
		  <?php
		  $date=$a->VDT_DATE;
		  ?>
          
          
          
          
          <?php endforeach;?>	
          
        <div style="display:inline; font-size:16px; color:#009; float:left; padding-right:50px;">
        
        
                <p>Voucher Date :<?php 
                echo $date->format('d-m-Y');?>
                </p>
        
        </div>

            <div style="float:left; font-size:16px; color:#009">
            
            			<p>Voucher No:<?php echo $a->voucher->VCH_NO_FULL?></p>
            
            
            </div>

<div style="clear:both">

</div>


            <div style="display:inline; font-size:16px; color:#009; float:left; padding-right:130px;">
            
            
            		<p>Invoice NO:<?php echo $a->voucher->VCH_INV_NO?></p>
            
            </div>

            <div style="float:left; font-size:16px; color:#009">
            
                    <p>Invoice Date:
                    
                    
                    
                    <?php $inv_date =$a->voucher->VCH_INV_DATE;
                    echo $inv_date->format('d-m-Y');?>
                    
                    </p>
                    
            
            </div>

            <div style="clear:both">
            
            </div>



            <div style="display:inline; font-size:16px; color:#009; float:left; padding-right:130px;">
            
            
            <p>chalan NO:<?php echo $a->voucher->VCH_CHALLAN_NO?></p>
            
            </div>

            <div style="float:left; font-size:16px; color:#009">
            
            <p>chalan Date:
            
            
            
            <?php $chalan_date =$a->voucher->VCH_CHALLAN_DATE;
            echo $chalan_date->format('d-m-Y');?>
            
            
            </p>


</div>

<div style="clear:both">

</div>

            
            
            <div style="float:left; font-size:16px; color:#009">
            
            <p>Description:<?php echo $a->voucher->VCH_NARRATION?></p>
            
            
            </div>



<table class="table-bordered" style="text-align:center; margin-bottom:0;">
<tr align="center">
<td>Name</td>
<td>full description</td>


<td>Debit</td>
<td>Credit</td>



</tr>



       <?php
	$run_sum=0;
	$balance=0;
		  foreach($vdt_id as $a):
		  ?>
          







<tr align="center">


<td><?php echo $a->ledger->LDG_NAME?></td>
<td><?php echo $a->voucher->VCH_FULL_DESCRIPTION?></td>



<td><?php echo $a->VDT_DEBIT?></td>
<td><?php echo $a->VDT_CREDIT?></td>

</tr> 



 <?php endforeach;?>	
	
	

 </table>
 
      <table class="table-bordered" style="text-align:center; border:none !important;">     
          <tr style="border:none !important;">
              <td style="border:none !important; width:16%;"></td>
              <td style="border:none !important; width:52%;"></td>
              <td style="border:none !important; width:13%;"> 
               Total:<?php echo $debit;?>
              </td>
              <td style="border:none !important; width:14%;">Total:<?php echo $credit?></td>
          
          </tr>

 	
<?php 

$type=$a->voucher->VCH_TYPE;


?>	
 
      <table class="table-bordered" style="text-align:center; border:none !important;">     
          <tr style="border:none !important;">
              <td style="border:none !important; width:16%;"></td>
              <td style="border:none !important; width:52%;"></td>
              <td style="border:none !important; width:13%;"></td>
              
                <?php
			
			if($type==6)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => 'jurnal', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => 'jurnal', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
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
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
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
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
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
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
              </td>
              
            <?php
			
			}
			?>
            
              
              
               
              <?php
			
			if($type==11)
			{
			?>
            
              <td style="border:none !important; width:14%;">
              
              
              
               <?= $this->Html->link('Edit',array ('action' => 'edit','controller' => '', $a->VCH_ID)); ?> &nbsp;|
           		   <?= $this->Html->link('Delete',array ('controller' => '', 'action' => 'delete', $a->VCH_ID)); ?> 
                   &nbsp;|
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
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
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
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
           		   <?= $this->Html->link('Print',array ('controller' => 'Ledgerbalance', 'action' => 'printer', $a->VCH_ID)); ?>
              
              </td>
              
            <?php
			
			}
			?>
            
               
              
          
          </tr>

 </table>
 

 
 </div></td></tr></table></div>
 
 </div>
 
 <script>


function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>