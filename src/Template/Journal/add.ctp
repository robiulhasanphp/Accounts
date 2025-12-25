
<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title">  New Journal </h4>
<div style="clear:both;"></div>
<h5 style='color:green;float:right;background:#ddd;padding:5px;margin-top:-35px;border-radius:3px'><?= $this->Flash->render() ?></h5>


<div style="border:1px solid #ccc;margin:auto;padding-left:10px;">
<?= $this->Form->create($Journal,['onsubmit' => 'return validate_form();']) ?>

                     
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
   
                            <div class="ldg_box l_Vbig">
                                        
										<div style="width:220px;float:left">
                                        <?=$this->Form->input('VCH_ACCOUNTS_MAIN',               
                                                [   
                                                'class'=>'dd',
												'id'=>'VCH_ACCOUNTS_MAIN',
                                                'label'    => 'A/C Head',
                                                'options' => $LDG_name,
                                                'type'=>'select',
										'style'=>'width:219px'                                                
                                                
                                                
                                                ]);   
                                                ?>
            
                                        </div>
            
										<div style="width:320px;float:left">
										<?=$this->Form->input('VCH_NARRATION_MAIN',               
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
                                                'id' => 'VCH_DR_AMOUNT_MAIN',
                                                'type'=>'text',
                                                'placeholder'=>'DR',
                                                'style'=>'width:98px;text-align:right'
                                                )); ?>
                                                </div>
            
            
                                                <div style="width:100px;float:left">
													<?= $this->Form->input('VCH_CR_AMOUNT_MAIN', array(
													'label'=>'CR',
													'id' => 'VCH_CR_AMOUNT_MAIN',
													'type'=>'text',
													'placeholder'=>'CR',
													'style'=>'width:98px;text-align:right'
													)); ?>
                                                </div>
            
            
            
                            </div>

<?php for($i=0;$i<5;$i++) { ?>               
                <div style="width:810px;float:left;padding:2px;height:35px;border:1px solid #ddd;border-bottom:none;border-top:none">
                                        
										<div style="width:220px;float:left">
                                      <?php if ($i>0){
									    echo $this->Form->input('VCH_ACCOUNTS['.$i.']',               
                                                [   
                                                'label'    => '',
												 'empty' => '- Select -',
												 'id'=>'VCH_ACCOUNTS['.$i.']',
                                                'options' => $LDG_name,
                                                'type'=>'select',
												'style'=>'width:219px'                                                
                                                
                                                
                                                ]);   
                                        }
										else
										{
										echo $this->Form->input('VCH_ACCOUNTS['.$i.']',               
                                                [   
                                                'label'    => '',
												 'id'=>'VCH_ACCOUNTS['.$i.']',												
												'options' => $LDG_name,
                                                'type'=>'select',
												'style'=>'width:219px'                                                
                                                
                                                
                                                ]);  
										}
										?>
										
                                        </div>
            
										<div style="width:320px;float:left">
										<?=$this->Form->input('VCH_NARRATIONS['.$i.']',               
										[   
										'label'=>'',
										'id'=>'VCH_NARRATIONS['.$i.']', 
										'type'     => 'text',
										'placeholder'=>'Description',
										'style'=>'width:319px'
										]);   
										?> 
										</div>
										
							

            
                                                <div style="width:100px;float:left">
                                                <?= $this->Form->input('VCH_DR_AMOUNT['.$i.']', array(
												'label'=>'',
                                                'id' => 'VCH_DR_AMOUNT['.$i.']',
                                                'type'=>'text',
                                                'placeholder'=>'DR',
                                                'style'=>'width:98px;text-align:right'
                                                )); ?>
                                                </div>
            
            
                                                <div style="width:100px;float:left">
													<?= $this->Form->input('VCH_CR_AMOUNT['.$i.']', array(
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

<script>
$(document).ready( function () {

$("input[type='text'][name^='VCH_CR_AMOUNT']").keyup(function(){
  sumThemUp();
});
  



$("input[type='text'][name^='VCH_DR_AMOUNT']").keyup(function(){
  sumThemUp();
});
  
$("input[type='text'][name^='VCH_CR_AMOUNT_MAIN']").keyup(function(){
  sumThemUp();
});

$("input[type='text'][name^='VCH_DR_AMOUNT_MAIN']").keyup(function(){
  sumThemUp();
});

$("input[type='select'][name^='VCH_ACCOUNTS']").keyup(function(){
  sumThemUp();
});  
});

function sumThemUp(){

	
    var sum_dr = 0;
    var sum_cr = 0;
    var main_dr=0;
    var main_cr=0;
	var v_dr=0;
	var v_cr=0;
	var sel_l=0;
	var i=0;		
	
	var vch_acc=$("[name^='VCH_ACCOUNTS']");
	
	
	
	
	var vch_acc_dr=$("[name^='VCH_DR_AMOUNT']");
	var vch_acc_cr=$("[name^='VCH_CR_AMOUNT']");
	
	//alert (vch_acc_dr.length);


for(i=0;i<vch_acc.length;i++)
{
	sel_l=TryParseFloat(vch_acc[i].value,0);
	
		if(sel_l>0)
	{
		
        sum_dr=sum_dr+ TryParseFloat(vch_acc_dr[i].value,0);
		sum_cr=sum_cr+ TryParseFloat(vch_acc_cr[i].value,0);
	}
		
	
	
	
	
}

$("[name='t_debit']").val(sum_dr);
$("[name='t_credit']").val(sum_cr);
	
	
	


	
    
	
    

	
	
};


function TryParseFloat(str,defaultValue) {
     var retValue = defaultValue;
     if(str !== null) {
         if(str.length > 0) {
             if (!isNaN(str)) {
                 retValue = parseFloat(str);
             }
         }
     }
     return retValue;
}

function validate_form(){


var v_date=$("[name='pay_date']").val();

if (v_date.length==0)
{
alert("Please specify Date");
return false;
}

var tDebit=0;
var tCredit=0;

tDebit=TryParseFloat($("[name='t_debit']").val(),0);
tCredit=TryParseFloat($("[name='t_credit']").val(),0);

if((tDebit<=0) || (tCredit<=0) || (tDebit!=tCredit))
{

alert('Amount Is Not Correct...');
return false;
}



}
</script>

          <div class="proj_dep"></div>
		  <div class="clr"></div>
</div>
</div>