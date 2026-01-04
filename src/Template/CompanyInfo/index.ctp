

            <div class="content_inner">
                <div class="scroll">
                      <h1><?php echo $this->Html->link('Add New Company', array('controller'=>'CompanyInfo', 'action'=>'add')); ?></h1>
              	<!--<div style="float:left; padding-bottom:50px;"> -->   
                        <?php 
                        foreach($CompanyInfo as $a): ?>

                              <table class="table-bordered" style="margin-bottom:15px;">
                                <tr>
                                    <td align="left" style="border:hidden;">
                                        <?php 
                                              echo "<strong>".$this->Html->link($a['CMP_NAME'], array('controller' => 'CompanyInfo', 'action' => 'view', $a['CMP_ID']))."</strong>"; 
                                              
                                              $tcmp=count($a->company_branch);
                                              
                                              //echo $tcmp;
                                              
                                              echo "<span class='count'>";
                                                  if($tcmp>1){
                                                      echo " [".$tcmp." Branches]";
                                                  }
                                                  else if($tcmp==0){echo " [ No Branch]"; }		
                                                  else{ echo " [".$tcmp." Branch]"; }
                                              echo "</span>";
                                          ?>
                                    </td>
                                    <td align="center" style="width:150px; border:hidden;">
										<?php echo $this->Html->link('Edit', array('controller'=>'CompanyInfo', 'action'=>'edit', $a->CMP_ID)); ?>&nbsp;|
                                        <?php echo $this->Html->link('Delete', array('controller'=>'CompanyInfo', 'action'=>'delete', $a->CMP_ID)); ?>
                                    </td>
                                </tr>
                              </table>
                                    
                              <?php
                              
                              
                                  $tr_table=count($a->company_branch);	
                                  
                                    if($tr_table > 0)
                                    {
                              ?>
                                      
                                   <table class="table-bordered">      
                                        <tr>
                                            <td>Name</td>
                                            <td>Address1</td>
                                            <td>Phone</td>
                                            <td>Fax</td>
                                            <td>Telephone</td>
                                            <td>Email</td>
                                            <td>Action</td>
                                        </tr>
                                   
                                      
                                      <?php	  
                                              foreach($a->company_branch as $d){
                                                  
                                      ?>              
                                        <tr>
                                            <td><?php echo $this->Html->link($d->BRN_NAME, array('controller'=>'CompanyBranch', 'action'=>'view', $d->BRN_ID)); ?></td>
                                            <td><?php echo $d->BRN_ADDRESS1; ?></td>
                                            <td><?php echo $d->BRN_PHONE; ?></td>
                                            <td><?php echo $d->BRN_FAX; ?></td>
                                            <td><?php echo $d->BRN_TEL; ?></td>
                                            <td><?php echo $d->BRN_EMAIL; ?></td>
                                            <td align="center">
                                                <?php echo $this->Html->link('Edit', array('controller'=>'CompanyBranch', 'action'=>'edit', $d->BRN_ID)); ?>&nbsp;|
                                                <?php echo $this->Html->link('Delete', array('controller'=>'CompanyBranch', 'action'=>'delete', $d->BRN_ID)); ?>
                                            </td>
                                        </tr>
                                      <?php }?>  
                                    
                               </table><br />
                               <?php }else{echo "<br /><br />";} ?>
                           
						<?php endforeach ?>
                        <?php unset($a); ?>
                        
					<!--</div> -->                   
                </div>
            </div>


