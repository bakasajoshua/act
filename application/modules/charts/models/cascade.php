<?php
if(!defined('BASEPATH')) exit('No direct access to script allowed!');

	/**
	* @author: Bakasa Joshua
	* @email : baksajoshua09@gmail.com
	*/
	class cascade extends MY_Model
	{
		
		function __construct()
		{
			parent:: __construct();
		}

		function cascade_children()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');
			$clhiv = 0;
			$childrenachievedIncare = 0;
			$childrengapIncare = 0;
			$childrenachievedTreatment = 0;
			$childrengapTreatment = 0;
			$childrenachievedSuppression = 0;
			$childrengapSuppression = 0;

			$sql = "SELECT
						*
					FROM `cascade`
					WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$return = $this->db->query($sql)->result_array();

			foreach ($return as $key => $value) {
				$calculated_data = array(
									'clhiv' => @$clhiv+@$value['clhiv'],
									'childrenachievedIncare' => @$childrenachievedIncare+@$value['childrenactualforidentification'],
									'childrengapIncare' => @$childrengapIncare+(@$value['childrentargetforidentification']-@$value['childrenactualforidentification']),
									'childrenachievedTreatment' => @$childrenachievedTreatment+@$value['childrenactualfortreatment'],
									'childrengapTreatment' => @$childrengapTreatment+(@$value['childrentargetfortreatment']-@$value['childrenactualfortreatment']),
									'childrenachievedSuppression' => @$childrenachievedSuppression+@$value['childrenactualforviralsuppression'],
									'childrengapSuppression' => @$childrengapSuppression+(@$value['childrentargetforviralsuppression']-@$value['childrenactualforviralsuppression'])
									);
			}

			$data["cascade_children"][0]["name"] = 'Gap';
			$data["cascade_children"][1]["name"] = 'Achieved';

			$data["cascade_children"][0]["data"] = array(NULL, (int) $calculated_data["childrengapIncare"], (int) $calculated_data["childrengapTreatment"], (int) $calculated_data["childrengapSuppression"]);
			$data["cascade_children"][1]["data"] = array((int) $calculated_data["clhiv"], (int) $calculated_data["childrenachievedIncare"], (int) $calculated_data["childrenachievedTreatment"], (int) $calculated_data["childrenachievedSuppression"]);
			
			return $data;
		}

		function cascaded_adults()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');
			$adultslhiv = 0;
			$adultsachievedIncare = 0;
			$adultsgapIncare = 0;
			$adultsachievedTreatment = 0;
			$adultsgapTreatment = 0;
			$adultsachievedSuppression = 0;
			$adultsgapSuppression = 0;

			$sql = "SELECT
						*
					FROM `cascade`
					WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$return = $this->db->query($sql)->result_array();

			foreach ($return as $key => $value) {
				$calculated_data = array(
									'adultslhiv' => @$adultslhiv+@$value['adultslhiv'],
									'adultsachievedIncare' => @$adultsachievedIncare+@$value['adultsactualforidentification'],
									'adultsgapIncare' => @$adultsgapIncare+(@$value['adultstargetforidentification']-@$value['adultsactualforidentification']),
									'adultsachievedTreatment' => @$adultsachievedTreatment+@$value['adultsactualfortreatment'],
									'adultsgapTreatment' => @$adultsgapTreatment+(@$value['adultstargetfortreatment']-@$value['adultsactualfortreatment']),
									'adultsachievedSuppression' => @$adultsachievedSuppression+@$value['adultsactualforviralsuppression'],
									'adultsgapSuppression' => @$adultsgapSuppression+(@$value['adultstargetforviralsuppression']-@$value['adultsactualforviralsuppression'])
									);
			}

			$data["cascade_adults"][0]["name"] = 'Gap';
			$data["cascade_adults"][1]["name"] = 'Achieved';

			$data["cascade_adults"][0]["data"] = array(NULL, (int) $calculated_data["adultsgapIncare"], (int) $calculated_data["adultsgapTreatment"], (int) $calculated_data["adultsgapSuppression"]);
			$data["cascade_adults"][1]["data"] = array((int) $calculated_data["adultslhiv"], (int) $calculated_data["adultsachievedIncare"], (int) $calculated_data["adultsachievedTreatment"], (int) $calculated_data["adultsachievedSuppression"]);
			
			return $data;
		}
	}

	
?>