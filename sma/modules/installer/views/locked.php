<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-blue.css" rel="stylesheet">
<style>
.error-box {
	color: #999;
	font-weight: 600;
	margin-top: 100px;
	text-align: center;
}
.error-box .message-small {
	font-size: 20px;
	line-height:24px;
}
.error-box .message-big {
	font-size: 80px;
	line-height: 100px;
	color:#CCC;
	text-shadow: 1px 1px 1px #666, 0 0 2px #333;
}
</style>
<script>
function goBack()
  {
  window.history.back()
  }
</script>
</head>

<body>
<div class="row-fluid">
<div class="span8 offset2">
  <div class="error-box">
    <div class="message-small">Installer is</div>
    <div class="clearfix"></div>
    <div class="message-big">Locked!</div>
    <div class="clearfix"></div>
    <div class="message-small">Please contact your developer.</div>
    <div class="clearfix" style="height:30px;"></div>
    <a class="btn btn-large btn-success" href="http://www.tecdiary.net/support/sma-guide/send_request.php" target="_blank"> <i class="icon-envelope icon-white"></i> Contact Support </a>
     <div class="clearfix"></div>
    <div style="margin-top: 30px"> <a onClick="goBack()" class="btn btn-info"> <i class="icon-arrow-left icon-white"></i> Go Back </a> <a href="<?php echo base_url(); ?>" class="btn btn-primary"> <i class="icon-home icon-white"></i> Homepage </a></div>
  </div>
</div>
</div>
</body>
</html>
