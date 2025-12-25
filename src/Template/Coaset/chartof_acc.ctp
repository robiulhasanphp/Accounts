<div class="content_inner">

<div style="padding-bottom:30px;">

<h5 style="padding-left:10px; float:left; color:#FF6A17;"> COaset List</h5>


<h5 style="padding-left:10px;" align="right"><?php echo $this->Html->link("Add new Coaset",
array('controller' => 'Coaset', 'action' => 'add')); ?></h5>


</div>
<style>
.chekbox { border:2px solid #ccc; width:220px; height: 500px; overflow-y: scroll; }

.select .checkbox label input {
    margin-top: -7px;
    width:320px;
}

</style>
<div>

<p style=" color:#063; font-size:12px">SET NAME:  <?php echo $SET_NAME;  ?></p><br />
<p style=" color:#063; font-size:12px">SET CODE:  <?php echo $SET_CODE;  ?></p>


<table class="table-bordered" align="left" >
    <tr>
        <td>Chart of Accounts</td>
        <td style="width:200px;">ledger</td>
    </tr>


	<tr>

            <td width="400px;">
            
            	<table>
            
					<?php
                    
                    $coa='';
                    //var_dump($CompanyRoot);
                    foreach($Coasetledger as $a):
                    
                    if($coa!=$a->chartofacc->COA_NAME)
                    {
						?>
						<td> <div class="block">&nbsp;</div>	</td>
				
				
						<td>
						
					
						<b><?php echo $a->chartofacc->COA_NAME?></b>
						</div>
						
						</td>
						<?php 
						
						 
						$coa=$a->chartofacc->COA_NAME;
                    }
            
            
            
            
            ?>
    	<tr>
            
            
        <td>
            
                    <td>
                    
                    <div class="main_title" style="width:310px;">
                    [ <?php echo $a->ledger->LDG_NAME; ?>  ]
                    
                    </div>
                    
                    </td>
                    
                    <td> 
                    
                    <?= $this->Html->link('Delete',array ('action' => 'delete', $a->SLD_ID)); ?> 
              
                    
                    </td>
            
    </tr>
            
            <?php endforeach;?>
            </table>
            
            
            </td>


        <td valign="top">
        
      <?= $this->Form->create() ?>
        
        
        
        <div align="center" style="text-align:center">
        
        
        
        
       <?= $this->Form->input('Name', array(
        'label'=>'Ledger Name',
        'options' => $name,
        'type'=>'select',
        'style'=>'border:1px solid #ccc;width:120px;'
        )); ?>
        
        </div> 
        
        
        
                <div class="chekbox">    
            
            <?php
            echo $this->Form->input('ledger',               
            [   
            
            'options'  => $LDG_NAME,
            'type'     => 'select',
            'multiple' => 'checkbox',
            'label'    => false,
            
            ]);   
            ?>
            
            </div>  
            <?=$this->Form->button('Add', array('class'=>'custom_submit','style'=>'float:right;'));  ?>
            <?= $this->Form->end() ?>   
            
            
            </td>
            
            
            </tr> 
        


</table>
        </div>
    </div>
        
