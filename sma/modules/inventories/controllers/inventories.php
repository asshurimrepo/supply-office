<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventories extends MX_Controller {

/*
| -----------------------------------------------------
| PRODUCT NAME: 	STOCK MANAGER ADVANCE 
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
| MODULE: 			Inventories
| -----------------------------------------------------
| This is inventory module controller file.
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
		$this->load->model('inventories_model');

	}
/* -------------------------------------------------------------------------------------------------------------------------------- */
//index or inventories page
	
   function index()
   {
	   if ($this->ion_auth->in_group('salesman'))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
		if($this->input->get('search_term')) { $data['search_term'] = $this->input->get('search_term'); } else { $data['search_term'] = false;}
		
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   $data['success_message'] = $this->session->flashdata('success_message');
	  
	  $data['warehouses'] = $this->inventories_model->getAllWarehouses();
      $meta['page_title'] = $this->lang->line("purchase_orders");
	  $data['page_title'] = $this->lang->line("purchase_orders");
      $this->load->view('commons/header', $meta);
      $this->load->view('content', $data);
      $this->load->view('commons/footer');
   }
   
  function getdatatableajax()
   {
 		if($this->input->get('search_term')) { $search_term = $this->input->get('search_term'); } else { $search_term = false;}
	   $this->load->library('datatables');
	   $this->datatables
			->select("purchases.id as id, date, reference_no, supplier_name, total")
			->from('purchases');
		$this->datatables->add_column("Actions", 
			"<center><a href='#' onClick=\"MyWindow=window.open('index.php?module=inventories&view=view_inventory&id=$1', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000,height=600'); return false;\" title='".$this->lang->line("view_inventory")."' class='tip'><i class='icon-fullscreen'></i></a> <a href='index.php?module=inventories&view=pdf&id=$1' title='".$this->lang->line("download_pdf")."' class='tip'><i class='icon-file'></i></a> <a href='index.php?module=inventories&view=email_inventory&id=$1' title='".$this->lang->line("email_inventory")."' class='tip'><i class='icon-envelope'></i></a> <a href='index.php?module=inventories&amp;view=edit&amp;id=$1' title='".$this->lang->line("edit_inventory")."' class='tip'><i class='icon-edit'></i></a> <a href='index.php?module=inventories&amp;view=delete&amp;id=$1' onClick=\"return confirm('". $this->lang->line('alert_x_inventory') ."')\" title='".$this->lang->line("delete_inventory")."' class='tip'><i class='icon-trash'></i></a></center>", "id")
		
	
		->unset_column('id');
		
		
	   echo $this->datatables->generate();

   }
   
   function warehouse($warehouse = DEFAULT_WAREHOUSE)
   {
	   if($this->input->get('warehouse_id')){ $warehouse = $this->input->get('warehouse_id'); }
	   
	  $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	  
	  $data['warehouses'] = $this->inventories_model->getAllWarehouses();
	  $data['warehouse_id'] = $warehouse;

      $meta['page_title'] = $this->lang->line("purchase_orders");
	  $data['page_title'] = $this->lang->line("purchase_orders");
      $this->load->view('commons/header', $meta);
      $this->load->view('warehouse', $data);
      $this->load->view('commons/footer');
   }
   
   function getwhinv($warehouse_id = NULL)
   {
	   if($this->input->get('warehouse_id')){ $warehouse_id = $this->input->get('warehouse_id'); }
   
   		$this->load->library('datatables');
	   $this->datatables
			->select("id, date, reference_no, supplier_name, total")
			->from('purchases')
			->where('warehouse_id', $warehouse_id)
			->add_column("Actions", 
			"<center><a href='#' onClick=\"MyWindow=window.open('index.php?module=inventories&view=view_inventory&id=$1', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000,height=600'); return false;\" title='".$this->lang->line("view_inventory")."' class='tip'><i class='icon-fullscreen'></i></a> <a href='index.php?module=inventories&view=pdf&id=$1' title='".$this->lang->line("download_pdf")."' class='tip'><i class='icon-file'></i></a> <a href='index.php?module=inventories&view=email_inventory&id=$1' title='".$this->lang->line("email_inventory")."' class='tip'><i class='icon-envelope'></i></a> <a href='index.php?module=inventories&amp;view=edit&amp;id=$1' title='".$this->lang->line("edit_inventory")."' class='tip'><i class='icon-edit'></i></a> <a href='index.php?module=inventories&amp;view=delete&amp;id=$1' onClick=\"return confirm('". $this->lang->line('alert_x_inventory') ."')\" title='".$this->lang->line("delete_inventory")."' class='tip'><i class='icon-trash'></i></a></center>", "id")
		
		->unset_column('id');
		
		
	   echo $this->datatables->generate();

   }
/* -------------------------------------------------------------------------------------------------------------------------------- */
//view inventory as html page
   
   function view_inventory($purchase_id = NULL)
   {
	   if($this->input->get('id')){ $purchase_id = $this->input->get('id'); }
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   
	   $data['rows'] = $this->inventories_model->getAllInventoryItems($purchase_id);
	   
	   $inv = $this->inventories_model->getInventoryByPurchaseID($purchase_id);
	   $supplier_id = $inv->supplier_id;
	   $data['supplier'] = $this->inventories_model->getSupplierByID($supplier_id);
	   
	   $data['inv'] = $inv;
	  $data['pid'] = $purchase_id;   
	  $data['page_title'] = $this->lang->line("inventory");
	
	  
      $this->load->view('view_inventory', $data);

   }
/* -------------------------------------------------------------------------------------------------------------------------------- */
//generate pdf and force to download 

function pdf()
   {
	   if($this->input->get('id')){ $purchase_id = $this->input->get('id'); }
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   
	   $data['rows'] = $this->inventories_model->getAllInventoryItems($purchase_id);
	   
	   $inv = $this->inventories_model->getInventoryByPurchaseID($purchase_id);
	   $supplier_id = $inv->supplier_id;
	   $data['supplier'] = $this->inventories_model->getSupplierByID($supplier_id);
	   
	   $data['inv'] = $inv;
	  $data['pid'] = $purchase_id;   
	  $data['page_title'] = $this->lang->line("inventory");
	
	  
      $html = $this->load->view('view_inventory', $data, TRUE);
	  
	 
	  $this->load->library('MPDF53/mpdf');
			  
		$mpdf=new mPDF('uft-8','A4', '12', '', 10, 10, 10, 10, 9, 9); 
		$mpdf->useOnlyCoreFonts = true;
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle(SITE_NAME);
		$mpdf->SetAuthor(SITE_NAME);
		$mpdf->SetCreator(SITE_NAME);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetAutoFont();
				
		$search = array("<div class=\"row-fluid\">", "<div class=\"span6\">");
		$replace = array("<div style='width: 100%;'>", "<div style='width: 48%; float: left;'>");
		$html = str_replace($search, $replace, $html);
		
		
	$name = $this->lang->line("inventory")."-".$inv->id.".pdf";
	
	$mpdf->WriteHTML($html);
	
	$mpdf->Output($name, 'D'); 
	
	exit;

   }
    
 
/* -------------------------------------------------------------------------------------------------------------------------------- */
//email inventory as html and send pdf as attachment   

   function email($purchase_id, $to, $cc = NULL, $bcc = NULL, $from_name, $from, $subject, $note)
   {
	   
	   	$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   	$data['rows'] = $this->inventories_model->getAllInventoryItems($purchase_id);
	   	$inv = $this->inventories_model->getInventoryByPurchaseID($purchase_id);
	   	$supplier_id = $inv->supplier_id;
	   	$data['supplier'] = $this->inventories_model->getSupplierByID($supplier_id);
	   	$data['inv'] = $inv;
	  	$data['pid'] = $purchase_id;   
	  	$data['page_title'] = $this->lang->line("inventory");
	
      	$html = $this->load->view('view_inventory', $data, TRUE);
	  
	  	$this->load->library('MPDF53/mpdf');
			  
		$mpdf=new mPDF('uft-8','A4', '12', '', 10, 10, 10, 10, 9, 9); 
		$mpdf->useOnlyCoreFonts = true;
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle(SITE_NAME);
		$mpdf->SetAuthor(SITE_NAME);
		$mpdf->SetCreator(SITE_NAME);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetAutoFont();
				
		$search = array("<div class=\"row-fluid\">", "<div class=\"span6\">");
		$replace = array("<div style='width: 100%;'>", "<div style='width: 48%; float: left;'>");
		$html = str_replace($search, $replace, $html);
		
		
		$name = $this->lang->line("inventory")."-".$inv->id.".pdf";
	
		$mpdf->WriteHTML($html);
	
		$mpdf->Output($name,'F', 'assets/uploads');
		
		if($note) { $message = html_entity_decode($note)."<br><hr>".$html; } else { $message = $html; }
	 		
		$this->load->library('email');
		
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
	
		$this->email->initialize($config);
		
		$this->email->from($from, $from_name);
		$this->email->to($to); 
		if($cc) { $this->email->cc($cc);}
		if($bcc) { $this->email->bcc($bcc);}
	
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->attach('assets/uploads/'.$name);	
		
		if($this->email->send()) {
			// email sent		
			unlink('assets/uploads/'.$name);
			return true;
		} else {
			//email not sent
			unlink('assets/uploads/'.$name);
			//echo $this->email->print_debugger();
			return false;
		}
	

   }
   
   
   function email_inventory($id = NULL)
   {
	   if($this->input->get('id')){ $id = $this->input->get('id'); }
	    $groups = array('owner', 'admin');
		if (!$this->ion_auth->in_group($groups))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
		//validate form input
		$this->form_validation->set_rules('to', $this->lang->line("to")." ".$this->lang->line("email"), 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('subject', $this->lang->line("subject"), 'trim|required|xss_clean');
		$this->form_validation->set_rules('cc', $this->lang->line("cc"), 'trim|xss_clean');
		$this->form_validation->set_rules('bcc', $this->lang->line("bcc"), 'trim|xss_clean');
		$this->form_validation->set_rules('note', $this->lang->line("message"), 'trim|xss_clean');
		
		if ($this->form_validation->run() == true)
		{
			$to = $this->input->post('to');
			$subject= $this->input->post('subject');
			if($this->input->post('cc')) { $cc = $this->input->post('cc'); } else { $cc = NULL; }
			if($this->input->post('bcc')) { $bcc = $this->input->post('bcc'); } else { $bcc = NULL; }
			$message = $this->ion_auth->clear_tags($this->input->post('note'));
			$user = $this->ion_auth->user()->row();	
			$from_name = $user->first_name." ".$user->last_name;
			$from = $user->email;
		}
		
		if ( $this->form_validation->run() == true && $this->email($id, $to, $cc, $bcc, $from_name, $from, $subject, $message) )
		{ 
					
			$this->session->set_flashdata('success_message', $this->lang->line("sent"));
			redirect("module=inventories", 'refresh');
			
			
		}
		else
		{ 
		
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		
			$data['to'] = array('name' => 'to',
				'id' => 'to',
				'type' => 'text',
				'value' => $this->form_validation->set_value('to'),
			);
			$data['subject'] = array('name' => 'subject',
				'id' => 'subject',
				'type' => 'text',
				'value' => $this->form_validation->set_value('subject'),
			);
			$data['note'] = array('name' => 'note',
				'id' => 'note',
				'type' => 'text',
				'value' => $this->form_validation->set_value('note'),
			);
			
			
		$user = $this->ion_auth->user()->row();	
	    $data['from_name'] = $user->first_name." ".$user->last_name;
		$data['from_email'] = $user->email;
		
	   $data['id'] = $id;
      $meta['page_title'] = $this->lang->line("email_inventory");
	  $data['page_title'] = $this->lang->line("email_inventory");
      $this->load->view('commons/header', $meta);
      $this->load->view('email', $data);
      $this->load->view('commons/footer');
			
		}
   }
			
		
/* -------------------------------------------------------------------------------------------------------------------------------- */ 
//Add new inventory

   function add()
   {
	   $groups = array('salesman', 'viewer');
		if ($this->ion_auth->in_group($groups))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
		//validate form input
		$this->form_validation->set_message('is_natural_no_zero',  $this->lang->line("no_zero_required"));
		$this->form_validation->set_rules('reference_no', $this->lang->line("ref_no"), 'required|xss_clean');
		$this->form_validation->set_rules('date', $this->lang->line("date"), 'required|xss_clean');
		$this->form_validation->set_rules('warehouse', $this->lang->line("warehouse"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('supplier', $this->lang->line("supplier"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('note', $this->lang->line("note"), 'xss_clean');
		
		$quantity = "quantity";
		$product = "product";
		$unit_cost = "unit_cost";
			
		if ($this->form_validation->run() == true)
		{
			$reference = $this->input->post('reference_no');
			$inv_date = trim($this->input->post('date'));
			if(JS_DATE == 'dd-mm-yyyy' || JS_DATE == 'dd/mm/yyyy') {
				$date = substr($inv_date, -4)."-".substr($inv_date, 3, 2)."-".substr($inv_date, 0, 2); 
			} else {
				$date = substr($inv_date, -4)."-".substr($inv_date, 0, 2)."-".substr($inv_date, 3, 2);
			}
			$warehouse_id = $this->input->post('warehouse');
			$supplier_id = $this->input->post('supplier');
			$supplier_details = $this->inventories_model->getSupplierByID($supplier_id);
			$supplier_name = $supplier_details->name;
			$note = $this->ion_auth->clear_tags($this->input->post('note'));
			$inv_total = 0;
				for($i=1; $i<=TOTAL_ROWS; $i++){
					if( $this->input->post($quantity.$i) && $this->input->post($product.$i) && $this->input->post($unit_cost.$i) ) {
						
						if(!$this->inventories_model->getProductByCode($this->input->post($product.$i))) {
							$this->session->set_flashdata('message', $this->lang->line("code_not_found")." ( ".$this->input->post($product.$i)." ).");
							redirect("module=inventories&view=add", 'refresh');
						}
						
						$inv_quantity[] = $this->input->post($quantity.$i);
						$inv_product_code[] = $this->input->post($product.$i);
						$inv_unit_cost[] = $this->input->post($unit_cost.$i);
						$inv_gross_total[] = (($this->input->post($quantity.$i)) * ($this->input->post($unit_cost.$i)));
						$inv_total += (($this->input->post($quantity.$i)) * ($this->input->post($unit_cost.$i)));
						
					}
				}
				
				foreach($inv_product_code as $pr_code){
					$product_details = $this->inventories_model->getProductByCode($pr_code);
					$product_id[] = $product_details->id;
					$product_name[] = $product_details->name;
					$product_code[] = $product_details->code;
				}
		
				$keys = array("product_id","product_code","product_name","quantity","unit_price", "gross_total");
		
					$items = array();
				foreach ( array_map(null, $product_id, $product_code, $product_name, $inv_quantity, $inv_unit_cost, $inv_gross_total) as $key => $value ) {
					$items[] = array_combine($keys, $value);
				}
			
		}
		
		
		if ( $this->form_validation->run() == true && $this->inventories_model->addPurchase($reference, $date, $supplier_id, $supplier_name, $note, $inv_total, $items, $warehouse_id) )
		{ //check to see if we are creating the biller
			//redirect them back to the admin page
					
			$this->session->set_flashdata('success_message', $this->lang->line("purchase_added"));
			redirect("module=inventories", 'refresh');
			
			
		}
		else
		{ //display the create biller form
			//set the flash data error message if there is one
		
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		
			$data['reference_no'] = array('name' => 'reference_no',
				'id' => 'reference_no',
				'type' => 'text',
				'value' => $this->form_validation->set_value('reference_no'),
			);
			$data['date'] = array('name' => 'date',
				'id' => 'date',
				'type' => 'text',
				'value' => $this->form_validation->set_value('date'),
			);
			$data['note'] = array('name' => 'note',
				'id' => 'note',
				'type' => 'textarea',
				'value' => $this->form_validation->set_value('note'),
			);
			
					
	   $data['suppliers'] = $this->inventories_model->getAllSuppliers();
	   $data['warehouses'] = $this->inventories_model->getAllWarehouses();
	   $data['rnumber'] = $this->inventories_model->getNextAI();
      $meta['page_title'] = $this->lang->line("add_purchase");
	  $data['page_title'] = $this->lang->line("add_purchase");
      $this->load->view('commons/header', $meta);
      $this->load->view('add', $data);
      $this->load->view('commons/footer');
	  
		}
   }
   
   /* -------------------------------------------------------------------------------------------------------------------------------- */ 
//Edit inventory

   function edit($id = NULL)
   {
	   if($this->input->get('id')){ $id = $this->input->get('id'); }
	   $groups = array('salesman', 'viewer');
		if ($this->ion_auth->in_group($groups))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
		//validate form input
		$this->form_validation->set_message('is_natural_no_zero',  $this->lang->line("no_zero_required"));
		$this->form_validation->set_rules('reference_no', $this->lang->line("ref_no"), 'required|xss_clean');
		$this->form_validation->set_rules('date', $this->lang->line("date"), 'required|xss_clean');
		$this->form_validation->set_rules('warehouse', $this->lang->line("warehouse"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('supplier', $this->lang->line("supplier"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('note', $this->lang->line("note"), 'xss_clean');
		
		$quantity = "quantity";
		$product = "product";
		$unit_price = "unit_cost";
		$item_id = "item_id";
			
		if ($this->form_validation->run() == true)
		{
			$reference = $this->input->post('reference_no');
			$inv_date = trim($this->input->post('date'));
			if(JS_DATE == 'dd-mm-yyyy' || JS_DATE == 'dd/mm/yyyy') {
				$date = substr($inv_date, -4)."-".substr($inv_date, 3, 2)."-".substr($inv_date, 0, 2); 
			} else {
				$date = substr($inv_date, -4)."-".substr($inv_date, 0, 2)."-".substr($inv_date, 3, 2);
			}
			$warehouse_id = $this->input->post('warehouse');
			$supplier_id = $this->input->post('supplier');
			$supplier_details = $this->inventories_model->getSupplierByID($supplier_id);
			$supplier_name = $supplier_details->name;
			$note = $this->ion_auth->clear_tags($this->input->post('note'));
			
			$inv_total = 0;
			
			for($i=1; $i<=TOTAL_ROWS; $i++){
					if( $this->input->post($quantity.$i) && $this->input->post($product.$i) && $this->input->post($unit_price.$i) ) {
						
						if(!$this->inventories_model->getProductByCode($this->input->post($product.$i))) {
							$this->session->set_flashdata('message', $this->lang->line("code_not_found")." ( ".$this->input->post($product.$i)." ).");
							redirect("module=inventories&view=edit&id=".$id, 'refresh');
						}
						
						$inv_quantity[] = $this->input->post($quantity.$i);
						$inv_product_code[] = $this->input->post($product.$i);
						$inv_unit_price[] = $this->input->post($unit_price.$i);
						$inv_gross_total[] = (($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)));
						$inv_total += (($this->input->post($quantity.$i)) * ($this->input->post($unit_price.$i)));
						
					}
				}
				
				foreach($inv_product_code as $pr_code){
					$product_details = $this->inventories_model->getProductByCode($pr_code);
					$product_id[] = $product_details->id;
					$product_name[] = $product_details->name;
					$product_code[] = $product_details->code;
				}
		
				$keys = array("product_id","product_code","product_name","quantity","unit_price", "gross_total");
		
					$items = array();
				foreach ( array_map(null, $product_id, $product_code, $product_name, $inv_quantity, $inv_unit_price, $inv_gross_total) as $key => $value ) {
					$items[] = array_combine($keys, $value);
				}
			
		}
		

		
		
		if ( $this->form_validation->run() == true && $this->inventories_model->updatePurchase($id, $reference, $date, $supplier_id, $supplier_name, $note, $inv_total, $items, $warehouse_id) )
		{  
					
			$this->session->set_flashdata('success_message', $this->lang->line("purchase_updated"));
			redirect("module=inventories", 'refresh');
			
		}
		else
		{  
		
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
					
					
	   $data['suppliers'] = $this->inventories_model->getAllSuppliers();
	   $data['products'] = $this->inventories_model->getAllProducts();
	   $data['warehouses'] = $this->inventories_model->getAllWarehouses();
	   $data['inv'] = $this->inventories_model->getInventoryByID($id);
	   $data['inv_products'] =  $this->inventories_model->getAllInventoryItems($id);
	   
      $data['id'] = $id;
	  $meta['page_title'] = $this->lang->line("update_purchase");
	  $data['page_title'] = $this->lang->line("update_purchase");
      $this->load->view('commons/header', $meta);
      $this->load->view('edit', $data);
      $this->load->view('commons/footer');
	  
	}
   } 
     
	
	/* ----------------------------------------------------------------------------------------------------------- */
   
   
   function csv_inventory()
   {
	   $groups = array('purchaser', 'salesman', 'viewer');
		if ($this->ion_auth->in_group($groups))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
		//validate form input
		$this->form_validation->set_message('is_natural_no_zero',  $this->lang->line("no_zero_required"));
		$this->form_validation->set_rules('reference_no', $this->lang->line("ref_no"), 'required|xss_clean');
		$this->form_validation->set_rules('date', $this->lang->line("date"), 'required|xss_clean');
		$this->form_validation->set_rules('warehouse', $this->lang->line("warehouse"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('supplier', $this->lang->line("supplier"), 'required|is_natural_no_zero|xss_clean');
		
		$this->form_validation->set_rules('note', $this->lang->line("note"), 'xss_clean');
		
		
		$this->form_validation->set_rules('userfile', $this->lang->line("upload_file"), 'xss_clean');
		
		$quantity = "quantity";
		$product = "product";
		$unit_price = "unit_price";
			
		if ($this->form_validation->run() == true)
		{
		if (DEMO) {
			$this->session->set_flashdata('message', $this->lang->line("disabled_in_demo"));
			redirect('module=home', 'refresh');
		}
		
			$reference = $this->input->post('reference_no');
			$inv_date = trim($this->input->post('date'));
			if(JS_DATE == 'dd-mm-yyyy' || JS_DATE == 'dd/mm/yyyy') {
				$date = substr($inv_date, -4)."-".substr($inv_date, 3, 2)."-".substr($inv_date, 0, 2); 
			} else {
				$date = substr($inv_date, -4)."-".substr($inv_date, 0, 2)."-".substr($inv_date, 3, 2);
			}
			$warehouse_id = $this->input->post('warehouse');
			$supplier_id = $this->input->post('supplier');
			$supplier_details = $this->inventories_model->getSupplierByID($supplier_id);
			$supplier_name = $supplier_details->name;
			$note = $this->ion_auth->clear_tags($this->input->post('note'));
			$inv_total = 0;
			
			
			
		if ( isset($_FILES["userfile"])) /*if($_FILES['userfile']['size'] > 0)*/
		{
				
		$this->load->library('upload_photo');
		
		//Set the config
		$config['upload_path'] = 'assets/uploads/csv/'; 
		$config['allowed_types'] = 'csv'; 
		$config['max_size'] = '200';
		$config['overwrite'] = TRUE; 
		
			//Initialize
			$this->upload_photo->initialize($config);
			
			if( ! $this->upload_photo->do_upload()){
			
				//echo the errors
				$error = $this->upload_photo->display_errors();
				$this->session->set_flashdata('message', $error);
				redirect("module=inventories&view=csv_inventory", 'refresh');
			} 
		
			//If the upload success
			$csv = $this->upload_photo->file_name;
					
			$arrResult = array();
				$handle = fopen("assets/uploads/csv/".$csv, "r");
				if( $handle ) {
				while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$arrResult[] = $row;
				}
				fclose($handle);
				}
				$titles = array_shift($arrResult);
				
				$keys = array('quantity', 'code', 'unit_price');
				
				$final = array();
						
						foreach ( $arrResult as $key => $value ) {
									$final[] = array_combine($keys, $value);
						}
				$prods = $this->inventories_model->getAllProducts();
				$rw=2;
					foreach($final as $csv_pr) {
					
						if(!$this->inventories_model->getProductByCode($csv_pr['code'])) {
							$this->session->set_flashdata('message', $this->lang->line("code_not_found")." ( ".$csv_pr['code']." ). ".$this->lang->line("line_no")." ".$rw);
							redirect("module=inventories&view=csv_inventory", 'refresh');
						}
					$rw++;	
				
				
						$product_details = $this->inventories_model->getProductByCode($csv_pr['code']);
						$product_id[] = $product_details->id;
						$product_name[] = $product_details->name;
						$product_code[] = $product_details->code;
						
								$inv_quantity[] = $csv_pr['quantity'];
								
								$inv_unit_price[] = $csv_pr['unit_price'];
								$inv_gross_total[] = ( $csv_pr['quantity'] * $csv_pr['unit_price'] );
								$inv_total += ( $csv_pr['quantity'] * $csv_pr['unit_price'] );
								
					}
		
		} 
		
				$keys = array("product_id","product_code","product_name","quantity","unit_price", "gross_total");
		
					$items = array();
				foreach ( array_map(null, $product_id, $product_code, $product_name, $inv_quantity, $inv_unit_price, $inv_gross_total) as $key => $value ) {
					$items[] = array_combine($keys, $value);
				}
				$items = $this->mres($items);
		}
		
		
		if ( $this->form_validation->run() == true && $this->inventories_model->addPurchase($reference, $date, $supplier_id, $supplier_name, $note, $inv_total, $items, $warehouse_id) )
		{ //check to see if we are creating the inv
			//redirect them back to the inv page
					
			$this->session->set_flashdata('success_message', $this->lang->line("purchase_added"));
			redirect("module=inventories", 'refresh');
			
			
		}
		else
		{ //display the create biller form
			//set the flash data error message if there is one
		
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		
			$data['reference_no'] = array('name' => 'reference_no',
				'id' => 'reference_no',
				'type' => 'text',
				'value' => $this->form_validation->set_value('reference_no'),
			);
			$data['date'] = array('name' => 'date',
				'id' => 'date',
				'type' => 'text',
				'value' => $this->form_validation->set_value('date'),
			);
			$data['supplier'] = array('name' => 'supplier',
				'id' => 'supplier',
				'type' => 'select',
				'value' => $this->form_validation->set_select('supplier'),
			);
			$data['note'] = array('name' => 'note',
				'id' => 'note',
				'type' => 'textarea',
				'value' => $this->form_validation->set_value('note'),
			);
			
		//$data['items'] = $items;			
	   $data['suppliers'] = $this->inventories_model->getAllSuppliers();
	   $data['products'] = $this->inventories_model->getAllProducts();
	   $data['warehouses'] = $this->inventories_model->getAllWarehouses();
	   $data['rnumber'] = $this->inventories_model->getNextAI();
	   
      $meta['page_title'] = $this->lang->line("add_purchase");
	  $data['page_title'] = $this->lang->line("add_purchase");
      $this->load->view('commons/header', $meta);
      $this->load->view('csv_inventory', $data);
      $this->load->view('commons/footer');
	  
		}
   }
   
   function mres($q) {
		if(is_array($q))
			foreach($q as $k => $v)
				$q[$k] = $this->mres($v); //recursive
		elseif(is_string($q))
			$q = mysql_real_escape_string($q);
		return $q;
	}
   
/* -------------------------------------------------------------------------------------------------------------------------------- */
	
	function delete($id = NULL)
	{
		if (DEMO) {
			$this->session->set_flashdata('message', $this->lang->line("disabled_in_demo"));
			redirect('module=home', 'refresh');
		}
		
		if($this->input->get('id')){ $id = $this->input->get('id'); }
		
		if (!$this->ion_auth->in_group('owner'))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=home', 'refresh');
		}
		
		if ( $this->inventories_model->deleteInventory($id) )
		{  
			$this->session->set_flashdata('success_message', $this->lang->line("inventory_deleted"));
			redirect('module=inventories', 'refresh');
		}
		
	}
	
	/*---------------------------------------------------------------------------------------------------------- */

function scan_item()
   {
	   if($this->input->get('code')) { $code = $this->input->get('code'); }
	   
	   if($item = $this->inventories_model->getProductByCode($code)) {
	   		
			$product_name = $item->name;
			$product_cost = $item->cost;
			
			$product = array('name' => $product_name, 'cost' => $product_cost);	
		
	   }
	   
	  echo json_encode($product);

   }
  
    function add_item()
   {
	   if($this->input->get('name')) { $name = $this->input->get('name'); }
	   
	   if($item = $this->inventories_model->getProductByName($name)) {
	   		
			$code = $item->code;
			$cost = $item->cost;
			
			$product = array('code' => $code, 'cost' => $cost);	
		
	   }
	   
	  echo json_encode($product);

   }
   
   function suggestions()
	{
		$term = $this->input->get('term',TRUE);
	
		if (strlen($term) < 2) break;
	
		$rows = $this->inventories_model->getProductNames($term);
	
		$json_array = array();
		foreach ($rows as $row)
			 array_push($json_array, $row->name);
	
		echo json_encode($json_array); 
	}

function formatMoney($number, $fractional=false) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return $number; 
} 
}