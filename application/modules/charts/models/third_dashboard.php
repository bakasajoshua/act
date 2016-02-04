<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');
/**
* 
*/
class third_dashboard extends MY_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function survival_retention_art()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');

		$sql = "SELECT
					`net_overall_cohort`,
					`alive_on_art`,
					`prophylaxisHAART`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `dhis_calc_art`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
		$ret_art = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["survival_art"][0]["name"] = 'art net cohort (12M)';
		$data["survival_art"][0]["type"] = 'column';
        $data["survival_art"][0]["yAxis"] = 1;

		$data["survival_art"][1]["name"] = 'alive and on art (12M)';
		$data["survival_art"][1]["type"] = 'column';
        $data["survival_art"][1]["yAxis"] = 1;

		$data["survival_art"][2]["name"] = 'Prop. A&ART';
		$data["survival_art"][2]["type"] = 'spline';

		$count=0;

		foreach ($months as $key => $value) {
			$data["survival_art"][0]["data"][$key]	=  $count;
			$data["survival_art"][1]["data"][$key]	=  $count;
			$data["survival_art"][2]["data"][$key]	=  $count;
			foreach ($ret_art as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["survival_art"][0]["data"][$key]	=  (int) $value1["net_overall_cohort"];
					$data["survival_art"][1]["data"][$key]	=  (int) $value1["alive_on_art"];
					$data["survival_art"][2]["data"][$key]	=  (int) $value1["prophylaxisHAART"];
				}
			}
		}

		$data["survival_art"][0]["tooltip"] = array("valueSuffix" => ' ');
		$data["survival_art"][1]["tooltip"] = array("valueSuffix" => ' ');
		$data["survival_art"][2]["tooltip"] = array("valueSuffix" => '%');
		
		return $data;
	}

	function peds_vl_testing()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');

		$sql = "SELECT
					`peds_vl_tests`,
					`peds_vl_sppd`,
					`prop_suppressed_peds`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `vl`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
		$peds_vl = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["peds_vl_test"][0]["name"] = 'Pediatric VL Tests';
		$data["peds_vl_test"][0]["type"] = 'column';

		$data["peds_vl_test"][1]["name"] = 'VLs Suppressed';
		$data["peds_vl_test"][1]["type"] = 'column';

		$data["peds_vl_test"][2]["name"] = 'Prop. Suppressed';
		$data["peds_vl_test"][2]["type"] = 'spline';
		$data["peds_vl_test"][2]["yAxis"] = 1;

		$count=0;

		foreach ($months as $key => $value) {
			foreach ($peds_vl as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["peds_vl_test"][0]["data"][$key]	=  (int) $value1["peds_vl_tests"];
					$data["peds_vl_test"][1]["data"][$key]	=  (int) $value1["peds_vl_sppd"];
					$data["peds_vl_test"][2]["data"][$key]	=  (int) $value1["prop_suppressed_peds"];
				}
			}
		}

		$data["peds_vl_test"][0]["tooltip"] = array("valueSuffix" => 'v');
		$data["peds_vl_test"][1]["tooltip"] = array("valueSuffix" => 'v');
		$data["peds_vl_test"][2]["color"] = 'Highcharts.getOptions().colors[3]';
		$data["peds_vl_test"][2]["tooltip"] = array("valueSuffix" => '%');

		return $data;
	}

	function adults_vl_testing()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');

		$sql = "SELECT
					`adult_vl_tests`,
					`adult_vl_sppd`,
					`prop_suppressed_adults`,
					MONTH(`period`) AS `month`,
					YEAR(`period`) AS `year`
				FROM `vl`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year'";
		$peds_vl = $this->db->query($sql)->result_array();

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["adults_vl_test"][0]["name"] = 'Adult VL Tests';
		$data["adults_vl_test"][0]["type"] = 'column';

		$data["adults_vl_test"][1]["name"] = 'VLs Suppressed';
		$data["adults_vl_test"][1]["type"] = 'column';

		$data["adults_vl_test"][2]["name"] = 'Prop. Suppressed';
		$data["adults_vl_test"][2]["type"] = 'spline';
		$data["adults_vl_test"][2]["yAxis"] = 1;

		$count=0;

		foreach ($months as $key => $value) {
			foreach ($peds_vl as $key1 => $value1) {
				if( (int)$value == (int) $value1["month"]){
					$data["adults_vl_test"][0]["data"][$key]	=  (int) $value1["adult_vl_tests"];
					$data["adults_vl_test"][1]["data"][$key]	=  (int) $value1["adult_vl_sppd"];
					$data["adults_vl_test"][2]["data"][$key]	=  (int) $value1["prop_suppressed_adults"];
				}
			}
		}

		$data["adults_vl_test"][0]["tooltip"] = array("valueSuffix" => 'v');
		$data["adults_vl_test"][1]["tooltip"] = array("valueSuffix" => 'v');
		$data["adults_vl_test"][2]["color"] = 'Highcharts.getOptions().colors[3]';
		$data["adults_vl_test"][2]["tooltip"] = array("valueSuffix" => '%');

		return $data;
	}
}
?>