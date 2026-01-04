<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;">Employee 

salary</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Select Employee",
array('controller' => 'Employeesalary', 'action' => 

'EmployeeSelect')); 


$sal_data=array();

?></h5>


</div>

<div class="add_box_2">


							
<table class="table-bordered" style="text-align:center">
    	<tr align="center">
                <td>Ldg code </td>
                <td>Employee name</td>
                
                      <?php foreach($name as $b):?>
                      
                     <td><?php echo($b["BAS_NAME"]);
					 $sal_data[]=$b["BAS_ID"];
					 
					 ?></td>
                     
                     <?php endforeach;?>
              
          </tr>
        
    
        
        
         <?php 
	
		 foreach($emp_name as $a):
		 
		 ?>
         
            <tr>
         
                  <td><?php echo $a->LDG_CODE;?></td>    
                 
                    <td><?php echo $a->LDG_NAME;?></td>
                    
                   
                   <?php  
				   $isFound=0;
				   $sal_amt=0;
				   for($r=0;$r<count($sal_data);$r++)
					{
		
										  $isFound=0;
										  $sal_amt=0;
							foreach($a->employeesalary as $sal):
							if($sal->EMS_SALARY==$sal_data[$r])
							{
								$sal_amt=$sal->EMS_AMOUNT;
								  $isFound=1;
								break;
							}
							
							endforeach;
							
							if($isFound==1)
							{
								echo "<td>".$sal_amt."</td>";
							}
							else
							{
								echo "<td></td>";
							}
								
						
					}
					
				
					?>
                    </tr>

                      
       <?php endforeach;?>
         
		    </table>

</fieldset>



<!-- src/Template/Users/add.ctp -->


<div class="add_box_2">
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add purchase') ?></legend>
    
	
		   <div class="newbox">   
                      <div class="custom_input2">
                  
                          <?=$this->Form->input('VCH_PROJECT',               
                        [   
            
                        'class'=>'dd',
                        'label'	=> 'Total Salary',
            			'value'=>$monthly_salary  
                    ]);   
                    ?>
                     
                   </div>
   
               <div class="custom_input3">
                            
                 <?=$this->Form->input('pdate',               
            [   
          	'id' => 'date-picker',
			'type'=>'text',
			'class'=>'dd',
			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
            'label'   => 'Month',
			
                    
        ]);   
        ?>
        
                    
               </div>
	</div> 

 </fieldset>
   
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Submit', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
   
   
   
<?= $this->Form->end() ?>


</div> 