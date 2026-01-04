
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                <div class="box">         
                    <h1 class="bar_title small_h">Bank Transaction</h1>
                    <ul>
                      <li class='plus'>
					  	<?php echo $this->Html->link("Create Deposit ", array('controller' => 'BankTrans', 'action' => 'add_dep')); ?>
                      </li>
                      <li class='plus'>
					  	<?php echo $this->Html->link("Create Withdraw", array('controller' => 'BankTrans', 'action' => 'add_with')); ?>
                      </li>
                    </ul>
                </div>
                </td>
                <td style="vertical-align:top" align="left">
                    <div class="dash_content">
                        <h1 class="bar_title small_h">Bank Transaction
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
                        <div style="padding-bottom:30px;">
                        

 <div style="float:right;width:800px;height:50px !important;padding:2px;">      
											 <?= $this->Form->create($BankTrans) ?> <span style="float:left;margin-top:10px;font-weight:700" >Search : &nbsp;&nbsp;</span>
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

      echo $this->Form->button('View Bank Transactions', array('style'=>'float:right;margin-top:5px;'));
	  


  ?></div>
</div>
                        
                        
                        
                        
<!--<table class="table-bordered" style="text-align:center">
    <tr align="center">
    <td>Date</td>
    <td>Voucher No</td>
    <td>Ledgers</td>
    <td>Description</td>
    <td>Cash Deposit</td>
    <td>Cash Withdraw</td>
    <td></td>
    <td>Action</td>
    </tr>
    		
    
    <?php
    //var_dump($CompanyRoot);
    foreach($BankTrans as $a){?>
        <tr align="center">
            <td>
                <?php
                    $date=$a->VCH_DATE;
                    echo $date->format('d-m-Y');
                ?>
            </td>
            
            <td><?php  echo $a->VCH_NO_FULL; ?> </td>
            <td align="left"><?php echo $a->VCH_FULL_DESCRIPTION?></td>
            <td align="left"><?php echo $a->VCH_FULL_DESCRIPTION?></td>
            
            <td align="right">
				<?php

					if(($a->VCH_CR_ACCOUNTS)==ACC_CASH){
						
            			echo number_format($a->VCH_AMOUNT,2);
					}
				?>
            </td>
            
            <td align="right">
				<?php
				//echo $a->VCH_CR_ACCOUNTS.' '.$a->VCH_DR_ACCOUNTS;
					if(($a->VCH_DR_ACCOUNTS)==ACC_CASH){
            			echo number_format($a->VCH_AMOUNT,2);
					}
				?>
            </td>
            <td align="right">
				<?php
					if(($a->VCH_DR_ACCOUNTS!=ACC_CASH) && ($a->VCH_CR_ACCOUNTS!=ACC_CASH)){
            			echo number_format($a->VCH_AMOUNT,2);
					}
				?>
            </td>
            
            
            <td align="center">
                <?php 
					if(($a->VCH_DR_ACCOUNTS)==ACC_CASH){
						echo  $this->Html->link('Edit',array ('action' => 'edit_with', $a->VCH_ID));
					}
					else if(($a->VCH_CR_ACCOUNTS)==ACC_CASH){
						echo  $this->Html->link('Edit',array ('controller' => 'BankTrans', 'action' => 'edit_dep', $a->VCH_ID));
					}
					else if(($a->VCH_DR_ACCOUNTS!=ACC_CASH) && ($a->VCH_CR_ACCOUNTS!=ACC_CASH)){
						echo  $this->Html->link('Edit',array ('controller' => 'BankTrans', 'action' => 'edit_dep', $a->VCH_ID));
					}
				?> &nbsp;|
                <?= $this->Html->link('Delete',array ('action' => 'delete', $a->VCH_ID)); ?>
            </td>
        </tr> 
    <?php }?>
</table>        -->                
                        
                        
                        
                        
							<?php
                                $tabledata=$BankTrans;
                                include("index_detail.php");
                            ?>
                        </div>
                    </div>
                 </td>
             </tr>
        </table>
   	</div>