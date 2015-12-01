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

	function counties()
    {
        return $this->db->get('counties')->result_array();
    }
    
    function dhis_insert_aggregation($data){
    	// echo "<pre>";print_r($data);
    	$tests = $this->tests_insert($data['tests']);
    	$positive = $this->positive_insert($data['positive']);
    	$enrollment = $this->enrollment_insert($data['enrollment']);
    	$art = $this->art_insert($data['art']);
    	
    	return TRUE;
    }

    function tests_insert($data){
    	foreach ($data as $key => $value) {
    		$tests[] = $value[0];
    		$tests_calc[] = $value[1];
    	}
    	$test = $this->db->insert_batch('dhis_tests', $tests);
    	$test_cal = $this->db->insert_batch('dhis_calc_tests', $tests_calc);

    	return TRUE;
    }

    function positive_insert($data){
    	foreach ($data as $key => $value) {
    		$positive[] = $value[0];
    		$positive_calc[] = $value[1];
    	}
    	$pos = $this->db->insert_batch('dhis_positive', $positive);
    	$pos_cal = $this->db->insert_batch('dhis_calc_positive', $positive_calc);

    	return TRUE;	
    }

    function enrollment_insert($data){
    	foreach ($data as $key => $value) {
    		$enrollment[] = $value[0];
    		$enrollment_calc[] = $value[1];
    	}
    	$enroll = $this->db->insert_batch('dhis_enrollment', $enrollment);
    	$enroll_cal = $this->db->insert_batch('dhis_calc_enrollment', $enrollment_calc);

    	return TRUE;
    }

    function art_insert($data){
    	foreach ($data as $key => $value) {
    		$art[] = $value[0];
    		$art_calc[] = $value[1];
    	}
    	$arts = $this->db->insert_batch('dhis_art', $art);
    	$arts_cal = $this->db->insert_batch('dhis_calc_art', $art_calc);

    	return TRUE;
    }
}
?>