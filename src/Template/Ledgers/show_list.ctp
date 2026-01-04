
        	<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title">Ledgers</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("Create Ledgers", array('controller' => 'Ledgers', 'action' => 'add')); ?></li>
                                    <li class='plus'><?php echo $this->Html->link("Create Ledger Types", array('controller' => 'Ledgertypem', 'action' => 'index')); ?></li>
</ul></div>
                                 <div class="box">         
                                <h1 class="bar_title">List</h1>
                                     
                                    <?php include('ledger_menu.php');?> 
                                     
                                </div>

        		</div>
                </td><td style="vertical-align:top" align="left">
                <div class="dash_content">
                
        		<h1 class="bar_title">Ledgers</h1>
                                  
    


<div style="padding-bottom:30px;">






</div>



<?php include('ledger_list.php');?>






</div></td></tr></table></div>
