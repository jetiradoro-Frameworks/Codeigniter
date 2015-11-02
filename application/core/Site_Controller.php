<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends My_Controller {	
	
	

	public function __construct(){	
		parent::__construct();

		// if(!$this->session->user){	
		// 	$this->setError("Has d'estar loguinat per accedir a l'aplicació");
		// 	redirect('login');
		// }		
		
		$this->add('breadcrumb',array());		
		// $this->add('user',$this->session->user);

	}

	

}
