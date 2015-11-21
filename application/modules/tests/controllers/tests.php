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
					$county = $row_data[0];
					$sql = "INSERT INTO `tst_counties` (`county_name`) VALUES ('$county')";
					// echo $sql;die();
					$this->db->query($sql);
				}
			fclose($handle);
			}

			// echo "<pre>";print_r($sheet_data);
			// $this->db->insert_batch('tst_counties',$sheet_data);
		}
	}
}
?>