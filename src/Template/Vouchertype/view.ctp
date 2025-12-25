<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> User group List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Vouchertype",
array('controller' => 'Vouchertype', 'action' => 'add')); ?></h5>


</div>
	<div class="scroll">

        
        <table class="table-bordered">
          <tr>
          <td>Voucher Code</td>
          	<td>Voucher Name</td>
            <td>Description</td>
        
    
       
		
         <tr align="center">
      
          
          <td><?php echo $Vouchertype->BAS_CODE?></td>
          <td><?php echo $Vouchertype->BAS_NAME?></td>
          <td><?php echo $Vouchertype->BAS_DESCRIPTION?></td>
         
      
              
             </td>
          </tr> 
			
		