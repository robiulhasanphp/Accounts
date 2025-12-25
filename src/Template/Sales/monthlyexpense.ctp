
<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;">Search Your Monthly Expenses</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new employee",
array('controller' => 'employee', 'action' => 'add')); ?></h5>



</div>
   
   <?php                 
$monthname = array('1' => 'JAN', '2' => 'FEB','3' => 'MARCH', '4' => 'APril', '5' => 'MAY', 
'6' => 'JUN','7' => 'JULY', '8' => 'AUG', '9' => 'SEP', '10' => 'OCT', '11' => 'NOV','12' => 'DEC');
$this->set(compact('monthname')); 


$year = array('2010' => '2010', '2011' => '2011','2012' => '2012', '2013' => '2013', '2014' => '2014', 
'2015' => '2015','2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020','2021' => '2021');
$this->set(compact('year')); 


?>
   
                               
<div style="padding:5px;width:100%;float:left">
			<?= $this->Form->create() ?>


		
   <div style="padding-left:250px;">
   
   
   
   
     <?= $this->Form->input('month_name', array(
            'label'=>'Month',
			'options' => $monthname,
			'type'=>'select',
			'style'=>'border:1px solid #ccc;width:100px;'
        )); ?>
        
        
        
           <?= $this->Form->input('year', array(
            'label'=>'year',
			'options' => $year,
			'type'=>'select',
			'style'=>'border:1px solid #ccc;width:100px;'
        )); ?>
        
      
        
       
  <?=$this->Form->button('Show', array('class'=>'custom_submit','style'=>'float:left;'));  ?>
  <?= $this->Form->end() ?>   
</div>



  <?php
  if (isset ($PAYMENT))
  {
  ?>              


	
            <table class="table-bordered">
            <tr>
            <td>Payment/Expense</td>
            <td>Receive</td>
            </tr>
            
            
                      <tr>
                                 <td  style="vertical-align:top">
                                      <table class="table-bordered">
                                     
                                             <tr>
                                                <td>
                                                <table class="table-bordered">
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>Narattion</td>
                                                            <td>Amount</td>
                                                           
                                                        </tr>
                                                        
                                                        
                                                        <?php foreach($PAYMENT as $a):
														
														$date=$a->VCH_DATE;
														
														?>
                                                         <tr>
                                                             <td><?php echo $date->format('d-m-Y');?></td>
                                                              <td><?php echo $a->VCH_NARRATION;?></td>
                                                             <td><?php echo $a->VCH_AMOUNT?></td>
                                            
                                                        </tr>
                                                        <?php endforeach;?>
                                                        
                                                        <tr>
                                                       <th align="right" colspan="3"><p align="right" style="color:#00C">Total: <?php echo $payment_ex?></th>
                                                        
                                                        </tr>       
                                                    
                                                </table>
                                                </td>
                                            </tr>
                                     
                                     </table>
                                </td>
                            
                                 <td  style="vertical-align:top">
                                        <table class="table-bordered" >
                                 
                                                 <tr>
                                                    <td>
                                                            <table class="table-bordered">
                                                                    <tr>
                                                                       <td>Date</td>
                                                                        <td>Narattion</td>
                                                                        <td>Amount</td>
                                                                    </tr>
                                                                    
                                                                    
                                                                    <?php foreach($receive as $b):
                                                                    $date=$b->VCH_DATE;
                                                                    ?>
                                                                     <tr>
                                                                         <td><?php echo $date->format('d-m-Y');?></td>
                                                                          <td><?php echo $b->VCH_NARRATION;?></td>
                                                                         <td><?php echo $b->VCH_AMOUNT?></td>
                                                                    </tr>
                                                                    <?php endforeach;?>   
                                                                    
                                                                    
                                                                     <tr>
                                                        <th align="right" colspan="3"><p align="right" style="color:#00C">Total: <?php echo $receive_Amount?></p></th>
                                                        
                                                        			</tr>     
                                                                
                                                            </table>
                                                    </td>
                                                </tr>
                                        </table>
                                </td>
                            
                      </tr>
          </table>
<?php
  }
  ?>
       
          </div>
    </div>
        
