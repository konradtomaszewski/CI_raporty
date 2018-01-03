<?php
header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport extends MX_Controller {
    
    public function index()
	{
		echo "Raport interwencji i cok";
    }
}