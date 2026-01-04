

<!-- src/Template/Users/add.ctp -->


<div class="add_box_2">
<?= $this->Form->create($vouchers) ?>
    <fieldset>
        <legend><?= __('Add purchase') ?></legend>
    
	
		   <div class="newbox">   
                      <div class="custom_input2">
                  
                          <?=$this->Form->input('VCH_PROJECT',               
                        [   
             
                        'options' => $department,
                        'type'=>'select',
                        'class'=>'dd',
                        'label'	=> 'Department',
            
                    ]);   
                    ?>
                     
                   </div>
   
               <div class="custom_input3">
                            
                 
                    
                    
                          
                        <?=$this->Form->input('VCH_DEPARTMENT',               
                            [   
                            'class'=>'dd',
                            'label'    => 'Project',
                            'options' => $project,
                            'type'=>'select'
                            
                            
                                    
                        ]);   
                        ?>
                    
               </div>
	</div> 




 


<div id="date">      

		<?=$this->Form->input('
		
		
		',               
            [   
          	'id' => 'birthday',
			'type'=>'text',
			'class'=>'dd',
			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
            'label'   => 'Purchase Date',
			
                    
        ]);   
        ?>
        
</div>
        
        
        <?=$this->Form->input('VCH_CR_ACCOUNTS',               
            [   
          	 'class'=>'dd',
             'label'    => 'Purchase from',
             'options' => $purchase,
             'type'=>'select'
                    
        ]);   
        ?>
        
        <?=$this->Form->input('VCH_DR_ACCOUNTS',               
            [   
          	'class'=>'dd',
             'label'    => 'Item',
             'options' =>$item,
             'type'=>'select'
			
                    
        ]);   
        ?>
        
        
        
		   <div class="newbox">   
                  <div class="custom_input2">
                    
                
                    
                           <?=$this->Form->input('INVDATE',               
                        [   
             
                        'id' => 'employ_date',
						'type'=>'text',
						'class'=>'dd',
						'dateFormat' => 'YMD',
						'minYear' => date('Y') - 80,
						'maxYear' => date('Y') - 18,
						'label'   => 'Date',
						
            
                    ]);   
                    ?>
                    
                    
               </div>
               
               <div class="custom_input3">
                            
                    <?=$this->Form->input('VCH_INV_NO',               
                        [   
                        'class'=>'dd',
                        'type'     => 'text',
                        'label'    => 'Invoice/bill no'
                        
                                
                    ]);   
                    ?>
                    
                    
               </div>
</div>        




		  <div class="newbox">  
                  <div class="custom_input2">
               
                    
                            <?=$this->Form->input('CHALLANDATE',               
                            [   
                 
									   'id' => 'chalan_date',
										'type'=>'text',
										'class'=>'dd',
										'dateFormat' => 'YMD',
										'minYear' => date('Y') - 80,
										'maxYear' => date('Y') - 18,
										'label'   => 'Date',
							
                
                        ]);   

                        ?>
                        
                    
                    
               </div>
   
                   <div class="custom_input3">
                                
                
                             
                    <?=$this->Form->input('VCH_CHALLAN_NO',               
                        [   
                        'class'=>'dd',
                        'type'     => 'text',
                        'label'    => 'chalan no'
                        
                                
                    ]);   
                    ?>
                    
                   </div>
</div> 




		<?=$this->Form->input('VCH_AMOUNT',               
            [   
 
            'type'     => 'text',
			'class'=>'dd',
			'label'	=> 'Purchase Amount',

        ]);   
        ?>
        
        
        
        		<?=$this->Form->input('VCH_NARRATION',               
            [   
 
            'type'     => 'text',
			'class'=>'dd',
			'label'	=> 'Remarks',

        ]);   
        ?> 
        
        
        
        
        
        
		
   </fieldset>
   
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Submit', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
   
   
   
<?= $this->Form->end() ?>

<script>
		  $('#trd_item').css('display','none');
		    var arrChkBox = document.getElementsByName("LDG_rso");
       
 $(arrChkBox).click(function()
{
	

		  $('#trd_item').css('display','none');
var vl=$(this).val();


	 if(vl=='INV;3')
	  {
		  $('#trd_item').css('display','block');
	  }	
	 

});


</script>
</div>