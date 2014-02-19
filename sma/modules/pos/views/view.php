<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $page_title." ".$this->lang->line("no")." ".$inv->id; ?></title>
<style type="text/css" media="all">
#wrapper { width: 280px; margin: 0 auto; text-align:center; color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; }
#wrapper img { width: 80%; }
h3 { margin: 5px 0; }
.left { width:60%; float:left; text-align:left; margin-bottom: 3px; }
.right { width:40%; float:right; text-align:right; margin-bottom: 3px; }
.table, .totals { width: 100%; margin:10px 0; }
.table th { border-bottom: 1px solid #000; }
.table td { padding:0; }
.totals td { width: 24%; padding:0; }
.table td:nth-child(2) { overflow:hidden; }
</style>
<style type="text/css" media="print">
#buttons { display: none; }
</style>
</head>

<body>
<div id="wrapper">
<img src="<?php echo $this->config->base_url(); ?>assets/uploads/logos/<?php echo $biller->logo; ?>" alt="Biller Logo">
	<h3 style="text-transform:uppercase;"><?php echo $biller->company; ?></h3>
	<?php echo "<p style=\"text-transform:capitalize;\">".$biller->address.", ".$biller->city.", ".$biller->postal_code.", ".$biller->state.", ".$biller->country."</p>"; 
	echo "<span class=\"left\">".$this->lang->line("reference_no").": ".$inv->reference_no."</span> 
	<span class=\"right\">".$this->lang->line("tel").": ".$biller->phone."</span>";
	if($pos->cf_title1 != "" && $pos->cf_value1 != "") {
		echo "<span class=\"left\">".$pos->cf_title1.": ".$pos->cf_value1."</span>";
	} 
	if($pos->cf_title2 != "" && $pos->cf_value2 != "") {	
		echo "<span class=\"right\">".$pos->cf_title2.": ".$pos->cf_value2."</span>";
	} 
	echo '<div style="clear:both;"></div>';
	echo "<span class=\"left\">".$this->lang->line("customer").": ". $inv->customer_name."</span> 
	<span class=\"right\">".$this->lang->line("date").": ".date(PHP_DATE, strtotime($inv->date))."</span>"; 
	 ?>
    <div style="clear:both;"></div>
    
	<table class="table" cellspacing="0"  border="0"> 
	<thead> 
	<tr> 
	    <th><?php echo $this->lang->line("#"); ?></th> 
	    <th><?php echo $this->lang->line("description"); ?></th> 
        <th><?php echo $this->lang->line("qty"); ?></th>
	    <th><?php echo $this->lang->line("price"); ?></th> 
	    <th><?php echo $this->lang->line("total"); ?></th> 
	</tr> 
	</thead> 
	<tbody> 
	<?php $r = 1; foreach ($rows as $row):?>
			<tr>
            	<td style="text-align:center; width:30px;"><?php echo $r; ?></td>
                <td style="text-align:left; width:180px;"><?php echo $row->product_name; ?></td>
                <td style="text-align:center; width:50px;"><?php echo $row->quantity; ?></td>
                <td style="text-align:right; width:55px; "><?php echo $this->ion_auth->formatMoney($row->unit_price); ?></td>
                <td style="text-align:right; width:65px;"><?php echo $this->ion_auth->formatMoney($row->gross_total); ?></td> 
			</tr> 
    <?php 
		$r++; 
		endforeach;
	?>
	</tbody> 
	</table> 
    
    <table class="totals" cellspacing="0" border="0">
    <tbody>
    <tr>
    <td style="text-align:left;"><?php echo $this->lang->line("total_items"); ?></td><td style="text-align:right; padding-right:1.5%; border-right: 1px solid #999;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv->count); ?></td>
    <td style="text-align:left; padding-left:1.5%;">Total</td><td style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv->inv_total); ?></td>
    </tr>
    <tr>
    <td style="text-align:left;"><?php echo $this->lang->line("product_tax"); ?></td><td style="text-align:right; padding-right:1.5%; border-right: 1px solid #999;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv->total_tax); ?></td>
    <td style="text-align:left; padding-left:1.5%;"><?php echo $this->lang->line("invoice_tax"); ?></td><td style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv->total_tax2); ?></td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:left;"><?php echo $this->lang->line("discount"); ?></td><td colspan="2" style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv->inv_discount); ?></td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:10px;"><?php echo $this->lang->line("total_payable"); ?></td><td colspan="2" style="border-top:1px solid #000; padding-top:10px; text-align:right; font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv->total); ?></td>
    </tr>
    </tbody>
    </table>
    
    <div style="border-top:1px solid #000; padding-top:10px;">
    <?php echo html_entity_decode($biller->invoice_footer); ?>
    </div>
    
    <div id="buttons" style="padding-top:10px; text-transform:uppercase;">
    <span class="left"><a href="<?php echo base_url(); ?>index.php?module=pos" style="width:80%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 1px; border-radius:5px;">Back to POS</a></span>
    <span class="right"><button type="button" onClick="window.print();return false;" style="width:80%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 1px; border-radius:5px;">Print</button></span>
    <div style="clear:both;"></div>
    </div>
</div>
</body>
</html>
