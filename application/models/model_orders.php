<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_orders extends CI_Model {
	
	public function get_user_id_by_session()
	{ 
		$usr_name = $this->session->userdata('username');
		$gry = $this->db->where('usr_name',$usr_name)
						->select('usr_id')
						->limit(1)
						->get('users');
				if($gry->num_rows() > 0 )
					{ 
							return $gry->row()->usr_id;
					}else
					{			
							return 0;
						 }	
	}
	public function get_user_name_by_session()
	{ 
		$usr_name = $this->session->userdata('username');
		$gry = $this->db->where('usr_name',$usr_name)
						->select('usr_name')
						->limit(1)
						->get('users');
				if($gry->num_rows() > 0 )
					{ 
							return $gry->row()->usr_name;
					}else
					{			
							return 0;
						 }	
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
	public function get_no_telp_by_session()
	{ 
		$usr_name = $this->session->userdata('username');
		$gry = $this->db->where('usr_name',$usr_name)
						->select('no_telp')
						->limit(1)
						->get('users');
				if($gry->num_rows() > 0 )
					{ 
							return $gry->row()->no_telp;
					}else
					{			
							return 0;
						 }	
	}
	public function process()
	{ 	
	
		
		//here for create new invoice
		$invoice = array(
						'data'		=>	date('Y-m-d H:i:s'),
						'due_date'	=>	date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
						'user_id'	=> $this->get_user_id_by_session(),
						'status'	=>	'unpaid'
						);
		$this->db->insert('invoices',$invoice);
		$invoice_id = $this->db->insert_id();
		//here for put ordered items in orders table
		foreach ($this->cart->contents() as $item)
		{
			$data = array(
						'invoice_id'		=> $invoice_id,
						'product_id'		=> $item['id'],
						'product_type'		=> $item['name'],
						'product_title'		=> $item['title'],
						'usr'				=> $this->get_user_id_by_session(),
						'nama'				=> $this->get_user_name_by_session(),
						'telp'				=> $this->get_no_telp_by_session(),
						'qty'				=> $item['qty'],
						'price'				=> $item['price']
						
						 );
			$this->db->insert('orders',$data);
		}
		
		$status['status'] = 'request';
		$data += $status;
		
		$pname 	= $item['name'];
		$pname	= $pname.' - '.$item['title'];
		
		send_email($this->get_email_by_session(),$data,'Tagihan dan Petunjuk Pembayaran '.$pname.'');
		
		return TRUE;
	}
	
	public function all_invoices()
	{ // get all orders from orders tble
		$get_orders = $this->db->get('invoices');
			if($get_orders->num_rows() > 0 ) {
					return $get_orders->result();
			} else {
					 return array();
			}
	}
	public function get_invoice_by_id($invoice_id)
	{
		$get_invoice_by = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
		if($get_invoice_by->num_rows() > 0 ) {
					return $get_invoice_by->result();
			} else {
					 return FALSE;
					}
	}
	
	public function get_orders_by_invoice($invoice_id)
	{
		$get_orders_by = $this->db->where('invoice_id',$invoice_id)->get('orders');
		if($get_orders_by->num_rows() > 0 ) {
					return $get_orders_by->result();
			} else {
					 return FALSE;
					}
	}
	
	
}//end class