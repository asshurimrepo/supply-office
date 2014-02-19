</div>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>
<div class="clearfix"></div>
<div id="footer">
  <div class="container">
    <p class="credit">Copyright &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> v<?php echo VERSION; ?> - Page rendered in {elapsed_time} seconds. 
    <!--<a href="http://tecdiary.net/support/sma-guide/" target="_blank" class="tip" title="<?php echo $this->lang->line('help'); ?>"><i class="icon-question-sign"></i></a>-->
    </p>   
  </div>
</div>

<?php if(THEME == 'rtl') { ?>
<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap-rtl.js"></script> 
<?php } else { ?>
<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap.min.js"></script> 
<?php } ?>
<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap-fileupload.js"></script> 
<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url(); ?>assets/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" charset="utf-8" src="<?php echo $this->config->base_url(); ?>assets/media/js/ZeroClipboard.js"></script> 
<script type="text/javascript" charset="utf-8" src="<?php echo $this->config->base_url(); ?>assets/media/js/TableTools.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->base_url(); ?>assets/js/DT_bootstrap.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/chosen.jquery.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/respond.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/rwd-table.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/redactor.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url(); ?>assets/js/bootbox.min.js"></script>
</body></html>