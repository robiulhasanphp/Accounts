
<div class="dash_board">
    <table border="0" style="width:100%">
        <tr>
            <td style="vertical-align:top" align="left">
                <div class="dash_content">
                    <h1 class="bar_title small_h">Balance</h1>
                                        
                    <table class="table-bordered" style="text-align:center;">
                         <?php foreach ($Ledgerendbalance as $a): ?>
                    	<tr>
                        	<td>
								<?php
									//var_dump($a);
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
                            <td>
								<?php 
									echo $a->LDG_BAL_PERIOD;
								?>
                            </td>
                            <td>
								<?php 
									echo $a->LDG_BALANCE_DR;
								?>
                            </td>
                            <td>
								<?php 
									echo $a->LDG_BALANCE_CR	;
								?>
                            </td>
                            <td>
                                <?php
									echo $this->Html->link('Edit',['controller' => 'Ledgerendbalance', 'action' => 'edit', '_full' => true, $a->LDG_BAL_ID])."&nbsp;|&nbsp;";
                                    echo $this->Html->link('Delete',['controller' => 'Ledgerendbalance', 'action' => 'delete', '_full' => true, $a->LDG_BAL_ID]);
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

                    
                    
                </div>          
            </td>
        </tr>
    </table>
</div>
