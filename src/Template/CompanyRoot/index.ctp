

  <div class="content_inner">
  <h3 style="width:100%;color:#00C;float:left">Group  <span style="float:right;padding-right:50px;font-size:14px"><?php echo $this->Html->link("Create Group of Company", array('controller' => 'CompanyRoot', 'action' => 'add')); ?></span>
</h3>
  

 <?php foreach ($CompanyRoot as $a): ?> 
  <table class="table-bordered" style="margin-bottom:15px;">
  	<tr>
    	<td align="left" style="border:hidden;">
        	<?php 
                  echo $this->Html->link($a['RT_NAME'], array('controller' => 'CompanyRoot', 'action' => 'view', $a['RT_ID'])); 
                  $tcmp=count($a->company_info);
				  
				  //echo $tcmp;
				  
                  echo "<span class='count'>";
					  if($tcmp>1){
						  echo " [".$tcmp." Companies]";
					  }
					  else if($tcmp==0){echo " [ No Company]"; }		
					  else{ echo " [".$tcmp." Company]"; }
                  echo "</span>";
              ?>
        </td>
    	<td width="200" style="border:hidden;"><?php echo $this->Html->link("Create New Company", array('controller' => 'CompanyInfo', 'action' => 'add', $a['RT_ID'])); ?></td>
    </tr>
  </table>
          
              
		  <?php 
              if($tcmp>0){
          ?>
             
  <div style="padding-left:50px;">
<h3 style="color:#963">Company</h3>
        <table class="table-bordered">
              <tr>
                  <th style=" padding-left:5px;">Name</th>
                  <th style=" padding-left:5px;">Address</th>
                  <th style="text-align:center">option</th>
              </tr>
    
    
        <?php } ?>
    
              <?php  foreach ($a->company_info as $d){ ?>
                 <tr>
                      <td style="width:30%;">
                          <?php echo $this->Html->link($d->CMP_NAME, array('controller' => 'CompanyInfo', 'action' => 'view', $d->CMP_ID)); ?>
                      </td>
                      <td><?php echo $d->CMP_ADDRESS; ?></td>
                      <td style="text-align:center; width:200px;">
                          <?php echo $this->Html->link("Edit", array('controller' => 'CompanyInfo', 'action' => 'edit', $d->CMP_ID)); ?>&nbsp;|&nbsp;
                          <?php echo $this->Html->link("Delete", array('controller' => 'CompanyInfo', 'action' => 'delete', $d->CMP_ID));?></td>
                          
                  </tr>
                  <tr ><td colspan="3">
				  
 <?php

$da=$this->requestAction('CompanyBranch/showbranch/'.$d->CMP_ID);// ['showbranch',$d->CMP_ID]));
echo $da;
//					  	$this->render('/CompanyBranch/index');//.$d->CMP_ID));
?>  

				  
				
              <?php } ?>
         </td></tr>
          </table><br />
              
          
          
</div>          
          
      <?php 
	  	endforeach; 
	  	unset($a); 
	  ?>
                  
  </div>
