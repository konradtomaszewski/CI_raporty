<?php
header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function index()
	{
		echo "<title>Import</title>";
		echo "<ul>Import:";
		echo "<li>Interwencji</li>";
		echo "<li>COK</il></ul>";
	}

	public function interwencje()
	{
		
		$data['title'] = "Zarządzenie danymi";
		$this->load->view("template/header", $data);
		$this->load->view("import_interwencje_view", $data);
		$this->load->view("template/footer");
	}

	public function cok()
	{
		
		$data['title'] = "Zarządzenie danymi";
		$this->load->view("template/header", $data);
		$this->load->view("import_cok_view", $data);
		$this->load->view("template/footer");
	}

	
}