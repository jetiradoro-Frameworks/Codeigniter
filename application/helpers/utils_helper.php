<?php
function ordenarArray ($ArrayaOrdenar, $por_este_campo, $descendiente = false) {
	$posicion = array();
	$NuevaFila = array();
	foreach ($ArrayaOrdenar as $clave => $fila) {
		$posicion[$clave] = $fila[$por_este_campo];
		$NuevaFila[$clave] = $fila;
	}
	if ($descendiente) {
		arsort($posicion);
	}
	else {
		asort($posicion);
	}
	$ArrayOrdenado = array();
	foreach ($posicion as $clave => $pos) {
		$ArrayOrdenado[] = $NuevaFila[$clave];
	}
	return $ArrayOrdenado;
}

/**
 * [post description]
 * @return [type] [description]|
 */
function post() {
	$CI =& get_instance();
	
	$postedflash = $CI->session->flashdata('post');

	if ($postedflash) {
		return (object) array_merge($CI->input->post(), (array) $postedflash);
	} else {
		return (object) $CI->input->post();
	}
}
/**
 * [get description]
 * @return [type] [description]
 */
function get() {
	$CI =& get_instance();
	return (object) $CI->input->get();
}

/**
 * Función para guardar subir un archivo al servidor, si la ruta que es passa per paràmetre no existeix, la crea.
 * @package  Helpers
 * @param  file  $fieldname nom del camp del formulari que conté la imatge
 * @param  string $name_file nom que es vol possar a l'arxiu
 * @param  string  $type      ruta del servidor on emmagatzemarà la imatge
 * @param  boolean $max_size  paràmetre que permet establir el pes màxim de la imatge, per defecte false, i agafa la constant definida
 * @return array  Informació de les dades que s'han pujat al servidor
 */
function file_save($fieldname,$name_file, $type, $max_size = false) {
	$CI =& get_instance();

	$CI->load->library('upload');

	//comprobamos si el path existe si no lo creamos y le damos permisos
	$dir = is_dir($type);	
	if(!$dir){
		mkdir($type, 0777, true);		
	}
	
	if($max_size) $tope = $max_size; else $tope = MAX_SIZE_UPLOAD;

	$config['upload_path'] = $type;//'./img/image/';
	$config['allowed_types'] = '*';
	$config['max_size']	= $tope;     
	$config['file_name'] = $name_file.'_'.date('Ymd_His');

	$CI->upload->initialize($config);

	if ( !$CI->upload->do_upload($fieldname)) {
		$array['error'] = true;
		$array['error_msg'] = $CI->upload->display_errors();
	} else {
		$array['error'] = false;
		$array['data'] = $CI->upload->data();
	}

	return ($array);
}

/**
 * Esborra un fitxer dels servidor
 * @package  Helpers
 * @param  string $img    nom de la imatge amb la extensió
 * @param  string $folder ruta del servidor on es troba la imatge
 */
function imgkill($img, $folder) {
	unlink($folder . $img);
}



function to_date($date, $format = "d/m/Y") {
	if (($date == "") or ($date == "0000-00-00") ) {
		return "";
	} else {
		return date($format,strtotime($date));
	}	
}


function oracleField($string){
	return mb_strtoupper($string);
}