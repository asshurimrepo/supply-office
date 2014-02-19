
<style type="text/css">
#fileData th, #fileData td { text-align:center;}			
</style>
<script>
             $(document).ready(function() {
                function format_date(oObj) {
					//var sValue = oObj.aData[oObj.iDataColumn]; 
					var aDate = oObj.split('-');
					<?php if(JS_DATE == 'dd-mm-yyyy') { ?>
					return aDate[2] + "-" + aDate[1] + "-" + aDate[0];
					<?php } elseif(JS_DATE == 'dd/mm/yyyy') { ?>
					return aDate[2] + "/" + aDate[1] + "/" + aDate[0];
					<?php } elseif(JS_DATE == 'mm/dd/yyyy') { ?>
					return aDate[1] + "/" + aDate[2] + "/" + aDate[0];
					<?php } elseif(JS_DATE == 'mm-dd-yyyy') { ?>
					return aDate[1] + "-" + aDate[2] + "-" + aDate[0];
					<?php } else { ?>
					return sValue;
					<?php } ?>
				}
				function currencyFormate(x) {
					var parts = x.toString().split(".");
				   return  parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",")+(parts[1] ? "." + parts[1] : ".00");
					 
				}
                $('#fileData').dataTable( {
					"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aaSorting": [[ 0, "desc" ]],
                    "iDisplayLength": <?php echo ROWS_PER_PAGE; ?>,
					'bProcessing'    : true,
					'bServerSide'    : true,
					'sAjaxSource'    : '<?php echo base_url(); ?>index.php?module=pos&view=getSuspendedSales',
					'fnServerData': function(sSource, aoData, fnCallback, fnFooterCallback)
					{
						aoData.push( { "name": "<?php echo $this->security->get_csrf_token_name(); ?>", "value": "<?php echo $this->security->get_csrf_hash() ?>" } );
					  $.ajax
					  ({
						'dataType': 'json',
						'type'    : 'POST',
						'url'     : sSource,
						'data'    : aoData,
						'success' : fnCallback
					  });
					},
					"oTableTools": {
						"sSwfPath": "assets/media/swf/copy_csv_xls_pdf.swf",
						"aButtons": [
								// "copy",
								"csv",
								"xls",
								{
									"sExtends": "pdf",
									"sPdfOrientation": "landscape",
									"sPdfMessage": ""
								},
								"print"
						]
					},
					"aoColumns": [ 
					 { "mRender": format_date }, null, null, { "mRender": currencyFormate }, { "mRender": currencyFormate }, { "mRender": currencyFormate }, { "mRender": currencyFormate },
					  { "bSortable": false }
					]
					
                } );
				
            } );
                    
</script>
<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>
  <h3 class="title"><?php echo $page_title; ?></h3>
	<p class="introtext"><?php echo $this->lang->line("list_results"); ?></p>
<div class="row-fluid">	
<table id="fileData" class="table table-bordered table-hover table-striped table-condensed" style="margin-bottom: 5px;">
		<thead>
        <tr>
            <th><?php echo $this->lang->line("date"); ?></th>
            <th><?php echo $this->lang->line("customer"); ?></th>
            <th><?php echo $this->lang->line("items"); ?></th>
            <th><?php echo $this->lang->line("product_tax"); ?></th>
            <th><?php echo $this->lang->line("invoice_tax"); ?></th>
            <th><?php echo $this->lang->line("discount"); ?></th>
            <th><?php echo $this->lang->line("total"); ?></th>
            <th style="width:105px; text-align:center;"><?php echo $this->lang->line("actions"); ?></th>
		</tr>
        </thead>
		<tbody>
			<tr>
            	<td colspan="8" class="dataTables_empty">Loading data from server</td>
			</tr>
        </tbody>
	</table>
 </div> 
      <div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
  </div>
  
  <div style="clear:both;"></div>
</div>
<div id="gmail_loading" style="display: none;">
<div class="blackbg"></div>
<div class="gmailLoader">
<img src="<?php echo $this->config->base_url(); ?>assets/pos/images/gmail-loader.gif" alt="Loading ..." /> <?php echo $this->lang->line('loading'); ?> 
</div>
</div>
