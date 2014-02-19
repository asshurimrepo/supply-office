<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos extends MX_Controller {

/*
| -----------------------------------------------------
| PRODUCT NAME: 	SIMPLE POS
| -----------------------------------------------------
| AUTHER:			MIAN SALEEM 
| -----------------------------------------------------
| EMAIL:			saleem@tecdiary.com 
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY TECDIARY IT SOLUTIONS
| -----------------------------------------------------
| WEBSITE:			http://tecdiary.net
| -----------------------------------------------------
|
| MODULE: 			POS
| -----------------------------------------------------
| This is sales module controller file.
| -----------------------------------------------------
*/

	 
	function __construct()
	{
		parent::__construct();
		
		// check if user logged in 
		if (!$this->ion_auth->logged_in())
	  	{
			redirect('module=auth&view=login');
	  	}
		$this->load->library('form_validation');
		$this->load->model('pos_model');
		$pos_setting = $this->pos_model->getSetting();
		define("CLIMIT", $pos_setting->cat_limit);
		define("PLIMIT", $pos_setting->pro_limit);
		define("DCAT", $pos_setting->default_category);
		define("DCUS", $pos_setting->default_customer);
		define("DBILLER", $pos_setting->default_biller);
		define("DTIME", $pos_setting->display_time);
		
		$this->lang->load('pos', LANGUAGE);
	}


/* -------------------------------------------------------------------------------------------------------------------------------- */ 
//Add new pos sale

   function index()
   {
	   	if( $this->input->get('suspend_id') ) { $data['sid'] = $this->input->get('suspend_id'); } else { $data['sid'] = NULL; }
		if( $this->input->post('delete_id') ) { $did = $this->input->post('delete_id'); } else { $did = NULL; }
		if( $this->input->post('suspend') ) { $suspend = TRUE; } else { $suspend = FALSE; }
		if( $this->input->post('count') ) { $count = $this->input->post('count'); $count = $count - 1; } 
		
		$groups = array('purchaser', 'viewer');
		if ($this->ion_auth->in_group($groups))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=sales', 'refresh');
		}
		
		//validate form input
		$this->form_validation->set_rules('customer', $this->lang->line("customer"), 'trim|required|xss_clean');

		$quantity = "quantity";
		$product = "product";
		$unit_price = "price";
		$tax_rate = "tax_rate";
		$sl = "serial";
		$dis = "discount";
			
		if ($this->form_validation->run() == true)
		{
			$date = date('Y-m-d');
			$reference_no = $this->pos_model->getNextAI();
			$paid_by = $this->input->post('rpaidby');
			$count = $this->input->post('count'); $count = $count - 1;
			$warehouse_id = DEFAULT_WAREHOUSE;
			$biller_id = DBILLER;
			$biller_details = $this->pos_model->getBillerByID($biller_id);
			$biller_name = $biller_details->name;
			
			if($customer_details = $this->pos_model->getCustomerByName($this->input->post('customer'))) {
				$customer_id = $customer_details->id;
				$customer_name = $customer_details->name;
			} else { 
				$customer_details = $this->pos_model->getCustomerByName(DCUS);
				$customer_id = $customer_details->id;
				$customer_name = $customer_details->name;
			}
			
			if(DISCOUNT_OPTION == 1) { $inv_discount = DEFAULT_DISCOUNT; }
			if(TAX2) {  $tax_rate2 = DEFAULT_TAX2; }
			
			$inv_total_no_tax = 0;

				for($i=1; $i<=500; $i++){
					if( $this->input->post($quantity.$i) && $this->input->post($product.$i) && $this->input->post($unit_price.$i) ) {
						
						if(TAX1) { 
							$tax_id = $this->input->post($tax_rate.$i);
							$tax_details = $this->pos_model->getTaxRateByID($tax_id);
							$taxRate = $tax_details->rate;
							$taxType = $tax_details->type;	
							$tax_rate_id[] = $tax_id;	
							
							if($taxType == 1 && $taxRate != 0) {
							$item_tax = (($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)) * $taxRate / 100);
							$val_tax[] = $item_tax;
							} else {
							$item_tax = $taxRate;	
							$val_tax[] = $item_tax;
							}
							
							if($taxType == 1) { $tax[] = $taxRate."%"; } else { $tax[] = $taxRate;  }			
						} else {
							$item_tax = 0;
							$tax_rate_id[] = 0;
							$val_tax[] = 0;
							$tax[] = "";
						}
						
						if(DISCOUNT_METHOD == 1 && DISCOUNT_OPTION == 2) {
						
							$discount_id = $this->input->post($dis.$i);
							$ds_details = $this->pos_model->getDiscountByID($discount_id);
							$ds = $ds_details->discount;
							$dsType = $ds_details->type;	
							$dsID[] = $discount_id;	
							
							if($dsType == 1 && $ds != 0) {
							$val_ds[] = (($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)) * $ds / 100);
							} else {
							$val_ds[] = $ds * ($this->input->post($quantity.$i));
							}
							
							if($dsType == 1) { $discount[] = $ds."%"; } else { $discount[] = $ds;  }	
						
						} elseif(DISCOUNT_METHOD == 2 && DISCOUNT_OPTION == 2) {
						
							$discount_id = $this->input->post($dis.$i);
							$ds_details = $this->pos_model->getDiscountByID($discount_id);
							$ds = $ds_details->discount;
							$dsType = $ds_details->type;	
							$dsID[] = $discount_id;	
							
							if($dsType == 1 && $ds != 0) {
							$val_ds[] = (((($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)) + $item_tax) * $ds) / 100);
							} else {
							$val_ds[] = $ds * ($this->input->post($quantity.$i));
							}
							
							if($dsType == 1) { $discount[] = $ds."%"; } else { $discount[] = $ds;  }	
						
						} else {
							$val_ds[] = 0;
							$dsID[] = 0;
							$discount[] = "";
							
						}
						if(PRODUCT_SERIAL) { $serial[] = $this->input->post($sl.$i); } else { $serial[] = ""; }
						$inv_quantity[] = $this->input->post($quantity.$i);
						$inv_product_code[] = $this->input->post($product.$i);
						$inv_unit_price[] = $this->input->post($unit_price.$i);
						$inv_gross_total[] = (($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)));
						
						$inv_total_no_tax += (($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)));
						
					}
				}
			
					
			if(DISCOUNT_OPTION == 2) {
				$total_ds = array_sum($val_ds);
			} else {
				$total_ds = 0;
			}
			
			
			if(TAX1) {
				$total_tax = array_sum($val_tax);
			} else {
				$total_tax = 0;
			}
			
			
			if(!empty($inv_product_code)) {	 
				foreach($inv_product_code as $pr_code){
					$product_details = $this->pos_model->getProductByCode($pr_code);
					$product_id[] = $product_details->id;
					$product_name[] = $product_details->name;
					$product_code[] = $product_details->code;
					$product_unit[] = $product_details->unit;
				}
			}
		
			$keys = array("product_id","product_code","product_name","product_unit", "tax_rate_id", "tax","quantity","unit_price", "gross_total", "val_tax", "serial_no", "discount_val", "discount", "discount_id");
		
			$items = array();
			foreach ( array_map(null, $product_id, $product_code, $product_name, $product_unit, $tax_rate_id, $tax, $inv_quantity, $inv_unit_price, $inv_gross_total, $val_tax, $serial, $val_ds, $discount, $dsID) as $key => $value ) {
				$items[] = array_combine($keys, $value);
			}
			
			if(TAX2) {
				$tax_dts = $this->pos_model->getTaxRateByID($tax_rate2);
				$taxRt = $tax_dts->rate;
				$taxTp = $tax_dts->type;	
					
				if($taxTp == 1 && $taxRt != 0) {
					$val_tax2 = ($inv_total_no_tax * $taxRt / 100);
				} else {
					$val_tax2 = $taxRt;
				}
				
			} else {
				$val_tax2 = 0;
				$tax_rate2 = 0;
			}
			
			if(DISCOUNT_METHOD == 1 && DISCOUNT_OPTION == 1) {
				
				$ds_dts = $this->pos_model->getDiscountByID($inv_discount);
				$ds = $ds_dts->discount;
				$dsTp = $ds_dts->type;	
					
				if($dsTp == 1 && $ds != 0) {
					$val_discount = ($inv_total_no_tax * $ds / 100);
				} else {
					$val_discount = $ds;
				}
			
			} elseif(DISCOUNT_METHOD == 2 && DISCOUNT_OPTION == 1) {
				
				$ds_dts = $this->pos_model->getDiscountByID($inv_discount);
				$ds = $ds_dts->discount;
				$dsTp = $ds_dts->type;	
					
				if($dsTp == 1 && $ds != 0) {
					$val_discount = ((($inv_total_no_tax + $total_tax + $val_tax2) * $ds) / 100);
				} else {
					$val_discount = $ds;
				}
				
			} else {
				$val_discount = $total_ds;
				$inv_discount = 0;
			}
			
			$gTotal = $inv_total_no_tax + $total_tax + $val_tax2 - $val_discount;
			
			$saleDetails = array('reference_no' => $reference_no,
					'date' => $date,
					'biller_id' => $biller_id,
					'biller_name' => $biller_name,
					'customer_id' => $customer_id,
					'customer_name' => $customer_name,
					'inv_total' => $inv_total_no_tax,
					'total_tax' => $total_tax,
					'total' => $gTotal,
					'total_tax2' => $val_tax2,
					'tax_rate2_id' => $tax_rate2,
					'inv_discount' => $val_discount,
					'discount_id' => $inv_discount,
					'user'	=> USER_NAME,
					'paid_by' => $paid_by,
					'count' => $count
				);
				
		}
		
		if ( $this->form_validation->run() == true && !empty($items) )
		{ 
			if($suspend) {
				if($this->pos_model->suspendSale($saleDetails, $items, $count, $did)) {
					$this->session->set_flashdata('success_message', $this->lang->line("sale_suspended"));
					redirect("module=pos", 'refresh');			
				}
			} else {
				if($saleID = $this->pos_model->addSale($saleDetails, $items, $warehouse_id, $did)) {
					$this->session->set_flashdata('success_message', $this->lang->line("sale_added"));
					redirect("module=pos&view=view_invoice&id=".$saleID, 'refresh');			
				}
			}
		}
		else
		{ 
		
		$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$data['success_message'] = $this->session->flashdata('success_message');
						
	  
	  $data['customer'] = $this->pos_model->getCustomerById(DCUS);
	  $data['biller'] = $this->pos_model->getBillerByID(DBILLER);
	  $data['discounts'] = $this->pos_model->getAllDiscounts();
	  $data['tax_rates'] = $this->pos_model->getAllTaxRates();
	  $data["total_cats"] = $this->pos_model->categories_count();
	  $data["total_cp"] = $this->pos_model->products_count(DCAT);
	  if(DISCOUNT_OPTION == 1) { 
			$discount_details = $this->pos_model->getDiscountByID(DEFAULT_DISCOUNT);
			
	  		$data['discount_rate'] = $discount_details->discount;
 			$data['discount_type'] = $discount_details->type;
			$data['discount_name'] = $discount_details->name;
	  } 
	  if(DISCOUNT_OPTION == 2) { 
			$discount2_details = $this->pos_model->getDiscountByID(DEFAULT_DISCOUNT);
	  		$data['discount_rate2'] = $discount2_details->discount;
 			$data['discount_type2'] = $discount2_details->type;
	  } 
	  if(TAX1) {
	  $tax_rate_details = $this->pos_model->getTaxRateByID(DEFAULT_TAX);
	  $data['tax_rate'] = $tax_rate_details->rate;

 		$data['tax_type'] = $tax_rate_details->type;
		$data['tax_name'] = $tax_rate_details->name;
	   	
	  }
	  if(TAX2) {
		$tax_rate2_details = $this->pos_model->getTaxRateByID(DEFAULT_TAX2);
	  	$data['tax_rate2'] = $tax_rate2_details->rate;
		$data['tax_name2'] = $tax_rate2_details->name;
 		$data['tax_type2'] = $tax_rate2_details->type;
	  }
	   $data['products'] = $this->ajaxproducts(DCAT);
	   $data['categories'] = $this->poscategories();
	   
	  $data['page_title'] = $this->lang->line("pos_module");

      $this->load->view('add', $data);

		}
   }
   
   function tax_rates()
   {
	   if($this->input->get('id')) { $id = $this->input->get('id'); }
	   if($this->input->get('old_id')) { $old_id = $this->input->get('old_id'); } else { $old_id = NULL; }
	   $new_tax_rate_details = $this->pos_model->getTaxRateByID($id);
	   
	   if($old_id) {
		   $old_tax_rate_details = $this->pos_model->getTaxRateByID($old_id);
		   
		   $tax = array('old_tax_rate' => $old_tax_rate_details->rate, 
						'old_tax_type' => $old_tax_rate_details->type,
						'new_tax_rate' => $new_tax_rate_details->rate, 
						'new_tax_type' => $new_tax_rate_details->type);	
	   } else { 
	   		$tax = array('new_tax_rate' => $new_tax_rate_details->rate, 
						'new_tax_type' => $new_tax_rate_details->type);
	   }
	  echo json_encode($tax);

   }
   
   function discounts()
   {
	   if($this->input->get('id')) { $id = $this->input->get('id'); }
	   if($this->input->get('old_id')) { $old_id = $this->input->get('old_id'); } else { $old_id = NULL; }
	   $new_discount_details = $this->pos_model->getDiscountByID($id);
	   
	   if($old_id) {
		   $old_discount_details = $this->pos_model->getDiscountByID($old_id);
		   
		   $ds = array('old_discount' => $old_discount_details->discount, 
						'old_discount_type' => $old_discount_details->type,
						'new_discount' => $new_discount_details->discount, 
						'new_discount_type' => $new_discount_details->type);	
	   } else { 
	   		$ds = array('new_discount' => $new_discount_details->discount, 
						'new_discount_type' => $new_discount_details->type);
	   }
	  echo json_encode($ds);

   }
   
   function scan_product()
   {
	   if($this->input->get('code')) { $code = $this->input->get('code'); }
	   
	   if($prodd = $this->pos_model->getProductByCode($code)) {
	   		
			$product_name = $prodd->name;
			$product_code = $prodd->code;
			$product_price = $prodd->price;
	   		$product_id = $prodd->id;
			$category_id = $prodd->category_id;
			if($product_id < 10) { $product_id = "0".(($product_id*100)/100);  }
			if($category_id < 10) { $category_id = "0".(($category_id*100)/100);  }
			$last = $category_id.$product_id;
			
			$product = array('product_name' => $product_name, 
						'product_code' => $product_code,
						'item_price' => $product_price,
						'last' => $last);	
			
		
	   }
	   
	  echo json_encode($product);

   }
	
	 function add_row($category_id = NULL, $code = NULL)
   {
	   if($this->input->get('code')) { $code = $this->input->get('code'); }
	   if($this->input->get('category_id')) { $category_id = $this->input->get('category_id'); } else { $category_id = 1; }
		   $products = $this->pos_model->getProductByCode($code);
		   
		  $row = '<td width="29px" style="text-align:center;"> x </td><td width="144px">'.$products->name.'</td><td width="44px" style="text-align:center;">1</td><td width="86px style="text-align:right;"> '.$products->price.' </td>';
		   
		   echo $row;
		   
   }
   
   function price($code = NULL)
   {
	   if($this->input->get('code')) { $code = $this->input->get('code'); }
		   $products = $this->pos_model->getProductByCode($code);
		   
		  $price = $products->price;
		  $name = $products->name;
		  $code = $products->code;
		   
		   $data = array('price'=> $price, 'name' => $name, 'code' => $code);
		   echo json_encode($data);
		   
   }
   
   function poscategories($category_id = NULL) {
	   
	   if($this->input->get('category_id')) { $category_id = $this->input->get('category_id'); } else { $category_id = DCAT; }
	   if($this->input->get('per_page') == 'n' ) { $page = 0; } else { $page = $this->input->get('per_page'); }
	   
        $categories = $this->pos_model->getAllCategories();
		$count = 1;
		$cats = "";
		foreach($categories as $category) {
	
			$cats .= "<li><button id=\"category\" type=\"button\" value='".$category->id."' class=\"gray\">
			".$category->name."</button></li>";
			$count++;
			
		}	
		
	if($this->input->get('per_page')) {

		echo $cats ;
	} else {
		return $cats;
	}
    
		
   }
   
   function ajaxproducts( $category_id = NULL) {
	   
	   
	   
	   if($this->input->get('category_id')) { $category_id = $this->input->get('category_id'); } else { $category_id = DCAT; }
	   if($this->input->get('per_page') == 'n' ) { $page = 0; } else { $page = $this->input->get('per_page'); }
	   
	$this->load->library("pagination");
	  
	    $config = array();
        $config["base_url"] = base_url() . "index.php?module=pos&view=ajaxproducts";
        $config["total_rows"] = $this->pos_model->products_count($category_id);
        $config["per_page"] = PLIMIT;
		$config['prev_link'] = FALSE;
		$config['next_link'] = FALSE;
		$config['display_pages'] = FALSE;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;

        $this->pagination->initialize($config);

        $products = $this->pos_model->fetch_products($category_id, $config["per_page"], $page);
		$pro = 1;
		$prods = "<div>";
		foreach($products as $product) {
			$count = $product->id;
			if($count < 10) { $count = "0".($count /100) *100;  }
			if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
		if($product->image == 'no_image.jpg') {
			$prods .= "
			<button id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"green\" ><i><img src=\"assets/uploads/thumbs/default.png\"></i><span><span>".$product->name."</span></span></button>";
		} else {
			$prods .= "
			<button id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"green\" ><i><img src=\"assets/uploads/thumbs/".$product->image."\"></i><span><span>".$product->name."</span></span></button>";
		}
			$pro++;	
		}
	
	if($pro <= PLIMIT) {
		for($i = $pro; $i <= PLIMIT; $i++) {
			$prods .= "<button type=\"button\" value='0' class=\"tr\" style=\"cursor: default !important;\"><i></i><span></span></button>";
		}
	}
	$prods .= "</div>";
	
	if($this->input->get('per_page')) {

		echo $prods ;
	} else {
		return $prods;
	}

           
		
   }


/* -------------------------------------------------------------------------------------------------------------------------------- */

function total_cp() {
	   
	   $category_id = $this->input->get('category_id'); 
		
	
	   if($result = $this->pos_model->products_count($category_id)) {

		} else {
			$result = 0;	
		}
		echo $result;

		exit;

   }
   
function products() {
	   
	   
	   $term = $this->input->get('q', TRUE); 
		$output = $this->input->get('output', TRUE); 
		
		if(!$term) { redirect("home"); }
		$cq = $term;
		if (!$cq) return;

	   $prs = $this->pos_model->getProductsByCode($cq);
	   
	   foreach($prs as $pr) {	   
		  $items[$pr->code] = $pr->price;   
	   }
	   
	   $results = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $cq) !== false) {
				array_push($results, array(strip_tags($key)));
			}
			if (count($results) > 11) {
					break;
			}
		}
		echo $this->array_to_json($results);
		

		exit;

   }

 
//view inventory as html page
   
   function view_invoice()
   {
	   if($this->input->get('id')){ $sale_id = $this->input->get('id'); } else { $sale_id = NULL; }
	   
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

		   $data['rows'] = $this->pos_model->getAllInvoiceItems($sale_id);
		   
		   $inv = $this->pos_model->getInvoiceBySaleID($sale_id);
		   $biller_id = $inv->biller_id;
		   $customer_id = $inv->customer_id;
		   $invoice_type_id = $inv->invoice_type;
		   $data['biller'] = $this->pos_model->getBillerByID($biller_id);
		   $data['customer'] = $this->pos_model->getCustomerByID($customer_id);
		   $data['invoice_types_details'] = $this->pos_model->getInvoiceTypeByID($invoice_type_id);
		   $data['pos'] = $this->pos_model->getSetting();
		   
		   $data['inv'] = $inv;
		   $data['sid'] = $sale_id; 
	  
	  $data['page_title'] = $this->lang->line("invoice");
	
	  
      $this->load->view('view', $data);

   }
  
   
   function today_sale()
   {
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   
	  if($cc_sale = $this->pos_model->getTodayCCSales()) { $data['ccsales'] = $cc_sale->total; } else { $data['ccsales'] = "0.00"; }
	  if($cash_sale = $this->pos_model->getTodayCashSales()) { $data['cashsales'] = $cash_sale->total; } else { $data['cashsales'] = "0.00"; }
	  if($ch_sale = $this->pos_model->getTodayChSales()) { $data['chsales'] = $ch_sale->total; } else { $data['chsales'] = "0.00"; }
	
	  $data['totalsales'] = $this->pos_model->getTodaySales();
	  $meta['page_title'] = $this->lang->line('today_sale');
      echo $this->load->view('sales', $data, TRUE);
   }
  
   
   function settings()
   {
	   
		//validate form input
		$this->form_validation->set_message('is_natural_no_zero', $this->lang->line('no_zero_required'));
		$this->form_validation->set_rules('pro_limit', $this->lang->line('pro_limit'), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('category', $this->lang->line('default_category'), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('customer', $this->lang->line('default_customer'), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('biller', $this->lang->line('default_biller'), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('cf_title1', $this->lang->line('cf_title1'), 'xss_clean');
		$this->form_validation->set_rules('cf_title2', $this->lang->line('cf_title2'), 'xss_clean');
		$this->form_validation->set_rules('cf_value1', $this->lang->line('cf_value1'), 'xss_clean');
		$this->form_validation->set_rules('cf_value2', $this->lang->line('cf_value2'), 'xss_clean');
		
		
		if ($this->form_validation->run() == true)
		{
			
			$data = array(
				'pro_limit' => $this->input->post('pro_limit'),
				'category' => $this->input->post('category'),
				'customer' => $this->input->post('customer'),
				'biller' => $this->input->post('biller'),
				'display_time' => $this->input->post('display_time'),
				'cf_title1' => $this->input->post('cf_title1'),
				'cf_title2' => $this->input->post('cf_title2'),
				'cf_value1' => $this->input->post('cf_value1'),
				'cf_value2' => $this->input->post('cf_value2')
			);
		}
		
		if ( $this->form_validation->run() == true && $this->pos_model->updateSetting($data))
		{  
			$this->session->set_flashdata('success_message', $this->lang->line('pos_setting_updated'));
			redirect("module=pos&view=settings", 'refresh');
		}
		else
		{
			
	   $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	   $data['success_message'] = $this->session->flashdata('success_message');
	   
	   $data['pos'] = $this->pos_model->getSetting();
	   $data['categories'] = $this->pos_model->getAllCategories(); 
	   $data['customers'] = $this->pos_model->getAllCustomers();
	   $data['billers'] = $this->pos_model->getAllBillers(); 
	   
      $meta['page_title'] = $this->lang->line('pos_settings');
	  $data['page_title'] = $this->lang->line('pos_settings');
      $this->load->view('commons/header', $meta);
      $this->load->view('setting', $data);
      $this->load->view('commons/footer');
	}
   }
   
   function suspend_bill() {
	   
	   
	   $csutomer_id = $this->input->post('id'); 
	   $saleData = base64_encode($this->input->post('saleData'));
	   $count = $this->input->post('count');
	   $tax1 = $this->input->post('tax1');
	   $tax2 = $this->input->post('tax2');
	   $total = $this->input->post('total');
	   
	   if($this->pos_model->suspendBill($csutomer_id, $saleData, $count, $tax1, $tax2, $total)) {
		   return true;
		} else {
			return false;
		}


   }
   
   function load_suspended_bill() {
	   
	   $id = $this->input->post('id'); 
	   
	   if($newData = $this->pos_model->getSaleByID($id)) {
		   
		   $items = $this->pos_model->getAllSaleItems($id);
		   $tax_rates = $this->pos_model->getAllTaxRates();
	      $r=1;
		  $sdata = "";
			foreach($items as $item){
			 $sdata .= '<tr id="row_'.$r.'"><td id="satu" style="text-align:center; width: 27px;"><button type="button" class="del_row" id="del-'.$r.'" value="'.$r.'"><i class="icon-trash"></i></button></td><td><input type="hidden" name="product'.$r.'" value="'.$item->product_code.'" id="product-'.$r.'"><input type="hidden" name="serial'.$r.'" value="" id="serial-'.$r.'"><input type="hidden" name="tax_rate'.$r.'" value="'.$item->tax_rate_id.'" id="tax_rate-'.$r.'"><input type="hidden" name="discount'.$r.'" value="'.$item->discount_id.'" id="discount-'.$r.'"><a href="#" id="model-'.$r.'" class="code">'.$item->product_name.'</a><input type="hidden" name="price'.$r.'" value="'.$item->unit_price.'" id="oprice-'.$r.'"></td><td style="text-align:center;"><input class="keyboard" onClick="this.select();" name="quantity'.$r.'" type="text" value="'.$item->quantity.'" autocomplete="off" id="quantity-'.$r.'"></td><td style="padding-right: 10px; text-align:right;"><input type="text" class="price" name="unit_price'.$r.'" value="'.$item->gross_total.'" id="price-'.$r.'"></td></tr>';
			  
			  $r++;
			
		} 
		   $item_count = $newData->count + 1;
		   $customer_id = $newData->customer_id;
		   $tax1 = $newData->tax1;
		   $tax2 = $newData->tax2;
		   $discount = $newData->discount;
		   $sale_total = $newData->inv_total;
		   $grand_total = $newData->total;
		   $data = array(
		   			'customer_id' => $customer_id,
		   			'sale_data' => $sdata,
					'count' => $item_count,
					'tax1' => $tax1,
					'tax2' => $tax2,
					'discount' => $discount,
					'inv_total' => $sale_total,
					'g_total' => $grand_total
					);

		} else {
			$data = NULL;
		}
		
		echo json_encode($data);
   }
   
   function suspended_sales()
   {
	  
		if ($this->ion_auth->in_group(array('purchaser', 'viewer')))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   $data['success_message'] = $this->session->flashdata('success_message');
	   
      $meta['page_title'] = $this->lang->line("suspended_sales");
	  $data['page_title'] = $this->lang->line("suspended_sales");
      $this->load->view('commons/header', $meta);
      $this->load->view('content', $data);
      $this->load->view('commons/footer');
   }
   
   function getSuspendedSales()
   {
		
	   $this->load->library('datatables');
	   $this->datatables
			->select("suspended_bills.id as id, date, customers.name, count, tax1, tax2, discount, total")
			->from('suspended_bills')
			->join('customers', 'customers.id=suspended_bills.customer_id', 'left')
			->group_by('suspended_bills.id');
			$this->datatables->add_column("Actions", 
			"<center><a class=\"tip\" title='".$this->lang->line("add_to_pos")."' href='index.php?module=pos&amp;suspend_id=$1'><i class=\"icon-plus-sign\"></i></a> <a class=\"tip\" title='".$this->lang->line("delete_suspended_sale")."' href='index.php?module=pos&amp;view=delete&amp;id=$1' onClick=\"return confirm('". $this->lang->line('alert_x_sale') ."')\"><i class=\"icon-trash\"></i></a></center>", "id")
		
		->unset_column('id');
		
		
	   echo $this->datatables->generate();

   }
   
   function delete($id = NULL)
    {
		
		$groups = array('admin', 'purchaser', 'salesman', 'viewer');
        if ($this->ion_auth->in_group($groups))
        {
            $this->session->set_flashdata('message', $this->lang->line("access_denied"));
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            redirect('module=sales', 'refresh');
        }
		
        if($this->input->get('id')){ $id = $this->input->get('id'); } else { $id = NULL; }
		
			if ( $this->pos_model->deleteSale($id) )
			{ 
				$this->session->set_flashdata('success_message', $this->lang->line("suspended_sale_deleted"));
				redirect('module=pos&view=suspended_sales', 'refresh');
			}
       
    } 
	
	function add_customer()
	{
		$cusData = $this->input->post('data');
		
		$this->load->helper('email');
		$error = NULL;
		
		if (!empty($cusData[0]) && !empty($cusData[1]) && valid_email($cusData[3]) && !empty($cusData[4]) && !empty($cusData[5]) && !empty($cusData[6]) && !empty($cusData[7]) && !empty($cusData[8]) && !empty($cusData[2]))
		{
    		$data = array('name' => $cusData[1],
				'email' => $cusData[3],
				'company' => $cusData[0],
				'address' => $cusData[4],
				'city' => $cusData[5],
				'state' => $cusData[6],
				'postal_code' => $cusData[7],
				'country' => $cusData[8],
				'phone' => $cusData[2]
			);
			
		}
		else
		{
			$error =  $this->lang->line("email")." ".$this->lang->line("is_required");
		}
		
		if (empty($cusData[8])) {$error =  $this->lang->line("country")." ".$this->lang->line("is_required"); }
		if (empty($cusData[7]) || !is_numeric($cusData[7])) {$error =  $this->lang->line("postal_code")." ".$this->lang->line("is_required"); }
		if (empty($cusData[6])) {$error =  $this->lang->line("state")." ".$this->lang->line("is_required"); }
		if (empty($cusData[5])) {$error =  $this->lang->line("city")." ".$this->lang->line("is_required"); }
		if (empty($cusData[4])) {$error =  $this->lang->line("address")." ".$this->lang->line("is_required"); }
		if (empty($cusData[2]) || !is_numeric($cusData[2])) {$error =  $this->lang->line("phone")." ".$this->lang->line("is_required"); }
		if (empty($cusData[1])) {$error =  $this->lang->line("name")." ".$this->lang->line("is_required"); }
		if (empty($cusData[0])) {$error =  $this->lang->line("company")." ".$this->lang->line("is_required"); }

		if(!$error) {
			if ( $this->pos_model->addCustomer($data))
			{  
				echo $this->lang->line("customer_added");
			}
		} else {
			echo  $error;
		}
	}
   
}
