

<table style="width:100%;background:#FFF"><tr><td style="width:10px;background:#CCC">&nbsp;</td><td style="padding-left:30px; width:100%;background:#FFF;text-align:left">
            <span  style="font-size:14px;font-weight:bold">Branches</span>
                <div class="scroll">
                    <span style="float:right"><?php echo $this->Html->link('Create New Branch', array('controller'=>'accounts/CompanyBranch', 'action'=>'add')); ?></span></div>
                    <br>
                    <div style="text-align:left">
                    
                    <?php //var_dump($CompanyBranch->count()); 
					if ($CompanyBranch->count()>0)
					{?>
                    
                     <table class="table-bordered">      
                                    <tr>
                                    <td></td>
                                        <td>Branch Name</td>
                                        <td>Address1</td>
                                        <td>Phone</td>
                                        <td>Fax</td>
                                        <td>Telephone</td>
                                        <td>Email</td>
                                        <td>Action</td>
                                    </tr>
                        <?php 
						$sl=1;
							foreach($CompanyBranch as $a){ ?>
                              
                               
                                  
                                    <tr >
                                    <td><?php echo $sl; ?></td>
                                        <td><?php echo $a['BRN_NAME']; ?></td>
                                        <td><?php echo $a['BRN_ADDRESS1']; ?></td>
                                        <td><?php echo $a['BRN_PHONE']; ?></td>
                                        <td><?php echo $a['BRN_FAX']; ?></td>
                                        <td><?php echo $a['BRN_TEL']; ?></td>
                                        <td><?php echo $a['BRN_EMAIL']; ?></td>
                                        <td align="center"><a href="CompanyBranch/edit/<?php echo $a['BRN_ID'];?>">Edit</a>
&nbsp;|
                                            <a href="CompanyBranch/delete/<?php echo $a['BRN_ID'];?>">Delete</a>
                                            
                                        </td>
                                    
                           
                    <?php $sl=$sl+1;
							} ?>
                    <?php unset($a); ?>
                        
                    </tr>
                                
                           </table>
                           <?php
					}
					else
					{
						echo "<div style='margin-top:-25px !important;position:absoulote'>No Branch Found</div>";
					}
					
					
					?>
                </div>


















</td></tr></table>