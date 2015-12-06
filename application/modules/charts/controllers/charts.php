<?php if (!defined('BASEPATH')) or exit('No direct script access allowed');
	/**
	* 
	*/
	class charts extends MY_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
		$this->load->model('charts_model');
		}
	}
?>