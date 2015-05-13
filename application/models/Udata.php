<?php
class Udata extends CI_Model{
	function __construct(){
		parent::__construct();	
		$this->load->database();
	}
	
	public function register($arr){
		$this->db->insert('user_data', $arr);
		return $this->db->affected_rows();
	}
	
	public function select($name){
		$this->db->select('*');
		$this->db->where('name',$name);
		$query = $this->db->get('user_data');
		return $query->result();	
	}
}
?>