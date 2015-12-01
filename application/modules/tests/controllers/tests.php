<?php
/**
* 
*/
class tests extends MY_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function upload_csv()
	{
		$this->load->view('upload');
	}

	function read_csv()
	{
		if (isset($_FILES)) {
			$file = $_FILES['upload'];
			$file_dir = $file['tmp_name'];
			if (($handle = fopen("$file_dir", "r")) !== FALSE) {
				while (($row_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$sheet_data[] = $row_data;
				}
			fclose($handle);
			}
			$this->load->library('../controllers/api');
			$this->api->format_data($sheet_data);
			// foreach ($sheet_data as $key => $value) {
			// 	// echo "<pre>";print_r($value);die();
			// 	$this->db->query("INSERT IGNORE INTO `counties` (`county_name`) VALUES ('".$value[0]."')");
			// }
			// $this->db->insert_batch('counties',$sheet_data);
			redirect('tests/upload_csv');
		}
	}
}
?>