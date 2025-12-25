<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$cakeDescription = 'mAcc : Fianncial Accounting System';




						
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    
    
<!--...start custom links....................................................................-->
    
	<?php 
        echo $this->Html->script('jquery-1.11.2.min.js');
        echo $this->Html->script('menu_script.js');
        echo $this->Html->script('jquery-ui.js'); 
    ?>
    
    
    
    
    
    <?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		

	
//		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	
		
	?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    <script>
		$(function() {
			$( "#birthday" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange:'-90:+0',
				dateFormat: 'dd-mm-yy'
			});
		});
		$(function() {
			$( "#employ_date" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange:'-90:+0',
				dateFormat: 'dd-mm-yy'
			});
		});
		$(function() {
			$( "#chalan_date" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange:'-90:+0',
				dateFormat: 'dd-mm-yy'
			});
		});		
	</script>
	<?php
		
		echo $this->Html->css('main');
		echo $this->Html->css('styles');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('jquery_ui');
		
	?>
    
    

    
    
    
<!--...start custom links....................................................................-->
    
</head>
<body class="home">
<?php 
$valid_user=0;					

$usr=$this->Session->read('Auth.User')                        ;
if (count($usr)>0){

$valid_user=$usr['USR_ID'];
}?>

		<div id="header">
        	<div class="container">
            	<div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 logo">
                        <?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => $cakeDescription, 'border' => '0',)),array('controller'=>'','action'=>'index'),array('escape' => false)); ?>
                    <div style="float:right;padding:5px;color:#0F9;font-size:14px"> <?php //echo $valid_user;
					 if ($valid_user>0)
					
					{
					echo "Welcome ".$usr['username']."    | ";
					 echo $this->Html->link(" Logout", array('controller' => 'users', 'action' => 'logout'));  }?></div>                        
                    </div>
                    </div></div>
		<div id="header">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header_menu" style="background:#063;color:#FFF;">
                                            <?php //if ($valid_user>0){ ?>
                        <div id='cssmenu'>

                            <ul>
                            
                               <li><?php echo $this->Html->link("Home",array('controller'=>'dashboard','action'=>'index'));?></li>
                               
                                <!--admin menu-->
                               <li class='last has-sub'><?php echo $this->Html->link("Vouchers", array('controller' => 'dashboard', 'action' => 'index')); ?>                    
                               		<ul>
                                     <li class=''><?php echo $this->Html->link("Journal Voucher", array('controller' => 'Journal', 'action' => 'index')); ?></li>
                                     
                                     <li class=''  style="height:2px !important;max-height:2px;border:1px solid #093"><a >&nbsp;</a></li>
                                     <li class=''><?php echo $this->Html->link("Purchase", array('controller' => 'Purchase', 'action' => 'index')); ?></li>
                                     
                                     <li class=''><?php echo $this->Html->link("Sales", array('controller' => 'Sales', 'action' => 'index')); ?></li>
                                     <li class=''  style="height:2px !important;max-height:2px;border:1px solid #093"><a >&nbsp;</a></li>
                                     <li class=''><?php echo $this->Html->link("Payment", array('controller' => 'Payment', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Receive", array('controller' => 'Recieve', 'action' => 'index')); ?></li>
                                     <li class=''  style="height:2px !important;max-height:2px;border:1px solid #093"><a >&nbsp;</a></li>
                                     
                                       <li class=''><?php echo $this->Html->link("Bank Transactions", array('controller' => 'BankTrans', 'action' => 'index')); ?></li>
                               <li class=''  style="height:2px !important;max-height:2px;border:1px solid #093"><a >&nbsp;</a></li>
							<!--  <li class=''><?php echo $this->Html->link("Salary", array('controller' => 'Salary', 'action' => 'index')); ?></li>-->

                                     <li class=''><?php echo $this->Html->link("Expenses", array('controller' => 'OfficeExpenses', 'action' => 'index')); ?></li>
                                  	</ul>
                               </li>
								<!--End admin menu-->
                              <li class='last has-sub'><?php echo $this->Html->link("Ledgers", array('controller' => 'Ledgers', 'action' => 'index')); ?>                    
                               		<ul>
                                     <li class=''><?php echo $this->Html->link("Create Ledgers", array('controller' => 'Ledgers', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("View Ledger", array('controller' => 'Ledgerbalance', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Ledger Balance Entry", array('controller' => 'OpeningBalance', 'action' => 'index')); ?></li>

                                     
                                     
                                     
                                     
                                     <li class=''><?php echo $this->Html->link("Supplier List", array('controller' => 'Ledgers', 'action' => 'ShowList', 'SUP')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Customer List", array('controller' => 'Ledgers', 'action' => 'ShowList', 'CST')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Employee List", array('controller' => 'Ledgers', 'action' => 'ShowList', 'EMP')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Bank List", array('controller' => 'Ledgers', 'action' => 'ShowList', 'BNK')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Inventory List", array('controller' => 'Ledgers', 'action' => 'ShowList', 'INV')); ?></li>



                                     <!--<li class=''><?php //echo $this->Html->link("Supplier List", array('controller' => '', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Customer List", array('controller' => '', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("A/C Recievables", array('controller' => '', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("A/C Payables", array('controller' => '', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Bank Books", array('controller' => '', 'action' => 'index')); ?></li>
                                     <li class=''><?php //echo $this->Html->link("Cash Books", array('controller' => '', 'action' => 'index')); ?></li>-->







                                     </ul>
                                     
                                     </li>
<li class='last has-sub' > <a href="#">                  Summery</a>
                               		<ul>
                                     
                                     <li class=''><?php echo $this->Html->link("Cash Summery", array('controller' => 'VoucherDateSum', 'action' => 'index')); ?></li>
                                  	</ul>
                               </li>
                               <!--admin menu-->
                               <li class='last has-sub'><?php echo $this->Html->link("Basic Data", array('controller' => 'BasicData', 'action' => 'index')); ?>                    
                               		<ul>
                                     <li class=''><?php echo $this->Html->link("Projects", array('controller' => 'Project', 'action' => 'index')); ?></li>
                                     
                                     <li class=''><?php echo $this->Html->link("Designations", array('controller' => 'Designation', 'action' => 'index')); ?></li>
                                     <li class=''><?php echo $this->Html->link("Departments", array('controller' => 'Department', 'action' => 'index')); ?></li>

                                     <!--<li class=''><?php //echo $this->Html->link("Salary & Allowances", array('controller' => 'Allowance', 'action' => 'index')); ?></li>-->
                                     <li class=''  style="height:2px !important;max-height:2px;border:1px solid #093"><a >&nbsp;</a></li>
                                     
                                     <li class=''><?php echo $this->Html->link("Voucher Type", array('controller' => 'Vouchertype', 'action' => 'index')); ?></li>

                                     <li class=''><?php echo $this->Html->link("Ledger Type", array('controller' => 'Ledgertypem', 'action' => 'index')); ?></li>
                                  	</ul>
                               </li>
								<!--End admin menu-->
                                
                               <!--admin menu-->
                               <li class='last has-sub' style="border-right:1px solid #030"><?php echo $this->Html->link("Admin", array('controller' => 'Admin', 'action' => 'index')); ?>                    
                               		<ul>
                                     
                                     <li class=''><?php echo $this->Html->link("Company", array('controller' => 'CompanyRoot', 'action' => 'index')); ?></li>
                                      <!--<li class=''><?php //echo $this->Html->link("User Groups", array('controller' => 'Usergroup', 'action' => 'index')); ?></li>-->
                                       <li class=''  style="height:2px !important;max-height:2px;border:1px solid #093"><a >&nbsp;</a></li>
                                       <li class=''><?php echo $this->Html->link("Users", array('controller' => 'Users', 'action' => 'index')); ?></li>
                                       <li class=''><?php echo $this->Html->link("Change Password", array('controller' => 'Users', 'action' => 'change_pass',$usr['USR_ID'])); ?></li>
                                  	</ul>
                               </li>
								<!--End admin menu-->
                               
							</ul>
							
						</div>	

                        </div>
                        							<?php //}?>
                    </div>
                </div>
            </div>
		</div>

	<div style="width:100%"></div>

    <div id="content" style="min-height:550px;">
    
    <div style="width:100%;height:50px;clear:both">&nbsp;</div>
    <!--start the content-->
	
    
                        
                        
										<?php echo $this->fetch('content'); ?>
                                        
                            
    
    </div><!--end the content-->
    
<div style="clear:both;"></div>    
<!--...end the content....................................................................-->
       <div id="footer" style="margin-top:50px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer_left">
                        <p>Miguns Group © All Rights Reserved 2015</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer_right">
                        <p>Powered By : <a href="#">Software Wing, Miguns Technologies</a></p>
                    </div>
                </div>
            </div>
        </div> 
<!--...end the footer....................................................................-->
	
	
<?php //echo $this->Html->script('bootstrap.min'); ?>

</body>
</html>
