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
		$this->load->module('charts');
	}

	function index()
	{
		$this->set_session_data();
		$data = array();
		$year = (Date('Y')-1);
		$filter = $this->filter($year);
		
		//Data array to be displayed
		$data['counties'] = $this->select_county();
		$data['cascaded'] = $this->charts->cascaded();
		// $data['first_ninety']= $this->charts->first_dashboard();
		// $data['second_ninety'] = $this->charts->second_dashboard();
		// $data['third_ninety'] = $this->charts->third_dashboard();

		$data['breadcrumb'] = $this->breadcrumb();

		// echo "<pre>";print_r($data);die();
		$this->template->dashboard($data);
	}

	function county($year=NULL)
	{

		if ($year==NULL)
			$filter = $this->filter($this->session->userdata('year'));
		else
			$filter = $this->filter($year);
		// echo $this->session->userdata('year');die();
		
		//Data array to be displayed
		$data['breadcrumb'] = $this->breadcrumb();
		$data['counties'] = $this->select_county();
		$data['first_ninety'] = $this->charts->first_dashboard();
		$data['second_ninety'] = $this->charts->second_dashboard();
		$data['third_ninety'] = $this->charts->third_dashboard();
		// echo "<pre>";print_r($data);die();
		$this->template->dashboard($data);
	}

	function ajax_get_sub_county($id)
	{
		$sub = $this->dashboard_model->get_sub_county($id);
		echo json_encode($sub);
	}

	function breadcrumb()
	{

		$li='';
		if ($this->session->userdata('county_ID')==0||$this->session->userdata('county_ID')==NULL||$this->session->userdata('county_ID')==FALSE) {
			$li = '<li><a href="javascript:;">Kenya|&nbsp;&nbsp;('.$this->session->userdata('year').')&nbsp;&nbsp;</a></li>';
		} else if ($this->session->userdata('sub_county_ID')==0||$this->session->userdata('sub_county_ID')==NULL||$this->session->userdata('sub_county_ID')==FALSE) {
			$county = $this->dashboard_model->get_single_county($this->session->userdata('county_ID'));
			// echo "<pre>";print_r($data);die();
			$li .= '<li><a href="javascript:;">Kenya</a></li>';
			$li .= '<li><a href="javascript:;">'.$county[0]['county_name'].'|&nbsp;&nbsp;('.$this->session->userdata('year').')&nbsp;&nbsp;</a></li>';
		} else {
			$sub_county = $this->dashboard_model->get_single_sub_county($this->session->userdata('county_ID'));
			// echo "<pre>";print_r($sub_county);die();
			$li .= '<li><a href="javascript:;">Kenya</a></li>';
			$li .= '<li><a href="javascript:;">'.$sub_county[0]['county_name'].'</a></li>';
			$li .= '<li><a href="javascript:;">'.$sub_county[0]['sub_county_name'].'|&nbsp;&nbsp;('.$this->session->userdata('year').')&nbsp;&nbsp;</a></li>';
		}
		return $li;
	}
	
}
?>