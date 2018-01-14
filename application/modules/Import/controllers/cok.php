<?php
header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Cok extends MX_Controller {
	public $path_dir = './imported_files/cok/';
	public $excel_file = null;

	public function __construct()
	{
		parent::__construct();
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
	}

	public function index()
	{
		$data['title'] = "Zarządzenie danymi";
		$this->load->view("template/header", $data);
		$this->load->view("cok", $data);
		$this->load->view("template/footer");
	}

	public function run_import()
	{
		$this->db->cache_off();
		if ($handle = opendir($this->path_dir)) {
			while (false !== ($this->excel_file = readdir($handle))) {
				if ($this->excel_file != "." && $this->excel_file != "..") {
					Cok::parse_xlsx($this->path_dir,$this->excel_file);
				}
				//Insert into imported file
				if ($this->excel_file != "." && $this->excel_file != "..") {
					$result = $this->db->query("SELECT * FROM imported_files WHERE filename='$this->excel_file'");
					$check_exist = $result->num_rows();
					if($check_exist == 0)
					{
						$this->db->query("INSERT INTO imported_files (id, filename, miasto, import_date, filetype) VALUES (NULL, '$this->excel_file', '$miasto', NOW(), 'cok')");
					}
				}
			}
			closedir($handle);
		}	
	}

	public function parse_xlsx($path_dir,$excel_file)
	{		
		header('Content-Type: text/plain');
		//require('assets/plugin/excel_reader/php-excel-reader/excel_reader2.php');
		require('assets/plugin/excel_reader/SpreadsheetReader.php');
		echo $excel_file.PHP_EOL;
		$Filepath = $path_dir.$excel_file;
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$Sheets = $Spreadsheet -> Sheets();

		foreach ($Sheets as $Index => $Name)
		{
			$Spreadsheet -> ChangeSheet($Index);
			foreach ($Spreadsheet as $Key => $Row)
			{
				if ($Row)
				{
					if($Row[0] != 'Agent')
					{
						$agent_name = $Row[0];
						$date = $Row[17];
						$agent_login = gmdate("H:i:s",$Row[15]*24*60*60);
						$agent_logout = gmdate("H:i:s",$Row[16]*24*60*60);
						$all_call_count = $Row[19];
						$received_call_count = $Row[18];
						$missed_call_count = $Row[19]-$Row[18];
							
						Cok::add_cok($agent_name, $date, $agent_login, $agent_logout, $all_call_count, $received_call_count, $missed_call_count);
					}
				}
			}
		}
	}

	public function add_cok($agent_name, $date, $agent_login, $agent_logout, $all_call_count, $received_call_count, $missed_call_count)
	{
		$dane= array(
			'agent_name' => $agent_name,
			'date' => $date,
			'agent_login' => $agent_login,
			'agent_logout' => $agent_logout,
			'all_call_count' => $all_call_count,
			'received_call_count' => $received_call_count,
			'missed_call_count' => $missed_call_count	
		);
	
		$result = $this->db->query("SELECT * FROM cok WHERE agent_name='$agent_name' AND date='$date'");
		$check_exist = $result->num_rows();
		if($check_exist == 0)
		{
			$this->db->query("INSERT INTO cok (id, agent_name, date, agent_login, agent_logout, all_call_count, received_call_count, missed_call_count) VALUES (NULL, '$agent_name', '$date', '$agent_login', '$agent_logout', '$all_call_count', '$received_call_count', '$missed_call_count');");
		}
		
	}

	public function import_result_details()
	{
		echo "narazie nic";
	}
}