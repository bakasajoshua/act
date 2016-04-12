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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			} else {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}
			
			$calculated_data = array();

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
					$addition";
			$return = $this->db->query($sql)->result_array();
			// echo "<pre>";print_r($return);die();
			$calculated_data = array(
									'clhiv' 						=> 0,
									'childrenachievedIncare' 		=> 0,
									'childrengapIncare' 			=> 0,
									'childrenachievedTreatment' 	=> 0,
									'childrengapTreatment' 			=> 0,
									'childrenachievedSuppression' 	=> 0,
									'childrengapSuppression'		=> 0
									);

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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			} else {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}

			$calculated_data = array();

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
					$addition";
			$return = $this->db->query($sql)->result_array();

			$calculated_data = array(
									'adultslhiv' 				=> 0,
									'adultsachievedIncare' 		=> 0,
									'adultsgapIncare' 			=> 0,
									'adultsachievedTreatment' 	=> 0,
									'adultsgapTreatment' 		=> 0,
									'adultsachievedSuppression' => 0,
									'adultsgapSuppression'		=> 0
									);

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

		function cascade_total()
		{
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			} else {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}

			$calculated_data = array();

			$totallhiv = 0;
			$totalachievedIncare = 0;
			$totalgapIncare = 0;
			$totalachievedTreatment = 0;
			$totalgapTreatment = 0;
			$totalachievedSuppression = 0;
			$totalgapSuppression = 0;

			$sql = "SELECT
						*
					FROM `cascade`
					$addition";
			$return = $this->db->query($sql)->result_array();

			$calculated_data = array(
									'totallhiv' 				=> 0,
									'totalachievedIncare' 		=> 0,
									'totalgapIncare' 			=> 0,
									'totalachievedTreatment' 	=> 0,
									'totalgapTreatment' 		=> 0,
									'totalachievedSuppression' => 0,
									'totalgapSuppression'		=> 0
									);
			
			foreach ($return as $key => $value) {
				$calculated_data = array(
									'totallhiv' => @$totallhiv+@$value['adultslhiv']+@$value['clhiv'],
									'totalachievedIncare' => @$totalachievedIncare+@$value['adultsactualforidentification']+@$value['childrenactualforidentification'],
									'totalgapIncare' => @$totalgapIncare+(@$value['adultstargetforidentification']-@$value['adultsactualforidentification'])+(@$value['childrentargetforidentification']-@$value['childrenactualforidentification']),
									'totalachievedTreatment' => @$totalachievedTreatment+@$value['adultsactualfortreatment']+@$value['childrenactualfortreatment'],
									'totalgapTreatment' => @$totalgapTreatment+(@$value['adultstargetfortreatment']-@$value['adultsactualfortreatment'])+(@$value['childrentargetfortreatment']-@$value['childrenactualfortreatment']),
									'totalachievedSuppression' => @$totalachievedSuppression+@$value['adultsactualforviralsuppression']+@$value['childrenactualforviralsuppression'],
									'totalgapSuppression' => @$totalgapSuppression+(@$value['adultstargetforviralsuppression']-@$value['adultsactualforviralsuppression'])+(@$value['childrentargetforviralsuppression']-@$value['childrenactualforviralsuppression'])
									);
			}

			$data["cascade_total"][0]["name"] = 'Gap';
			$data["cascade_total"][1]["name"] = 'Achieved';

			$data["cascade_total"][0]["data"] = array(NULL, (int) $calculated_data["totalgapIncare"], (int) $calculated_data["totalgapTreatment"], (int) $calculated_data["totalgapSuppression"]);
			$data["cascade_total"][1]["data"] = array((int) $calculated_data["totallhiv"], (int) $calculated_data["totalachievedIncare"], (int) $calculated_data["totalachievedTreatment"], (int) $calculated_data["totalachievedSuppression"]);
			
			return $data;
		}
	}

?>