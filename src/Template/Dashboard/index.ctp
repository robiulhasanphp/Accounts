<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Purchase</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("New Purchase", array('controller' => 'Purchase', 'action' => 'add')); ?></li>
                                  <li class='plus'> <?php echo $this->Html->link("Search your Voucher", array('controller' => 'Dashboard', 'action' => 'search')); ?></li>
                                   
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
                
                
                






 <h4 class="small_h">&nbsp;Todays Vouchers</h4>
                           <style>
						   td{
							   font-size:11px;
						   }
						   .total_bottom {
							   color:#030;
							   font-size:12px !important;
							   font-weight:bold;
						   }
    						</style>








<h5 style="color:#960">&nbsp;Journal Vouchers</h5>





		 
			 
         <?php
		 $ndelete=true;
$hasdata=false;
foreach($jurnal as $a) {
	$hasdata=true;
	break;
}
	
	
		 if ($hasdata==false)
		 {
			 echo "<h5 style='padding-left:150px;color:#ddc'>No Voucher Toaday</h5>";
		 }
		 else{
		 
		   $tabledata=$jurnal;
		  include("index_detail.php"); 
		 }
		 
		 
		 ?>			
			
                
<h5 style="color:#960">&nbsp;Purchase Vouchers</h5>
                                  
    







		 
			 
         <?php  
		 
		 $hasdata=false;
foreach($purchase as $a) {
	$hasdata=true;
	break;
}
	
	
		 if ($hasdata==false)
		 {
			 echo "<h5 style='padding-left:150px;color:#ddc'>No Voucher Toaday</h5>";
		 }
		 else{

		 $tabledata=$purchase;
		  include("index_detail.php"); }?>			
			




<h5 style="color:#960">&nbsp;Sales Vouchers</h5>
                                  
    






		 
			 
         <?php  $hasdata=false;
foreach($sales as $a) {
	$hasdata=true;
	break;
}
	
	
		 if ($hasdata==false)
		 {
			 echo "<h5 style='padding-left:150px;color:#ddc'>No Voucher Toaday</h5>";
		 }
		 else{$tabledata=$sales;
		  include("index_detail.php");} ?>			
			




<h5 style="color:#960">&nbsp;Payment Vouchers</h5>
                                  
    





		 
			 
         <?php
		 
		 
		 $hasdata=false;
foreach($paymeny as $a) {
	$hasdata=true;
	break;
}
	
	
		 if ($hasdata==false)
		 {
			 echo "<h5 style='padding-left:150px;color:#ddc'>No Voucher Toaday</h5>";
		 }
		 else{  $tabledata=$paymeny;
		  include("index_detail.php"); }?>			
			
            
            
            
<h5 style="color:#960">&nbsp;Reciept Vouchers</h5>
                                  
    




		 
			 
         <?php
		 
		  $hasdata=false;
foreach($receipt as $a) {
	$hasdata=true;
	break;
}
	
	
		 if ($hasdata==false)
		 {
			 echo "<h5 style='padding-left:150px;color:#ddc'>No Voucher Toaday</h5>";
		 }
		 else{   $tabledata=$receipt;
		  include("index_detail.php"); }?>			
			
            
            
                      

                  
          <h5 style="color:#960">&nbsp;Expense Vouchers</h5>
          
                       



		 
			 
         <?php
		 		  $hasdata=false;
foreach($receipt as $a) {
	$hasdata=true;
	break;
}
	
	
		 if ($hasdata==false)
		 {
			 echo "<h5 style='padding-left:150px;color:#ddc'>No Voucher Toaday</h5>";
		 }
		 else{  $tabledata=$type_expense;
		  include("index_detail.php"); }?>			
						
			

        </div></td></tr></table></div>