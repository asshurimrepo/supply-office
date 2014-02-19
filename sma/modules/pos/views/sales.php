
<table width="100%" class="stable">
<tr>
<td colspan="2"><h4><?php if (isset($totalsales->date)) { echo $totalsales->date; } else { echo date('l, F j, Y'); } ?></h4></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #EEE;"><h4><?php echo $this->lang->line('cash_sale'); ?>:</h4></td>
<td style="text-align:right; border-bottom: 1px solid #EEE;"><h4><span><?php echo $cashsales; ?></span></h4></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #EEE;"><h4><?php echo $this->lang->line('ch_sale'); ?>:</h4></td>
<td style="text-align:right;border-bottom: 1px solid #EEE;"><h4><span><?php echo $chsales; ?></span></h4></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #DDD;"><h4><?php echo $this->lang->line('cc_sale'); ?>:</h4></td>
<td style="text-align:right;border-bottom: 1px solid #DDD;"><h4><span><?php echo $ccsales; ?></span></h4></td>
</tr>
<tr>
<td width="300px;" style="font-weight:bold;"><h4><?php echo $this->lang->line('total'); ?>:</h4></td>
<td width="200px;" style="font-weight:bold;text-align:right;"><h4><span><?php if(isset($totalsales->total)) { echo $totalsales->total; } else { echo "0.00"; } ?></span></h4></td>
</tr>    
</table>    
    
    

