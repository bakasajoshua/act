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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			} else {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}
			
			$sql = "SELECT
						`cum_eid` AS `cumulative_infants_test`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_tests`
					$addition
					GROUP BY `period`";
			$eid_test = $this->db->query($sql)->result_array();
			
			$sql = "SELECT
						`cum_eid` AS `cumulative_infants_positive`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_positive`
					$addition
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			} else {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}
			
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
					$addition";
			$test = $this->db->query($sql)->result_array();
			// echo "<pre>";print_r($sql);echo "</pre>";
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_children` AS `cumulative_positive_children`
					FROM `dhis_calc_positive` `dp`
					$addition";
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			} else {
				$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}
			

			// Getting the cumulative DHIS tests in the selected county
			$sql = "SELECT
						MONTH(`dt`.`period`) AS `month`,
						YEAR(`dt`.`period`) AS `year`,
						`dt`.`cum_adults` AS `cumulative_tested_adults`
					FROM `dhis_calc_tests` `dt`
					$addition";
			$test = $this->db->query($sql)->result_array();
			
			// Getting the cumulative DHIS positives in the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_adults` AS `cumulative_positive_adults`
					FROM `dhis_calc_positive` `dp`
					$addition";
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `dcp`.`county_ID` = $cid AND YEAR(`dcp`.`period`) = $year AND `dct`.`county_ID` = $cid AND YEAR(`dct`.`period`) = $year";
			} else {
				$addition = "WHERE `dcp`.`sub_county_ID` = $sid AND YEAR(`dcp`.`period`) = $year AND `dct`.`sub_county_ID` = $sid AND YEAR(`dct`.`period`) = $year";
			}
			
			$sql = "SELECT
						`dcp`.`eid` AS `infants_positive`,
						(`dcp`.`eid`/`dct`.`eid`) AS `infants_positivity`,
						MONTH(`dcp`.`period`) AS `month`,
						YEAR(`dcp`.`period`) AS `year`
					FROM `dhis_calc_positive` `dcp`, `dhis_calc_tests` `dct`
					$addition
					GROUP BY `dcp`.`period`";
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
						$data["infant_pos"][1]["data"][$key]	=  ((int) $value1["infants_positivity"]*100);
					}
				}
				$data["infant_pos"][1]["tooltip"] = array('valueSuffix' => '%' );
			}
			
			return $data;
		}

		function children_positive(){
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `dcp`.`county_ID` = $cid AND YEAR(`dcp`.`period`) = $year AND `dct`.`county_ID` = $cid AND YEAR(`dct`.`period`) = $year";
			} else {
				$addition = "WHERE `dcp`.`sub_county_ID` = $sid AND YEAR(`dcp`.`period`) = $year AND `dct`.`sub_county_ID` = $sid AND YEAR(`dct`.`period`) = $year";
			}

			// Getting the DHIS positives in the selected county
			$sql = "SELECT
						MONTH(`dcp`.`period`) AS `month`,
						YEAR(`dcp`.`period`) AS `year`,
						`dcp`.`total_children` AS `total_positive_children`,
						(`dcp`.`total_children`/`dct`.`total_children`) AS `children_positivity`
					FROM `dhis_calc_positive` `dcp`, `dhis_calc_tests` `dct`
					$addition";
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
						$data["child_pos"][1]["data"][$key]	=  ((int) $value1["children_positivity"]*100);
					}
				}
				$data["child_pos"][1]["tooltip"] = array('valueSuffix' => '%' );
			}
			
			return $data;
		}

		function adults_positive(){
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE `dcp`.`county_ID` = $cid AND YEAR(`dcp`.`period`) = $year AND `dct`.`county_ID` = $cid AND YEAR(`dct`.`period`) = $year";
			} else {
				$addition = "WHERE `dcp`.`sub_county_ID` = $sid AND YEAR(`dcp`.`period`) = $year AND `dct`.`sub_county_ID` = $sid AND YEAR(`dct`.`period`) = $year";
			}

			// Getting the DHIS positives in the selected county
			$sql = "SELECT
						MONTH(`dcp`.`period`) AS `month`,
						YEAR(`dcp`.`period`) AS `year`,
						`dcp`.`total_adults` AS `total_positive_adults`,
						(`dcp`.`total_adults`/`dct`.`total_adults`) AS `adults_positivity`
					FROM `dhis_calc_positive` `dcp`, `dhis_calc_tests` `dct`
					$addition";
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
						$data["adult_pos"][1]["data"][$key]	=  (int) ($value1["adults_positivity"]*100);
					}
				}
				$data["adult_pos"][1]["tooltip"] = array('valueSuffix' => '%' );
			}
			
			return $data;
		}

		function children_enrollment()
		{
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$additionpositive = "WHERE `dp`.`county_ID` = $cid AND YEAR(`period`) = $year";
				$additionenrolled = "WHERE `de`.`county_ID` = $cid AND YEAR(`period`) = $year";
			} else {
				$additionpositive = "WHERE `dp`.`sub_county_ID` = $sid AND YEAR(`period`) = $year";
				$additionenrolled = "WHERE `de`.`sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}

			//Getting the number of children positive for the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_children` AS `cumulative_positive_children`
					FROM `dhis_calc_positive` `dp`
					$additionpositive";
			$positive = $this->db->query($sql)->result_array();

			$sql = "SELECT
						MONTH(`de`.`period`) AS `month`,
						YEAR(`de`.`period`) AS `year`,
						`de`.`cum_enrl_care_peds` AS `cumulative_enrolled_children`
					FROM `dhis_calc_enrollment` `de`
					$additionenrolled";
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$additionpositive = "WHERE `dp`.`county_ID` = $cid AND YEAR(`period`) = $year";
				$additionenrolled = "WHERE `de`.`county_ID` = $cid AND YEAR(`period`) = $year";
			} else {
				$additionpositive = "WHERE `dp`.`sub_county_ID` = $sid AND YEAR(`period`) = $year";
				$additionenrolled = "WHERE `de`.`sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}

			//Getting the number of children positive for the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`,
						`dp`.`cum_adults` AS `cumulative_positive_adults`
					FROM `dhis_calc_positive` `dp`
					$additionpositive";
			$positive = $this->db->query($sql)->result_array();

			$sql = "SELECT
						MONTH(`de`.`period`) AS `month`,
						YEAR(`de`.`period`) AS `year`,
						`de`.`cum_enrl_care_adults` AS `cumulative_enrolled_adults`
					FROM `dhis_calc_enrollment` `de`
					$additionenrolled";
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$additionpositive = "WHERE `dp`.`county_ID` = $cid AND YEAR(`period`) = $year";
				$additionenrolled = "WHERE `de`.`county_ID` = $cid AND YEAR(`period`) = $year";
			} else {
				$additionpositive = "WHERE `dp`.`sub_county_ID` = $sid AND YEAR(`period`) = $year";
				$additionenrolled = "WHERE `de`.`sub_county_ID` = $sid AND YEAR(`period`) = $year";
			}

			//Getting the number of children positive for the selected county
			$sql = "SELECT
						MONTH(`dp`.`period`) AS `month`,
						YEAR(`dp`.`period`) AS `year`
					FROM `dhis_calc_positive` `dp`
					$additionpositive";
			$positive = $this->db->query($sql)->result_array();

			$sql = "SELECT
						MONTH(`de`.`period`) AS `month`,
						YEAR(`de`.`period`) AS `year`,
						`de`.`cum_enrl_care_total` AS `cumulative_enrolled_total`
					FROM `dhis_calc_enrollment` `de`
					$additionenrolled";
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
						// $data["total_posen"][0]["data"][$key]	=  (int) $value1["cumulative_positive_total"];
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE YEAR(`period`) = $year AND `county_ID` = $cid";
			} else {
				$addition = "WHERE YEAR(`period`) = $year AND `sub_county_ID` = $sid";
			}
			
			//Getting the children target
			$targets = $this->get_target_lines($year);
			
			$sql = "SELECT
						`curr_art_peds`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_art`
					$addition";
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE YEAR(`period`) = $year AND `county_ID` = $cid";
			} else {
				$addition = "WHERE YEAR(`period`) = $year AND `sub_county_ID` = $sid";
			}
			
			//Getting the number of children positive for the selected county
			$targets = $this->get_target_lines($year);
			
			$sql = "SELECT
						`curr_art_adults`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_art`
					$addition";
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
			$cid = $this->session->userdata('county_ID');
			$sid = $this->session->userdata('sub_county_ID');
			$year = $this->session->userdata('year');

			if ($sid==0) {
				$addition = "WHERE YEAR(`period`) = $year AND `county_ID` = $cid";
			} else {
				$addition = "WHERE YEAR(`period`) = $year AND `sub_county_ID` = $sid";
			}
			
			//Getting the number of children positive for the selected county
			$targets = $this->get_target_lines($year);
			
			$sql = "SELECT
						`curr_art_total`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `dhis_calc_art`
					$addition";
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