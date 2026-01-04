<div class="dash_board">
<table border="0" style="width:100%"><tr><td style="width:250px;vertical-align:top">
<div class="dash_left">
                       <div class="box">         
      <h1 class="bar_title small_h">Purchase</h1>
      <ul>
        <li class='plus'><?php echo $this->Html->link("New Purchase", array('controller' => 'Purchase', 'action' => 'add')); ?></li>
         
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

        
 <h4 class="inner_title" style="color:#000066; font-size:14px;"> Search your Voucher LIst </h4>
      
<?= $this->Form->create($Dashboard) ?>

<div class="ldg_box l_big">
		  <?= $this->Form->input('name', array(
            'label'=>'Ledger name',
			'empty' => 'choose one',
			'options' => $LDG_name,
			'type'=>'select',
			'style'=>'border:1px solid #ccc; background:url(../img/bg.png) repeat-x bottom;background-position:center'
        )); ?>
		
	

						<?=$this->Form->input('date_from',               
							[   
							'id' => 'birthday',
							'type'=>'text',
							'class'=>'dd',
							'dateFormat' => 'YMD',
							'minYear' => date('Y') - 80,
							'maxYear' => date('Y') - 18,
							'label'   => 'Date from',
							
									
						]);   
						?>
		
		
		
                           <?=$this->Form->input('date_to',               
                        [   
             
                        'id' => 'employ_date',
						'type'=>'text',
						'class'=>'dd',
						'dateFormat' => 'YMD',
						'minYear' => date('Y') - 80,
						'maxYear' => date('Y') - 18,
						'label'   => 'Date to',
						
            
                    ]);   
                    ?>
		
		<?= $this->Form->input('amount', array(
            'label'=>'Amount',
			'type'=>'text',
			'style'=>'width:110px'
        )); ?>
		
		
		
   
  <?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
   


</div>

   
<?= $this->Form->end() ?>

         <div class="dash_content">
                
        <?php
   
   if($search_result)
   {
   ?> 
                
 <h1 class="bar_title small_h">Search result</h1>
		<div style="padding-bottom:30px;">
		</div>

			<div style="padding-bottom:30px;">
			
			
			
			
			
					 <?php  $tabledata=$search_result;
					  include("index_detail.php"); ?>
					
					  
					  <?php
					  }
					  ?>
			</div>

</div></td></tr></table></div>