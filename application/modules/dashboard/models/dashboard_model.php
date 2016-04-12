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
		// echo "<pre>";print_r($this->db->get('counties')->result_array());die();
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

	

}
?>