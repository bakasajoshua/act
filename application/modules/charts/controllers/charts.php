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

		public function first_dashboard()
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
			$data['estimated_total_inneed_identification'] = $this->first_dashboard->estimate_total_identification();

			return $data;
		}

		public function second_dashboard()
		{
			$this->load->model('second_dashboard');

			$data['infants_cumulative_positive_art'] = $this->second_dashboard->cumulative_infants_started_art();
			$data['children_cumulative_art_enrollment'] = $this->second_dashboard->cumulative_children_started_art();
			$data['adults_cumulative_art_enrollment'] = $this->second_dashboard->cumulative_adults_started_art();

			$data['children_inneed_treatment'] = $this->second_dashboard->children_need_treatment();
			$data['adults_inneed_treatment'] = $this->second_dashboard->adults_need_treatment();
			$data['total_inneed_treatment'] = $this->second_dashboard->total_need_treatment();


			return $data;
		}

		public function third_dashboard()
		{
			$this->load->model('third_dashboard');

			$data['survival_retention_art'] = $this->third_dashboard->survival_retention_art();

			return $data;
		}
	}
?>