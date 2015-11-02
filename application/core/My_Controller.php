<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

	public $data;
	protected $lang_id = 1;
	protected $locale;

	public function __construct(){
		parent::__construct();
	
		//si no se ha definido page, se intenta obtener
		if (empty($this->data['page'])) {
			$this->add('page', $this->router->fetch_class());
		}

		//asignamos variables de URIS para el uso en vista
		$this->add('url', $this->url());
		$this->add('menu','home');
		$this->add('method',$this->router->fetch_method());
		$this->add('controller',$this->router->fetch_class());

		
		// $this->getLang();
		// $this->getTranslates();
		
	}

	/**
	 * Añadimos parametros al data
	 */
	protected function add($key,$value){
		$this->data[$key] = $value;
	}

	/**
	 * url al controlador actual
	 * @return [type] [description]
	 */
	protected function url() {
		return base_url() . $this->route();
	}

	protected function route() {
		if (empty($this->data['area'])) {
			return ($this->data['page']);
		} else {
			return ($this->data['area'] . "/" . $this->data['page']);
		}
	}


	public function add_transport($key, $array){
		$this->session->set_flashdata($key,$array);
	}


	public function setError($message, $type='danger'){
		if($type=='danger'){
			$status = 'Error. ';
		}else{
			$status = 'Correcte. ';
		}

		$array = array(
			'type' => $type,
			'status' => $status,
			'message' => $message,
			);

		$this->add_transport('notification',$array);
	}

	// protected function getLang(){
		
	// 	if(!$this->session->lang){
	// 		$lang = array(
	// 			'ID'=>1,
	// 			'IDIOMA'=>'català',
	// 			'SIGLES'=>'ca'
	// 			);
	// 		$this->session->set_userdata('lang',(object) $lang);
	// 	}

	// 	$this->add('lang',$this->session->lang);
	// 	$this->lang_id = $this->session->lang->ID;

	// 	// obtenemos el desplegable
	// 	$this->load->model('idiomes_model');
	// 	$rs = $this->idiomes_model->all();

	// 	$this->add('idiomes',$rs->result);

	// }

	// protected function getTranslates(){
	// 	$this->load->model('translates_model');

	// 	$rs = $this->translates_model->allByIdioma();

	// 	$array = array();
	// 	foreach($rs->result as $row){
	// 		$array[$row->CLAU] = $row->DESCRIPCIO;
	// 	}

	// 	$this->locale = (object) $array;

	// 	$this->add('locale',(object) $array);
	// }
}
