<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('send_email')) {
	function send_email($destination=null,$data = array(), $subject = 'Default Subject')
	{
		$email = '';
		$email = $destination;
		
		$smtp_user = 'akastoreonlineshop@gmail.com';
		$config = Array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'ssl://smtp.googlemail.com',
			'smtp_port' 	=> 465,
			'smtp_user' 	=> $smtp_user, // change it to yours
			'smtp_pass' 	=> '*passw0rd', // change it to yours
			'mailtype' 		=> 'html',
			'smtp_timeout' 	=> '4',
			'charset' 		=> 'iso-8859-1',
			'wordwrap' => TRUE
		);
		
		$CI =& get_instance();
		
		$message = $CI->load->view('layout/email_template', $data, TRUE);
		
        $CI->load->library('email', $config);
      	$CI->email->set_newline("\r\n");
      	$CI->email->from('info@akastore.com'); // change it to yours
		
		$CI->email->to($email);// change it to yours
      	
		$CI->email->subject($subject);
      	$CI->email->message($message);
      	if($CI->email->send())
     	{
      		//echo 'Email sent.';
     	}
     	else
    	{
     		show_error($CI->email->print_debugger());
    	}
	}
}