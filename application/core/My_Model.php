<?php
class My_Model extends CI_Model{

	protected $table;

	public function __construct(){
		parent::__construct();
	}


    /**
     * Función para obtener un listado con todos los resultado de la tabla
     * @param  [type] $value [Valor buscado en la base de datos]
     * @param  string $field [Campo por el que se busca, por defecto id]
     * @return Devuelve un objeto con los atributos:
     * status: void, success (valores que puede coger este atributo, void, es sin resultados y success es consulta correcta)
     * rows: numero de filas que devuelve el resultado
     * query: consulta que se ha generado para obtener el resultado
     * result: objeto con el resultado o mensaje de que no hay resultados en caso de ser vacio
     *
     * También puede devolver excepción en caso de haber fallado la consulta.
     */
    public function all(){
        // variable para retornar el resultado
    	$data = array();

    	$this->db->from(strtoupper($this->table));

    	$rs = $this->db->get();

    	if(!$rs){
    		throw new Exception("Error intentar obtener los resultados de la tabla ".strtoupper($this->table)."<br><br> ERROR: ".$this->db->conn_id->error);            
    	}

    	if($rs->num_rows() == 0){
    		$data['status'] = 'void';
    		$data['rows'] = 0;
    		$data['query'] = $this->db->last_query();
    		$data['result'] = 'No hay resultados';
    	}else{
    		$data['status'] = 'success';
    		$data['rows'] = $rs->num_rows();
    		$data['query'] = $this->db->last_query();
    		$data['result'] = $rs->result();
    	}

    	return (object) $data;
    }



    /**
     * Función para obtener un unico resultado de la BD
     * @param  [type] $value [Valor buscado en la base de datos]
     * @param  string $field [Campo por el que se busca, por defecto id]
     * @return Devuelve un objeto con los atributos:
     * status: void, success (valores que puede coger este atributo, void, es sin resultados y success es consulta correcta)
     * rows: numero de filas que devuelve el resultado
     * query: consulta que se ha generado para obtener el resultado
     * result: objeto con el resultado o mensaje de que no hay resultados en caso de ser vacio
     *
     * También puede devolver excepción en caso de haber fallado la consulta.
     */
    public function getOne($value, $field='ID'){

        // variable para retornar el resultado
    	$data = array();

    	$this->db->from(strtoupper($this->table));
    	$this->db->where($field,$value);

    	$rs = $this->db->get();

    	if(!$rs){
    		throw new Exception("Error intentar obtener el valor ".$id." en la columna ".$field." de la tabla ".strtoupper($this->table)."<br><br> ERROR:".$this->db->conn_id->error);          
    	}

    	if($rs->num_rows() == 0){
    		$data['status'] = 'void';
    		$data['rows'] = 0;
    		$data['query'] = $this->db->last_query();
    		$data['result'] = 'No hay resultados';
    	}else{
    		$result = $rs->result();
    		$data['status'] = 'success';
    		$data['rows'] = $rs->num_rows();
    		$data['query'] = $this->db->last_query();
    		$data['result'] = $rs->row();
    	}

    	return (object) $data;

    }


    /**
     * Guardar un registro en base de datos
     * @param  [type] $post Objeto o array asociativo con los campos de la base de datos y el valor asignado
     * @return Devuelve una excepción de error o el id del registro insertado.
     */
    public function guardar($post,$sequence=false){

    	$this->db->trans_begin();

    	$this->db->set($post);

    	$error = "fallo generico al intentar insertar";

    	$rs = $this->db->insert(strtoupper($this->table));

    	if($rs < 1){
    		$error = "Error al insertar en ".strtoupper($this->table)."<br><br> ERROR: ".$this->db->conn_id->error;
    	}

    	if($sequence){
    		$id = $this->getLastId($sequence);    		
    	}else{
    		$id = 0;
    	}

    	if($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		throw new Exception($error);

    	}else{
    		$this->db->trans_commit();

    		return $id;
    	}

    }

    /**
     * Actualiza registros de la base de datos
     * @param  [type] $post Objeto con los campos de la base de datos y el valor asignado
     * @return Devuelve una excepción de error.
     */
    public function actualizar($post){

    	$this->db->trans_begin();

    	$error = "fallo generico al intentar insertar";

        // capturamos el id del objeto que queremos actualizar
    	$id = $post->ID;

        //desconfiguramos el campo id del objeto pasado por post
    	unset($post->ID);

        //pasamos la asociacion de atributos y valores a la base de datos       
    	$this->db->set($post);

        // ejecutamos el update con el filtro del id
    	$this->db->where('ID',$id);
    	$rs = $this->db->update(strtoupper($this->table));

    	if($rs < 1){
    		$error = "Error al actualizar el id ".$id." en ".strtoupper($this->table)."<br><br> ERROR: ".$this->db->conn_id->error;
    	}

    	if($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		throw new Exception($error);

    	}else{
    		$this->db->trans_commit();

    		return $rs;
    	}

    }


    /**
     * Borra un registro de la tabla configurada 
     * @param  [type] $value [valor a borrar de la base de datos]
     * @param  string $field [atributo en el que buscar el valor, por defecto id]
     * @return [type]        [description]
     */
    public function borrar($value,$field='ID'){

    	$this->db->where($field,$value);
    	$rs = $this->db->delete(strtoupper($this->table));

    	return $rs;
    }

     /**
     * Función para obtener un listado con todos los resultado de la tabla
     * @param  [type] $value [Valor buscado en la base de datos]
     * @param  string $field [Campo por el que se busca, por defecto id]
     * @return Devuelve un objeto con los atributos:
     * status: void, success (valores que puede coger este atributo, void, es sin resultados y success es consulta correcta)
     * rows: numero de filas que devuelve el resultado
     * query: consulta que se ha generado para obtener el resultado
     * result: objeto con el resultado o mensaje de que no hay resultados en caso de ser vacio
     *
     * También puede devolver excepción en caso de haber fallado la consulta.
     */
    public function allByIdioma(){
        // variable para retornar el resultado
    	$data = array();

    	$this->db->from(strtoupper($this->table));
    	$this->db->where('IDIOMA_ID',$this->session->lang->ID);

    	$rs = $this->db->get();

    	if(!$rs){
    		throw new Exception("Error intentar obtener los resultados de la tabla ".strtoupper($this->table)."<br><br> ERROR: ".$this->db->conn_id->error);            
    	}

    	if($rs->num_rows() == 0){
    		$data['status'] = 'void';
    		$data['rows'] = 0;
    		$data['query'] = $this->db->last_query();
    		$data['result'] = 'No hay resultados';
    	}else{
    		$data['status'] = 'success';
    		$data['rows'] = $rs->num_rows();
    		$data['query'] = $this->db->last_query();
    		$data['result'] = $rs->result();
    	}

    	return (object) $data;
    }



    /**
     * Función para obtener un unico resultado de la BD
     * @param  [type] $value [Valor buscado en la base de datos]
     * @param  string $field [Campo por el que se busca, por defecto id]
     * @return Devuelve un objeto con los atributos:
     * status: void, success (valores que puede coger este atributo, void, es sin resultados y success es consulta correcta)
     * rows: numero de filas que devuelve el resultado
     * query: consulta que se ha generado para obtener el resultado
     * result: objeto con el resultado o mensaje de que no hay resultados en caso de ser vacio
     *
     * También puede devolver excepción en caso de haber fallado la consulta.
     */
    public function getOneByIdioma($value, $field='ID'){

        // variable para retornar el resultado
    	$data = array();

    	$this->db->from(strtoupper($this->table));
    	$this->db->where($field,$value);
    	$this->db->where('IDIOMA_ID',$this->session->lang->ID);

    	$rs = $this->db->get();

    	if(!$rs){
    		throw new Exception("Error intentar obtener el valor ".$id." en la columna ".$field." de la tabla ".strtoupper($this->table)."<br><br> ERROR:".$this->db->conn_id->error);          
    	}

    	if($rs->num_rows() == 0){
    		$data['status'] = 'void';
    		$data['rows'] = 0;
    		$data['query'] = $this->db->last_query();
    		$data['result'] = 'No hay resultados';
    	}else{
    		$result = $rs->result();
    		$data['status'] = 'success';
    		$data['rows'] = $rs->num_rows();
    		$data['query'] = $this->db->last_query();
    		$data['result'] = $result[0];
    	}

    	return (object) $data;

    }

    /**
     * Obtiene el identificador actual de la sequencia pasada por parámetro
     * @param  string $sequence Nombre de la sequencia de la base de datos
     * @return int           Numero identificador
     */
    public function getLastId($sequence){
    	$this->db->select($sequence.".CURRVAL AS IDVAL", false);
    	$this->db->from("DUAL");

    	$query = $this->db->get();

    	$rs = $query->row();

    	return $rs->IDVAL;
    }

}