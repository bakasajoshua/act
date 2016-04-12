<?php
/**
* author: Bakasa Joshua
* @baksajoshua09@gmail.com
*/
class api_model extends CI_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

    function get_county_names()
    {
        foreach ($this->counties() as $key => $value)
            $new_db_counties[] = $value['county_name'];
        
        return $new_db_counties;
    }

    function get_counties()
    {
        return $this->db->query("SELECT
                                    `county_ID`,
                                    `county_name`
                                FROM `counties`")->result_array();
    }

	function counties($name)
    {
        /*
        *When using this function to compare county names,
        *always use str_replace(" ","",$string) to remove whitespace that comes with the county_name
        */
        return $this->db->query("SELECT
                                    `county_ID`
                                FROM `counties`
                                WHERE `county_name` = '$name'")->result_array();
    }

    function insert_sub_counties($data){
        foreach ($data as $key => $value) {
            $sub_county_name = $value['sub_county_name'];
            $county_ID = $value['county_ID'];
            $insert = $this->db->query('INSERT IGNORE INTO `sub_counties` (`sub_county_name`,`county_ID`) VALUES("$sub_county_name","$county_ID")');
        }
        return $insert;
    }

    //Addition of the missing sub counties
    function insert_missing_sub_counties($data)
    {
        $sub_county_name = $data['sub_county_name'];
        $county_ID = $data['county_ID'];
        $sql = "INSERT IGNORE INTO `sub_counties` (`sub_county_name`,`county_ID`) VALUES('$sub_county_name','$county_ID')";
        // echo $sql;die();
        $insert = $this->db->query($sql);
        
        return $this->db->insert_id();
    }

    function get_subcounty_by_name($name){
        $this->db->where('sub_county_name', $name);
        return $this->db->get('sub_counties')->result_array();
        // return $this->db->query("SELECT
        //                             `sub_county_ID`,
        //                             `sub_county_name`
        //                         FROM `sub_counties`
        //                         WHERE `sub_county_name` = '$name'")->result_array();
    }

    function subCounties($name)
    {
        $this->db->where('sub_county_name',$name);
        return $this->db->get('sub_counties')->result_array();
        
    }

    function cascade_insert($data)
    {
        if($this->db->get('cascade')->result_array())
        {
            foreach ($data as $key => $value) {
                $this->db->where('sub_county_ID', $value['sub_county_ID']);
                $this->db->update('cascade', $value);
            }
        }
        $this->db->insert_batch('cascade', $data);

        return TRUE;
    }

    function formatting_eid_data($data,$year,$month){
        $sub_counties = $this->db->get('sub_counties')->result_array();
        // echo "<pre>";print_r($data);die();
        foreach ($data as $key => $value) {
            foreach ($sub_counties as $k => $v) {
                if ($value['SubCounty']==$v['sub_county_name']) {
                    $value['County'] = $v['county_ID'];
                    $value['SubCounty'] = $v['sub_county_ID'];
                    $value['period'] = $year."-".$month."-".$this->config->item('eid_report_day');
                    $new_array[] = $value;
                }
            }
        }

        $facility = $this->add_facility($new_array);

        if ($facility) {
            $facilities = $this->db->get('facilities')->result_array();
            foreach ($new_array as $key => $value) {
                foreach ($facilities as $k => $v) {
                    if ($value['MFL']==$v['MFL_Code']) {
                        $value['Facility'] = $v['facility_ID'];
                        $insert_array[] = $value;
                    }
                }
            }

            $insert = $this->adding_eid_data($insert_array);
        }

        $eid_calc = $this->calculate_eid_data($insert_array,$year,$month);

        return $insert;
        
    }

    function adding_eid_data($data)
    {
        foreach ($data as $key => $value) {
            $insertion = array(
                        'county_ID' => $value['County'],
                        'sub_county_ID' => $value['SubCounty'],
                        'facility_ID' => $value['Facility'],
                        'MFL' => $value['MFL'],
                        'period' => $value['period'],
                        'test' => $value['Test'],
                        'negative' => $value['Neg'],
                        'positive' => $value['Pos'],
                        'onTx' => $value['OnTx'],
                        'invalid' => $value['Invalid']
                    );
            $insert = $this->db->insert('eid', $insertion);
        }

        return $insert;
    }

    function calculate_eid_data($data,$year,$month)
    {
        //Gets the data already calculated
        $eid_calculated = $this->db->get('eid_calc')->result_array();
        
        //If this is not the first time running this function,
        //      performs an aggregation from that basis
        if ($eid_calculated) {

            //foreach loop that performs the cumulative addition
                foreach ($data as $key => $value) {
                    //Getting the calculated values from the latest reported month of the year for the current Sub County
                    $sub_county = $value['sub_county_ID'];
                    $aggregates = $this->db->query("SELECT * FROM `eid_calc` WHERE `sub_county_ID` = '$sub_county' AND YEAR(`period`) = '$year' AND `period` = (SELECT MAX(`period`) FROM `eid_calc`)")->result_array();
                }

            $insertion = $this->add_eid_calculatedData($new_aggregate);
        }
        //If it is the first time running this function,
        //      take the values just added and do the aggregation from that basis
        else {
            $eid = $this->db->query("SELECT
                                        `county_ID`,
                                        `sub_county_ID`,
                                        `period`,
                                        SUM(`test`) AS `test`,
                                        SUM(`negative`) AS `negative`,
                                        SUM(`positive`) AS `positive`,
                                        SUM(`onTx`) AS `onTx`,
                                        SUM(`invalid`) AS `invalid`
                                    FROM `eid`
                                    GROUP BY `sub_county_ID`")->result_array();
            
            $insertion = $this->add_eid_calculatedData($eid);
            
        }

        return $insertion;
        
    }

    function add_eid_calculatedData($data)
    {
        foreach ($data as $key => $value) {
                $insert = array(
                                'county_ID' => $value['county_ID'],
                                'sub_county_ID' => $value['sub_county_ID'],
                                'period' => $value['period'],
                                'cumulative_test' => $value['test'],
                                'cumulative_negative' => $value['negative'],
                                'cumulative_positive' => $value['positive'],
                                'cumulative_onTx' => $value['onTx'],
                                'cumulative_invalid' => $value['invalid']);

                $insertion = $this->db->insert('eid_calc', $insert);
            }
        return $insertion;
    }

    function add_facility($data)
    {
        foreach ($data as $key => $value) {
            $mfl = $value['MFL'];
            $facility = $value['Facility'];
            $sub_county_ID = $value['SubCounty'];
            $insert = $this->db->query("INSERT IGNORE INTO `facilities` (`MFL_Code`, `facility_name`, `sub_county_ID`) VALUES ('$mfl', '$facility', '$sub_county_ID')");
        }
        return $insert;
    }
    
    function dhis_insert_aggregation($data){
    	// echo "<pre>";print_r($data);
    	$tests = $this->tests_insert($data['tests']);
    	$positive = $this->positive_insert($data['positive']);
    	// $enrollment = $this->enrollment_insert($data['enrollment']);
    	// $art = $this->art_insert($data['art']);
     //    $vl = $this->vl_insert($data['vl']);
    	
    	return TRUE;
    }

    function tests_insert($data){
    	
    	$test_cal = $this->db->insert_batch('dhis_calc_tests', $data);

    	return TRUE;
    }

    function positive_insert($data){
    	
    	$pos_cal = $this->db->insert_batch('dhis_calc_positive', $data);

    	return TRUE;	
    }

    function enrollment_insert($data){
    	
    	$enroll_cal = $this->db->insert_batch('dhis_calc_enrollment', $data);

    	return TRUE;
    }

    function art_insert($data){
    	
    	$arts_cal = $this->db->insert_batch('dhis_calc_art', $data);

    	return TRUE;
    }

    function vl_insert($data)
    {
        $vl_cal = $this->db->insert_batch('vl', $data);

        return TRUE;
    }
}
?>