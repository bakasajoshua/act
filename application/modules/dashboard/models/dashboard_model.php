<?php
/**
* 
*/
class dashboard_model extends MY_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function get_single_county($id){
		$this->db->where('county_ID',$id);
		return $this->db->get('counties')->result_array();
	}
	function get_single_sub_county($id){
		$sql = "SELECT
					`sc`.`sub_county_name`,
					`c`.`county_name`
				FROM `sub_counties` `sc`
				JOIN `counties` `c`
				ON `sc`.`county_ID` = `c`.`county_ID`
				WHERE `sc`.`sub_county_ID` = '$id'";
		return $this->db->query($sql)->result_array();
	}

	function get_sub_county($id)
	{
		$this->db->where('county_ID',$id);
		return $this->db->get('sub_counties')->result_array();
	}

	function county_chart($id)
	{
		$data['cumulative_test_positive'] = $this->cumulative_children_tests_vs_positive($id);
		return $data;
	}

	function cumulative_children_tests_vs_positive($id)
	{
		$id = $id['county_ID'];
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
				WHERE `dt`.`county_ID` = '$id'";
		$test = $this->db->query($sql)->result_array();
		// echo "<pre>";print_r($sql);echo "</pre>";
		$sql = "SELECT
					MONTH(`dp`.`period`) AS `month`,
					YEAR(`dp`.`period`) AS `year`,
					`dp`.`cum_children` AS `cumulative_positive_children`
				FROM `dhis_calc_positive` `dp`
				WHERE `dp`.`county_ID` = '$id'";
		$positive = $this->db->query($sql)->result_array();
		// echo "<pre>";print_r($sql);echo "</pre>";die();
		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$data["child_tspos"][0]["name"] = 'Infants tested';
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
	function positive($id)
	{

	}
	function enrollment($id)
	{

	}
	function art($id)
	{

	}
}
?>