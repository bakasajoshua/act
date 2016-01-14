<?php
/**
* 
*/
class template extends MY_Controller
{
	
	public function dashboard($data=NULL)
	{
		$data['year_filter'] = $this->year_filter();
		$this->load->view('template_view',$data);	
	}
}
?>