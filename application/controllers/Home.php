<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->add('section','Home');
	}

	public function index()
	{
		$data = $this->data;
		
		$this->load->view('home/index',$data);
	}


}
