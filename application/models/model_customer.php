<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_customer extends CI_Model {
		
	public function get_shopping_history($user)
		{// get all invoices identified by $user
			$get_it =  $this->db->select('i.*,SUM(o.qty * o.price) AS total')
								->from('invoices i, users u,orders o')
								->where('u.usr_name',$user)
								->where('u.usr_id = i.user_id')
								->where('o.invoice_id = i.id')
								->group_by('o.invoice_id')
								->get
								();

								
			if($get_it->num_rows() > 0 )
			{
				return $get_it->result();
			}else{
					return FALSE; //if there are no matching records
				}
		}
		public function mark_invoice_paid_confirmed($invoice_id,$amount,$bukti_trnsfr)
		{//check the invoice
			// print_r($bukti_trnsfr);die;
			$ret = TRUE ;
			$this->db->where('invoice_id', $invoice_id)
					 ->update('orders', $bukti_trnsfr);
			$is_invoice = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
			if($is_invoice->num_rows() == 0  )
			{
					$ret = $ret && FALSE;

			}else{//check the amount
					
					//get total qty order from invoice id
					$get_total_qty = $this->db->select("a.*,((SELECT p.pro_stock FROM products p WHERE pro_id=a.product_id)-a.qty)stocksisa")
										->where("invoice_id",$invoice_id)
										->from("orders a")
										->get()->result_array();
										for($x=0;$x<count($get_total_qty);$x++){
											$this->db->where('pro_id',$get_total_qty[$x]['product_id'])->update('products',array('pro_stock'=>$get_total_qty[$x]['stocksisa']));
										}
					

					$total = $this->db->select('SUM(qty * price) AS total')
									  ->where('invoice_id',$invoice_id)
									  ->get('orders');				  
					if($total->row()->total > $amount )

					{
							$ret = $ret && FALSE ;
					}else
					{//mark the invoice to PAID
							$this->db->where('id',$invoice_id)->update('invoices',array('status'=>'confirmed'));
							//update alamat pengirim
							$this->db->where('invoice_id',$invoice_id)->update('orders',array('alamat_kirim'=>$this->input->post('alamat_kirim')));
							//update keterangan
							$this->db->where('invoice_id',$invoice_id)->update('orders',array('keterangan'=>$this->input->post('keterangan')));
						}
						
				 }
			return $ret;
		}
		public function simpangambar($bukti_trnsfr)
		{
			$ret = TRUE;
			$data_order = $this->db->insert('invoices', $bukti_trnsfr);
		}
		
	}///end class  ///
	
	
?>
		