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
									'clhiv' => @$clhiv+@$value['clhiv'],
									'childrengapIncare' => @$childrengapIncare+(@$value['childrentargetforidentification']-@$value['childrenactualforidentification']),
									'childrenachievedTreatment' => @$childrenachievedTreatment+@$value['childrenactualfortreatment'],
									'childrengapTreatment' => @$childrengapTreatment+(@$value['childrentargetfortreatment']-@$value['childrenactualfortreatment']),
									'childrenachievedSuppression' => @$childrenachievedSuppression+@$value['childrenactualforviralsuppression'],
									'childrengapSuppression' => @$childrengapSuppression+(@$value['childrentargetforviralsuppression']-@$value['childrenactualforviralsuppression'])
									);
			}

			echo "<pre>";print_r($calculated_data);die();
		}
	}

	
?>