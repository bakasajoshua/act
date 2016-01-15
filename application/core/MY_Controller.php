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
        // $this->year_filter();
    }

    public function year_filter()
    {
        $string = '';
        $year = Date('Y')-5;

        $string .= '<ul class="tabbed" id="network_tabs" style="padding-left: 0;">';
        $string .= '<li><span>Year:  |</span></li>';
        $string .= '<li><span>&nbsp;&nbsp;...&nbsp;&nbsp;|</span></li>';
        for ($i=0; $i < 6; $i++) { 
            $string .= '<li class="tab">
                            <span>
                                &nbsp;&nbsp;
                                    <a href="'.base_url().'dashboard/county/'.$year.'">'.$year.'</a>
                                &nbsp;&nbsp;|
                            </span>
                        </li>';
            $year++;
        }
        $string .= '<li><span>&nbsp;&nbsp;...&nbsp;&nbsp;|</span></li>';
        $string .= '</ul>';

        return $string;
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

    public function set_session_data()
    {
        $data = array(
            'county_ID' => 0,
            'sub_county_ID' => 0,
            'year' => Date('Y'));
        $this->session->set_userdata($data);
        return TRUE;
    }

    public function filter($year)
    {
        $this->session->set_userdata('year', $year);

        //Setting the relevant selected county
        if ($this->input->post('county_name'))
            $this->session->set_userdata('county_ID', $this->input->post('county_name'));

        //Setting the relevant selected Sub County
        if ($this->input->post('sub_county_select'))
            $this->session->set_userdata('sub_county_ID', $this->input->post('sub_county_select'));
        
        return TRUE;
    }

}
?>