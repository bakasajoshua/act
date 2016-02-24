<?php
/**
* author: Bakasa Joshua
* @baksajoshua09@gmail.com
*/
class api extends MX_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('api_model');
	}

	function index()
	{
		print("Welcome to my self-made API");
	}

	function eid($year=NULL,$month=NULL){
		$data = file_get_contents('C:/Users/JOSHUA/Documents/FTP/eid'.$year.''.$month.'.json');//Getting the EID data from the json file that was downloaded
		// $data = file_get_contents('http://nascop.org/eid/eidapi.php?year=2013&month=07');
		$data = json_decode($data, true);
		$data = $data['posts'];
		
		$add_subs = $this->add_missing_sub_counties($data);
		$add_eid = $this->add_eid_data($data,$year,$month);
	}

	function add_eid_data($data,$year,$month){
		$add = $this->api_model->formatting_eid_data($data,$year,$month);

		// redirect(base_url().'api');
	}

	function add_missing_sub_counties($data)
	{
		$count=0;
		$sub_counties=array();
		
		//getting the stored counties in the database
		$db_counties = $this->api_model->counties();
		//Formatting the received counties to be in the same format as the ones from the DB
		foreach ($data as $key => $value){
			$eid_counties = $this->format_county_name($value['County']);
			foreach ($db_counties as $k => $v) {
				if (str_replace(' ', '', $v['county_name'])==str_replace(' ', '', $eid_counties)) {
					$sub_counties[$count]['sub_county_name'] = $value['SubCounty'];
					$sub_counties[$count]['county_ID'] = $v['county_ID'];
					$count++;
				}
			}
		}

		return $this->api_model->insert_sub_counties($sub_counties);
	}

	function format_data($data)
	{

		$counter=0;
		$cols = array();
		//Data formatting to match the db cols and rows
		foreach ($data as $key => $value) {
			//Isolating the title column
			if ($key==0) {
				foreach ($value as $k => $v) {
					//removing the spaces in the title column names
					$v = strtolower(str_replace(" ", "", $v));
					$cols[] = $v;
				}
			}
			else
			{
				//Assigning the title columns as keys for the rest of the data
				foreach ($value as $k => $v) {
					$new[$counter][$cols[$k]] = $v;
				}
				$counter++;
			}
			
		}
		
		//Getting back the aggregated values from the raw data
		$insert_data = $this->sub_formating_data($new);
		$insert = $this->api_model->dhis_insert_aggregation($insert_data);
	}

	function sub_formating_data($data)
	{
		
		foreach ($data as $k => $v) {
			//Assigning the county_ID to the corresponding county_name
			$county = $this->format_county_name($v['county']);
			$counties = $this->api_model->counties($county);
			$data[$k]['county'] = $counties[0]['county_ID'];
			
			//Formatting the period of the data to php
			$dates = date_parse($v['periods']);
			$data_date = $dates['day'].'-'.$dates['month'].'-'.$dates['day'];
			$data[$k]['periods'] = $data_date;

		}
		
		//Organizing the data to and calculating the required aggregates:
		//		Tests
		//		Positive
		//		Enrollment
		//		ART
		$newdata['tests'] = $this->calculate_dhis_tests($data);
		$newdata['positive'] = $this->calculate_dhis_positive($data);
		$newdata['enrollment'] = $this->calculate_dhis_enrollment($data);
		$newdata['art'] = $this->calculate_dhis_art($data);
		$newdata['vl'] = $this->calculate_vl($data);
		// echo "<pre>";print_r($newdata['art']);die();

		return $newdata;
	}

	function calculate_dhis_tests($data){
		$cumulative_eid=0;
		$cumulative_children=0;
		$cumulative_adults=0;
		$cumulative_total=0;
		$next = NULL;
        foreach ($data as $key => $value) {
        	if ($next == NULL) {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['county'];
        	} else {
        		if($next != $value['county'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			$cumulative_eid=0;
        			$cumulative_children=0;
					$cumulative_adults=0;
					$cumulative_total=0;
					$next = $value['county'];
        		}
        	}
        	
   			// $test_sum[0] = ($value['vctclientstested(15-24yrs,female)']+$value['vctclientstested(female,_gt25yrs)']+$value['vctclientstested(15-24yrs,male)']+$value['vctclientstested(male,_gt25yrs)']+$value['dtcinpatienttested(male,adult_gt14yrs)']+$value['dtcoutpatienttested(male,adult_gt14yrs)']+$value['dtcoutpatienttested(female,adult_gt14yrs)']);
			// $test_sum[1] = ($value['dtcinpatienttested(female,adult_gt14yrs)']+$value['anchivtests']+$value['labouranddelivery']+$value['postnatal(within72']);
			// $dhis_tests[0] = array(
			//   		'county_ID' => $value['county'],
			//   		'sub_county_ID' => $value['county'],
			//   		'facility_ID' => $value['county'],
			//   		'period' => $value['periods'],
			//   		'vct_female_15_24' => $value['vctclientstested(15-24yrs,female)'],
			//   		'vct_female_25' => $value['vctclientstested(female,_gt25yrs)'],
			//   		'vct_male_15_24' => $value['vctclientstested(15-24yrs,male)'],
			//   		'vct_male_25' => $value['vctclientstested(male,_gt25yrs)'],
			//   		'dtc_inmale_gt14' => $value['dtcinpatienttested(male,adult_gt14yrs)'],
			//   		'dtc_outmale_gt14' => $value['dtcoutpatienttested(male,adult_gt14yrs)'],
			//   		'dtc_infemale_gt14' => $value['dtcoutpatienttested(female,adult_gt14yrs)'],
			//   		'dtc_outfemale_gt14' => $value['dtcinpatienttested(female,adult_gt14yrs)'],
			//   		'anc_hiv_tests' => $value['anchivtests'],
			//   		'labour_delivery' => $value['labouranddelivery'],
			//   		'postnatal' => $value['postnatal(within72'],
			//   		'dtc_infemale_lt14' => $value['dtcinpatienttested(female,children_lt14yrs)'],
			//   		'dtc_outfemale_lt14' => $value['dtcoutpatienttested(female,children_lt14yrs)'],
			//   		'dtc_inmale_lt14' => $value['dtcoutpatienttested(male,children_lt14yrs)'],
			//   		'dtc_outmale_lt14' => $value['dtcinpatienttested(male,children_lt14yrs)']
			// 	);
			$total_eid = $value['eid_tests'];
			$total_children = $value['tested_peds'];
			$total_adults = $value['tested_adult'];
			$total = $value['tested_total'];
			$cumulative_eid = $cumulative_eid+$total_eid;
			$cumulative_children = $cumulative_children+$total_children;
			$cumulative_adults = $cumulative_adults+$total_adults;
			$cumulative_total = $cumulative_total+$total;
			$dhis_tests[$key] = array(
				  		'county_ID' => $value['county'],
						'sub_county_ID' => $value['county'],
						'facility_ID' => $value['county'],
						'period' => $value['periods'],
						'eid' => $total_eid,
						'total_children' => $total_children,
						'total_adults' => $total_adults,
						'total' => $total,
						'cum_eid' => $cumulative_eid,
						'cum_children' => $cumulative_children,
						'cum_adults' => $cumulative_adults,
						'cum_total' => $cumulative_total
					);
			
        }
        
		return $dhis_tests;

	}

	function calculate_dhis_positive($data){
		$cum_eid=0;
		$cum_children=0;
		$cum_adults=0;
		$cum_total=0;
		$next = NULL;
		
		foreach ($data as $key => $value) {
			if ($next == NULL) {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['county'];
        	} else {
        		if($next != $value['county'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			$cum_eid=0;
        			$cum_children=0;
					$cum_adults=0;
					$cum_total=0;
					$next = $value['county'];
        		}
        	}
			// $dhis_positive[0] =  array(
			// 	  		'county_ID' => $value['county'],
			// 	  		'sub_county_ID' => $value['county'],
			// 	  		'facility_ID' => $value['county'],
			// 	  		'period' => $value['periods'],
			// 			'vct_female_15_24' => $value['vctclientshiv+ve(15-24yrs,female)'],
			// 			'vct_female_25' => $value['vctclientshiv+ve(female,_gt25yrs)'],
			// 			'vct_male_15_24' => $value['vctclientshiv+ve(15-24yrs,male)'],
			// 			'vct_male_25' => $value['vctclientshiv+ve(male,_gt25yrs)'],
			// 			'dtc_inmale_gt14' => $value['dtc-inpatienthiv+ve(male,adult_gt14yrs)'],
			// 			'dtc_outmale_gt14' => $value['dtc-outpatienthiv+ve(male,adult_gt14yrs)'],
			// 			'dtc_infemiale_gt14' => $value['dtc-inpatienthiv+ve(female,adult_gt14yrs)'],
			// 			'dtc_outfemale_gt14' => $value['dtc-outpatienthiv+ve(female,adult_gt14yrs)'],
			// 			'anc_hiv_tests' => $value['antenatalpositive'],
			// 			'labour_delivery' => $value['labouranddeliverypositive'],
			// 			'postnatal' => $value['postnatalhiv+'],
			// 			'dtc_infemale_lt14' => $value['dtc-inpatienthiv+ve(female,children_lt14yrs)'],
			// 			'dtc_outfemale_lt14' => $value['dtc-outpatienthiv+ve(female,children_lt14yrs)'],
			// 			'dtc_inmale_lt14' => $value['dtc-inpatienthiv+ve(male,children_lt14yrs)'],
			// 			'dtc_outmale_lt14' => $value['dtc-outpatienthiv+ve(male,children_lt14yrs)'],
			// 		  	'known_positive_status' => $value['knownpositivestatus']
			// 		);
			//Positive Calculations
        	$total_eid = $value['eid_pos'];
			$total_children = $value['pos_peds'];
			$total_adults = $value['pos_adult'];
			$total = $value['pos_total'];
			$infants_positivity = (@($value['eid_pos']/$value['eid_tests'])*100);
			$children_positivity = (@($value['pos_peds']/$value['tested_peds'])*100);
			$adults_positivity = (@($value['pos_adult']/$value['tested_adult'])*100);
			$cum_eid = $cum_eid+$total_eid;
			$cum_children= ($cum_children+$total_children);
			$cum_adults = ($cum_adults+$total_adults);
			$cum_total = ($cum_total+$total);
			$pregnant_mothers = ($value['anc_pos']+$value['lab_dev_pos']+$value['pnc_pos']+$value['monthers_ks']);

			//Positive Data Structuring
			$dhis_positive[$key] = array(
				  		'county_ID' => $value['county'],
				  		'sub_county_ID' => $value['county'],
				  		'facility_ID' => $value['county'],
				  		'period' => $value['periods'],
				  		'eid' => $total_eid,
						'total_children' => $total_children,
						'total_adults' => $total_adults,
						'total' => $total,
						'infants_positivity' => $infants_positivity,
						'children_positivity' => $children_positivity,
						'adults_positivity' => $adults_positivity,
						'cum_eid' => $cum_eid,
						'cum_children' => $cum_children,
						'cum_adults' => $cum_adults,
						'cum_total' => $cum_total,
						'hiv_pos_tb_patients' => $value['hiv_pos_tb_patients'],
						'pregnant_mothers' => $pregnant_mothers
					);
			
		}

		return $dhis_positive;
	}

	function calculate_dhis_enrollment($data){
		$cum_children=0;
		$cum_adults=0;
		$cum_total=0;
		$next = NULL;
		
		foreach ($data as $key => $value) {
			if ($next == NULL) {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['county'];
        	} else {
        		if($next != $value['county'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			$cum_children=0;
					$cum_adults=0;
					$cum_total=0;
					$next = $value['county'];
        		}
        	}
			// $dhis_enrollment[0] = array(
			// 			'county_ID' => $value['county'],
			// 	  		'sub_county_ID' => $value['county'],
			// 	  		'facility_ID' => $value['county'],
			// 	  		'period' => $value['periods'],
			// 			'female_under_15' => $value['femaleunder15yrsenrolledincare'],
			// 			'male_under_15' => $value['maleunder15yrsenrolledincare'],
			// 			'female_above_15' => $value['femaleabove15yrsenrolled'],
			// 			'male_above_15' => $value['maleabove15yrsenrolled']
			// 		);

			$cum_children = ($cum_children+$value['enrl_care_peds']);
			$cum_adults = ($cum_adults+$value['enrl_care_adult']);
			$cum_total = ($cum_total+$value['enrl_care_total']);

			$dhis_enrollment[$key] = array(
						'county_ID' => $value['county'],
				  		'sub_county_ID' => $value['county'],
				  		'facility_ID' => $value['county'],
				  		'period' => $value['periods'],
				  		'enrl_care_lt_1yr' => $value['enrl_care_lt_1yr'],
						'enrl_care_peds' => $value['enrl_care_peds'],
						'enrl_care_adults' => $value['enrl_care_adult'],
						'enrl_care_total' => $value['enrl_care_total'],
						'curr_care_lt1yr' => $value['curr_care_lt1yr'],
						'curr_care_peds' => $value['curr_care_peds'],
						'curr_care_adults' => $value['curr_care_adult'],
						'curr_care_total' => $value['curr_care_total'],
						'cum_enrl_care_peds' => $cum_children,
						'cum_enrl_care_adults' => $cum_adults,
						'cum_enrl_care_total' => $cum_total
					);

		}
		return $dhis_enrollment;
	}

	function calculate_dhis_art($data){
		
		$cum_children=0;
		$cum_adults=0;
		$cum_infants=0;
		$next = NULL;
		
		foreach ($data as $key => $value) {
			if ($next == NULL) {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['county'];
        	} else {
        		if($next != $value['county'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			$cum_children=0;
					$cum_adults=0;
					$cum_infants=0;
					$next = $value['county'];
        		}
        	}

			// $dhis_enrollment[0] = array(
			// 			'county_ID' => $value['county'],
			// 	  		'sub_county_ID' => $value['county'],
			// 	  		'facility_ID' => $value['county'],
			// 	  		'period' => $value['periods'],
			// 		  	'female_under_15_starting' => $value['femaleunder15yrsstartingart'],
			// 		  	'male_under_15_starting' => $value['maleunder15yrsstartingart'],
			// 		  	'female_above_15_starting' => $value['femaleabove15yrstartingart'],
			// 		  	'male_above_15_starting' => $value['maleabove15yrsstartingart'],
			// 		  	'art_net_cohort' => $value['artnetcohortat12'],
			// 		  	'on_original' => $value['onoriginal1stline'],
			// 		  	'on_alternative_1' => $value['onalternative1stl'],
			// 		  	'on_alternative_2' => $value['on2ndline'],
			// 		  	'prophylaxisHAART' => $value['prophylaxis-haart']
			// 		);

			$cum_children = $cum_children+$value['start_art_peds'];
           	$cum_adults = $cum_adults+$value['start_art_adult'];
			$cum_infants = $cum_infants+$value['start_art_lt_1yr'];
			$percentage_tb_start_art = (@($value['start_art_tb_patient']/$value['hiv_pos_tb_patients'])*100);
			$aliveART = $value['on_alt_1st_line']+$value['1st_line_snr_art']+$value['2nd_line_sor_art'];
			// $retained = ($aliveART/$value['art_net_cht_snr_art'])*100;

			$dhis_art[$key] = array(
						'county_ID' => $value['county'],
				  		'sub_county_ID' => $value['county'],
				  		'facility_ID' => $value['county'],
				  		'period' => $value['periods'],
				  		'curr_art_lt_1yr' => $value['curr_art_lt_1yr'],
				  		'curr_art_peds' => $value['curr_art_peds'],
				  		'curr_art_adults' => $value['curr_art_adult'],
				  		'curr_art_total' => $value['curr_art_total'],
				  		'start_art_lt_1yr' => $value['start_art_lt_1yr'],
						'start_art_peds' => $value['start_art_peds'],
						'start_art_adults' => $value['start_art_adult'],
						'start_art_total' => $value['start_art_total'],
						'cum_started_infants' => $cum_infants,
						'cum_started_children' => $cum_children,
						'cum_started_adults' => $cum_adults,
						'net_overall_cohort' => $value['art_net_cht_snr_art'],
						'alive_on_art' => $aliveART,
						'retained_on_art' => $value['art_net_cht_snr_art'],
						'start_art_tb_patient' => $value['start_art_tb_patient'],
						'percentage_tb_start_art' => $percentage_tb_start_art,
						'pregnantmothersonART' => $value['prophy_haart']
					);

		}

		return $dhis_art;
	}

	function calculate_vl($data)
	{
		foreach ($data as $key => $value) {
			$viral_load[$key] = array(
						'county_ID' => $value['county'],
				  		'sub_county_ID' => $value['county'],
				  		'facility_ID' => $value['county'],
				  		'period' => $value['periods'],
				  		'peds_vl_tests' => $value['peds_vl_test'],
				  		'peds_vl_sppd' => $value['peds_vl_sppd'],
				  		'adult_vl_tests' => $value['adult_vl_test'],
				  		'adult_vl_sppd' => $value['adult_vl_suppd'],
				  		'total_vl_tests' => ($value['peds_vl_test']+$value['adult_vl_test']),
						'total_vl_sppd' => ($value['peds_vl_sppd']+$value['adult_vl_suppd']),
						'prop_suppressed_peds' => (int)(($value['peds_vl_sppd']/$value['peds_vl_test'])*100),
						'prop_suppressed_adults' => (int)(($value['adult_vl_suppd']/$value['adult_vl_test'])*100)
					);
		}

		return $viral_load;
	}


	public function format_county_name($name='')
	{
		$new_name = '';
		if ($name=='' || $name==' ') {
			$new_name = NULL;
		} else {
			if(strpos($name, '-'))
			{
				$exploded_county = explode("-", $name);
				$new_name = $exploded_county[0]." ".$exploded_county[1];
			}
			else{
				$new_name = $name;
			}
		}
		
		return $new_name;
	}
}
?>