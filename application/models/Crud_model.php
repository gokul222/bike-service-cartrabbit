<?php
class Crud_Model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//get record count by sql
	function get_count_by_sql($SQL){
		$rs = $this->db->query($SQL);
		return $rs->num_rows();
	}

	//get records by sql
	function get_by_sql($SQL){
		$rs = $this->db->query($SQL);
		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}


	// select records count (for pagination)
	function get_count($table_name = '', $where=array())
	{
		$rs = $this->db->get_where($table_name,$where);
		return $rs->num_rows();
	}

	// select records
	function get($table_name = '', $where=array(),$limit=null,$offset=null,$order_by_field=null,$order_by_order=null){

		if(!is_null($offset) and !is_null($limit))
		{
			$this->db->limit($limit,$offset);
		}
		if($order_by_field != null and $order_by_order != null)
		{
			$this->db->order_by($order_by_field, $order_by_order);
		}
		$rs = $this->db->get_where($table_name,$where);

		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	// get list of records for drop down
	function get_list($id_field_name,$value_field_name,$table_name,$init_list=array(),$where=array()){
		$this->db->select($id_field_name);
		$this->db->select($value_field_name);
		$this->db->where($where);
		$rs = $this->db->get($table_name);
		if($rs->num_rows()>0){
			$records = $rs->result_array();
			foreach($records as $record){
				$init_list[$record[$id_field_name]] = $record[$value_field_name];
			}
		}
		return $init_list;
	}
	// get one row
	function get_row($table_name,$where=array()){
		$records = $this->get($table_name,$where);
		if($records != false){
			return $records[0];
		}
		else{
			return false;
		}
	}
	// get one rows
	function get_rows($table_name,$where=array()){
		$records = $this->get($table_name,$where);
		if($records != false){
			return $records;
		}
		else{
			return false;
		}
	}
	// get one field
	function get_one($field_name,$table_name,$where=array())
	{
		$records = $this->get($table_name,$where);
		if($records != false){
			return $records[0][$field_name];
		}
		else{
			return false;
		}
	}
	// create new record
	function insert($table_name = '', $data=array())
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}

	// update existing record
	function update($table_name = '', $data=array(),$where=array())
	{
		$this->db->update($table_name,$data,$where);
	}

	// delete existing record
	function delete($table_name = '', $where=array())
	{
		$this->db->delete($table_name,$where);
	}
	// Update or Insert
	function update_or_insert($table_name = '', $data=array(), $where=array())
	{
		$n = $this->get_count($table_name,$where);
		if($n > 0)
		{
			$this->update($table_name,$data,$where);
			return true;
		}
		else
		{
			$this->db->insert($table_name,$data);
			return $this->db->insert_id();
		}
	}

	//Pagination.
	function get_page_data($offset = 1,$limit =10,$table_name = "",$table_id = "") {
		$query = $this->db->select($table_name.'.*')
				->limit($limit, $offset)
				->order_by($table_id,'desc')
				->get($table_name);
		$result = $query->result_array();
		return $result;
	}

	// select records
	public function get_order_by($table_name = '', $where=array(),$order_by_field=null,$order_by_order=null){

		if($order_by_field != null and $order_by_order != null)
		{
			$this->db->order_by($order_by_field, $order_by_order);
		}
		$rs = $this->db->get_where($table_name,$where);

		if($rs->num_rows() > 0){
			return $rs->result_array();
		}
		else{
			return false;
		}
	}

	function get_list_data($table_name = "",$where=array(),$order_by_order='',$order_by_field='') {
		$this->db->order_by($order_by_field, $order_by_order);
		$query = $this->db->get_where($table_name,$where);
		$result = $query->result_array();
		return $result;
	}

}
