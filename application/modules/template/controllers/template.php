<?php
/**
* 
*/
class template extends MY_Controller
{
	
	public function dashboard($data=NULL)
	{
		$this->load->view('dashboard',$data);	
	}

	public function dashboard2($data=NULL)
	{
		$this->load->view('dashboard2',$data);	
	}

	public function dashboard3($data=NULL)
	{
		$this->load->view('dashboard3',$data);	
	}
}
?>