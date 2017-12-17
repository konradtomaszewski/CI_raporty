<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
		echo "Tutaj wyświetli się raport ilościowy";

	}

	public function ilosciowy_generate()
	{
		$query = $this->db->query("SELECT * FROM interwencje");
		//$result = db->query($query);


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
}