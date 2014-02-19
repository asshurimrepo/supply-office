<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfers extends MX_Controller {

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
| MODULE: 			Transfers
| -----------------------------------------------------
| This is transfers module controller file.
| -----------------------------------------------------
*/

	 
	function __construct()
	{
		parent::__construct();
		
		if (!$this->ion_auth->logged_in())
	  	{
			redirect('module=auth&view=login');
	  	}
		
		$groups = array('owner', 'admin');
		if (!$this->ion_auth->in_group($groups))
		{
			$this->session->set_flashdata('message', $this->lang->line("access_denied"));
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			redirect('module=products', 'refresh');
		}
		
		$this->load->library('form_validation');
		$this->load->model('transfers_model');

	}
	
	function index()
   {
	  
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   $data['success_message'] = $this->session->flashdata('success_message');
	   
      $meta['page_title'] = $this->lang->line("transfers");
	  $data['page_title'] = $this->lang->line("transfers");
      $this->load->view('commons/header', $meta);
      $this->load->view('contents', $data);
      $this->load->view('commons/footer');
   }
   
   function gettransfers()
   {
 
	   $this->load->library('datatables');
	   $this->datatables
			->select("id, DATE_FORMAT(date, '".MYSQL_DATE."') as date, transfer_no, from_warehouse_name as fname, from_warehouse_code as fcode, to_warehouse_name as tname,to_warehouse_code as tcode", FALSE)
			->from('transfers')
			->edit_column("fname", "$1 ($2)", "fname, fcode")
			->edit_column("tname", "$1 ($2)", "tname, tcode")
			->add_column("Actions", 
			"<center><a href='#' onClick=\"MyWindow=window.open('index.php?module=transfers&view=view_transfer&id=$1','MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000,height=600'); return false;\" title='".$this->lang->line("view_transfer")."' class='tip'><i class='icon-fullscreen'></i></a> <a href='index.php?module=transfers&view=transfer_pdf&id=$1' title='".$this->lang->line("download_pdf")."' class='tip'><i class='icon-file'></i></a> <a href='index.php?module=transfers&view=edit&id=$1' title='".$this->lang->line("edit_transfer")."' class='tip'><i class='icon-edit'></i></a> <a href='index.php?module=transfers&view=delete_transfer&id=$1' onClick=\"return confirm('". $this->lang->line('alert_x_transfer') ."');\" title='".$this->lang->line("delete_transfer")."' class='tip'><i class='icon-trash'></i></a></center>", "id")
		
		->unset_column('id')
		->unset_column('fcode')
		->unset_column('tcode');
		
		
	   echo $this->datatables->generate();

   }
	
   
	function add()
	{

		//validate form input
		$this->form_validation->set_message('is_natural_no_zero', $this->lang->line("no_zero_required"));
		$this->form_validation->set_rules('reference_no', $this->lang->line("reference_no"), 'required|xss_clean');
		$this->form_validation->set_rules('date', $this->lang->line("date"), 'required|xss_clean');
		$this->form_validation->set_rules('to_warehouse', $this->lang->line("warehouse").' ('.$this->lang->line("to").')', 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('from_warehouse', $this->lang->line("warehouse").' ('.$this->lang->line("from").')', 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('product1', $this->lang->line("product1"), 'required|xss_clean');
		$this->form_validation->set_rules('quantity1', $this->lang->line("quantity1"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('note', $this->lang->line("note"), 'xss_clean');
		
		if ( $this->form_validation->run() ) {
			
			$transfer_no 	= $this->input->post('reference_no');
			$inv_date = trim($this->input->post('date'));
			if(JS_DATE == 'dd-mm-yyyy' || JS_DATE == 'dd/mm/yyyy') {
				$date = substr($inv_date, -4)."-".substr($inv_date, 3, 2)."-".substr($inv_date, 0, 2); 
			} else {
				$date = substr($inv_date, -4)."-".substr($inv_date, 0, 2)."-".substr($inv_date, 3, 2);
			}
			$to_warehouse 	= $this->input->post('to_warehouse');
			$from_warehouse = $this->input->post('from_warehouse');
			$note = $this->ion_auth->clear_tags($this->input->post('note'));
			
			$from_warehouse_details = $this->transfers_model->getWarehouseByID($from_warehouse);
			$from_warehouse_code = $from_warehouse_details->code;
			$from_warehouse_name = $from_warehouse_details->name;
			
			$to_warehouse_details = $this->transfers_model->getWarehouseByID($to_warehouse);
			$to_warehouse_code = $to_warehouse_details->code;
			$to_warehouse_name = $to_warehouse_details->name;
			
			
			if($to_warehouse == $from_warehouse) {
				$this->session->set_flashdata('message', $this->lang->line("same_warehouse"));
				redirect("module=products&view=transfer", 'refresh');
			}
				$quantity = "quantity";
				$product = "product";
		
				for($i=1; $i<=TOTAL_ROWS; $i++){
					if( $this->input->post($quantity.$i) && $this->input->post($product.$i) ) {				
						$tr_pr_code[] = $this->input->post($product.$i);
						$tr_quantity[] = $this->input->post($quantity.$i);
						
					}
				}
				
					foreach($tr_pr_code as $pr_code) {
						
						$product_details = $this->transfers_model->getProductByCode($pr_code);
						$tr_product_id[] = $product_details->id;
						$tr_product_code[] = $product_details->code;
						$tr_product_name[] = $product_details->name;
						$tr_product_unit[] = $product_details->unit;
						
					}
				
				$transferDetails = array('transfer_no' => $transfer_no,
					'date' => $date,
					'from_warehouse_id' => $from_warehouse,
					'from_warehouse_code' => $from_warehouse_code,
					'from_warehouse_name' => $from_warehouse_name,
					'to_warehouse_id' => $to_warehouse,
					'to_warehouse_code' => $to_warehouse_code,
					'to_warehouse_name' => $to_warehouse_name,
					'note' => $note,
					'user' => USER_NAME
				);
				
				$keys = array("product_id","product_code","product_name","product_unit", "quantity");
		
					$items = array();
				foreach ( array_map(null, $tr_product_id, $tr_product_code, $tr_product_name, $tr_product_unit, $tr_quantity) as $key => $value ) {
					$items[] = array_combine($keys, $value);
				}
		/*	
		$data['transfer'] = $transferDetails;
		$data['items'] = $items
		
		foreach($items as $item){
				$data['item_id'] = $item['product_id'];
				$data['item_quantity'] = $item['quantity'];
		}*/
		}
		
		
			
		if ( $this->form_validation->run() == true && $this->transfers_model->transferProducts($transferDetails, $items))
		{  
			$this->session->set_flashdata('success_message', $this->lang->line("quantity_transferred"));
			redirect("module=transfers", 'refresh');
		}
		else
		{  
			
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			
			$data['name'] = array('name' => 'name',
				'id' => 'name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('name'),
			);
			$data['quantity'] = array('name' => 'quantity',
				'id' => 'quantity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('quantity'),
			);
			
			
		$data['warehouses'] = $this->transfers_model->getAllWarehouses();
		$data['products'] = $this->transfers_model->getAllProducts();	
		$data['rnumber'] = $this->transfers_model->getNextAI();
		$meta['page_title'] = $this->lang->line("transfer_quantity");
		$data['page_title'] = $this->lang->line("transfer_quantity");
		$this->load->view('commons/header', $meta);
		$this->load->view('add', $data);
		$this->load->view('commons/footer');
		
		}
	}
	
	function edit()
	{
		if($this->input->get('id')) { $id = $this->input->get('id'); } else { $id = NULL; }
		
		//validate form input
		$this->form_validation->set_message('is_natural_no_zero', $this->lang->line("no_zero_required"));
		$this->form_validation->set_rules('reference_no', $this->lang->line("reference_no"), 'required|xss_clean');
		$this->form_validation->set_rules('date', $this->lang->line("date"), 'required|xss_clean');
		$this->form_validation->set_rules('to_warehouse', $this->lang->line("warehouse").' ('.$this->lang->line("to").')', 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('from_warehouse', $this->lang->line("warehouse").' ('.$this->lang->line("from").')', 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('product1', $this->lang->line("product1"), 'required|xss_clean');
		$this->form_validation->set_rules('quantity1', $this->lang->line("quantity1"), 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('note', $this->lang->line("note"), 'xss_clean');
		
		if ( $this->form_validation->run() ) {
			
			$transfer_no 	= $this->input->post('reference_no');
			$inv_date = trim($this->input->post('date'));
			if(JS_DATE == 'dd-mm-yyyy' || JS_DATE == 'dd/mm/yyyy') {
				$date = substr($inv_date, -4)."-".substr($inv_date, 3, 2)."-".substr($inv_date, 0, 2); 
			} else {
				$date = substr($inv_date, -4)."-".substr($inv_date, 0, 2)."-".substr($inv_date, 3, 2);
			}
			$to_warehouse 	= $this->input->post('to_warehouse');
			$from_warehouse = $this->input->post('from_warehouse');
			$note = $this->ion_auth->clear_tags($this->input->post('note'));
			
			$from_warehouse_details = $this->transfers_model->getWarehouseByID($from_warehouse);
			$from_warehouse_code = $from_warehouse_details->code;
			$from_warehouse_name = $from_warehouse_details->name;
			
			$to_warehouse_details = $this->transfers_model->getWarehouseByID($to_warehouse);
			$to_warehouse_code = $to_warehouse_details->code;
			$to_warehouse_name = $to_warehouse_details->name;
			
			
			if($to_warehouse == $from_warehouse) {
				$this->session->set_flashdata('message', $this->lang->line("same_warehouse"));
				redirect("module=products&view=transfer", 'refresh');
			}
				$quantity = "quantity";
				$product = "product";
		
				for($i=1; $i<=TOTAL_ROWS; $i++){
					if( $this->input->post($quantity.$i) && $this->input->post($product.$i) ) {				
						$tr_pr_code[] = $this->input->post($product.$i);
						$tr_quantity[] = $this->input->post($quantity.$i);
						
					}
				}
				
					foreach($tr_pr_code as $pr_code) {
						
						$product_details = $this->transfers_model->getProductByCode($pr_code);
						$tr_product_id[] = $product_details->id;
						$tr_product_code[] = $product_details->code;
						$tr_product_name[] = $product_details->name;
						$tr_product_unit[] = $product_details->unit;
						
					}
				
				$transferDetails = array('transfer_no' => $transfer_no,
					'date' => $date,
					'from_warehouse_id' => $from_warehouse,
					'from_warehouse_code' => $from_warehouse_code,
					'from_warehouse_name' => $from_warehouse_name,
					'to_warehouse_id' => $to_warehouse,
					'to_warehouse_code' => $to_warehouse_code,
					'to_warehouse_name' => $to_warehouse_name,
					'note' => $note,
					'user' => USER_NAME
				);
				
				$keys = array("product_id","product_code","product_name","product_unit", "quantity");
		
					$items = array();
				foreach ( array_map(null, $tr_product_id, $tr_product_code, $tr_product_name, $tr_product_unit, $tr_quantity) as $key => $value ) {
					$items[] = array_combine($keys, $value);
				}
		/*	
		$data['transfer'] = $transferDetails;
		$data['items'] = $items
		
		foreach($items as $item){
				$data['item_id'] = $item['product_id'];
				$data['item_quantity'] = $item['quantity'];
		}*/
		}
		
		
			
		if ( $this->form_validation->run() == true && $this->transfers_model->updateTransfer($id, $transferDetails, $items))
		{  
			$this->session->set_flashdata('success_message', $this->lang->line("transfer_updated"));
			redirect("module=transfers", 'refresh');
		}
		else
		{  
			
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			
		$data['warehouses'] = $this->transfers_model->getAllWarehouses();
		$data['transfer'] = $this->transfers_model->getTransferByID($id);
		$data['transfer_items'] = $this->transfers_model->getAllTransferItems($id);
		$data['id'] = $id;
		$data['products'] = $this->transfers_model->getAllProducts();	
		$data['rnumber'] = $this->transfers_model->getNextAI();
		$meta['page_title'] = $this->lang->line("edit_transfer_quantity");
		$data['page_title'] = $this->lang->line("edit_transfer_quantity");
		$this->load->view('commons/header', $meta);
		$this->load->view('edit', $data);
		$this->load->view('commons/footer');
		
		}
	}
	
	function transfer_csv()
	{

		//validate form input
		$this->form_validation->set_message('is_natural_no_zero', $this->lang->line("no_zero_required"));
		$this->form_validation->set_rules('reference_no', $this->lang->line("reference_no"), 'required|xss_clean');
		$this->form_validation->set_rules('date', $this->lang->line("date"), 'required|xss_clean');
		$this->form_validation->set_rules('to_warehouse', $this->lang->line("warehouse").' ('.$this->lang->line("to").')', 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('from_warehouse', $this->lang->line("warehouse").' ('.$this->lang->line("from").')', 'required|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('note', $this->lang->line("note"), 'xss_clean');
		$this->form_validation->set_rules('userfile', $this->lang->line("upload_file"), 'xss_clean');
		
		if ( $this->form_validation->run() ) {
		
			$transfer_no 	= $this->input->post('reference_no');
			$inv_date = trim($this->input->post('date'));
			if(JS_DATE == 'dd-mm-yyyy' || JS_DATE == 'dd/mm/yyyy') {
				$date = substr($inv_date, -4)."-".substr($inv_date, 3, 2)."-".substr($inv_date, 0, 2); 
			} else {
				$date = substr($inv_date, -4)."-".substr($inv_date, 0, 2)."-".substr($inv_date, 3, 2);
			}
			$to_warehouse 	= $this->input->post('to_warehouse');
			$from_warehouse = $this->input->post('from_warehouse');
			$note = $this->ion_auth->clear_tags($this->input->post('note'));
			
			$from_warehouse_details = $this->transfers_model->getWarehouseByID($from_warehouse);
			$from_warehouse_code = $from_warehouse_details->code;
			$from_warehouse_name = $from_warehouse_details->name;
			
			$to_warehouse_details = $this->transfers_model->getWarehouseByID($to_warehouse);
			$to_warehouse_code = $to_warehouse_details->code;
			$to_warehouse_name = $to_warehouse_details->name;
			
			
			if($to_warehouse == $from_warehouse) {
				$this->session->set_flashdata('message', $this->lang->line("same_warehouse"));
				redirect("module=products&view=transfer", 'refresh');
			}
				
		
		if ($this->form_validation->run() == true)
		{
		if (DEMO) {
			$this->session->set_flashdata('message', $this->lang->line("disabled_in_demo"));
			redirect('module=home', 'refresh');
		}
						
			
		if ( isset($_FILES["userfile"])) /*if($_FILES['userfile']['size'] > 0)*/
		{
				
		$config['upload_path'] = 'assets/uploads/csv/'; 
		$config['allowed_types'] = 'csv'; 
		$config['max_size'] = '200';
		$config['overwrite'] = TRUE; 
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if( ! $this->upload->do_upload()){
			
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('message', $error);
				redirect("module=products&view=transfer_csv", 'refresh');
			} 
		
			$csv = $this->upload->file_name;
					
			$arrResult = array();
				$handle = fopen("assets/uploads/csv/".$csv, "r");
				if( $handle ) {
				while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$arrResult[] = $row;
				}
				fclose($handle);
				}
				$titles = array_shift($arrResult);
				
				$keys = array('code', 'quantity');
				
				$final = array();
						
						foreach ( $arrResult as $key => $value ) {
									$final[] = array_combine($keys, $value);
						}
				
				$rw=2;
					foreach($final as $csv_pr) {
					
						if(!$this->transfers_model->getProductByCode($csv_pr['code'])) {
							$this->session->set_flashdata('message', $this->lang->line("code_not_found")." ( ".$csv_pr['code']." ). ".$this->lang->line("line_no")." ".$rw);
							redirect("module=transfers&view=transfer_csv", 'refresh');
						}
				$rw++;
						$code = $csv_pr['code'];
						$qt = $csv_pr['quantity'];
						$product_details = $this->transfers_model->getProductByCode($code);
						$product_id[] = $product_details->id;
						$product_name[] = $product_details->name;
						$product_code[] = $product_details->code;
						$product_unit[] = $product_details->unit;
						
						$quantity[] = $qt;
									
					}
		
		} 
		
				$transferDetails = array('transfer_no' => $transfer_no,
					'date' => $date,
					'from_warehouse_id' => $from_warehouse,
					'from_warehouse_code' => $from_warehouse_code,
					'from_warehouse_name' => $from_warehouse_name,
					'to_warehouse_id' => $to_warehouse,
					'to_warehouse_code' => $to_warehouse_code,
					'to_warehouse_name' => $to_warehouse_name,
					'note' => $note
				);
				
				$keys = array("product_id","product_code","product_name","product_unit", "quantity");
		
					$items = array();
				foreach ( array_map(null, $product_id, $product_code, $product_name, $product_unit, $quantity) as $key => $value ) {
					$items[] = array_combine($keys, $value);
				}
				$items = $this->mres($items);
		}
		
		/*
		$data['transfer'] = $transferDetails;
		$data['items'] = $items;
		*/
		
		}
		
		
		
		if ( $this->form_validation->run() == true && $this->transfers_model->transferProducts($transferDetails, $items))
		{  
			$this->session->set_flashdata('success_message', $this->lang->line("quantity_transferred"));
			redirect("module=transfers", 'refresh');
		}
		else
		{  
			
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			
			$data['name'] = array('name' => 'name',
				'id' => 'name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('name'),
			);
			$data['quantity'] = array('name' => 'quantity',
				'id' => 'quantity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('quantity'),
			);
			
			
		$data['warehouses'] = $this->transfers_model->getAllWarehouses();
		$data['products'] = $this->transfers_model->getAllProducts();	
		$data['rnumber'] = $this->transfers_model->getNextAI();
		$meta['page_title'] = $this->lang->line("transfer_quantity");
		$data['page_title'] = $this->lang->line("transfer_quantity");
		$this->load->view('commons/header', $meta);
		$this->load->view('transfer_csv', $data);
		$this->load->view('commons/footer');
		
		}
	}
	
   
	function view_transfer($transfer_id = NULL)
   {
	   if($this->input->get('id')) { $transfer_id = $this->input->get('id'); }
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   
	   $data['rows'] = $this->transfers_model->getAllTransferItems($transfer_id);
	   
	   $transfer = $this->transfers_model->getTransferByID($transfer_id);
	  
	  $data['from_warehouse'] = $this->transfers_model->getWarehouseByID($transfer->from_warehouse_id);
	  $data['to_warehouse'] = $this->transfers_model->getWarehouseByID($transfer->to_warehouse_id);
	   
	   
	   $data['transfer'] = $transfer;
	  $data['tid'] = $transfer_id;   
	  $data['page_title'] = $this->lang->line("transfer");
	
	  
      $this->load->view('view_transfer', $data);

   }
   
   function transfer_pdf($transfer_id = NULL)
   {
	   	 
		   if($this->input->get('id')) { $transfer_id = $this->input->get('id'); }
		   
	   $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	   
	   $data['rows'] = $this->transfers_model->getAllTransferItems($transfer_id);
	   
	   $transfer = $this->transfers_model->getTransferByID($transfer_id);
	  
	  $data['from_warehouse'] = $this->transfers_model->getWarehouseByID($transfer->from_warehouse_id);
	  $data['to_warehouse'] = $this->transfers_model->getWarehouseByID($transfer->to_warehouse_id);
	   
	   
	   $data['transfer'] = $transfer;
	  $data['tid'] = $transfer_id;   
	  $data['page_title'] = $this->lang->line("transfer");
	  
	 
	  $this->load->library('MPDF53/mpdf');
			  
		$mpdf=new mPDF('uft-8','A4', '', '', 15, 15, 25, 25, 9, 9, 'L'); 
		$mpdf->useOnlyCoreFonts = true;    // false is default
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle(SITE_NAME);
		$mpdf->SetAuthor(SITE_NAME);
		$mpdf->SetCreator(SITE_NAME);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetAutoFont();
		
		$html =  $this->load->view('view_transfer', $data, TRUE);
		
	$name = "Transfer No. ".$transfer_id.".pdf";
	
	$search = array("<div class=\"row-fluid\">", "<div class=\"span6\">", "<div class=\"span5\">", "<div class=\"span5 offset2\">");
		$replace = array("<div style='width: 100%;'>", "<div style='width: 48%; float: left;'>", "<div style='width: 40%; float: left;'>", "<div style='width: 40%; float: right;'>");
	
	$html = str_replace($search, $replace, $html);
	$html = str_replace($search, $replace, $html);
	
	$mpdf->WriteHTML($html);
	
	$mpdf->Output($name, 'D'); 
	
	exit;

   }
   

	function mres($q) {
		if(is_array($q))
			foreach($q as $k => $v)
				$q[$k] = $this->mres($v); //recursive
		elseif(is_string($q))
			$q = mysql_real_escape_string($q);
		return $q;
	}
	
	function delete_transfer($id = NULL)
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
		
		
		if ( $this->transfers_model->deleteTransfer($id) )
		{ 
			$this->session->set_flashdata('success_message', $this->lang->line("transfer_deleted"));
			redirect('module=transfers', 'refresh');
		}
		
	}
	
	function scan_item()
   {
	   if($this->input->get('code')) { $code = $this->input->get('code'); }
	   
	   if($item = $this->transfers_model->getProductByCode($code)) {
	   		
			$product_name = $item->name;
			
			$product = array('name' => $product_name);	
		
	   }
	   
	  echo json_encode($product);

   }
  
  
    function add_item()
   {
	   if($this->input->get('name')) { $name = $this->input->get('name'); }
	   
	   if($item = $this->transfers_model->getProductByName($name)) {
	   		
			$code = $item->code;
			
			$product = array('code' => $code);	
		
	   }
	   
	  echo json_encode($product);

   }
   
   function suggestions()
	{
		$term = $this->input->get('term',TRUE);
	
		if (strlen($term) < 2) break;
	
		$rows = $this->transfers_model->getProductNames($term);
	
		$json_array = array();
		foreach ($rows as $row)
			 array_push($json_array, $row->name);
	
		echo json_encode($json_array); 
	}
	
}