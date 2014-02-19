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
/* = STEPS CONTAINER
----------------------------*/
#wiz { margin-bottom: 30px; }
.wizard-steps {
    margin:0px 10px 0px 10px;
    padding:0px;
    position: relative;
    clear:both;
    font-weight: bold;
}
.wizard-steps .step {
    position:relative;
	width:25%;
	padding:8px 0;
}
.wizard-steps div {
    float: left; 
	margin-left: -2px;        
}
/* = STEP NUMBERS
----------------------------*/
.wizard-steps span {
    display: block;
    float: left;
    font-size: 14px;
    text-align:center;
    width:25px;
    margin: -3px 10px 0px 10px;
    line-height:25px;
    color: #666;
    background: #FFF;
    border: 1px solid #EEE;
    -webkit-border-radius:20px;
    -moz-border-radius:120px;
    border-radius:20px;
}
/* = DEFAULT STEPS
----------------------------*/
.wizard-steps a {
	width:80%;
    position:relative;
    display:block;
    height:24px;
    padding:0px 10px 0px 3px;
    float: left;
    font-size:15px;
    line-height:24px;
    color:#666;
    background: #EEE;
    text-decoration:none;
	overflow:hidden;
	padding:6px 0;
}
.wizard-steps .a-before {
    width:0px;
    height:0px;
    border-top: 18px solid #EEE;
    border-bottom: 18px solid #EEE;
    border-left:18px solid transparent;

}
.wizard-steps .a-after {
    width: 0;
    height: 0;
    border-top: 18px solid transparent;
    border-bottom: 18px solid transparent;
    border-left:18px solid #EEE;
	margin-left: 0;
}
 
/* = COMPLETED STEPS
----------------------------*/
 
.wizard-steps .completed-step a {
    color:#FFF;
    background: #3FB618;
	text-shadow: none;
}
.wizard-steps .completed-step .a-before {
    border-top: 18px solid #3FB618;
    border-bottom: 18px solid #3FB618;
}
.wizard-steps .completed-step .a-after {
    border-left: 18px solid #3FB618;
}
.wizard-steps .completed-step span {
    border: 2px solid #3FB618;
    color: #3FB618;
}
/* = ACTIVE STEPS
----------------------------*/
.wizard-steps .active-step a {
    color:#FFF;
    background: #0F82F5;
}
.wizard-steps .active-step .a-before {
    border-top: 18px solid #0F82F5;
    border-bottom: 18px solid #0F82F5;
}
.wizard-steps .active-step .a-after {
    border-left: 18px solid #0F82F5;
}
.wizard-steps .active-step span {
    color: #0F82F5;
    border: 2px solid #0F82F5;
}
@media (max-width: 980px) {
.wizard-steps .a-before { display: none; }
.wizard-steps .a-after { display: none; }
}
@media (max-width: 767px) {
.wizard-steps span { display: none; }
.wizard-steps .a-before { display: none; }
.wizard-steps .a-after { display: none; }
}  
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
<div id="wiz">
<div class="wizard-steps">
    <div class="completed-step step">
        <div class="a-before"></div>
        <a>
            <span>1</span> 
            Permissions
        </a>
        <div class="a-after"></div>
    </div>
    <div class="active-step step">
        <div class="a-before"></div>
        <a>
          <span>2</span> 
          Database Installation
        </a>
        <div class="a-after"></div>
    </div>
    <div class="step">
        <div class="a-before"></div>
        <a>
            <span>3</span> 
            Site Config
        </a>
        <div class="a-after"></div>
    </div>
 
    <div class="step">
        <div class="a-before"></div>
        <a>
            <span>4</span> 
            Done
        </a>
        <div class="a-after"></div>
    </div>
</div>
<div class="clearfix"></div>
</div>
        <h1><?php echo $title; ?>!</h1>
        <p class="lead">Please provide the information to create and setup database tables. Field with * are required.</p>
        <?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
		<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>


		<?php echo validation_errors(); ?>
      <div class="well">
      <?php $attrib = array('class' => 'form-horizontal', 'id' => 'addSale_form'); echo form_open("module=installer&view=setup&step=2", $attrib); ?>

<legend>Database Details:</legend>
<div class="control-group">
  <label class="control-label" for="db_host"><?php echo $this->lang->line("databaseHost"); ?></label>
  <div class="controls"> <?php echo form_input('db_host', (isset($_POST['db_host']) ? $_POST['db_host'] : ''), 'class="span4 tip" title="Enter Database Host. E.G - localhost." id="db_host" required="required" data-error="Database Host is required"');?></div>
</div>
<div class="control-group">
  <label class="control-label" for="db_name"><?php echo $this->lang->line("databaseName"); ?></label>
  <div class="controls"> <?php echo form_input('db_name', (isset($_POST['db_name']) ? $_POST['db_name'] : ''), 'class="span4 tip" title="Enter Database Name." id="db_name" required="required" data-error="Database Name is required"');?></div>
</div>
<div class="control-group">
  <label class="control-label" for="db_user"><?php echo $this->lang->line("databaseUsername"); ?></label>
  <div class="controls"> <?php echo form_input('db_user', (isset($_POST['db_user']) ? $_POST['db_user'] : ''), 'class="span4 tip" title="Enter Database Username." id="db_user" required="required" data-error="Database Username is required"');?></div>
</div>
<div class="control-group">
  <label class="control-label" for="db_password"><?php echo $this->lang->line("databasePassword"); ?></label>
  <div class="controls"> <?php echo form_password('db_password', (isset($_POST['db_password']) ? $_POST['db_password'] : ''), 'class="span4 tip" title="Enter Database Password." id="db_name" required="required" data-error="Database Password is required"');?></div>
</div>
      
      <div class="control-group"><div class="controls"><?php echo form_submit('submit', $this->lang->line("submit"), 'class="btn btn-primary" style="padding: 6px 15px;"');?></div></div>
<?php echo form_close();?>   
      </div>

      <div class="footer">
        <p class="text-center">&copy; 2013 Tecdiary IT Solutions</p>
      </div>

    </div> 
</body>
</html>