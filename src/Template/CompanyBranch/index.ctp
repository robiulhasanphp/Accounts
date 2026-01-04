

            <div class="content_inner">
                <div class="scroll">
                    <h1><?php echo $this->Html->link('Add New Branch', array('controller'=>'CompanyBranch', 'action'=>'add')); ?></h1>
                        <?php 
							foreach($CompanyBranch as $a): ?>
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
                               
                                  
                                    <tr align="center">
                                        <td><?php echo $this->Html->link($a['BRN_NAME'], array('controller'=>'CompanyBranch', 'action'=>'view', $a['BRN_ID'])); ?></td>
                                        <td><?php echo $a['BRN_ADDRESS1']; ?></td>
                                        <td><?php echo $a['BRN_PHONE']; ?></td>
                                        <td><?php echo $a['BRN_FAX']; ?></td>
                                        <td><?php echo $a['BRN_TEL']; ?></td>
                                        <td><?php echo $a['BRN_EMAIL']; ?></td>
                                        <td align="center">
                                            <?php echo $this->Html->link('Edit', array('controller'=>'CompanyBranch', 'action'=>'edit', $a['BRN_ID'])); ?>&nbsp;|
                                            <?php echo $this->Html->link('Delete', array('controller'=>'CompanyBranch', 'action'=>'delete', $a['BRN_ID'])); ?>
                                            
                                        </td>
                                    </tr>
                                
                           </table>
                           
                    <?php endforeach ?>
                    <?php unset($a); ?>
                        
                    
                </div>
            </div>

















