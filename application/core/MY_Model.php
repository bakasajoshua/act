<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    function user_data($user_id)
    {
    	$sql = "SELECT * FROM `users` `us` JOIN `user_types` `ut` ON `us`.`user_type_id` = `ut`.`user_type_id` WHERE `us`.`user_id` = '$user_id'";

    	$result = $this->db->query($sql);
    	$result = $result->result_array();

    	return $result[0];
    }

    function get_user_id($email)
    {
        $sql = "SELECT `user_id` FROM `users` WHERE `email` = '$email'";

        $result = $this->db->query($sql);
        $result = $result->result_array();

        return $result[0]['user_id'];
    }

    public function get_member_data($member_id)
    {
        $this->db->where('member_id',$member_id);
        return $this->db->get('members');
    }

    public function get_user_member_data($user_id)
    {
        $this->db->where('user_id',$user_id);
        return $this->db->get('members');
    }

    function get_member_email($member_id)
    {
        $sql = "SELECT
                    `us`.`email`
                FROM `users` `us`
                JOIN `members` `mb`
                ON `us`.`user_id` = `mb`.`user_id`
                WHERE `mb`.`member_id` = '$member_id'";
        $result = $this->db->query($sql)->result_array();
        
        return $result[0]['email'];
    }

    function get_loan_details($loan_id)
{
    $sql = "SELECT 
                `ln`.`loan_id`,
                `ln`.`loan_amount`,
                `ln`.`loan_purpose`,
                `ln`.`is_paid`,
                DAY(`ln`.`date_of_application`) AS `date_of_application`,
                MONTH(`ln`.`date_of_application`) AS `month_of_application`,
                YEAR(`ln`.`date_of_application`) AS `year_of_application`,
                `ln`.`months`,
                `ln`.`instalments`,
                `ln`.`month_income`,
                `ln`.`status`,
                `ln`.`loan_payable`,
                `lt`.`name` AS `loan_type`,
                `mb`.`member_id`,
                `mb`.`first_name`,
                `mb`.`middle_name`,
                `mb`.`last_name`,
                `mb`.`mobile_number`,
                `mb`.`town`
            FROM `loans` `ln`
            JOIN `users` `us` ON `ln`.`user_id` = `us`.`user_id`
            JOIN `loan_types` `lt` ON `ln`.`loan_type` = `lt`.`loan_type_id`
            JOIN `members` `mb` ON `mb`.`user_id` = `ln`.`user_id`
            WHERE `ln`.`loan_id` = '$loan_id'";
    return $sql;
}

function get_guarantor_affirmation($loan_id)
{
    $sql = "SELECT
                `ln`.`status`,
                `mb`.`first_name`,
                `mb`.`middle_name`,
                `mb`.`last_name`,
                `mb`.`mobile_number`,
                `mb`.`user_id`
            FROM `loan_notifications` `ln`
            JOIN `members` `mb` ON `ln`.`guarantor_id` = `mb`.`member_id`
            WHERE `ln`.`loan_id` = '$loan_id'";
    return $sql;
}
    
}
