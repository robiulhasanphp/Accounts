
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                <div class="box">         
                    <h1 class="bar_title small_h">Cash Withdraw From Bank</h1>
                    <ul>
                      <li class='plus'>
					  	<?php echo $this->Html->link("Create Cash Withdraw", array('controller' => 'CashWithdraw', 'action' => 'add')); ?>
                      </li>
                    </ul>
                </div>
                </td>
                <td style="vertical-align:top" align="left">
                    <div class="dash_content">
                        <h1 class="bar_title small_h">Cash Withdraw From Bank</h1>
                        <div style="padding-bottom:30px;"></div>
							<?php
                                $tabledata=$CashWithdraw;
                                include("index_detail.php"); 
                            ?>
                        </div>
                    </div>
                 </td>
             </tr>
        </table>
   	</div>