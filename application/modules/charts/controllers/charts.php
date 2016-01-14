<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class charts extends MY_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
		}

		public function first_dashboard($id=NULL)
		{
			$this->load->model('first_dashboard');

			$data['infants_cumulative_test_positive'] = $this->first_dashboard->cumulative_infants_tests_vs_positive();
			$data['children_cumulative_test_positive'] = $this->first_dashboard->cumulative_children_tests_vs_positive();
			$data['adults_cumulative_test_positive'] = $this->first_dashboard->cumulative_adults_tests_vs_positive();
			$data['infants_positivity'] = $this->first_dashboard->infants_positive();
			$data['children_positivity'] = $this->first_dashboard->children_positive();
			$data['adults_positivity'] = $this->first_dashboard->adults_positive();
			$data['children_positive_enrolled'] = $this->first_dashboard->children_enrollment();
			$data['adults_positive_enrolled'] = $this->first_dashboard->adults_enrollment();
			$data['total_positive_enrolled'] = $this->first_dashboard->total_enrollment();
			$data['estimated_identified_children'] = $this->first_dashboard->estimated_children_identification();
			$data['estimated_identified_adults'] = $this->first_dashboard->estimate_adults_identification();

			return $data;
		}

		public function second_dashboard($id=NULL)
		{
			$this->load->model('second_dashboard');
		}
	}
?>