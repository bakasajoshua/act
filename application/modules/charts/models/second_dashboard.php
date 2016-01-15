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
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');

		$sql = "SELECT
						SUM(`cumulative_positive`) AS `cumulative_infants_positive`,
						SUM(`cumulative_onTx`) AS `cumulative_infants_starting`,
						MONTH(`period`) AS `month`,
						YEAR(`period`) AS `year`
					FROM `eid_calc`
					WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'
					GROUP BY `period`";
			$eid_pos_art = $this->db->query($sql)->result_array();

			$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

			$data["infant_posart"][0]["name"] = 'HIV +ve';
			$data["infant_posart"][1]["name"] = 'started on ART';

			$count=0;

			foreach ($months as $key => $value) {
				$data["infant_posart"][0]["data"][$key]	=  $count;
				$data["infant_posart"][1]["data"][$key]	=  $count;
				foreach ($eid_pos_art as $key1 => $value1) {
					if( (int)$value == (int) $value1["month"]){
						$data["infant_posart"][0]["data"][$key]	=  (int) $value1["cumulative_infants_positive"];
						$data["infant_posart"][1]["data"][$key]	=  (int) $value1["cumulative_infants_starting"];
					}
				}
			}
			
			return $data;
	}

	function cumulative_children_started_art()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');
		
		$sql = "SELECT 
					`cum_children` AS `cumulative_art_children`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
		$art = $this->db->query($sql)->result_array();

		$sql = "SELECT 
					`cum_children` AS `cumulative_enroll_children`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
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
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');
		
		$sql = "SELECT 
					`cum_adults` AS `cumulative_art_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
		$art = $this->db->query($sql)->result_array();

		$sql = "SELECT 
					`cum_adults` AS `cumulative_enroll_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
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
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');
		
		//Getting the children target
		$targets = $this->get_target_lines($year);
		
		$sql = "SELECT
					`total_children_starting`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
		$inart = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`total_children`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
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
					$data["child_need"][1]["data"][$key]	=  (int) $value1["total_children_starting"];
				}
			}

			foreach ($incare as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["child_need"][2]["data"][$key]	=  (int) $value1["total_children"];
				}
			}
		}
		return $data;
	}

	function adults_need_treatment()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');
		
		//Getting the children target
		$targets = $this->get_target_lines($year);
		
		$sql = "SELECT
					`total_adults_starting`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
		$inart = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`total_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
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
					$data["adult_need"][1]["data"][$key]	=  (int) $value1["total_adults_starting"];
				}
			}

			foreach ($incare as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["adult_need"][2]["data"][$key]	=  (int) $value1["total_adults"];
				}
			}
		}
		return $data;
	}

	function total_need_treatment()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');
		
		//Getting the children target
		$targets = $this->get_target_lines($year);
		
		$sql = "SELECT
					`total_starting`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
		$inart = $this->db->query($sql)->result_array();

		$sql = "SELECT
					`total`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_enrollment`
				WHERE YEAR(`period`) = '$year' AND `county_ID` = '$id'";
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
					$data["total_need"][1]["data"][$key]	=  (int) $value1["total_starting"];
				}
			}

			foreach ($incare as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["total_need"][2]["data"][$key]	=  (int) $value1["total"];
				}
			}
		}
		return $data;
	}
}
?>