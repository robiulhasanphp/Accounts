<table class="table-bordered" >
    <tr >
          	<td>Ledger Code</td>
          	<td>Ledger Name</td>
          	<td style="text-align:right;">Balance</td>
           
          </tr>
        
        <?php 
									$sql = "SELECT L.LDG_ID,L.LDG_CODE,L.LDG_NAME,L.`LDG_TYPES`,NULLIF(LB.LBL_BALANCE_DR,0) as BAL_DR,NULLIF(LB.LBL_BALANCE_CR,0) as BAL_CR,  LTR.T_DBT,LTR.T_CRT from  `ledgers` L 
Left Join  (select `LDG_ID`,`LBL_BALANCE_DR`,`LBL_BALANCE_CR` from `ledger_balance` 
            where LDG_BAL_PERIOD=(Select min(LDG_BAL_PERIOD) from `ledger_balance`)) as LB  on 
            L.LDG_ID=LB.LDG_ID
LEFT JOIN (Select VDT_LDG_ID,sum(vdt_debit) as T_DBT,sum(vdt_Credit) as T_CRT from voucher_dtls inner join vouchers
           on voucher_dtls.vch_id=vouchers.VCH_ID where VCH_STATUS=16
          group by VDT_LDG_ID) as LTR on
          L.LDG_ID=LTR.VDT_LDG_ID where L.LDG_TYPES LIKE '%".$ldg_type."%'";
										$Ledgers = $conn->execute($sql);//->fetch('assoc');
										
									
									
									?> 
          <?php
		//  var_dump($Ledgers);
		
			$total = 0;
		
		  foreach($Ledgers as $a):?>
		 
			 
         <tr>
             
              <td><?php  //var_dump($a);
			  echo $a['LDG_CODE']?></td>
			  <td><?php echo $a['LDG_NAME']?></td>
              
              
              
              
               <td style="text-align:right; font-weight:bold; letter-spacing:1px;"><?php 
			   
			   $balance =( $a['BAL_DR']-$a['BAL_CR'])+($a['T_DBT']-$a['T_CRT']);
			   
			   $total = $total+$balance;
			   
			   if($balance<0){
				   
				   
				   
				   echo number_format(abs($balance),2)." Cr";
			   }
			   else{echo number_format($balance,2)." Dr";}
			   
			   ?>
             
          </tr> 
			
		  <?php endforeach;?>
          <tr>
          	 <th colspan="2" >Total</th><th style="text-align:right; font-weight:bold; letter-spacing:1px;"><?php  if($total<0){
				   
				   
				   
				   echo number_format(abs($total),2)." Cr";
			   }
			   else{echo number_format($total,2)." Dr";} ?>
               </th>
          </tr>
		    </table>