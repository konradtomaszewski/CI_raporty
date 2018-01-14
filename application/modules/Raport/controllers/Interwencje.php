<?php
header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Interwencje extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
	}

	public function index()
	{
		echo "Lista raportów";
	}

	public function dzialania_serwisowe()
	{
		$data['title'] = 'Raport podjętch działań';
		$this->load->view("template/header", $data);
		$this->load->view("interwencje_dzialania", $data);
		$this->load->view("template/footer");
	}

	public function dzialania_serwisowe_json()
	{
		if(isset($_GET['data_od']) && isset($_GET['data_do'])){
			$data_od = $_GET['data_od'];
			$data_do = $_GET['data_do'];
		}else{
			$data_od = date("Y-m-d", strtotime("-1 day"));
			$data_do = date("Y-m-d");
		}
		$this->db->cache_off();
		$query = $this->db->query("SELECT date(data) as 'data', miasto, serwisant, usterka, rodzaj_usterki, nra FROM interwencje WHERE date(data) BETWEEN '$data_od' AND '$data_do' GROUP BY data,nra,serwisant,usterka");
		/*$query = $this->db->query("SELECT date(data) as 'data', miasto, serwisant, usterka, rodzaj_usterki, nra 
									FROM interwencje WHERE date(data) BETWEEN '$data_od' AND '$data_do' 
									GROUP BY FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(data)/900)*900), nra, serwisant");*/
									
		$raport = array();
		foreach($query->result() as $row)
		{
			$temp = array();
			if($row->miasto == "WKM")
			{
				if($row->nra < 100)
				{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Warszawa';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['emtest'] = '1';
					$temp['automat'] = 'EMTest';
					$raport[] = $temp;
				}
				else
				{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Warszawa';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['sb'] = '1';
					$temp['automat'] = 'S&B';
					$raport[] = $temp;
				}
			}
			elseif($row->miasto == "WrKM")
			{
				//if($row->nra < 610)
				//{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Wrocław';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['sb'] = '1';
					$temp['automat'] = 'S&B';
					$raport[] = $temp;
				/*}
				else{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Wrocław';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['mera'] = '1';
					$temp['automat'] = 'Mera';
					$raport[] = $temp;
				}*/	
			}
			elseif($row->miasto == "WrKMmob")
			{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Wrocław';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['mobilne'] = '1';
					$temp['automat'] = 'Mobilne';
					$raport[] = $temp;
			}
			elseif($row->miasto == "BKM")
			{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Bydgoszcz';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['sb'] = '1';
					$temp['automat'] = 'S&B';
					$raport[] = $temp;
			}
			elseif($row->miasto == "GDANSK")
			{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Gdańsk';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['rodzaj_usterki'] = $row->rodzaj_usterki;
					$temp['emtest'] = '1';
					$temp['automat'] = 'EMTest';
					$raport[] = $temp;
			}
		}
		echo json_encode($raport);
	}

	public function ilosciowy_export()
	{
		if(isset($_GET['data_od']) && isset($_GET['data_do'])){
			$data_od = $_GET['data_od'];
			$data_do = $_GET['data_do'];
		}else{
			$data_od = date("Y-m-d", strtotime("-1 day"));
			$data_do = date("Y-m-d");
		}
		$this->db->cache_off();
		//$query = $this->db->query("SELECT date(data) as 'data', miasto, serwisant, usterka, nra FROM interwencje WHERE date(data) BETWEEN '$data_od' AND '$data_do'");
		$query = $this->db->query("SELECT date(data) as 'data', miasto, serwisant, usterka, rodzaj_usterki, nra 
									FROM interwencje WHERE date(data) BETWEEN '$data_od' AND '$data_do' 
									GROUP BY FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(data)/900)*900), nra, serwisant");
		
		$raport = array();
		foreach($query->result() as $row)
		{
			$temp = array();
			if($row->miasto == "WKM")
			{
				if($row->nra < 100)
				{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Warszawa';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['emtest'] = '1';
					$raport[] = $temp;
				}
				else
				{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Warszawa';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['sb'] = '1';
					$raport[] = $temp;
				}
			}
			elseif($row->miasto == "WrKM")
			{
				if($row->nra < 610)
				{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Wrocław';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['sb'] = '1';
					$raport[] = $temp;
				}
				else{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Wrocław';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['mera'] = '1';
					$raport[] = $temp;
				}	
			}
			elseif($row->miasto == "WrKMmob")
			{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Wrocław';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['mobilne'] = '1';
					$raport[] = $temp;
			}
			elseif($row->miasto == "BKM")
			{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Bydgoszcz';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['sb'] = '1';
					$raport[] = $temp;
			}
			elseif($row->miasto == "GDANSK")
			{
					$temp['data'] = $row->data;
					$temp['miasto'] = 'Gdańsk';
					$temp['serwisant'] = $row->serwisant;
					$temp['usterka'] = $row->usterka;
					$temp['emtest'] = '1';
					$raport[] = $temp;
			}
		}
		
		echo "<table>";
		foreach($raport as $row)
		{
			echo "<tr>";
			echo "<td>".$row['data']."</td><td>".$row['miasto']."</td><td>".$row['serwisant']."</td><td>".$row['usterka']."</td><td>".@$row['emtest']."</td><td>".@$row['sb']."</td><td>".@$row['mera']."</td><td>".@$row['mobilne']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}