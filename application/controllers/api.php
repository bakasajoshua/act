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
		// echo "<pre>";print_r($new);die();
		//Getting back the aggregated values from the raw data
		$insert_data = $this->sub_formating_data($new);
		$insert = $this->api_model->dhis_insert_aggregation($insert_data);
	}

	function sub_formating_data($data)
	{
		$counties = $this->api_model->counties();

		foreach ($counties as $key => $value) {
			foreach ($data as $k => $v) {
				//Assigning the county_ID to the corresponding county_name
				$county = $this->format_county_name($v['organisationunitname']);
				if ($county == $value['county_name']) {
					$data[$k]['organisationunitname'] = $value['county_ID'];
				}
				//Formatting the period of the data to php
				$dates = date_parse($v['periodname']);
				$test_date = Date('Y').'-'.$dates['month'].'-'.$dates['day'];
				$data[$k]['periodname'] = $test_date;

			}
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

		return $newdata;
	}

	function calculate_dhis_tests($data){
			$cumulative_children=0;
			$cumulative_adults=0;
			$next = 0;
        foreach ($data as $key => $value) {
        	if ($next == 0) {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['organisationunitname'];
        	} else {
        		if($next != $value['organisationunitname'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			echo $next;
        			$cumulative_children=0;
					$cumulative_adults=0;
        		}
        	}
        	
        	$test_sum[0] = ($value['vctclientstested(15-24yrs,female)']+$value['vctclientstested(female,_gt25yrs)']+$value['vctclientstested(15-24yrs,male)']+$value['vctclientstested(male,_gt25yrs)']+$value['dtcinpatienttested(male,adult_gt14yrs)']+$value['dtcoutpatienttested(male,adult_gt14yrs)']+$value['dtcoutpatienttested(female,adult_gt14yrs)']);
			$test_sum[1] = ($value['dtcinpatienttested(female,adult_gt14yrs)']+$value['anchivtests']+$value['labouranddelivery']+$value['postnatal(within72']);
			$dhis_tests[0] = array(
			  		'county_ID' => $value['organisationunitname'],
			  		'sub_county_ID' => $value['organisationunitname'],
			  		'facility_ID' => $value['organisationunitname'],
			  		'period' => $value['periodname'],
			  		'vct_female_15_24' => $value['vctclientstested(15-24yrs,female)'],
			  		'vct_female_25' => $value['vctclientstested(female,_gt25yrs)'],
			  		'vct_male_15_24' => $value['vctclientstested(15-24yrs,male)'],
			  		'vct_male_25' => $value['vctclientstested(male,_gt25yrs)'],
			  		'dtc_inmale_gt14' => $value['dtcinpatienttested(male,adult_gt14yrs)'],
			  		'dtc_outmale_gt14' => $value['dtcoutpatienttested(male,adult_gt14yrs)'],
			  		'dtc_infemale_gt14' => $value['dtcoutpatienttested(female,adult_gt14yrs)'],
			  		'dtc_outfemale_gt14' => $value['dtcinpatienttested(female,adult_gt14yrs)'],
			  		'anc_hiv_tests' => $value['anchivtests'],
			  		'labour_delivery' => $value['labouranddelivery'],
			  		'postnatal' => $value['postnatal(within72'],
			  		'dtc_infemale_lt14' => $value['dtcinpatienttested(female,children_lt14yrs)'],
			  		'dtc_outfemale_lt14' => $value['dtcoutpatienttested(female,children_lt14yrs)'],
			  		'dtc_inmale_lt14' => $value['dtcoutpatienttested(male,children_lt14yrs)'],
			  		'dtc_outmale_lt14' => $value['dtcinpatienttested(male,children_lt14yrs)']
				);
			$total_children = ($value['dtcinpatienttested(female,children_lt14yrs)']+$value['dtcoutpatienttested(female,children_lt14yrs)']+$value['dtcoutpatienttested(male,children_lt14yrs)']+$value['dtcinpatienttested(male,children_lt14yrs)']);
			$total_adults = ($test_sum[0]+$test_sum[1]);
			$cumulative_children = $cumulative_children+$total_children;
			$cumulative_adults = $cumulative_adults+$total_adults;
			$dhis_tests[1] = array(
				  		'county_ID' => $value['organisationunitname'],
						'sub_county_ID' => $value['organisationunitname'],
						'facility_ID' => $value['organisationunitname'],
						'period' => $value['periodname'],
						'total_children' => $total_children,
						'total_adults' => ($test_sum[0]+$test_sum[1]),
						'cum_children' => $cumulative_children,
						'cum_adults' => $cumulative_adults,
					);
			$tests[] = $dhis_tests;
        }
        // echo "<pre>";print_r($tests);die();
		 return $tests;

	}

	function calculate_dhis_positive($data){
		$cum_children=0;
		$cum_adults=0;
		$cum_total=0;
		$next = 0;

		foreach ($data as $key => $value) {
			if ($next = '') {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['organisationunitname'];
        	} else {
        		if($next != $value['organisationunitname'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			$cum_children=0;
					$cum_adults=0;
					$cum_total=0;
        		}
        	}
			$dhis_positive[0] =  array(
				  		'county_ID' => $value['organisationunitname'],
				  		'sub_county_ID' => $value['organisationunitname'],
				  		'facility_ID' => $value['organisationunitname'],
				  		'period' => $value['periodname'],
						'vct_female_15_24' => $value['vctclientshiv+ve(15-24yrs,female)'],
						'vct_female_25' => $value['vctclientshiv+ve(female,_gt25yrs)'],
						'vct_male_15_24' => $value['vctclientshiv+ve(15-24yrs,male)'],
						'vct_male_25' => $value['vctclientshiv+ve(male,_gt25yrs)'],
						'dtc_inmale_gt14' => $value['dtc-inpatienthiv+ve(male,adult_gt14yrs)'],
						'dtc_outmale_gt14' => $value['dtc-outpatienthiv+ve(male,adult_gt14yrs)'],
						'dtc_infemiale_gt14' => $value['dtc-inpatienthiv+ve(female,adult_gt14yrs)'],
						'dtc_outfemale_gt14' => $value['dtc-outpatienthiv+ve(female,adult_gt14yrs)'],
						'anc_hiv_tests' => $value['antenatalpositive'],
						'labour_delivery' => $value['labouranddeliverypositive'],
						'postnatal' => $value['postnatalhiv+'],
						'dtc_infemale_lt14' => $value['dtc-inpatienthiv+ve(female,children_lt14yrs)'],
						'dtc_outfemale_lt14' => $value['dtc-outpatienthiv+ve(female,children_lt14yrs)'],
						'dtc_inmale_lt14' => $value['dtc-inpatienthiv+ve(male,children_lt14yrs)'],
						'dtc_outmale_lt14' => $value['dtc-outpatienthiv+ve(male,children_lt14yrs)'],
					  	'known_positive_status' => $value['knownpositivestatus']
					);

			$total_children = ($value['dtc-outpatienthiv+ve(male,children_lt14yrs)']+$value['dtc-inpatienthiv+ve(female,children_lt14yrs)']+$value['dtc-inpatienthiv+ve(male,children_lt14yrs)']+$value['dtc-outpatienthiv+ve(female,children_lt14yrs)']);
			$total_adults = ($value['vctclientshiv+ve(15-24yrs,female)']+$value['vctclientshiv+ve(female,_gt25yrs)']+$value['vctclientshiv+ve(15-24yrs,male)']+$value['vctclientshiv+ve(male,_gt25yrs)']+$value['dtc-inpatienthiv+ve(male,adult_gt14yrs)']+$value['dtc-outpatienthiv+ve(male,adult_gt14yrs)']+$value['dtc-inpatienthiv+ve(female,adult_gt14yrs)']+$value['dtc-outpatienthiv+ve(female,adult_gt14yrs)']+$value['antenatalpositive']+$value['labouranddeliverypositive']+$value['postnatalhiv+']);
			$total = ($total_children+$total_adults);
			$cum_children= ($cum_children+$total_children);
			$cum_adults = ($cum_adults+$total_adults);
			$cum_total = ($cum_total+$total);

			$dhis_positive[1] = array(
				  		'county_ID' => $value['organisationunitname'],
				  		'sub_county_ID' => $value['organisationunitname'],
				  		'facility_ID' => $value['organisationunitname'],
				  		'period' => $value['periodname'],
						'total_children' => $total_children,
						'total_adults' => $total_adults,
						'total' => $total,
						'cum_children' => $cum_children,
						'cum_adults' => $cum_adults,
						'cum_total' => $cum_total,
						'pregnant_mothers' => ($value['antenatalpositive']+$value['labouranddeliverypositive']+$value['postnatalhiv+']+$value['knownpositivestatus'])
					);
			$positive[] = $dhis_positive;
		}

		return $positive;
	}

	function calculate_dhis_enrollment($data){
		$cum_children=0;
		$cum_adults=0;
		$cum_total=0;
		$next = 0;

		foreach ($data as $key => $value) {
				if ($next = '') {//Checking if it is the first Iteration and setting the next value the same as the county name
        		$next = $value['organisationunitname'];
        	} else {
        		if($next != $value['organisationunitname'])//Checking if the next value is equivalent to the current county in process then reset the cummulatives if different
        		{
        			$cum_children=0;
					$cum_adults=0;
					$cum_total=0;
        		}
        	}
			$dhis_enrollment[0] = array(
						'county_ID' => $value['organisationunitname'],
				  		'sub_county_ID' => $value['organisationunitname'],
				  		'facility_ID' => $value['organisationunitname'],
				  		'period' => $value['periodname'],
						'female_under_15' => $value['femaleunder15yrsenrolledincare'],
						'male_under_15' => $value['maleunder15yrsenrolledincare'],
						'female_above_15' => $value['femaleabove15yrsenrolled'],
						'male_above_15' => $value['maleabove15yrsenrolled']
					);

			$total_children = ($value['femaleunder15yrsenrolledincare']+$value['maleunder15yrsenrolledincare']);
			$total_adults = ($value['femaleabove15yrsenrolled']+$value['maleabove15yrsenrolled']);
			$total = ($total_children+$total_adults);
			$cum_children = ($cum_children+$total_children);
			$cum_adults = ($cum_adults+$total_adults);
			$cum_total = ($cum_total+$total);

			$dhis_enrollment[1] = array(
						'county_ID' => $value['organisationunitname'],
				  		'sub_county_ID' => $value['organisationunitname'],
				  		'facility_ID' => $value['organisationunitname'],
				  		'period' => $value['periodname'],
						'total_children' => $total_children,
						'total_adults' => $total_adults,
						'total' => $total,
						'cum_children' => $cum_children,
						'cum_adults' => $cum_adults,
						'cum_total' => $cum_total
					);

			$enrollment[] = $dhis_enrollment;
		}
		return $enrollment;
	}

	function calculate_dhis_art($data){
		foreach ($data as $key => $value) {

			$dhis_enrollment[0] = array(
						'county_ID' => $value['organisationunitname'],
				  		'sub_county_ID' => $value['organisationunitname'],
				  		'facility_ID' => $value['organisationunitname'],
				  		'period' => $value['periodname'],
					  	'female_under_15_starting' => $value['femaleunder15yrsstartingart'],
					  	'male_under_15_starting' => $value['maleunder15yrsstartingart'],
					  	'female_above_15_starting' => $value['femaleabove15yrstartingart'],
					  	'male_above_15_starting' => $value['maleabove15yrsstartingart'],
					  	'art_net_cohort' => $value['artnetcohortat12'],
					  	'on_original' => $value['onoriginal1stline'],
					  	'on_alternative_1' => $value['onalternative1stl'],
					  	'on_alternative_2' => $value['on2ndline'],
					  	'prophylaxisHAART' => $value['prophylaxis-haart']
					);

			$total_children = ($value['femaleunder15yrsstartingart']+$value['maleunder15yrsstartingart']);
			$total_adults = ($value['femaleabove15yrstartingart']+$value['maleabove15yrsstartingart']);
			$aliveART = ($value['onoriginal1stline']+$value['onalternative1stl']+$value['on2ndline']);
			$retained = (($aliveART/$value['artnetcohortat12'])*100);

			$dhis_enrollment[1] = array(
						'county_ID' => $value['organisationunitname'],
				  		'sub_county_ID' => $value['organisationunitname'],
				  		'facility_ID' => $value['organisationunitname'],
				  		'period' => $value['periodname'],
						'total_children_starting' => $total_children,
						'total_adults_starting' => $total_adults,
						'net_overall_cohort' => $value['artnetcohortat12'],
						'alive_on_art' => $aliveART,
						'retained_on_art' => $retained,
						'pregnantmothersonART' => $value['prophylaxis-haart']
					);

			$art[] = $dhis_enrollment;
		}

		return $art;
	}

	public function format_county_name($name='')
	{
		$new_name = '';
		if ($name=='' || $name==' ') {
			$new_name = NULL;
		} else {
			$county = explode('County', $name);
			if(strpos($county[0], '-'))
			{
				$exploded_county = explode("-", $county[0]);
				$new_name = $exploded_county[0]." ".$exploded_county[1];
			}
			else{
				$new_name = $county[0];
			}
		}
		
		return $new_name;
	}
}
?>