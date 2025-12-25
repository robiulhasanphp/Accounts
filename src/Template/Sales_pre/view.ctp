
<div class="content_inner" style="padding:0 20px; float:left;">
    <table style="width:100%;">
        <tr>
            <td colspan="2" align="right">
                <b> <?= $this->Html->link('Edit',array ('action' => 'edit', $Sales->VCH_ID)); ?> </b>
            </td>
        </tr>
    </table><br /><br />
    
    
    
    
    <table class="tbl_cv">
        <tr>
            <td>
                <table>
                    <tr>
                        <td width="150"><strong>Slaes Date:</strong></td>
                        <td class="td_class" <td><?php echo $Sales->VCH_DATE?></td></td>
                    </tr>
                    <tr>
                        <td width="150"><strong>Slaes Type:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_TYPE?></td>
                    </tr>
                    <tr>
                        <td width="150"><strong>Project:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_PROJECT?></td>
                    </tr>
                    <tr>
                        <td width="150"><strong>Department:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_DEPARTMENT?></td>
                    </tr>
                    <tr>
                        <td width="150"><strong>Sales full no:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_NO_FULL?></td>
                    </tr>
                    
                      <tr>
                        <td width="150"><strong>chalan date:</trong></td>
                        <td class="td_class"><?php echo $Sales->VCH_CHALLAN_DATE?></td>
                    </tr>
               
                </table>
            </td>
            
            
            <td>
                <table>
                  <tr>
                      <td width="150"><strong>full description:</strong></td>
                      <td class="td_class"><?php echo $Sales->VCH_FULL_DESCRIPTION?></td>
                  </tr>
                       <tr>
                        <td width="150"><strong>Slaes Amount:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_AMOUNT?></td>
                    </tr>
                    <tr>
                        <td width="150"><strong>debit Account:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_DR_ACCOUNTS?></td>
                    </tr>
                    <tr>
                        <td width="150"><strong>Credit account:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_CR_ACCOUNTS?></td>
                    </tr>
                    
                    
                    <tr>
                        <td width="150"><strong>inv date:</strong></td>
                        <td class="td_class"><?php echo $Sales->VCH_INV_DATE?></td>
                    </tr>
                 
                </table>
            </td>
        </tr>
        
        
    </table>
</div>

       


</div>
