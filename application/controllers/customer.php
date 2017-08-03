<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
		
	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('model_customer');
		$this->load->model('model_settings');
		$this->load->model('model_users');
	}

	public function index()
	{	
			
	}
	public function payment_confirmation($invoice_id = 0 )
	{	
		$data['get_sitename'] = $this->model_settings->sitename_settings();
		$data['get_footer'] = $this->model_settings->footer_settings();
		$this->form_validation->set_rules('invoice_id_input','Invoice id','required|integer');
		$this->form_validation->set_rules('amount_input','Amount Transfered','required|integer');
		
		if($this->form_validation->run()	==	FALSE)
		{
			if($this->input->post('invoice_id_input'))
			{
				$data['invoice_id'] =set_value('invoice_id_input');
			}else{	
					$data['invoice_id'] = $invoice_id;
				}
			$this->load->view('customer/form_payment_confirmation',$data);
		}else{
				$config['upload_path'] = 'assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				// $config['max_size'] = '1024';
				$config['max_size'] = '4084';
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('userfile')){
					//kalau error upload
					print_r($this->upload->display_errors());
				}else{
					//kalau success upload
					$upload_image = $this->upload->data('bukti_trnsfr');
					$userfile = array(
					'bukti_trnsfr'	=> $this->upload->data()['file_name']);
					
					$is_valid = $this->model_customer->mark_invoice_paid_confirmed(set_value('invoice_id_input'),set_value('amount_input'),$userfile);
					if ($is_valid)
					{
							$data['nama'] 	= $this->session->userdata('username');
							$data['status'] = 'verified';
							
							send_email($this->get_email_by_session(),$data,'Hore, Pesanan Sedang Di Proses');
							$this->session->set_flashdata('message','Terima Kasih, Produk Yang Anda Pesan Akan Segera Kami Proses');
							redirect('customer/shopping_history');
					}else{
							$this->session->set_flashdata('error','Jumlah Nominal Salah, Silahkan Coba Lagi ');
							redirect('customer/payment_confirmation/'.set_value('invoice_id_input'));
						}
				}
					
			}
	}
	public function shopping_history()
	{
		$data['get_sitename'] = $this->model_settings->sitename_settings();
		$data['get_footer'] = $this->model_settings->footer_settings();	
		
		$user=$this->session->userdata('username');
		$data['history'] = $this->model_customer->get_shopping_history($user);
		$this->load->view('customer/shopping_history_list',$data);
	}
	
	public function get_email_by_session()
	{ 
		$usr_name = $this->session->userdata('username');
		$gry = $this->db->where('usr_name',$usr_name)
						->select('email')
						->limit(1)
						->get('users');
				if($gry->num_rows() > 0 )
					{ 
							return $gry->row()->email;
					}else
					{			
							return 0;
						 }	
	}
	
	
	
}//end class
