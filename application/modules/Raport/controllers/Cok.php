<?php
header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Cok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
	}

	public function index()
	{
		echo "Tutaj wyświetli się lista raportów";
	}

	public function ilosciowy()
	{
		$data['title'] = 'Raport ilościowy';
		$this->load->view("template/header", $data);
		$this->load->view("cok_ilosciowy", $data);
		$this->load->view("template/footer");
	}

	public function ilosciowy_json()
	{
		if(isset($_GET['data_od']) && isset($_GET['data_do'])){
			$data_od = $_GET['data_od'];
			$data_do = $_GET['data_do'];
		}else{
			$data_od = date("Y-m-d", strtotime("- day"));
			$data_do = date("Y-m-d");
		}
		$this->db->cache_on();
		$query = $this->db->query("SELECT * FROM cok WHERE date(date) BETWEEN '$data_od' AND '$data_do' ORDER BY date ASC");
		
		$raport = array();
		foreach($query->result() as $row)
		{
			$temp = array();
			$temp['Agent'] = $row->agent_name;
			$temp['Data'] = $row->date;
			//$temp['Godzina zalogowania'] = $row->agent_login;
			//$temp['Godzina wylogowania'] = $row->agent_logout;
			
			//$temp['Liczba połączeń'] = $row->all_call_count;
			$temp['Połączenia odebrane'] =$row->received_call_count;
			$temp['Połączenia nieodebrane'] =$row->missed_call_count;
			
			$raport[] = $temp;
			
		}
		echo json_encode($raport);
	}
}