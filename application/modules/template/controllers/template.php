<?php
/**
* 
*/
class template extends MY_Controller
{
	
	public function dashboard($data=NULL)
	{
		$this->load->view('template_view',$data);	
	}
}
?>