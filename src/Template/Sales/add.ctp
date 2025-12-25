<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title">  New Sales</h4>
<div style="clear:both;"></div>
<h5 style='color:green;float:right;background:#ddd;padding:5px;margin-top:-35px;border-radius:3px'><?= $this->Flash->render() ?></h5>


<div style="border:1px solid #ccc;margin:auto;padding-left:10px;">
<?= $this->Form->create($Sales) ?>

       
    
	

                     
                  <div class="proj_dep">
                          <?=$this->Form->input('VCH_PROJECT',               
                        [   
             
                        'options' => $project,
                        'type'=>'select',
                        'class'=>'inp_select',
                        'label'	=> 'Project',
            
                    ]);   
                    ?>
						<?=$this->Form->input('VCH_DEPARTMENT',               
                        [   
             
                        'options' => $department,
                        'type'=>'select',
                        'class'=>'inp_select',
                        'label'	=> 'Department',
            
                    ]);   
                    ?>

   

                            
                 
                    
                    
                          
                       

</div>
<div class="h_border"></div>

 
  <div class="proj_dep">

<div id="date">      

		<?=$this->Form->input('pay_date',               
            [   
          	'id' => 'birthday',
			'type'=>'text',
			'class'=>'dd',
			'dateFormat' => 'DMY',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
            'label'   => 'Sales Date',
			
                    
        ]);   
        ?>
        
</div>
        
  </div>      
          <div class="proj_dep" >  
		  <?=$this->Form->input('VCH_DR_ACCOUNTS',               
            [   
          	 
             'label'    => 'Customer',
             'options' => $sales_t,
             'type'=>'select',
			 'style'=>'width:400px;float:left'
			 
                    
        ]);   
        ?>

		</div>
          
		  <div class="proj_dep">           <div style="width:700px;"?>  
        <?=$this->Form->input('VCH_CR_ACCOUNTS',               
            [   
         
             'label'    => 'Item',
             'options' =>$item,
             'type'=>'select',
			 'style'=>'width:400px;float:left'
			
                    
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
                
                    
                           <?=$this->Form->input('check_date',               
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
			'label'	=> 'Sales Amount',
					 'style'=>'width:300px;height:40px;text-align:center;margin-left:20px;font-size:20px !important;padding:6px !important;color:blue !important'

        ]);   
        ?>
        </div>
		</div>
		<div>

   <div class="proj_dep"> 
        		<?=$this->Form->input('VCH_NARRATION',               
            [   
 
            'type'     => 'textarea',
		
			'label'	=> 'Remarks',
			
			 'style'=>'width:500px;float:left'

        ]);   
        ?> 
        
        
        
        
        </div>
        
		
</div>
   
   
  <?php 
  	echo '<div class="button">';
	echo '<div style="width:70px;float:right;height:50px;">Continue Add';
	  echo $this->Form->checkbox('CONTINUE',['checked'=>'checked']);
echo '</div>';
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