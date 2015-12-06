<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//error_reporting(0);
class MY_Controller extends MX_Controller{
    function __construct() {
        parent::__construct();
        $this->load->module('template');
    }

    function select_county()
    {
    	$select = '';
    	$counties = $this->db->get('counties')->result_array();
    	// echo "<pre>";print_r($counties);die();
    	$select .= '<select class="btn btn-info" id="county-select" name="county_name">';
    	$select .= '<option value="0" selected="true">Kenya</option>';
    	$select .= '<optgroup label="Select a County">';
        if ($counties) {
    		foreach ($counties as $key => $value) {
    			$select .= '<option value="'.$value['county_ID'].'">'.$value['county_name'].'</option>';
    		}
    	}
    	$select .= '<optgroup label="Select a County">';
    	$select .= '</select>';

    	return $select;
    	
    }

}
