<?php
/**
* 
*/
class dashboard extends MY_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('dashboard_model');
	}

	function index()
	{
		$data = array();
		$id=array('county_ID' => 0);
		$data['counties'] = $this->select_county();
		$data['chart']= $this->dashboard_model->county_chart($id);
		$data['breadcrumb'] = $this->breadcrumb($id);

		// echo "<pre>";print_r($data);die();
		$this->template->dashboard($data);
	}

	function county()
	{
		if ($this->input->post('sub_county_select')==0) {
			$id = array('county_ID' => $this->input->post('county_name'),'sub_county_ID' => NULL);
		} else {
			$id = array('county_ID' => $this->input->post('county_name'),'sub_county_ID' => $this->input->post('sub_county_select') );
		}
		// echo "<pre>";print_r($id);die();
		$data['breadcrumb'] = $this->breadcrumb($id);
		$data['counties'] = $this->select_county();
		$data['chart'] = $this->dashboard_model->county_chart($id);
		
		$this->template->dashboard($data);
	}

	function ajax_get_sub_county($id)
	{
		$sub = $this->dashboard_model->get_sub_county($id);
		echo json_encode($sub);
	}

	function breadcrumb($data)
	{

		$li='';
		if ($data['county_ID']==0||$data['county_ID']==NULL||$data['county_ID']==FALSE) {
			$li = '<li><a href="javascript:;">Kenya</a></li>';
		} else if ($data['sub_county_ID']==0||$data['county_ID']==NULL||$data['county_ID']==FALSE) {
			$county = $this->dashboard_model->get_single_county($data['county_ID']);
			// echo "<pre>";print_r($data);die();
			$li .= '<li><a href="javascript:;">Kenya</a></li>';
			$li .= '<li><a href="javascript:;">'.$county[0]['county_name'].'</a></li>';
		} else {
			$sub_county = $this->dashboard_model->get_single_sub_county($data['sub_county_ID']);
			// echo "<pre>";print_r($sub_county);die();
			$li .= '<li><a href="javascript:;">Kenya</a></li>';
			$li .= '<li><a href="javascript:;">'.$sub_county[0]['county_name'].'</a></li>';
			$li .= '<li><a href="javascript:;">'.$sub_county[0]['sub_county_name'].'</a></li>';
		}
		return $li;
	}
	
}
?>