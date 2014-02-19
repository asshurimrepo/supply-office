<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-cosmo.css" rel="stylesheet">
<style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }
	  .tooltip-inner { font-weight:bold; }
</style>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet"> 
<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/validation.js"></script> 
<script type="text/javascript">
$(function () {
	$('.tip').tooltip({ placement: "right", trigger: "focus" });
	$('form').form();
});
</script> 
</head>

<body>
<div class="container">

        <h1><?php echo $title; ?>!</h1>
        <p class="lead">Please provide purchase code and envato username to validate your purchase and get the premium membership of Tecdiary for LifeTime Update and 1 year Support. Field with * are required.</p>
        <?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>

		<?php echo validation_errors(); ?>
      <div class="row-fluid well">
      <?php $attrib = array('class' => 'form-horizontal', 'id' => 'addSale_form'); echo form_open("module=installer&view=run_install", $attrib); ?>
<legend>Envato Purchase Details:</legend>
<div class="control-group">
  <label class="control-label" for="username">Envato Username</label>
  <div class="controls"> <?php echo form_input('eusername', (isset($_POST['eusername']) ? $_POST['eusername'] : ''), 'class="span4 tip" title="Enter Your CodeCanyon.net Username." id="db_name" required="required" data-error="Envato Username is required"');?></div>
</div>

<div class="control-group">
  <label class="control-label" for="purchase_code">Purchase Code</label>
  <div class="controls"> <?php echo form_input('purchase_code', (isset($_POST['purchase_code']) ? $_POST['purchase_code'] : ''), 'class="span4 tip" title="Enter Envato Item Purchase Code." id="purchase_code" required="required" data-error="Purchase Code is required"');?>
  </div>
</div>
<p class="text-info"><strong>Purchase Code?</strong> Please download License File from CodeCanyon.net and open License file to find the purchase code.</p>
<p>&nbsp;</p>
<legend>Support Account Informations:</legend>
<div class="control-group">
  <label class="control-label" for="first_name"><?php echo $this->lang->line("first_name"); ?></label>
  <div class="controls"> <?php echo form_input('first_name', '', 'class="span4 tip" id="first_name" title="Enter First Name." pattern=".{2,55}" required="required" data-error="'.$this->lang->line("first_name").' '.$this->lang->line("is_required").'"');?> </div>
</div>
<div class="control-group">
  <label class="control-label" for="last_name"><?php echo $this->lang->line("last_name"); ?></label>
  <div class="controls"> <?php echo form_input('last_name', '', 'class="span4 tip" id="last_name" title="Enter Last Name." pattern=".{2,55}" required="required" data-error="'.$this->lang->line("last_name").' '.$this->lang->line("is_required").'"');?> </div>
</div>

<div class="control-group">
  <label class="control-label" for="email">Email Address</label>
  <div class="controls"> <?php echo form_input('email', (isset($_POST['email']) ? $_POST['email'] : ''), 'class="span4 tip" title="Enter Your Email Address to Get New Update Alerts." id="email" required="required" data-error="Email Address is required"');?></div>
</div>

      <div class="control-group"><div class="controls"><?php echo form_submit('submit', 'Validate & Register', 'class="btn btn-primary" style="padding: 6px 15px;"');?></div></div>
<?php echo form_close();?>   
<span class="text-error pull-right">No Need Support &amp; Updates? <a href="index.php?module=installer&view=setup&step=1" class="btn btn-danger">Proceed to Installation</a></span>
      </div>

      <div class="footer">
        <p class="text-center">&copy; 2013 Tecdiary IT Solutions</p>
      </div>

    </div> 
</body>
</html>