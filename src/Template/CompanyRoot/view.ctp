

  <div class="content_inner">
    <?php  foreach ($CompanyRoot as $a): ?>
        <table class="rootview table-bordered">
              <tr>
                  <th style=" padding-left:5px;">Id</th>
                  <th style=" padding-left:5px;">Code</th>
                  <th style=" padding-left:5px;">Name</th>
                  <th>Web</th>
                  <th>Action</th>
              </tr>
    
                 <tr>
                 	<td><?php echo $a->RT_ID; ?></td>
                    <td><?php echo $a->RT_CODE; ?></td>	 
                    <td style="width:30%;">
                        <?php echo $this->Html->link($a->RT_NAME, array('controller' => 'CompanyRoot', 'action' => 'view', $a->RT_ID)); ?>
                    </td>
                    <td><?php echo $a->RT_WB; ?></td>
                    <td style="width:200px;">
                        <?php echo $this->Html->link("Edit", array('controller' => 'CompanyRoot', 'action' => 'edit', $a->RT_ID)); ?>&nbsp;|&nbsp;
                        <?php echo $this->Html->link("Delete", array('controller' => 'CompanyRoot', 'action' => 'delete', $a->RT_ID));?></td>
                  </tr>
         
          </table><br />
      <?php 
	  	endforeach; 
	  	unset($a); 
	  ?>
                  
  </div>
