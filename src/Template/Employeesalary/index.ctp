
<div class="add_box_2">
		
		
								
<table class="table-bordered" style="text-align:center">
    	<tr align="center">
          	<td>Allowance</td>
          	<td>Amount</td>
      
          </tr>
        
        
          <?php
		
		  foreach($salary as $a):?>
		 
			 
         <tr align="center">
             
              <td><?php echo $a->EMS_CREATE_BY?></td>
              <td><?php echo $a->EMS_AMOUNT?></td>
              
        </tr> 
			
		  <?php endforeach;?>
		    </table>


</div> 