$(document).ready(function(){
		
	
				var count = 1;
				var total = 0;
				var an = 1;
				var tax_rate = <?php echo $tax_rate; ?>;
				var tax_type = <?php echo $tax_type; ?>;
				var tax_value = 0;
				var tax_rate2 = <?php echo $tax_rate2; ?>;
				var tax_type2 = <?php echo $tax_type2; ?>;
				var tax_value2;
				var ids = new Array();
				var p_page = 0;
				var page = 0;
				var cat_id = <?php echo DCAT; ?>;
		   		var sproduct_name;
				var slast;
				var total_cp = <?php echo $total_cp; ?>;
				var total_cats = <?php echo $total_cats; ?>;
				var new_tax_rate; var new_tax_type; var old_tax_rate; var old_tax_type;
				add_row();
				loadProducts();
		 
/*-------------------------------------------------------------------------------------------------------------------------*/
function loadProducts() {
$('button[id^="category"]').click(function () {
	if(cat_id != $(this).val()) {	
	$('#gmail_loading').show();
	
	cat_id = $(this).val();
				  		
	$.ajax({
			  type: "get",
			  
			  url: "index.php?module=pos&view=ajaxproducts",
			  data: { category_id: cat_id, per_page: 'n' },
			  dataType: "html",
			  success: function(data) {
					$('#proajax').empty();
					var newPrs = $('<div></div>');
					newPrs.html(data);
			
					newPrs.appendTo("#proajax");
				}
			  
	}).done(function() { 
				
			add_row();
			
			$.ajax({
			  type: "get",
			  async: false,
			  url: "index.php?module=pos&view=total_cp",
			  data: { category_id: cat_id },
			  dataType: "html",
			  success: function(data) {
				
				   total_cp = data;
					
				}
			  
			});	
			
		 	p_page = 'n';
			
		$('#gmail_loading').hide();
	});
	}
});
}
/* ------------------------------------------------------------------------------------------ */	
$('#cnext').click(function () {
	 
 	if (page == 'n') { page = 0 }
	page =  page + <?php echo CLIMIT; ?>;
 	if (total_cats >= <?php echo CLIMIT; ?> && page < total_cats) {

	$('#gmail_loading').show();
	
			
	$.ajax({
			  type: "get",
			  
			  url: "index.php?module=pos&view=poscategories",
			  data: { per_page: page },
			  dataType: "html",
			  success: function(data) {
					$('#cats').empty();
					var newPrs = $('<div></div>');
					newPrs.html(data);
			
					newPrs.appendTo("#cats");
				}
			  
	}).done(function() { 
			loadProducts();
	});
	$('#gmail_loading').hide();
 } else {
	 page = page - <?php echo CLIMIT; ?>;
 }
});
/* ------------------------------------------------------------------------------------------ */	
$('#cprevious').click(function () {
			
	if(page == 'n') { page = 0; }
	
	if (page != 0) {	
	 
	$('#gmail_loading').show();
	
	page =  page - <?php echo CLIMIT; ?>; 
	if(page == 0) { page = 'n' }
		
	$.ajax({
			  type: "get",
			  
			  url: "index.php?module=pos&view=poscategories",
			  data: { per_page: page },
			  dataType: "html",
			  success: function(data) {
					$('#cats').empty();
					var newPrs = $('<div></div>');
					newPrs.html(data);
			
					newPrs.appendTo("#cats");
				}
			  
	}).done(function() { 
			loadProducts();
	});
		 	
		$('#gmail_loading').hide();
	}
			
});	
/* ------------------------------------------------------------------------------------------ */	

/* ------------------------------------------------------------------------------------------ */		
$('#next').click(function () {
	
	
			
	if (p_page == 'n') { p_page = 0 }
	p_page =  p_page + <?php echo PLIMIT; ?>;
 	if (total_cp >= <?php echo PLIMIT; ?> && p_page < total_cp) {
	$('#gmail_loading').show();
	$.ajax({
			  type: "get",
			  
			  url: "index.php?module=pos&view=ajaxproducts",
			  data: { category_id: cat_id, per_page: p_page },
			  dataType: "html",
			  success: function(data) {
					$('#proajax').empty();
					var newPrs = $('<div></div>');
					newPrs.html(data);
			
					newPrs.appendTo("#proajax");
				}
			  
	}).done(function() { 
				
			add_row();
		 	
		$('#gmail_loading').hide();
	});
	
	} else {
	 p_page = p_page - <?php echo PLIMIT; ?>;
 }
});


/*------------------------------------------------------------------------------------------------------------------*/
$('#previous').click(function () {
				
	if(p_page == 'n') { p_page = 0; }
	
	if (p_page != 0) {	
	 
	$('#gmail_loading').show();
	
	p_page =  p_page - <?php echo PLIMIT; ?>; 
	if(p_page == 0) { p_page = 'n' }
			
	$.ajax({
			  type: "get",
			  
			  url: "index.php?module=pos&view=ajaxproducts",
			  data: { category_id: cat_id, per_page: p_page },
			  dataType: "html",
			  success: function(data) {
					$('#proajax').empty();
					var newPrs = $('<div></div>');
					newPrs.html(data);
			
					newPrs.appendTo("#proajax");
				}
			  
	}).done(function() { 
				
			add_row();
		 	
		$('#gmail_loading').hide();
	});
	
	}
});	
		  
/*------------------------------------------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------------------------------------------*/
$("#saletbl").on("click", 'input[id^="product"]', function() {	
	
	var delID=$(this).attr('id');
	var dl_id = delID.split("-");
 	var rw_no = dl_id[1];
	var q1 = $('#quantity-'+rw_no);
	q1.focus();
	return false;
});
$("#saletbl").on("click", 'input[id^="price"]', function() {
	
	var delID=$(this).attr('id');
	var dl_id = delID.split("-");
 	var rw_no = dl_id[1];
	var q1 = $('#quantity-'+rw_no);
	q1.focus();
	return false;
});

$("#saletbl").on("focus", 'select[id^="tax_rate"]', function() {
	old_val = $(this).val();
});
 

$("#saletbl").on("change", 'select[id^="tax_rate"]', function() {
	$('#gmail_loading').show();
	new_val = $(this).val();
	
	$.ajax({
			  type: "get",
			  async: false,
			  url: "index.php?module=pos&view=tax_rates",
			  data: { id: new_val, old_id: old_val },
			  dataType: "json",
			  success: function(data) {
					 new_tax_rate = parseFloat(data.new_tax_rate);
					 new_tax_type = parseFloat(data.new_tax_type);
					 old_tax_rate = parseFloat(data.old_tax_rate);
					 old_tax_type = parseFloat(data.old_tax_type);
				},
			error: function(){
       			alert('<?php echo $this->lang->line('tax_request_failed'); ?>');
				return false;
    		}
			  
	});
	var delID=$(this).attr('id');
	var dl_id = delID.split("-");
 	var rw_no = dl_id[1];
	var p = '#price-'+rw_no;
	var row_price = parseFloat($.trim($(p).val()));
	
		 if(new_tax_type == 2){ new_pr_tax_rate = new_tax_rate; }
			if(new_tax_type == 1){ new_pr_tax_rate = (row_price*new_tax_rate)/100; }
			
			if(old_tax_type == 2){ old_pr_tax_rate = old_tax_rate; }
			if(old_tax_type == 1){ old_pr_tax_rate = (row_price*new_tax_rate)/100; }
			
			
			tax_value -= old_tax_rate;
			tax_value += new_tax_rate;
			
			current_tax = parseFloat(tax_value).toFixed(2);
			
		 var g_total = total + tax_value + tax_value2;
		 grand_total = parseFloat(g_total).toFixed(2);
			
		 $("#total-payable").empty();
		 $("#tax").empty();
		  $("#total-payable").append(grand_total);
		 $("#tax").append(current_tax);
		 
		 old_val = $(this).val();
		 $('#gmail_loading').hide();
		 
});

		  
$("#saletbl").on("click", 'button[class^="del_row"]', function() {
		 	
			var delID=$(this).attr('id');
			
			var dl_id = delID.split("-");
 			var rw_no = dl_id[1];
			
			var p1 = $('#price-'+rw_no);
			var q1 = $('#quantity-'+rw_no);
			var t1 = $('#tax_rate-'+rw_no);
			var t1_val = t1.val();
			
			
			$.ajax({
				  type: "get",
				  async: false,
				  url: "index.php?module=pos&view=tax_rates",
				  data: { id: t1_val },
				  dataType: "json",
				  success: function(data) {
						 new_tax_rate = parseFloat(data.new_tax_rate);
						 new_tax_type = parseFloat(data.new_tax_type);
					},
				error: function(){
					alert('<?php echo $this->lang->line('tax_request_failed'); ?>');
					return false;
				}
				  
			});
	
			var row_price = parseFloat(p1.val());
			var row_quantity = parseInt(q1.val());


			
			total = total - row_price;
			current = parseFloat(total).toFixed(2);	 
				 
		 count = count - row_quantity;
		 
		 if(isNaN(count)) {  
		 	alert('<?php echo $this->lang->line('pos_error'); ?>');  
			count = parseInt(count);
			$('#cancel').trigger('click'); 
			return false; 
		}
		 if(isNaN(current)) {  
		 	alert('<?php echo $this->lang->line('pos_error'); ?>');
			total = parseInt(total);
			$('#cancel').trigger('click');  
			return false; 
		}
		 
		 if(new_tax_type == 2){ new_pr_tax_rate = new_tax_rate; }
		 if(new_tax_type == 1){ new_pr_tax_rate = (row_price*new_tax_rate)/100; }
		 
		 tax_value -= new_pr_tax_rate;
			
		 current_tax = parseFloat(tax_value).toFixed(2);
		 
		 if(tax_type2 == 2){ tax_value2 = tax_rate2; }
			if(tax_type2 == 1){ tax_value2 = (total*tax_rate2)/100; }
			current_tax2 = parseFloat(tax_value2).toFixed(2);
			
		 var g_total = total + tax_value + tax_value2;
		 grand_total = parseFloat(g_total).toFixed(2);
			
		 $("#total-payable").empty();
		 $("#total").empty();
		 $("#count").empty();
		 $("#tax").empty();
		 $("#tax2").empty();
		  $("#total-payable").append(grand_total);
		 $("#total").append(current);
		 $("#count").append(count);
		 $("#tax").append(current_tax);
		 $("#tax2").append(current_tax2);
		 
		 
		 an--;
	
		 row_id = $("#row_"+rw_no);
		 row_id.remove();
				
});

$("#saletbl").on("focus", ".keyboard", function() {
key_pad();
});


function add_row() {
	$('button[id^="product"]').click(function () {
			
	  
			if(count>=1000) {
				 alert("<?php echo $this->lang->line('qty_limit'); ?>");
				 return false;
			}
			
			if(an >= 51){
				  alert("<?php echo $this->lang->line('max_pro_reached'); ?>");
				  $('#gmail_loading').hide();
					
					var divElement = document.getElementById('protbldiv');
					 divElement.scrollTop = divElement.scrollHeight;
				  return false;
			}
			
		$('#gmail_loading').show();		
		  
			var v = $(this).val();

			$.ajax({
			  type: "get",
			  async: false,
			  url: "index.php?module=pos&view=price",
			  data: { code: v },
			  dataType: "json",
			  success: function(data) {
				
				  item_price = parseFloat(data);
					
				}
			  
			});
			
			
			var leng=$(this).attr('id').length;
			var last = $(this).attr('id').substr(leng-4);
			var pric='price'+last;
			var quan='quantity'+last;
			var code='code'+last;

			var pr_name = $(this).parent().text();
			var prod_name = $.trim(pr_name);
			
			var newTr = $('<tr id="row_'+ count + last +'"></tr>');
			newTr.html('<td id="satu" style="text-align:center; width: 27px;"><button type="button" class="del_row" id="del-'+ count + last +'" value="'+ item_price +'">  </button></td><td><input type="text" class="code" name="product'+ count +'" value="'+ prod_name +'" id="product-'+ count + last +'"></td><td style="text-align:center;"><input class="keyboard" name="quantity'+ count +'" type="text" value="1" id="quantity-'+ count + last +'"></td><td><select class="chzn-select tax" name="tax_rate'+ count +'" id="tax_rate-'+ count + last +'"><?php
				foreach($tax_rates as $tax) {
					echo "<option value=" . $tax->id;
					if($tax->id == DEFAULT_TAX) { echo ' selected="selected"'; }
					echo ">" . $tax->name . "</option>";
				}
			?></select></td><td style="padding-right: 10px; text-align:right;"><input type="text" class="price" name="unit_price'+ count +'" value="'+ parseFloat(item_price).toFixed(2) +'" id="price-'+ count + last +'"></td>');
			
			newTr.appendTo("#saletbl");
			 
		 	total += item_price;
			current = parseFloat(total).toFixed(2);
			
			if(tax_type == 2){ new_tax_value = tax_rate; }
			if(tax_type == 1){ new_tax_value = (item_price*tax_rate)/100; }
			tax_value += new_tax_value;
			
			current_tax = parseFloat(tax_value).toFixed(2);
			
			if(tax_type2 == 2){ tax_value2 = tax_rate2; }
			if(tax_type2 == 1){ tax_value2 = (total*tax_rate2)/100; }
			current_tax2 = parseFloat(tax_value2).toFixed(2);
			
		 var g_total = total + tax_value + tax_value2;
		 grand_total = parseFloat(g_total).toFixed(2);
			
		 $("#total-payable").empty();
		 $("#total").empty();
		 $("#count").empty();
		 $("#tax").empty();
		 $("#tax2").empty();
		  $("#total-payable").append(grand_total);
		 $("#total").append(current);
		 $("#count").append(count);
		 $("#tax").append(current_tax);
		 $("#tax2").append(current_tax2);

			
		count++;
		an++;
		var divElement = document.getElementById('protbldiv');
		 divElement.scrollTop = divElement.scrollHeight;

		 $('#gmail_loading').hide(); 
		 

		 });
		 		 
}
	  
function key_pad() { 

	
	$('.keyboard').keyboard({
			restrictInput: true,
			preventPaste: true,
			autoAccept: true,
		   alwaysOpen: false,
		   openOn       : 'click',
			layout: 'costom',
		  display: {
				'a'     : '\u2714:Accept (Shift-Enter)', 
				'accept': 'Accept:Accept (Shift-Enter)',
				'b'     : '\u2190:Backspace', 
				'bksp'  : 'Bksp:Backspace',
				'c'     : '\u2716:Cancel (Esc)', 
				'cancel': 'Cancel:Cancel (Esc)',
			'clear'  : 'C:Clear'
		
			},
		   
			position     : {
				of : null, 
				my : 'center top',
				at : 'center top',
				at2: 'center bottom' 
			  },
		
		  usePreview   : false,
		  
			customLayout: {
				'default': [
				  '1 2 3 {b}',
				  '4 5 6 {clear}',
				  '7 8 9 0',
				  '{accept} {cancel}'
					]
			},
	beforeClose : function(e, keyboard, el, accepted) {		
	var before_qty = parseInt(keyboard.originalContent);
	var after_qty = parseInt(el.value);
	
	var row_id = $(this).attr('id');
			  
			
			var sp_id = row_id.split("-");
 			var id_no = sp_id[1];
			var p = '#price-'+id_no;
		
				 var row_price = parseFloat($.trim($(p).val()));
				 
				 if(before_qty == 1) { product_price =  row_price; }
				 if(before_qty > 1) { product_price = (row_price /  before_qty ); }
				 

			var gross_total = after_qty * product_price;
			
			var b_count = (count - before_qty);
			var a_count = (b_count + after_qty);
			count = a_count;
			
			
			var b_total = (total - row_price);
			var a_total = (b_total + gross_total);
			total = a_total;
			
			
			gross_total = parseFloat(gross_total).toFixed(2);
			$(p).val(gross_total);
			current = parseFloat(total).toFixed(2);
			
		 if(tax_type == 2){ tax_value = tax_rate; }
		 if(tax_type == 1){ tax_value = (total*tax_rate)/100; }
			
		 current_tax = parseFloat(tax_value).toFixed(2);
		 
		 if(tax_type2 == 2){ tax_value2 = tax_rate2; }
			if(tax_type2 == 1){ tax_value2 = (total*tax_rate2)/100; }
			current_tax2 = parseFloat(tax_value2).toFixed(2);
			
		 var g_total = total + tax_value + tax_value2;
		 grand_total = parseFloat(g_total).toFixed(2);
			
		 $("#total-payable").empty();
		 $("#total").empty();
		 $("#count").empty();
		 $("#tax").empty();
		 $("#tax2").empty();
		  $("#total-payable").append(grand_total);
		 $("#total").append(current);
		 $("#count").append(count-1);
		 $("#tax").append(current_tax);
		 $("#tax2").append(current_tax2);
		 
	}
		});
			
		
}	


$('.customer').focus(function() {
  $(this).val('');
 
});

$('#scancode').keydown(function(e){
			if(e.keyCode == 13){
				
			if(count>=1000) {
				 alert("<?php echo $this->lang->line('qty_limit'); ?>");
				 return false;
			}
			if(an >= 51){
				  alert("<?php echo $this->lang->line('max_pro_reached'); ?>");
				  $('#gmail_loading').hide();
					
					var divElement = document.getElementById('protbldiv');
					 divElement.scrollTop = divElement.scrollHeight;
				  return false;
			}
			
			
				
			$('#gmail_loading').show();
		  
			var v = $(this).val();
			
			
			$.ajax({
			  type: "get",
			  async: false,
			  url: "index.php?module=pos&view=scan_product",
			  data: { code: v },
			  dataType: "json",
			  success: function(data) {
				
				  item_price = parseFloat(data.item_price).toFixed(2);
				  sproduct_name = data.product_name;
				  slast = data.last;
					
				},
			error: function(){
       			alert('<?php echo $this->lang->line('code_error'); ?>');
				item_price = false;
    		}
			  
			});
			
			if(item_price == false) { $(this).val(''); $('#gmail_loading').hide(); return false; }
			
			var newTr = $('<tr id="row_'+ count + slast +'"></tr>');
			newTr.html('<td id="satu" width="29px" style="text-align:center;"><button class="del_row" id="del-'+ count + slast +'" value="'+ item_price +'"> </button></td><td width="144px"><input type="text" class="code" name="product'+ count +'" value="'+ sproduct_name +'" id="product-'+ count + slast +'" /></td><td width="44px" style="text-align:center;"><input class="keyboard" name="quantity'+ count +'" type="text" value="1" id="quantity-'+ count + slast +'" /></td><td><select class="chzn-select tax" name="tax_rate'+ count +'" id="tax_rate-'+ count + slast +'"><?php
				foreach($tax_rates as $tax) {
					echo "<option value=" . $tax->id;
					if($tax->id == DEFAULT_TAX) { echo ' selected="selected"'; }
					echo ">" . $tax->name . "</option>";
				}
			?></select></td><td style="width: 76px; padding-right: 10px; text-align:right;"><input type="text" class="price" name="price'+ count +'" value="'+ item_price +'" id="price-'+ count + slast +'" /></td>');
			
			newTr.appendTo("#saletbl");
		 
		 	total += parseFloat(item_price);
			current = parseFloat(total).toFixed(2);
			
		 if(tax_type == 2){ tax_value = tax_rate; }
		 if(tax_type == 1){ tax_value = (total*tax_rate)/100; }
			
		 current_tax = parseFloat(tax_value).toFixed(2);
		 
		 if(tax_type2 == 2){ tax_value2 = tax_rate2; }
			if(tax_type2 == 1){ tax_value2 = (total*tax_rate2)/100; }
			current_tax2 = parseFloat(tax_value2).toFixed(2);
			
		 var g_total = total + tax_value + tax_value2;
		 grand_total = parseFloat(g_total).toFixed(2);
			
		 $("#total-payable").empty();
		 $("#total").empty();
		 $("#count").empty();
		 $("#tax").empty();
		 $("#tax2").empty();
		  $("#total-payable").append(grand_total);
		 $("#total").append(current);
		 $("#count").append(count);
		 $("#tax").append(current_tax);
		 $("#tax2").append(current_tax2);
		 
	
		count++;
		an++;
			
		var divElement = document.getElementById('protbldiv');
		divElement.scrollTop = divElement.scrollHeight;


				
		$(this).val('');	
		$('#gmail_loading').hide(); 
		e.preventDefault();
		return false;
		}
			
			
});

$("#cancel").click(function() {
	$("#saletbl").empty();
	count =1;
	total = 0;
	tax_value = 0;
	tax_value2 = 0;
	an = 1;
	current = parseFloat(total).toFixed(2);
	 current_tax = parseFloat(tax_value).toFixed(2);
	 
	var g_total = total + tax_value;
		 grand_total = parseFloat(g_total).toFixed(2);
			
		 $("#total-payable").empty();
		 $("#total").empty();
		 $("#count").empty();
		 $("#tax").empty();
		 $("#tax2").empty();
		  $("#total-payable").append(grand_total);
		 $("#total").append(current);
		 $("#count").append(count-1);
		 $("#tax").append(current_tax);
		 $("#tax2").append(current_tax);
});

$("#payment").click(function() {
	$("#paymentdiv").empty();
	var twt = total + tax_value + tax_value2;
count = count - 1;
	if(isNaN(twt) || twt == 0) {  
		 	alert('<?php echo $this->lang->line('x_total'); ?>');  
			return false; 
		}
	twt = parseFloat(twt).toFixed(2);
	newPTDiv = $('<div style="padding: 10px;"></div>');
	newPTDiv.html('<h3 style="line-height: 2em;">Total Payable Amount: <span style="background: #FFFF99; padding: 5px 10px; text-weight: bold; color: #000;">'+ twt +'</span><br />Total Purchased Items: <span style="background: #FFFF99; text-weight: bold; padding: 5px 10px; color: #000;">'+ count +'</span></h3><h3>Paid by: <select name="paid_by" id="paid_by" class="chzn-select" style="width: 250px;"><option value="cash">Cash</option><option value="CC">Credit Card</option><option value="Cheque">Cheque</option></select></h3><div id="pcash"><h3>Paid:<input type="text" id="paid-amount"style="border: 1px solid #CCC; padding: 3px;" /></h3><h3>Return Change: <span style="background: #FFFF99; padding: 5px 10px; text-weight: bold; color: #000;" id="balance"></span></h3></div><button style="-moz-box-shadow:inset 0px 1px 0px 0px #caefab; -webkit-box-shadow:inset 0px 1px 0px 0px #caefab; box-shadow:inset 0px 1px 0px 0px #caefab; 	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77d42a), color-stop(1, #5cb811) ); background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% ); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#77d42a\', endColorstr=\'#5cb811\'); background-color:#77d42a; border:1px solid #268a16; display:inline-block; color:#306108; padding: 10px 20px; font-weight:bold; text-decoration:none; text-shadow:1px 1px 0px #aade7c; cursor: pointer;" id="submit-sale">Submit Sale</button>');
	
	newPTDiv.appendTo("#paymentdiv");
	
	$('#ptclick').trigger('click');
count = count + 1;

$("#paid_by").change(function () {

	var p_val = $(this).val();
	if(p_val == 'cash') {

	$('#pcash').show();
	
	$('input[id^="paid-amount"]').keydown(function(e){		
			paid = $(this).val();
			if(e.keyCode == 13){
				if(paid < total) { 
				alert('<?php echo $this->lang->line('paid_l_t_payable'); ?>'); 
				return false; }
				$("#balance").empty();
				var balance = paid - twt;
				balance = parseFloat(balance).toFixed(2);
				$("#balance").append(balance);
				
				e.preventDefault();
				return false;
			}
	});
	
	} else { 

		$('#pcash').hide();
		
	}
	
$('#rpaidby').val(p_val);

});

$('#paid-amount').keyboard({
			restrictInput: true,
			preventPaste: true,
			autoAccept: true,
		   alwaysOpen: false,
		   openOn       : 'click',
			layout: 'costom',
		  display: {
				'a'     : '\u2714:Accept (Shift-Enter)', 
				'accept': 'Accept:Accept (Shift-Enter)',
				'b'     : '\u2190:Backspace', 
				'bksp'  : 'Bksp:Backspace',
				'c'     : '\u2716:Cancel (Esc)', 
				'cancel': 'Cancel:Cancel (Esc)',

			'clear'  : 'C:Clear'
		
			},
		   
			position     : {
				of : null, 
				my : 'center top',
				at : 'center top',
				at2: 'center bottom'
			  },
		
		
		  usePreview   : false,
		  
			customLayout: {
				'default': [
				  '1 2 3 {clear}',
				  '4 5 6 .',
				  '7 8 9 0',
				  '{accept} {cancel}'
					]
			},
			beforeClose : function(e, keyboard, el, accepted) {		
				
				var paid = parseFloat(el.value);
				if(paid < twt) { 
				alert('Paid amount is less than the payable amount.'); 
				$(this).val('');
				
				return false; }
				$("#balance").empty();
				var balance = paid - twt;
				balance = parseFloat(balance).toFixed(2);
				$("#balance").append(balance);
			}
});
	
$('#submit-sale').click(function() {
	<?php if($sid) { ?>
	suspend = $('<span></span>');	
	suspend.html('<input type="hidden" name="delete_id" value="<?php echo $sid; ?>" />');
	suspend.appendTo("#hidesuspend");
	<?php } ?>
		gotit = confirm('Are you sure you want to add Sale?'); 
			if(gotit) {
				$('#submit').trigger('click');
			} else {
				return false;
			}
			
});


});
	
$('#close').click(function(){
    $(".yellow_bar").hide();
});	

/* -------------------------------------- */

$('#suspend').click(function() {
	suspend = $('<span></span>');	
	suspend.html('<input type="hidden" name="count" value="'+ count +'" /><input type="hidden" name="suspend" value="yes" />');
	suspend.appendTo("#hidesuspend");
	
	gotit = confirm('Are you sure you want to suspend Sale?'); 
			if(gotit) {
				$('#submit').trigger('click');
			} else {
				return false;
			}
	
  });
/* -------------------------------------- */	
<?php if($sid) { ?>

$.ajax({
			  type: "post",
			  async: false,
			  dataType: "json",
			  url: "index.php?module=pos&view=load_suspended_bill",
			  data: { id: <?php echo $sid; ?> },
			  success: function(data) {
				 if(data != null) {
					  if(data.sale_data != "undefined") { sale_data = unescape(data.sale_data); } else { sale_data = "<tbody></tbody>"; }
					  if(data.count != null) { sale_count = parseInt(data.count); } else { sale_count = 1; }
					  if(data.tax1 != null) { sale_tax1 = parseFloat(data.tax1); } else { sale_tax1 = 0; }
					  if(data.tax2 != null) { sale_tax2 = parseFloat(data.tax2); } else { sale_tax2 = 0; }
					  if(data.total != null) { sale_total = parseFloat(data.total); } else { sale_total = 0; }
				  } else {
					sale_data = "<tbody></tbody>";
					sale_count = 1;
					sale_tax1 = 0;
					sale_tax2 = 0;
					sale_total = 0;
				  }
				},
			  error: function() {
				sale_data = "<tbody></tbody>";
				sale_count = 1;
				sale_tax1 = 0;
				sale_tax2 = 0;
				sale_total = 0;
				}
				
	});
	
 	$("#saletbl").html( sale_data );
	
	count = sale_count;
	total = sale_total;
	tax_value = sale_tax1;
	tax_value2 = sale_tax2;
	current = parseFloat(total).toFixed(2);
	 current_tax = parseFloat(tax_value).toFixed(2);
	 current_tax2 = parseFloat(tax_value2).toFixed(2);
	 
	var g_total = sale_total + sale_tax1 + sale_tax2;
		 grand_total = parseFloat(g_total).toFixed(2);
	
	$("#total-payable").empty();
		 $("#total").empty();
		 $("#count").empty();
		 $("#tax").empty();
		 $("#tax2").empty();
		  $("#total-payable").append(grand_total);
		 $("#total").append(current);
		 $("#count").append(count-1);
		 $("#tax").append(current_tax);
		 $("#tax2").append(current_tax2);
		 

<?php } ?>
});	

	
$(function() {
    setTimeout(function() {
        $(".yellow_bar").hide('blind', {}, 500)
    }, 5000);
});

document.onkeypress = function (e) { 
  if(e.keyCode == 27){
	  window.location = "<?php echo base_url(); ?>";
	  return false;
   }
};
<?php if(DTIME == "yes") { ?>
function sivamtime() {
now=new Date();
var month_names = new Array ( );
month_names[month_names.length] = "January";
month_names[month_names.length] = "February";
month_names[month_names.length] = "March";
month_names[month_names.length] = "April";
month_names[month_names.length] = "May";
month_names[month_names.length] = "June";
month_names[month_names.length] = "July";
month_names[month_names.length] = "August";
month_names[month_names.length] = "September";
month_names[month_names.length] = "October";
month_names[month_names.length] = "November";
month_names[month_names.length] = "December";

var day_names = new Array ( );
day_names[day_names.length] = "Sunday";
day_names[day_names.length] = "Monday";
day_names[day_names.length] = "Tuesday";
day_names[day_names.length] = "Wednesday";
day_names[day_names.length] = "Thursday";
day_names[day_names.length] = "Friday";
day_names[day_names.length] = "Saturday";
 
  hour=now.getHours();
  min=now.getMinutes();
  sec=now.getSeconds();

if (min<=9) { min="0"+min; }
if (sec<=9) { sec="0"+sec; }
if (hour>12) { hour=hour-12; add="PM"; }
else { hour=hour; add="AM"; }
if (hour==12) { add="PM"; }

time = day_names[now.getDay()]+", "+now.getDate()+" "+month_names[now.getMonth()]+" "+now.getFullYear()+", "+((hour<=9) ? "0"+hour : hour) + ":" + min + ":" + sec + " " + add;

if (document.getElementById) { document.getElementById('theTime').innerHTML = time; }
else if (document.layers) {
 document.layers.theTime.document.write(time);
 document.layers.theTime.document.close(); }

setTimeout("sivamtime()", 1000);
}
window.onload = sivamtime;
<?php } ?>