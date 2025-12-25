        	<div class="container">
            	<div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title_tx">

            		</div>
        		</div>

            	<div class="row">
               


                        
                            <div class="content_right" ><!--start the content_right-->
                            
                               
                                    <div class="content_inner">
                                    <h1 class="cnt_title">Company Information (In Details)</h1>
                                    </div>
                                                                  
                                   <table class="table-bordered">      
                                        <tr>
                                            <td>Name</td>
                                            <td>Address</td>
                                            <td>Phone</td>
                                            <td>Fax</td>
                                            <td>Email</td>
                                            
                                            <td>Action</td>
                                        </tr>
                                   
                                      
                                      <?php	  
                                              foreach($CompanyInfo as $d){
                                                  
                                      ?>              
                                        <tr align="center">
                                            <td><?php echo $this->Html->link($d->CMP_NAME, array('controller'=>'CompanyInfo', 'action'=>'view', $d->CMP_ID)); ?></td>
                                            <td><?php echo $d->CMP_ADDRESS; ?></td>
                                            <td><?php echo $d->CMP_PHONE; ?></td>
                                            <td><?php echo $d->CMP_FAX; ?></td>
                                            <td><?php echo $d->CMP_EMAIL; ?></td>
                                            <td align="center">
                                                <?php echo $this->Html->link('Edit', array('controller'=>'CompanyInfo', 'action'=>'edit', $d->CMP_ID)); ?>&nbsp;|
                                                <?php echo $this->Html->link('Delete', array('controller'=>'CompanyInfo', 'action'=>'delete', $d->CMP_ID)); ?>
                                            </td>
                                        </tr>
                                      <?php }?>  
                                    
                               </table><br />





</div></div></div>