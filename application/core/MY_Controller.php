<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//error_reporting(0);
class MY_Controller extends MX_Controller{
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->module('hash');
    }

    function get_loan_data($loan_id)
	{
		$this->load->model('manager/m_manager');
		$garant = array();
		$loan_not = $this->m_manager->get_loan_notifications($loan_id)->result_array();
		$count=1;
		foreach ($loan_not as $key => $value) {
				$garant[$count]=$value['guarantor_id'];
				$count++;
		}
		$data = array(
					'guarantor1'=> $garant[1],
					'guarantor2'=> $garant[2]
					);
		return $data;
	}

	function identifier_builder($email)
	{
		$encrypt_key = $this->config->item('activation');
		$scope = date('MD');
		$input = $email.$scope.$encrypt_key.$email;
		$identifier = strtoupper(hash('sha256', $input));

		return $identifier;
	}

	function status_3level($status)
	{
		$tag = '';
		if ($status==0) {
			$tag = '<span><i class="label label-warning">PENDING</i></span>';
		} else if ($status==1) {
			$tag = '<span><i class="label label-success">APPROVED</i></span>';
		}
		else if ($status==2) {
			$tag = '<span><i class="label label-danger">DECLINED</i></span>';
		}
		return $tag;
	}

   	function send_email($email,$subject, $message)
	{
		$time=date('Y-m-d');
		
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => "chrisrichrads@gmail.com",
			'smtp_pass' => "joshuaSUN"
			);
		// echo $email."<pre>";print_r($config);die();
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('chrisrichrads@gmail.com', 'SACCO MANAGEMENT SYSTEM');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		
		
		if($this->email->send())
			{	
				// $this->admin_model->store_sent_email($recipient, $subject, $message, $time);
				// $this->load->view('students_view');
				return "Email sent";
				
			} else 
			{
				show_error($this->email->print_debugger());
				return "An error occured while sending the email";
			}
	}

	function login_reroute($type)
	{
		if ($this->session->userdata('is_logged_in')) {
			if ($type != $this->session->userdata('user_type')) {
				redirect(base_url().$this->template->redirect($this->session->userdata('user_type')));
			}
		} else {
			redirect(base_url().'users/login');
		}
	}

	function _logged_in()
	{
		if (!$this->session->userdata('is_logged_in')) {
			redirect(base_url().'users/login');
		} 
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'users/homepage');
	}

	public static function truncateStringWords($str, $maxlen=32)
	{
	    if (strlen($str) <= $maxlen) return $str;

	    $newstr = substr($str, 0, $maxlen);
	    if (substr($newstr, -1, 1) != ' ') $newstr = substr($newstr, 0, strrpos($newstr, " "));

	    return $newstr;
	}


}
