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
		//Variable determining the data type being handled
		//		counties => inserting counties
		//		dhis 	 => inserting dhis data
		$data_handler='dhis';

		if (isset($_FILES)) {
			$file = $_FILES['upload'];
			$file_dir = $file['tmp_name'];
			if (($handle = fopen("$file_dir", "r")) !== FALSE) {
				while (($row_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$sheet_data[] = $row_data;
				}
			fclose($handle);
			}
			
			if ($data_handler == 'dhis') 
			{
				$this->load->library('../controllers/api');
				$this->api->format_data($sheet_data);
			} 
			else if ($data_handler == 'counties') 
			{
				$count=0;
				$newcounties = array();
				foreach ($sheet_data as $key => $value) {
					$county = explode('County', $value[0]);
					if(strpos($county[0], '-'))
					{
						$exploded_county = explode("-", $county[0]);
						$newcounties[$count] = $exploded_county[0]." ".$exploded_county[1];
					}
					else{
						$newcounties[$count] = $county[0];
					}
					
					$count++;
				}
				foreach ($newcounties as $key => $value) 
					$this->db->query("INSERT IGNORE INTO `counties` (`county_name`) VALUES ('".$value."')");
				
			}
			else if ($data_handler == 'cascade') 
			{
				$this->load->library('../controllers/api');
				$this->api->format_cascade($sheet_data);
			}
		}
	}
}
?>