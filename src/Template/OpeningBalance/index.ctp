
<div class="dash_board">
    <table border="0" style="width:100%">
        <tr>
            <td style="width:250px;vertical-align:top">
                    <div class="dash_left">
                    <div class="box">         
                      <h1 class="bar_title small_h">Ledgers</h1>
                      <ul>
                        <li class='plus'><?php echo $this->Html->link("Create Ledgers Balance", array('controller' => 'OpeningBalance', 'action' => 'add')); ?></li>
                        <li class='plus'><?php echo $this->Html->link("Create Ledgers", array('controller' => 'Ledgers', 'action' => 'add')); ?></li>
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
            </td>
            <td style="vertical-align:top" align="left">
                <div class="dash_content">
                    <h1 class="bar_title small_h">Balance</h1>
                                        
                    <table class="table-bordered" style="text-align:center;">
                        <tr>
                            <td colspan="8" style="text-align:center;">
                            	<?php
								
								if (count($LDG_period)==0)
								{
									echo "<b style='color:red'>No Balance Entered Yet!!! </b>".$this->Html->link("  Create Ledgers Balance", array('controller' => 'OpeningBalance', 'action' => 'add'));

								}
								else
								{
									echo $this->Form->create($OpeningBalance);
		
		
		
									echo  $this->Form->input('LDG_BAL_PERIOD', array(
										'label'=>'Period',
										'options' => $LDG_period,
										'type'=>'select',
										'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
									)); 
									echo '<div style="clear:both"></div>';
						
									echo '<div class="button">';
										echo $this->Form->button('Show', array('class'=>'custom_submit'));
									echo '</div>'; 
									
									echo $this->Form->end();
								}
								?>
                            </td>
                        </tr>
                    	<tr>
                        	<td>Ledger Name</td>
                            <td>Balance Date</td>
                            <td>Balance Period</td>
                            <td>Balance DR</td>
                            <td>Balance CR</td>
                            <td>Action</td>
                        </tr>
						<?php
						$total_debit=0;
						$total_credit=0;
						
							foreach($OpeningBalance as $a):
						?>
                    	<tr>
                        	<td>
								<?php 
									echo $a->ledger->LDG_NAME;
								?>
                            </td>
                            <td>
								<?php 
									$b_date  = $a->LDG_BAL_DATE;
									$b_date = date_format($b_date, "d-m-Y");
									echo $b_date;
								?>
                            </td>
                            <td >
								<?php 
									echo $a->LDG_BAL_PERIOD;
								?>
                            </td>
                            <td style="text-align:right">
								<?php 
									echo number_format($a->LBL_BALANCE_DR,2);
								?>
                            </td>
                            <td style="text-align:right">
								<?php 
									echo number_format($a->LBL_BALANCE_CR,2)	;
									
									$total_debit=$total_debit+$a->LBL_BALANCE_DR;
									$total_credit=$total_credit+$a->LBL_BALANCE_CR;

								?>
                            </td>
                            <td>
                                <?php
									echo $this->Html->link('Edit',['action' => 'edit', '_full' => true, $a->LDG_BAL_ID])."&nbsp;|&nbsp;";
                                    echo $this->Html->link('Delete',[ 'action' => 'delete', '_full' => true, $a->LDG_BAL_ID]);
                                ?>
                            </td>
                        </tr>
						<?php
							endforeach;
						?>
						<tr>
                        	<td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align:right;font-weight:bold"><?php echo number_format($total_debit,2);  ?></td>
                            <td style="text-align:right;font-weight:bold"><?php echo number_format($total_credit,2);  ?></td>
                            <td></td>
                        </tr>

                    </table>

                    
                    
                </div>          
            </td>
        </tr>
    </table>
</div>
