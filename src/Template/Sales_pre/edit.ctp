<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title">  Edit Sales </h4>
<div style="clear:both;"></div>



<div style="border:1px solid #ccc;margin:auto;padding-left:10px;">
<?= $this->Form->create($Sales) ?>

       
    
	

                     
                  <div class="proj_dep">
                         <?=$this->Form->input('VCH_PROJECT',               
                        [   
             
                        'options' => $department,
                        'type'=>'select',
                        'class'=>'dd',
                        'label'	=> 'Department',
            
                    ]);   
                    ?>
					
					
					
					
						   
                        <?=$this->Form->input('VCH_DEPARTMENT',               
                            [   
                            'class'=>'dd',
                            'label'    => 'Project',
                            'options' => $project,
                            'type'=>'select'
                            
                            
                                    
                        ]);   
                        ?>
   

                            
                 
                    
                    
                          
                       

</div>
<div class="h_border"></div>

 
  <div class="proj_dep">

<div id="date">      

		<?=$this->Form->input('pdate',               
            [   
          	'id' => 'birthday',
			'type'=>'text',
			'class'=>'dd',
			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
            'label'   => 'Sale Date',
			
                    
        ]);   
        ?>
        
</div>
        
  </div>      
          <div class="proj_dep" >  
		   <?=$this->Form->input('VCH_CR_ACCOUNTS',               
            [   
          	 'class'=>'dd',
             'label'    => 'Customer',
             'options' =>$sale_to ,
             'type'=>'select'
                    
        ]);   
        ?>

		</div>
          
		  <div class="proj_dep">           <div style="width:700px;"?>  
         <?=$this->Form->input('VCH_DR_ACCOUNTS',               
            [   
          	'class'=>'dd',
             'label'    => 'Item',
             'options' =>$item,
             'type'=>'select'
			
                    
        ]);   
        ?>
        </div>
        </div>
        <div class="h_border"></div>
		  
		          <div class="proj_dep">            
                  
                  
                    
                       <?=$this->Form->input('VCH_INV_NO',               
                        [   
             
                        'class'=>'dd',
                        'type'     => 'text',
                        'label'    => 'Invoice/bill no'
						
            
                    ]);   
                    ?>
                         
                 
					
					
					
					
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






		          <div class="proj_dep">            
				                       <?=$this->Form->input('VCH_CHALLAN_NO',               
                            [   
                 
								 'class'=>'dd',
                        'type'     => 'text',
                        'label'    => 'chalan no'
                        
                
                        ]);   
                        ?>
                        

               
                
                        
                    
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
			           
   

                                
                
                             


		          <div class="proj_dep" style="background:#DBEAF9;height:auto;border:1px solid #ccc;">         <div style="width:500px;margin:auto;float:none">

		<?=$this->Form->input('VCH_AMOUNT',               
            [   
 
            'type'     => 'text',
			'class'=>'dd',
			'label'	=> 'Sale Amount',

        ]);   
        ?>
        
        </div>
		</div>
		<div>

   <div class="proj_dep"> 
        		
        		<?=$this->Form->input('VCH_NARRATION',               
            [   
 
            'type'     => 'text',
			'class'=>'dd',
			'label'	=> 'Remarks',

        ]);   
        ?> 
		
			<?=$this->Form->input('VCH_ID',               
            [   
 
            'type'     => 'hidden',
			'class'=>'dd',
			'label'	=> 'Remarks',

        ]);   
        ?> 
        
        
        
        
        </div>
        
		
</div>
   
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create Voucher', array('class'=>'custom_submit'));
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
          <div class="proj_dep"></div>
		  <div class="clr"></div>
</div>
</div>