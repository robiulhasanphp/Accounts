<div class="content_inner">

<div class="inner_box big" style="width:900px;" >



<h4 class="inner_title"> Creat New Ledger </h4>
<div style="clear:both;"></div>



<div style="border:1px solid #ccc;margin:auto;padding-left:10px;">
<?= $this->Form->create($Ledgers) ?>


<div class="ldg_box l_mdeium" >
		
		  <?= $this->Form->input('LDG_ACC_TYPE', array(
            'label'=>'Category',
			'options' => $Usergroups,
			'type'=>'select',
			'style'=>'width:150px'
			
        )); ?>
		  
		  <?= $this->Form->input('LDG_CODE', array(
            'label'=>'Ledger code',
			'type'=>'text',
			'style'=>'width:150px'
        )); ?>
</div>
<div class="ldg_box l_big">
		  <?= $this->Form->input('LDG_NAME', array(
            'label'=>'Ledger name',
			'type'=>'text',
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
		 <?= $this->Form->input('LDG_FULL_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'textarea'
        )); ?>

</div>
<div class="ldg_box l_Vbig">
<div style="width:350px;float:left">
 <?= $this->Form->input('LDG_CURRENT_BALANCE', array(
            'label'=>'Opening Balance',
			'type'=>'text',
			'style'=>'width:150px'
        )); ?>
</div>
<div style="width:350px;float:left">
 <?= $this->Form->input('balance_date', array(
            'label'=>'Balance Date',
			'id' => 'birthday',
			'type'=>'text',
			'value'=>$balance_just_date,
			'class'=>'dd',
			'dateFormat' => 'YMD',
			'minYear' => date('Y') - 80,
			'maxYear' => date('Y') - 18,
			'style'=>'width:150px'
        )); ?>
		</div>

</div>

   <div class="ldg_box l_Vbig">

                
		<?=$this->Form->input('LDG_rso',               
            [   
            'options'  => $Ladgertyp,
            'type'     => 'radio',
            'multiple' => 'radio',
			'onclick'  => 'demoShow("asda");',
			'label'	=> 'Category',
			'value'  => 'OTH;0',
        ]);   
        ?>
   		<div class="custom_input1" id="trd_item">
                
		<?=$this->Form->input('INV_TYPE',               
            [   
            'options'  => ['1'=>'NON TRADE','2'=>'TRADE ITEM'],
            'type'     => 'radio',
            'multiple' => 'radio',
			'label'	=> '',
			'value' => '1',
				
        ]);   
        ?>
        
	   </div>
        
<div class="ldg_box l_Vbig">



    
        
		<?=$this->Form->input('LDG_chk',               
            [   
    
            'options'  => $Ladgertypem,
            'type'     => 'select',
            'multiple' => 'checkbox',
            'label'    => 'Ledger Type'

			
			
                    
        ]);   
        ?>
        
   </div>

      
		
		
        <div style="width:500px;float:left;padding-left:5px;">

        
         <?= $this->Form->input('LDG_ADDESS1', array(
            'label'=>'Adderss1',
			'type'=>'text'
        )); ?>
        
         <?= $this->Form->input('LDG_ADDESS2', array(
            'label'=>'Adderss2',
			'type'=>'text'
        )); ?>
        
         <?= $this->Form->input('LDG_PHONE', array(
            'label'=>'Phone',
			'type'=>'text'
        )); ?>
        
         <?= $this->Form->input('LDG_EMAIL', array(
            'label'=>'Email',
			'type'=>'text'
        )); ?>
		 
		
		
</div>
   
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
   

   
<?= $this->Form->end() ?>
   </div></div><div style="clear:both;"></div></div>
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