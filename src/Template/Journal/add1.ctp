
<div class="content_inner">

    <div class="inner_box big" style="width:900px;" >
	
                <h4 class="inner_title">  New Voucher</h4>
				<h5 style='color:green;float:right;background:#ddd;padding:5px;margin-top:-35px;border-radius:3px'><?= $this->Flash->render() ?></h5>

				<div style="border:1px solid #ccc; margin:auto; padding-left:10px;">
						<?= $this->Form->create('Createvoucher', ['onSubmit'=>"return CheckAndSubmit()"]);  ?>

                     
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
            'label'   => 'Purchase Date',
			
                    
        ]);   
        ?>
        
</div>
        
  </div>      
          
		  <div class="proj_dep">           <div style="width:700px;"?>  
        <?=$this->Form->input('VCH_DR_ACCOUNTS',               
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
			'label'	=> 'Purchase Amount',
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

							<script>
                            $(VCH_DR_AMOUNT).mousedown(function(){	change_drcr('D')});	
                            $(VCH_CR_AMOUNT).mousedown(function(){	change_drcr('C');});	
                            
                            $(VCH_DR_AMOUNT).keypress(function(){	change_drcr('D')});
                            $(VCH_CR_AMOUNT).keypress(function(){	change_drcr('C')});
                            
                            $(VCH_DR_AMOUNT).change(function(){	change_drcr('D')});
                            $(VCH_CR_AMOUNT).change(function(){	change_drcr('C')});
                            
                            
                            $(CR_AMOUNT).mousedown(function(){	change_drcr('C');});	
                            
                            $(DR_AMOUNT).mousedown(function(){	change_drcr('D');});
                            
                            $(DR_AMOUNT).keypress(function(){	change_drcr('D')});
                            $(CR_AMOUNT).keypress(function(){	change_drcr('C')});
                            
                            $(DR_AMOUNT).change(function(){	change_drcr('D')});
                            $(CR_AMOUNT).change(function(){	change_drcr('C')});
                            
                            
                            
                            
                            function change_drcr(opt)
                            {
                            
                            var dr=$(VCH_DR_AMOUNT).val();
                            var cr=$(VCH_CR_AMOUNT).val();
                            
                            /*var debit=$(DR_AMOUNT).val();
                            var credit=$(CR_AMOUNT).val();*/
                            
                            
                            if (opt=='C')
                            {
								if (cr!='')
								{
								$(VCH_DR_AMOUNT).val('');
								$(VCH_DR_AMOUNT).attr('readonly', true);
							   
							   
								}
								else
								{
								$(VCH_DR_AMOUNT).attr('readonly', false);
								
							   
								
								}
                            }
                            else
                            {
								if (dr!='')
								{
									$(VCH_CR_AMOUNT).val('');
									$(VCH_CR_AMOUNT).attr('readonly', true);
								
								}
                	            else
                    	        {
            	                	$(VCH_CR_AMOUNT).attr('readonly', false);
        	    
                        	    
                            	}
                            
                            }
                            
                            
                            
                            
                            
                            }
                            
                            </script>
                            
                            
                            
                            



                            <div class="ldg_box l_Vbig">
                                        
										<div style="width:220px;float:left">
                                        <?=$this->Form->input('VCH_ACCOUNT_MAIN',               
                                                [   
                                                'class'=>'dd',
                                                'label'    => 'A/C Head',
                                                'options' => $LDG_name,
                                                'type'=>'select',
										'style'=>'width:219px'                                                
                                                
                                                
                                                ]);   
                                                ?>
            
                                        </div>
            
										<div style="width:320px;float:left">
										<?=$this->Form->input('ACCOUNT_MAIN_NARRATION',               
										[   
										
										'type'     => 'text',

										'label'	=> 'Description',
										'placeholder'=>'Description',
										'style'=>'width:319px'
										]);   
										?> 
										</div>
										
							

            
                                                <div style="width:100px;float:left">
                                                <?= $this->Form->input('VCH_DR_AMOUNT_MAIN', array(
                                                'label'=>'DR',
                                                'id' => 'VCH_DR_AMOUNT',
                                                'type'=>'text',
                                                'placeholder'=>'DR',
                                                'style'=>'width:98px;text-align:right'
                                                )); ?>
                                                </div>
            
            
                                                <div style="width:100px;float:left">
													<?= $this->Form->input('VCH_CR_AMOUNT_MAIN', array(
													'label'=>'CR',
													'id' => 'VCH_CR_AMOUNT',
													'type'=>'text',
													'placeholder'=>'CR',
													'style'=>'width:98px;text-align:right'
													)); ?>
                                                </div>
            
            
            
                            </div>

<?php for($i=0;$i<5;$i++) { ?>               
                <div style="width:810px;float:left;padding:2px;height:35px;border:1px solid #ddd;border-bottom:none;border-top:none">
                                        
										<div style="width:220px;float:left">
                                        <?=$this->Form->input('VCH_ACCOUNTS['.$i.']',               
                                                [   
                                                'label'    => '',
												'empty' => '- Select -',
                                                'options' => $LDG_name,
                                                'type'=>'select',
												'style'=>'width:219px'                                                
                                                
                                                
                                                ]);   
                                                ?>
            
                                        </div>
            
										<div style="width:320px;float:left">
										<?=$this->Form->input('VCH_NARRATION['.$i.']',               
										[   
										'label'=>'',
										'type'     => 'text',
										'placeholder'=>'Description',
										'style'=>'width:319px'
										]);   
										?> 
										</div>
										
							

            
                                                <div style="width:100px;float:left">
                                                <?= $this->Form->input('debit_amount['.$i.']', array(
												'label'=>'',
                                                'id' => 'VCH_DR_AMOUNT['.$i.']',
                                                'type'=>'text',
                                                'placeholder'=>'DR',
                                                'style'=>'width:98px;text-align:right'
                                                )); ?>
                                                </div>
            
            
                                                <div style="width:100px;float:left">
													<?= $this->Form->input('credit_amount['.$i.']', array(
													'id' => 'VCH_CR_AMOUNT['.$i.']',
													'type'=>'text',
													'placeholder'=>'CR',
													'label'=>'',
													'style'=>'width:98px;text-align:right'
													)); ?>
                                                </div>
            
            
            
                            </div>

<?php } ?>

<div class="clr"></div>

<br/>

	   	<div style="width:540px;float:left;font-size:14px;padding:6px;margin-top:14px;text-align:right">&nbsp;<b>Total</d></div>
            
                                                <div style="width:100px;float:left">
                                                <?= $this->Form->input('t_debit', array(
												'label'=>'',
                                                'id' => 't_debit',
                                                'type'=>'text',
                                                'placeholder'=>'Total Debit',
												'readonly'=>true,
                                                'style'=>'width:98px;text-align:right;'
                                                )); ?>
                                                </div>
            
                                                <div style="width:100px;float:left">
                                                <?= $this->Form->input('t_credit', array(
												'label'=>'',
                                                'id' => 't_credit',
                                                'type'=>'text',
                                                'placeholder'=>'Total Credit',
												'readonly'=>true,
                                                'style'=>'width:98px;text-align:right;'
                                                )); ?>
                                                </div>
            



							


					

					
					
					
					
					
					
					
					
				
   
     


					
					
							<div class="clr" align="right">
					
                            <?php			
                            
                            echo '<div class="button" style="float:right; margin:20px 60px; padding:0;">';
                            echo $this->Form->button('Create Payment', array('class'=>'custom_submit'));
                            echo '</div>'; 
                            
							 echo '<div class="clr"></div>';
                            
                            echo $this->Form->end();
                            ?>
							
							</div>

					
						
					
						





		<script>  
        function deleteRow(row)
        {
        var i=row.parentNode.parentNode.rowIndex;
        document.getElementById('POITable').deleteRow(i);
        }
        
        
        function insRow()
        {
        var x=document.getElementById('POITable');
        // deep clone the targeted row
        var new_row = x.rows[1].cloneNode(true);
        // get the total number of rows
        var len = x.rows.length;
        // set the innerHTML of the first row 
        new_row.cells[0].innerHTML = len;
        
        // grab the input from the first cell and update its ID and value
        var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
        inp1.id += len;
        inp1.value = '';
        
        // grab the input from the first cell and update its ID and value
        var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
        inp2.id += len;
        inp2.value = '';
        
        // append the new row to the table
        x.appendChild( new_row );
        }
        </script>





	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function()
    {
    $('#button').toggle(
    function()
    {
    $('#div1').css({'display':'none'});
    $('#div2').slideDown(); // or try "fadeIn()"
    $('#button').attr;
    }, 
    function() 
    {
    $('#div2').css({'display':'none'});
    $('#div1').slideDown(); // or try "fadeIn()"
    $('#button').attr;
    });
    });
    </script>
    

     
    <div class="clr"></div>
  
    
    
    </div>  
</div>
