<?php
class News_data extends CI_Model{
	function __construct(){
		parent::__construct();	
		$this->load->database();
	}
	
	public function add_new($arr){
		$this->db->insert('news_data', $arr);
		//return $this->db->affected_rows();
	}
	
	public function num_all(){
		$this->db->select('*');
		$this->db->from('news_data');
		return $this->db->count_all_results();//->result();
	}
	
	public function num_search($str){
		$this->db->like("topic",$str);
		$this->db->from('news_data');
		return $this->db->count_all_results();//->result();
	}
	
	public function select_limit($pagesize, $offset){
		$this->db->select('*');
		$this->db->order_by('id','asc');
		$this->db->limit($pagesize, $offset);
		return $this->db->get('news_data');	
	}
	
	public function select_new($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		return $this->db->get('news_data');	
	}
	
	public function update_new($id,$arr){
		$this->db->where('id',$id);
		$this->db->update('news_data',$arr);	
	}
	
	public function delete_new($id){
		$this->db->where('id',$id);
		$this->db->delete('news_data');	
	}
	
	public function search_limit($str, $pagesize, $offset){
		$this->db->select('*');
		$this->db->like("topic",$str);
		$this->db->order_by('id','asc');
		$this->db->limit($pagesize, $offset);
		return $this->db->get('news_data');
	}
}
?>