<div class="dash_board">
            <table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
            	<div class="dash_left">
                                                 <div class="box">         
                                <h1 class="bar_title small_h">Sales</h1>
                                <ul>
                                  <li class='plus'><?php echo $this->Html->link("New Sales", array('controller' => 'Sales', 'action' => 'add')); ?></li>
                                   
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
                
        		                                <h1 class="bar_title small_h">Sales List</h1>
                                  
    


<div style="padding-bottom:30px;">






</div>




         <?php  $tabledata=$Sales;
		  include("index_detail.php"); ?>			



</div></td></tr></table></div>