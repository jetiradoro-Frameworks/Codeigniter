<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends My_Controller {

	public function __construct(){	
		parent::__construct();

		if(!$this->session->user){	
			$this->setError("Has d'estar loguinat per accedir a l'aplicació");
			redirect('login');
		}

		if(!$this->session->admin){
			$this->setError("Has de tenir permisos d'administració per accedir a aquest mòdul");
			redirect('home');
		}
		
		
		$this->add('breadcrumb',array());		
		$this->add('user',$this->session->user);

		$this->layout->css("//cdn.datatables.net/responsive/1.0.5/css/dataTables.responsive.css");
		$this->layout->js("//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js");
		$this->layout->js("//cdn.datatables.net/responsive/1.0.5/js/dataTables.responsive.js");
		$this->layout->js("//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js");
		
	}
	

}
