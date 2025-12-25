
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Expenses</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("Create Expenses", array('controller' => 'OfficeExpenses', 'action' => 'add')); ?></li>
                                    <li class='plus'><?php echo $this->Html->link("Create Ledger Types", array('controller' => 'Ledgertypem', 'action' => 'index')); ?></li>
</ul></div>
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
                
        		                                <h1 class="bar_title small_h">Expenses :                                              
                                                
                                                <?php
												if ($sdate==$edate)
												{
													echo date('d-m-Y',strtotime($sdate));
												}
												else
												{
													echo $sdate." To ".$edate;
												}
												?>
                                                </h1>
                                                
  <div style="float:right;width:800px;height:50px !important;padding:2px;">      
											 <?= $this->Form->create($OfficeExpenses) ?> <span style="float:left;margin-top:10px;font-weight:700" >Search : &nbsp;&nbsp;</span>
                                              <?= $this->Form->input('sdate', array(
            'label'=>'From ',
			'id' => 'employ_date',
			'type'=>'text',
			'style'=>'margin-right:20px',
			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
			'style'=>'width:150px;margin-right:5px;'
        )); ?>
          <?= $this->Form->input('edate', array(
            'label'=>'To',
			'id' => 'birthday',
			'type'=>'text',

			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
			'style'=>'width:150px'
        )); ?>
         <?php 

      echo $this->Form->button('View Expense Vouchers', array('style'=>'float:right;margin-top:5px;'));
	  


  ?></div>
  
  
  
                                  
    


<div style="padding-bottom:30px;">






</div>


			 
<?php  $tabledata=$OfficeExpenses;include("index_detail.php"); ?>			

</div></td></tr></table></div>
