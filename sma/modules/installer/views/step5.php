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
	width:20%;
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
    font-size: 10px;
    text-align:center;
    width:15px;
    margin: 2px 5px 0px 5px;
    line-height:15px;
    color: #666;
    background: #FFF;
    border: 1px solid #EEE;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
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
    font-size:13px;
    line-height:24px;
    color:#666;
    background: #EEE;
    text-decoration:none;
	overflow:hidden;
}
.wizard-steps .a-before {
    width:0px;
    height:0px;
    border-top: 12px solid #EEE;
    border-bottom: 12px solid #EEE;
    border-left:12px solid transparent;

}
.wizard-steps .a-after {
    width: 0;
    height: 0;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent;
    border-left:12px solid #EEE;
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
    border-top: 12px solid #3FB618;
    border-bottom: 12px solid #3FB618;
}
.wizard-steps .completed-step .a-after {
    border-left: 12px solid #3FB618;
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
    border-top: 12px solid #0F82F5;
    border-bottom: 12px solid #0F82F5;
}
.wizard-steps .active-step .a-after {
    border-left: 12px solid #0F82F5;
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
    <div class="completed-step step">
        <div class="a-before"></div>
        <a>
          <span>2</span> 
          Database Installation
        </a>
        <div class="a-after"></div>
    </div>
    <div class="completed-step step">
        <div class="a-before"></div>
        <a>
            <span>3</span> 
            Site Config
        </a>
        <div class="a-after"></div>
    </div>
    <div class="completed-step step">
        <div class="a-before"></div>
        <a>
            <span>4</span> 
            Owner Account
        </a>
        <div class="a-after"></div>
    </div>
    <div class="active-step step">
        <div class="a-before"></div>
        <a>
            <span>5</span> 
            Done
        </a>
        <div class="a-after"></div>
    </div>
</div>
<div class="clearfix"></div>
</div>
        <h1><?php echo $title; ?>!</h1>
        <p class="lead">&nbsp;</p>
        <?php if($this->session->flashdata('success_message')) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $this->session->flashdata('success_message') . "</div>"; } ?>

		<?php echo validation_errors(); ?>
      <div class="well">
      <p class="text-info">If you haven't validate your purchase and not register for Free support, You can register a account with us anytime at http://tecdiary.com/support </p>
      <p class="text-error">You will not get any reply for your messages/emails untill you have not register with us.</p>
      <p class="text-success">Thank you for purchasing the script. Please don't forget to rate it on download page of CodeCanyon.net and send us your feedback to improve the script.</p>
      <a href="<?php echo base_url(); ?>" class="btn btn-primary"><i class="icon-home icon-white"></i> Homepage</a>
      
      </div>

      <div class="footer">
        <p class="text-center">&copy; 2013 Tecdiary IT Solutions</p>
      </div>

    </div> 
</body>
</html>