<?php
/**
* 
*/
class dashboard extends MY_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function index($id=NULL)
	{
		// $data = array('Joshua' => 'Bakasa', 'Joshua' => 'Bakasa' );
		$data['counties'] = $this->select_county();

		$this->template->dashboard($data);
	}

	function dashboard2()
	{
		$data = array('Joshua' => 'Bakasa', 'Joshua' => 'Bakasa' );

		$this->template->dashboard2($data);
	}

	function dashboard3()
	{
		$data = array('Joshua' => 'Bakasa', 'Joshua' => 'Bakasa' );

		$this->template->dashboard3($data);
	}
}
?>