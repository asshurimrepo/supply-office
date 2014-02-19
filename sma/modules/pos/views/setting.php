<script src="<?php echo $this->config->base_url(); ?>assets/js/validation.js"></script>
<script type="text/javascript">
$(function() {
	$('form').form();
});
</script>
<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>

	<h3 class="title"><?php echo $page_title; ?></h3>
	<p><?php echo $this->lang->line('update_info'); ?></p>
	
    <?php $attrib = array('class' => 'form-horizontal'); echo form_open("module=pos&view=settings", $attrib);?>

<div class="control-group">
  <label class="control-label" for="limit"><?php echo $this->lang->line("pro_limit"); ?></label>
  <div class="controls"> <?php echo form_input('pro_limit', $pos->pro_limit, 'class="span4" id="limit" required="required" data-error="'.$this->lang->line("pro_limit").' '.$this->lang->line("is_required").'"');?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="limit"><?php echo $this->lang->line("default_category"); ?></label>
  <div class="controls"> <?php 
	  	$ct[''] = '';
	  foreach($categories as $catrgory){
    		$ct[$catrgory->id] = $catrgory->name;
		}
		
		echo form_dropdown('category', $ct, $pos->default_category, 'class="chzn-select" data-placeholder="Select Default Category" required="required" data-error="'.$this->lang->line("default_category").' '.$this->lang->line("is_required").'"'); ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="limit"><?php echo $this->lang->line("default_biller"); ?></label>
  <div class="controls"> <?php 
	   		$bl[0] = "";
	   		foreach($billers as $biller){
				$bl[$biller->id] = $biller->name;
			}
			if(isset($_POST['biller'])) { $biller = $_POST['biller']; } else { $biller = ""; }
			echo form_dropdown('biller', $bl, $pos->default_biller, 'class="chzn-select" data-placeholder="Choose a Biller" required="required" data-error="'.$this->lang->line("default_biller").' '.$this->lang->line("is_required").'"');  ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="limit"><?php echo $this->lang->line("default_customer"); ?></label>
  <div class="controls"> <?php 
	   		$cu[0] = "";
	   		foreach($customers as $customer){
				if($customer->company == "-") {
					$cu[$customer->id] = $customer->name." (P)";
				} else {
					$cu[$customer->id] = $customer->company." (C)";
				}
			}
			if(isset($_POST['customer'])) { $customer = $_POST['customer']; } else { $customer = ""; }
			echo form_dropdown('customer', $cu, $pos->default_customer, 'class="chzn-select" data-placeholder="Choose a Customer" required="required" data-error="'.$this->lang->line("default_customer").' '.$this->lang->line("is_required").'"');  ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="limit"><?php echo $this->lang->line("display_time"); ?></label>
  <div class="controls"> <?php 
	  	$dtime = array ('yes' => $this->lang->line('yes'), 'no' => $this->lang->line('no1'));
		echo form_dropdown('display_time', $dtime, $pos->display_time, 'class="chzn-select" data-placeholder="Select " required="required" data-error="'.$this->lang->line("display_time").' '.$this->lang->line("is_required").'"'); ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="tcf1"><?php echo $this->lang->line("cf_title1"); ?></label>
  <div class="controls"><?php echo form_input('cf_title1', $pos->cf_title1, 'class="span4 tip" id="tcf1" title="'.$this->lang->line("cf_display_on_bill").'"'); ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="vcf1"><?php echo $this->lang->line("cf_value1"); ?></label>
  <div class="controls"><?php echo form_input('cf_value1', $pos->cf_value1, 'class="span4 tip" id="vcf1" title="'.$this->lang->line("cf_display_on_bill").'"'); ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="tcf2"><?php echo $this->lang->line("cf_title2"); ?></label>
  <div class="controls"><?php echo form_input('cf_title2', $pos->cf_title2, 'class="span4 tip" id="tcf2" title="'.$this->lang->line("cf_display_on_bill").'"'); ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="vcf2"><?php echo $this->lang->line("cf_value2"); ?></label>
  <div class="controls"><?php echo form_input('cf_value2', $pos->cf_value2, 'class="span4 tip" id="vcf2" title="'.$this->lang->line("cf_display_on_bill").'"'); ?>
  </div>
</div>
            
   <div class="control-group">
  <div class="controls"> <?php echo form_submit('submit', $this->lang->line("update_settings"), 'class="btn btn-primary"');?> </div>
</div>
<?php echo form_close();?> 