<?php
header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport extends CI_Controller {

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
		$data['title'] = 'Raport ilościowy live';
		$this->load->view("template/header", $data);
		$this->load->view("ilosciowy_view", $data);
		$this->load->view("template/footer");
	}

	public function ilosciowy_json()
	{
		if(isset($_GET['data_od']) && isset($_GET['data_do'])){
			$data_od = $_GET['data_od'];
			$data_do = $_GET['data_do'];
		}else{
			$data_od = date("Y-m-d");
			$data_do = date("Y-m-d");
		}
		$query = $this->db->query("SELECT date(data) as 'data', miasto, serwisant, usterka, emtest, sb, mera, mobilne FROM raport WHERE date(data) BETWEEN '$data_od' AND '$data_do'");
		$arr = array();
		foreach($query->result() as $row)
		{
			$temp = array();
			$temp['data']=$row->data;
			$temp['miasto']=$row->miasto;
			$temp['serwisant']=$row->serwisant;
			$temp['usterka']=$row->usterka;
			$temp['emtest']=$row->emtest;
			$temp['sb']=$row->sb;
			$temp['mera']=$row->mera;
			$temp['mobilne']=$row->mobilne;
			$arr[] = $temp;
		}
		echo json_encode($arr);
	}

	public function ilosciowy_generate()
	{
		$this->db->query("TRUNCATE raport");

		$query = $this->db->query("SELECT * FROM interwencje");
		foreach($query->result() as $row)
		{
			//print_r($row);
			
			$data = $row->data;
			$nra = $row->nra;
			$miasto = $row->miasto;
			$serwisant = $row->serwisant;
			$usterka = $row->usterka;
			
			if($miasto == "WKM")
			{
				if($nra < 100)
				{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Warszawa', serwisant='$serwisant', usterka='$usterka', emtest='1'");
					
				}
				else
				{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Warszawa', serwisant='$serwisant', usterka='$usterka', sb='1'");
				}
			}
			else if($miasto == "WrKM")
			{
				if($nra <= 608)
				{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Wrocław', serwisant='$serwisant', usterka='$usterka', sb='1'");
				}
				else if($nra > 608 && $nra < 1000)
				{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Wrocław', serwisant='$serwisant', usterka='$usterka', mera='1'");
				}
			}
			else if($miasto == "WrKMmob")
			{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Wrocław', serwisant='$serwisant', usterka='$usterka', mobilne='1'");
			}
			else if($miasto == "BKM")
			{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Bydgoszcz', serwisant='$serwisant', usterka='$usterka', sb='1'");
			}
			else if($miasto == "GDANSK")
			{
					$this->db->query("INSERT INTO raport SET data='$data', miasto='Gdańsk', serwisant='$serwisant', usterka='$usterka', emtest='1'");
			}
		}
	}

	public function ilosciowy_test()
	{
		if(isset($_GET['data_od']) && isset($_GET['data_do'])){
			$data_od = $_GET['data_od'];
			$data_do = $_GET['data_do'];
		}else{
			//$data_od = date("Y-m-d");
			$data_od = '2017-12-18';
			$data_do = date("Y-m-d");
		}
		$query = $this->db->query("SELECT * FROM interwencje WHERE date(data) BETWEEN '$data_od' AND '$data_do'");
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
		}
		echo json_encode($raport);
	}
}