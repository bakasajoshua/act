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
	}

	function in_care()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');

		$sql = "SELECT
					MONTH(`period`) AS `month`,
					`curr_care_peds`,
					`curr_care_adults`,
					`curr_care_total`
				FROM `dhis_calc_enrollment`
				WHERE `county_ID` = '$id' AND YEAR(`period`) = '$year' AND MONTH(`period`) = '12'";

		return $this->db->query($sql)->result_array();
	}

	function on_art()
	{
		$id = $this->session->userdata('county_ID');
		$year = $this->session->userdata('year');

		$sql = "SELECT
					MONTH(`period`) AS `month`,
					`curr_art_peds`,
					`curr_art_adults`,
					`curr_art_total`
				FROM `dhis_calc_art`
				WHERE `county_ID` = '0' AND YEAR(`period`) = '2015' AND MONTH(`period`) = '12'";

		return $this->db->query($sql)->result_array();
	}

	function cascade_children()
	{

	}
?>