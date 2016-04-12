<?php
if(!defined('BASEPATH')) exit('No direct access allowed to this script');
/**
* 
*/
class second_dashboard extends MY_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function cumulative_infants_started_art()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}

		$sql = "SELECT
					`cum_eid` AS `cumulative_infants_positive`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_positive`
				$addition
				GROUP BY `period`";
		$eid_pos = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`cum_started_infants` AS `cumulative_infants_starting`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition
				GROUP BY `period`";
		$eid_art = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["infant_posart"][0]["name"] = 'HIV +ve';
		$data["infant_posart"][1]["name"] = 'started on ART';

		$count=0;

		foreach ($months as $key => $value) {
			$data["infant_posart"][0]["data"][$key]	=  $count;
			$data["infant_posart"][1]["data"][$key]	=  $count;
			foreach ($eid_pos as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["infant_posart"][0]["data"][$key]	=  (int) $value1["cumulative_infants_positive"];
				}
			}

			foreach ($eid_art as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["infant_posart"][1]["data"][$key]	=  (int) $value1["cumulative_infants_starting"];
				}
			}
		}
		
		return $data;
	}

	function cumulative_children_started_art()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}
		
		$sql = "SELECT 
					`cum_started_children` AS `cumulative_art_children`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition";
		$art = $this->db->query($sql)->result_array();

		$sql = "SELECT 
					`cum_enrl_care_peds` AS `cumulative_enroll_children`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				$addition";
		$enroll = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["child_posart"][0]["name"] = 'started on ART';
		$data["child_posart"][1]["name"] = 'enrolled in care';

		$count=0;

		foreach ($months as $key => $value) {
			$data["child_posart"][0]["data"][$key]	=  $count;
			$data["child_posart"][1]["data"][$key]	=  $count;
			foreach ($art as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["child_posart"][0]["data"][$key]	=  (int) $value1["cumulative_art_children"];
				}
			}

			foreach ($enroll as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["child_posart"][1]["data"][$key]	=  (int) $value1["cumulative_enroll_children"];
				}
			}
		}
		
		return $data;
	}

	function cumulative_adults_started_art()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}
		
		$sql = "SELECT 
					`cum_started_adults` AS `cumulative_art_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition";
		$art = $this->db->query($sql)->result_array();

		$sql = "SELECT 
					`cum_enrl_care_adults` AS `cumulative_enroll_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				$addition";
		$enroll = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["adult_posart"][0]["name"] = 'started on ART';
		$data["adult_posart"][1]["name"] = 'enrolled in care';

		$count=0;

		foreach ($months as $key => $value) {
			$data["adult_posart"][0]["data"][$key]	=  $count;
			$data["adult_posart"][1]["data"][$key]	=  $count;
			foreach ($art as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["adult_posart"][0]["data"][$key]	=  (int) $value1["cumulative_art_adults"];
				}
			}

			foreach ($enroll as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["adult_posart"][1]["data"][$key]	=  (int) $value1["cumulative_enroll_adults"];
				}
			}
		}
		
		return $data;
	}

	function hiv_pos_tb_patients()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}

		$sql = "SELECT
					`hiv_pos_tb_patients`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_positive`
				$addition";
		$tb_pos = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`start_art_tb_patient`,
					`percentage_tb_start_art`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition";
		$tb_art = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["hiv_tb"][0]["name"] = "HIV +ve TB Cases";
        $data["hiv_tb"][0]["type"] = "column";
        $data["hiv_tb"][0]["yAxis"] = 1;

        $data["hiv_tb"][1]["name"] = "Cases started on ART";
        $data["hiv_tb"][1]["type"] = "column";
        $data["hiv_tb"][1]["yAxis"] = 1;

        $data["hiv_tb"][2]["name"] = "% started on ART";
        $data["hiv_tb"][2]["type"] = "spline";

        $count = 0;

		foreach ($months as $key => $value) {
			$data["hiv_tb"][0]["data"][$key]	=  $count;
			$data["hiv_tb"][1]["data"][$key]	=  $count;
			$data["hiv_tb"][2]["data"][$key]	=  $count;
		
			foreach ($tb_pos as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["hiv_tb"][0]["data"][$key]	=  (int) $value1["hiv_pos_tb_patients"];
				}
			}

			foreach ($tb_art as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["hiv_tb"][1]["data"][$key]	=  (int) $value1["start_art_tb_patient"];
					$data["hiv_tb"][2]["data"][$key]	=  (int) $value1["percentage_tb_start_art"];
				}
			}
		}

		$data["hiv_tb"][0]["tooltip"] = array( 'valueSuffix' => 'v');
		$data["hiv_tb"][1]["tooltip"] = array( 'valueSuffix' => 'v');
		$data["hiv_tb"][2]["tooltip"] = array( 'valueSuffix' => '%');

		return $data;
	}

	function get_target_lines($year)
		{
			$sql = "SELECT
						`children`,
						`adults`
					FROM `second_target`
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


	function children_need_treatment()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}
		
		//Getting the children target
		$targets = $this->get_target_lines($year);
		
		$sql = "SELECT
					`curr_art_peds`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition";
		$inart = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`curr_care_peds`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				$addition";
		$incare = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		//Building the chart data
		$data["child_need"][0]["name"] = 'target line';
		$data["child_need"][1]["name"] = 'curr` on ART';
		$data["child_need"][2]["name"] = 'curr` in care';

		$count=0;
		$target = ($targets['children']/12);
		foreach ($months as $key => $value) {
			$data["child_need"][0]["data"][$key]	=  (int) $target;
			$data["child_need"][1]["data"][$key]	=  $count;
			$data["child_need"][2]["data"][$key]	=  $count;
			foreach ($inart as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["child_need"][1]["data"][$key]	=  (int) $value1["curr_art_peds"];
				}
			}

			foreach ($incare as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["child_need"][2]["data"][$key]	=  (int) $value1["curr_care_peds"];
				}
			}
		}
		return $data;
	}

	function adults_need_treatment()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}
		
		//Getting the children target
		$targets = $this->get_target_lines($year);
		
		$sql = "SELECT
					`curr_art_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition";
		$inart = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`curr_care_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				$addition";
		$incare = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		//Building the chart data
		$data["adult_need"][0]["name"] = 'target line';
		$data["adult_need"][1]["name"] = 'curr` on ART';
		$data["adult_need"][2]["name"] = 'curr` in care';

		$count=0;
		$target = ($targets['adults']/12);
		foreach ($months as $key => $value) {
			$data["adult_need"][0]["data"][$key]	=  (int) $target;
			$data["adult_need"][1]["data"][$key]	=  $count;
			$data["adult_need"][2]["data"][$key]	=  $count;
			foreach ($inart as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["adult_need"][1]["data"][$key]	=  (int) $value1["curr_art_adults"];
				}
			}

			foreach ($incare as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["adult_need"][2]["data"][$key]	=  (int) $value1["curr_care_adults"];
				}
			}
		}
		return $data;
	}

	function total_need_treatment()
	{
		$cid = $this->session->userdata('county_ID');
		$sid = $this->session->userdata('sub_county_ID');
		$year = $this->session->userdata('year');

		if ($sid==0) {
			$addition = "WHERE `county_ID` = $cid AND YEAR(`period`) = $year";
		} else {
			$addition = "WHERE `sub_county_ID` = $sid AND YEAR(`period`) = $year";
		}
		
		//Getting the children target
		$targets = $this->get_target_lines($year);
		
		$sql = "SELECT
					`curr_art_total`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				$addition";
		$inart = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`curr_care_total`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				$addition";
		$incare = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		//Building the chart data
		$data["total_need"][0]["name"] = 'target line';
		$data["total_need"][1]["name"] = 'curr` on ART';
		$data["total_need"][2]["name"] = 'curr` in care';

		$count=0;
		$target = (($targets['children']+$targets['adults'])/12);
		foreach ($months as $key => $value) {
			$data["total_need"][0]["data"][$key]	=  (int) $target;
			$data["total_need"][1]["data"][$key]	=  $count;
			$data["total_need"][2]["data"][$key]	=  $count;
			foreach ($inart as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["total_need"][1]["data"][$key]	=  (int) $value1["curr_art_total"];
				}
			}

			foreach ($incare as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["total_need"][2]["data"][$key]	=  (int) $value1["curr_care_total"];
				}
			}
		}
		return $data;
	}
}
?>