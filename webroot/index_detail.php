<style>
</style>
<table class="table-bordered" style="font-size:10px" >
    <tr align="center">
          	<th style="width:100px">Date</th>
          	<th style="width:100px;">Voucher No</th>
            <th style="width:250px;max-width:250px">
            <?php
			
			$VCH_TYPE=VCH_TYPE_EXPENSE;
			
			
			foreach($tabledata as $a){
				$VCH_TYPE=$a->VCH_TYPE;
				break;
			}
//echo $VCH_TYPE;
			switch($VCH_TYPE)
			{
				case VCH_TYPE_JOURNAL:echo "Accounts";break;
				case VCH_TYPE_SALES:echo "Sales To";break;
				case VCH_TYPE_PURCHASE:echo "Purchase From";break;
				case VCH_TYPE_PAYMENT:echo "Paid To";break;
				case VCH_TYPE_RECIEPT:echo "Recieve From"; break;
				case VCH_TYPE_EXPENSE:echo "Description";break;
				case VCH_TYPE_BANK:echo "Bank";	
				break;
			
			}
			?>
            
            </th>

            <th style="width:300px;max-width:300px">Narration</th>
<?php if (	$VCH_TYPE==VCH_TYPE_BANK) { ?>
<th style="width:100px;max-width:120px">Deposit</th>
<th style="width:100px;max-width:120px">Widthdraw</th>
<?php } else { ?>
			<th style="width:120px;max-width:150px">Amount</th>
            <?php }?>

         
            <th>Action</th>
			<th>Status</th>
          </tr>
        
        
          <?php
		  //var_dump($CompanyRoot);
		  $total=0;
		  $total_dep=0;
		  $total_with=0;		  
		  foreach($tabledata as $a) {
			$ACC_TO='';
			$dep_amt=0;
			$with_amt=0;			
			  switch($VCH_TYPE)
			{
				case VCH_TYPE_JOURNAL:$ACC_TO='';break;
				case VCH_TYPE_SALES:$ACC_TO=$a->ACC_DR_NAME;break;
				case VCH_TYPE_PURCHASE:$ACC_TO=$a->ACC_CR_NAME;break;
				case VCH_TYPE_PAYMENT:$ACC_TO=$a->ACC_DR_NAME;break;
				case VCH_TYPE_RECIEPT:$ACC_TO=$a->ACC_CR_NAME; break;
				case VCH_TYPE_EXPENSE:$ACC_TO=$a->ACC_DR_NAME;break;
				case VCH_TYPE_BANK:
				if ($a->VCH_DR_ACCOUNTS==ACC_CASH){
					$ACC_TO=$a->ACC_CR_NAME;
					$with_amt=$a->VCH_AMOUNT;
				}
				else
				{
						$ACC_TO=$a->ACC_DR_NAME;
						$dep_amt=$a->VCH_AMOUNT;
				}
				break;
			
			}
			  
			  ?>
         <tr >
             <?php if(!isset($ndelete)){
				 $ndelete=false;
			 }?>
              <td><?php
			  $nedit=false;
			  		 if(isset($no_edit))
					 {
						 $nedit=$no_edit;
					 }
				$date=$a->VCH_DATE;
			    echo $date->format('d-m-Y');?></td>
			 
              <td><?php  echo  $a->VCH_NO_FULL; ?> </td>

              <td align="left"><?php echo strtoupper( $ACC_TO)?></td>
                            <td align="left"><?php echo strtoupper($a->VCH_NARRATION)?></td>








<?php if (	$VCH_TYPE==VCH_TYPE_BANK) { ?>
<td style="text-align:right"><?php echo number_format($dep_amt,2);

$total_dep=$total_dep+$dep_amt;?></td>
<td style="text-align:right"><?php echo number_format($with_amt,2);

$total_with=$total_with+$with_amt;?></td>
<?php } else { ?>

<td style="text-align:right"><?php echo number_format($a->VCH_AMOUNT,2);

$total=$total+$a->VCH_AMOUNT;
?></td>
<?php }

 ?>
            
              
                   <td align="center">
                   <?php 
				   
//				   if($a->VCH_CREATE_BY!=$user_id){$nedit=true;}
				   if(($a->VCH_STATUS!=STS_SENT) && ($a->VCH_STATUS!=STS_APPROVED) && ($a->VCH_STATUS!=STS_DELETED))
				   {
				   
				   
				   		if ($VCH_TYPE==VCH_TYPE_BANK) { if($dep_amt>0){?>
                   
               <?php if($nedit==false) {echo $this->Html->link('Edit',array ('action' => 'edit_dep', $a->VCH_ID)); }
				   }
				   else
				   {
						if($nedit==false) {echo $this->Html->link('Edit',array ('action' => 'edit_with', $a->VCH_ID)); }}
                    }else{ ?>
               <?php if($nedit==false) {echo $this->Html->link('Edit',array ('action' => 'edit', $a->VCH_ID)); }} ?> 
               
               
               
               &nbsp;|
               
               
       <?php if($ndelete==true) { echo '';} else {echo $this->Html->link('Delete',array ('action' => 'delete', $a->VCH_ID));} ?> 
         <?php }?></td><td style="text-align:center">
 <?php 
 	if($nedit==false) 
 	{
	 
	  if(($a->VCH_STATUS==STS_APPROVED))
	   	{
	  	 	echo "<span style='color:green'>APPROVED</span>";
		}
		else	if (($a->VCH_STATUS==STS_DENIED))
		{
			echo "<span style='color:red'>DENIED</span>";
		}
		else
		{

			if(($a->VCH_STATUS==STS_SENT) && ($a->VCH_STATUS_BY==$user_id))
			{
				
				echo " <span style='color:green'>Waiting for Approval</span>";
	  		}
			elseif(($a->VCH_STATUS==STS_SENT) && ($a->VCH_STATUS_TO==$user_id))
			{
				echo $this->Html->link('View',array ('action' => 'Approve','controller'=>'VoucherAction', $a->VCH_ID));  
				echo '&nbsp;|&nbsp;';
			}
		 	else{
					echo $this->Html->link('Send',array ('action' => 'SendForApproval','controller'=>'VoucherAction', $a->VCH_ID));  
					echo '&nbsp;|&nbsp;';

/*					if($a->VCH_CREATE_BY==$user_id)
					{
					}*/
					
		 	}
			echo $this->Html->link('Approve',array ('action' => 'ApproveSelf','controller'=>'VoucherAction', $a->VCH_ID));  
		}
 		
		
		
		}

?>
             	 </td>
          </tr> 
          <?php }?>
          
          
          
          
          
          <tr class="total_bottom"><th  class="total_bottom" colspan="5" style="text-align:right"><b>Total</b> : &nbsp;&nbsp;
		  
		  <?php if (	$VCH_TYPE==VCH_TYPE_BANK) {
			  echo number_format($total_dep,2)."</th><th style='text-align:right'>".number_format($total_with,2);
		  }
		  else
		  {
			   echo number_format($total,2);}?></th>
               <th></th></tr>
</table>
