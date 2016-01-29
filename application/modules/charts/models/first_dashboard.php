<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');
	/**
	* 
	*/
	class first_dashboard extends MY_Model
	{
		
		function __construct()
		{
			parent:: __construct();
		}

		function cumulative_infants_tests_vs_positive()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			$sql = "SELECT
						`eid` AS `cumulative_infants_test`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_tests`
					WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'
					GROUP BY `period`";
			$eid_test = $this->db->query($sql)->result_array();
			
			$sql = "SELECT
						`eid` AS `cumulative_infants_positive`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_positive`
					WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'
					GROUP BY `period`";
			$eid_pos = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["infant_tspos"][0]["name"] = 'Tested';
			$data["infant_tspos"][1]["name"] = 'HIV +ve';

			$count=0;

			foreach ($months as $key => $value) {
				$data["infant_tspos"][0]["data"][$key]	=  $count;
				$data["infant_tspos"][1]["data"][$key]	=  $count;
				foreach ($eid_test as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["infant_tspos"][0]["data"][$key]	=  (int) $value1["cumulative_infants_test"];
					}
				}
				foreach ($eid_pos as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["infant_tspos"][1]["data"][$key]	=  (int) $value1["cumulative_infants_positive"];
					}
				}
			}
			// echo "<pre>";print_r($data);die();
			return $data;
		}

		function cumulative_children_tests_vs_positive()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');
			// echo "<pre>";print_r($id);echo "</pre>";
			// $condition = isset($id['sub_county_ID'])? "`dt`.`sub_county_ID` = $id['sub_county_ID']": "`dt`.`county_ID` = $id['county_ID']";
			// if ($id['sub_county_ID']==0) {
			// 	$condition = "`dt`.`county_ID` = $id['county_ID']";
			// } else {
			// 	$condition = "`dt`.`sub_county_ID` = '$id['sub_county_ID']'";
			// }
			
			$sql = "SELECT
						MONTH(`dt`.`period`) AS `month`,
						YEAR(`dt`.`period`) AS `year`,
						`dt`.`cum_children` AS `cumulative_tested_children`
					FROM `dhis_calc_tests` `dt`
					WHERE `dt`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$test = $this->db->query($sql)->result_array();
			// echo "<pre>";print_r($sql);echo "</pre>";
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_children` AS `cumulative_positive_children`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();
			// echo "<pre>";print_r($sql);echo "</pre>";die();
			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["child_tspos"][0]["name"] = 'Tested';
			$data["child_tspos"][1]["name"] = 'HIV +ve';

			$count=0;

			foreach ($months as $key => $value) {
				$data["child_tspos"][0]["data"][$key]	=  $count;
				$data["child_tspos"][1]["data"][$key]	=  $count;
				foreach ($test as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_tspos"][0]["data"][$key]	=  (int) $value1["cumulative_tested_children"];
					}
				}

				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_tspos"][1]["data"][$key]	=  (int) $value1["cumulative_positive_children"];
					}
				}
			}
			// echo "<pre>";print_r($data);die();
			return $data;

		}

		function cumulative_adults_tests_vs_positive(){
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			// Getting the cumulative DHIS tests in the selected county
			$sql = "SELECT
						MONTH(`dt`.`period`) AS `month`,
						YEAR(`dt`.`period`) AS `year`,
						`dt`.`cum_adults` AS `cumulative_tested_adults`
					FROM `dhis_calc_tests` `dt`
					WHERE `dt`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$test = $this->db->query($sql)->result_array();
			
			// Getting the cumulative DHIS positives in the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_adults` AS `cumulative_positive_adults`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["adult_tspos"][0]["name"] = 'Tested';
			$data["adult_tspos"][1]["name"] = 'HIV +ve';

			$count=0;
			//Generating points on a monthly basis
			foreach ($months as $key => $value) {
				$data["adult_tspos"][0]["data"][$key]	=  $count;
				$data["adult_tspos"][1]["data"][$key]	=  $count;

				//Generating the points for the tests line
				foreach ($test as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_tspos"][0]["data"][$key]	=  (int) $value1["cumulative_tested_adults"];
					}
				}
				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_tspos"][1]["data"][$key]	=  (int) $value1["cumulative_positive_adults"];
					}
				}
			}
			
			return $data;
		}

		function infants_positive()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			$sql = "SELECT
						`eid` AS `infants_positive`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_positive`
					WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'
					GROUP BY `period`";
			$positive = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["infant_pos"][0]["name"] = 'positive';
            $data["infant_pos"][0]["type"] = 'column';
            $data["infant_pos"][0]["yAxis"] = 1;

            $data["infant_pos"][1]["name"] = 'positivity';
            $data["infant_pos"][1]["type"] = 'spline';

            $count=0;
            //Generating points on a monthly basis
			foreach ($months as $key => $value) {
				$data["infant_pos"][0]["data"][$key]	=  $count;
				$data["infant_pos"][1]["data"][$key]	=  $count;
				
				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["infant_pos"][0]["data"][$key]	=  (int) $value1["infants_positive"];
					}
				}
				$data["infant_pos"][0]["tooltip"] = array('valueSuffix' => 'v' );

				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["infant_pos"][1]["data"][$key]	=  (int) $value1["infants_positive"];
					}
				}
				$data["infant_pos"][1]["tooltip"] = array('valueSuffix' => '%' );
			}
			
			return $data;
		}

		function children_positive(){
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			// Getting the DHIS positives in the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`total_children` AS `total_positive_children`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["child_pos"][0]["name"] = 'positive';
            $data["child_pos"][0]["type"] = 'column';
            $data["child_pos"][0]["yAxis"] = 1;

            $data["child_pos"][1]["name"] = 'positivity';
            $data["child_pos"][1]["type"] = 'spline';
			
			$count=0;
			//Generating points on a monthly basis
			foreach ($months as $key => $value) {
				$data["child_pos"][0]["data"][$key]	=  $count;
				$data["child_pos"][1]["data"][$key]	=  $count;
				
				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_pos"][0]["data"][$key]	=  (int) $value1["total_positive_children"];
					}
				}
				$data["child_pos"][0]["tooltip"] = array('valueSuffix' => 'v' );

				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_pos"][1]["data"][$key]	=  (int) $value1["total_positive_children"]/2;
					}
				}
				$data["child_pos"][1]["tooltip"] = array('valueSuffix' => '%' );
			}
			
			return $data;
		}

		function adults_positive(){
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			// Getting the DHIS positives in the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`total_adults` AS `total_positive_adults`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["adult_pos"][0]["name"] = 'positive';
            $data["adult_pos"][0]["type"] = 'column';
            $data["adult_pos"][0]["yAxis"] = 1;

            $data["adult_pos"][1]["name"] = 'positivity';
            $data["adult_pos"][1]["type"] = 'spline';
			
			$count=0;
			//Generating points on a monthly basis
			foreach ($months as $key => $value) {
				$data["adult_pos"][0]["data"][$key]	=  $count;
				$data["adult_pos"][1]["data"][$key]	=  $count;
				
				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_pos"][0]["data"][$key]	=  (int) $value1["total_positive_adults"];
					}
				}
				$data["adult_pos"][0]["tooltip"] = array('valueSuffix' => 'v' );

				//Generating the points for the positive line
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_pos"][1]["data"][$key]	=  (int) $value1["total_positive_adults"]/2;
					}
				}
				$data["adult_pos"][1]["tooltip"] = array('valueSuffix' => '%' );
			}
			
			return $data;
		}

		function children_enrollment()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			//Getting the number of children positive for the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_children` AS `cumulative_positive_children`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();

			$sql = "SELECT
						MONTH(`de`.`period`) AS `month`,
						YEAR(`de`.`period`) AS `year`,
						`de`.`cum_enrl_care_peds` AS `cumulative_enrolled_children`
					FROM `dhis_calc_enrollment` `de`
					WHERE `de`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$enrolled = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			//Building the chart data
			$data["child_posen"][0]["name"] = 'HIV +ve';
			$data["child_posen"][1]["name"] = 'enrolled';

			$count=0;
			foreach ($months as $key => $value) {
				$data["child_posen"][0]["data"][$key]	=  $count;
				$data["child_posen"][1]["data"][$key]	=  $count;
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_posen"][0]["data"][$key]	=  (int) $value1["cumulative_positive_children"];
					}
				}

				foreach ($enrolled as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_posen"][1]["data"][$key]	=  (int) $value1["cumulative_enrolled_children"];
					}
				}
			}
			return $data;
		}

		function adults_enrollment()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			//Getting the number of children positive for the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_adults` AS `cumulative_positive_adults`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();

			$sql = "SELECT
						MONTH(`de`.`period`) AS `month`,
						YEAR(`de`.`period`) AS `year`,
						`de`.`cum_enrl_care_adults` AS `cumulative_enrolled_adults`
					FROM `dhis_calc_enrollment` `de`
					WHERE `de`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$enrolled = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			//Building the chart data
			$data["adult_posen"][0]["name"] = 'HIV +ve';
			$data["adult_posen"][1]["name"] = 'enrolled';

			$count=0;
			foreach ($months as $key => $value) {
				$data["adult_posen"][0]["data"][$key]	=  $count;
				$data["adult_posen"][1]["data"][$key]	=  $count;
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_posen"][0]["data"][$key]	=  (int) $value1["cumulative_positive_adults"];
					}
				}

				foreach ($enrolled as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_posen"][1]["data"][$key]	=  (int) $value1["cumulative_enrolled_adults"];
					}
				}
			}
			return $data;
		}

		function total_enrollment()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');

			//Getting the number of children positive for the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_total` AS `cumulative_positive_total`
					FROM `dhis_calc_positive` `dp`
					WHERE `dp`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$positive = $this->db->query($sql)->result_array();

			$sql = "SELECT
						MONTH(`de`.`period`) AS `month`,
						YEAR(`de`.`period`) AS `year`,
						`de`.`cum_enrl_care_total` AS `cumulative_enrolled_total`
					FROM `dhis_calc_enrollment` `de`
					WHERE `de`.`county_ID` = '$id' AND YEAR(`period`) = '$year'";
			$enrolled = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			//Building the chart data
			$data["total_posen"][0]["name"] = 'HIV +ve';
			$data["total_posen"][1]["name"] = 'enrolled';

			$count=0;
			foreach ($months as $key => $value) {
				$data["total_posen"][0]["data"][$key]	=  $count;
				$data["total_posen"][1]["data"][$key]	=  $count;
				foreach ($positive as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["total_posen"][0]["data"][$key]	=  (int) $value1["cumulative_positive_total"];
					}
				}

				foreach ($enrolled as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["total_posen"][1]["data"][$key]	=  (int) $value1["cumulative_enrolled_total"];
					}
				}
			}
			return $data;
		}

		function get_target_lines($year)
		{
			$sql = "SELECT
						`children`,
						`adults`
					FROM `first_target`
					WHERE `year` = '$year'";
			$targets = $this->db->query($sql)->result_array();
			if ($targets) {
				$data = array(
						'children' => $targets[0]['children'],
						'adults' => $targets[0]['adults']
						);
			}else{
				$data = array(
						'children' => 0,
						'adults' => 0
						);
			}
			
			return $data;
		}

		function estimated_children_identification()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');
			
			//Getting the children target
			$targets = $this->get_target_lines($year);
			
			$sql = "SELECT
						`curr_art_peds`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_art`
					WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
			$incare = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			//Building the chart data
			$data["child_care"][0]["name"] = 'target line';
			$data["child_care"][1]["name"] = 'currently in care';

			$count=0;
			$target = ($targets['children']/12);
			foreach ($months as $key => $value) {
				$data["child_care"][0]["data"][$key]	=  (int) $target;
				$data["child_care"][1]["data"][$key]	=  $count;
				foreach ($incare as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["child_care"][1]["data"][$key]	=  (int) $value1["curr_art_peds"];
					}
				}
			}
			return $data;
		}

		
		function estimate_adults_identification()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');
			
			//Getting the number of children positive for the selected county
			$targets = $this->get_target_lines($year);
			
			$sql = "SELECT
						`curr_art_adults`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_art`
					WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
			$incare = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			//Building the chart data
			$data["adult_care"][0]["name"] = 'target line';
			$data["adult_care"][1]["name"] = 'currently in care';

			$count=0;
			$target = ($targets['adults']/12);
			foreach ($months as $key => $value) {
				$data["adult_care"][0]["data"][$key]	=  (int) $target;
				$data["adult_care"][1]["data"][$key]	=  $count;
				foreach ($incare as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["adult_care"][1]["data"][$key]	=  (int) $value1["curr_art_adults"];
					}
				}
			}
			return $data;
		}

		function estimate_total_identification()
		{
			$id = $this->session->userdata('county_ID');
			$year = $this->session->userdata('year');
			
			//Getting the number of children positive for the selected county
			$targets = $this->get_target_lines($year);
			
			$sql = "SELECT
						`curr_art_total`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_art`
					WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
			$inneed = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			//Building the chart data
			$data["total_care"][0]["name"] = 'target line';
			$data["total_care"][1]["name"] = 'currently in care';

			$count=0;
			$target = (($targets['children']+$targets['adults'])/12);
			foreach ($months as $key => $value) {
				$data["total_care"][0]["data"][$key]	=  (int) $target;
				$data["total_care"][1]["data"][$key]	=  $count;
				foreach ($inneed as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["total_care"][1]["data"][$key]	=  (int) $value1["curr_art_total"];
					}
				}
			}
			return $data;	
		}

		
	}
?>