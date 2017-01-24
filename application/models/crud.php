<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model {

	public $table ='';
	public $id_key ='';
	

	
	//Получение данных об одной записи
	public function get()
	{
	
	$query=$this->db->get($this->table);
	return $query->result_array();
		
	}

	public function get_obj($obj_id)
	{
	
	  
	    $this->db->where($this->id_key,$obj_id);
		$query=$this->db->get($this->table);
		return $query->result_array();
		
	}
	public function get_category($field,$obj_id)
	{
	    $this->db->where($field,$obj_id);
		$query=$this->db->get($this->table);
		return $query->row_array();
		
	}
	public function get_and($current,$lang,$and)
	{
		$this->db->where($this->id_key,$lang);
		$this->db->where($and,$current);
		$query=$this->db->get($this->table);
		return $query->result_array();//было row_array
		
	}
	public function get_and_result($current,$lang,$and)
	{
		$this->db->where($this->id_key,$lang);
		$this->db->where($and,$current);
		$query=$this->db->get($this->table);
		return $query->result_array();
		
	}
	public function get_table($key,$item,$type,$style)
	{
		if($item!=0){
		
		$this->db->where($key,$item);
		}
		$this->db->where('type',$type);
		if(isset($style)){
		
		$this->db->where('style',$style);
		}
		$query=$this->db->get($this->table);
		return $query->result_array();
	}
	public function get_where_array($array,$type)
	{
	//извлекаем модель продъюсер которой обозначен и тип которой имеется
	//и обозначаем условие where // развивающая литература по логическим терминам
		foreach($array as $key=>$value){
		$this->db->where($key,$value);
		$this->db->where('type',$type);
		}
		$query=$this->db->get($this->table);
		return $query->result_array();
	}
	public function get_free($table,$key,$item)
	{
	    $this->db->where($key,$item);
		$query=$this->db->get($table);
		return $query->result_array();
	}
	public function get_except_array($table,$key,$except)
	{
		foreach($except as $value){
	    $this->db->where(''.$key.' !=',$value['id']);
		}
		
		$query=$this->db->get($table);
		return $query->result_array();
	}
	public function get_free_table($table)
	{
	  	$query=$this->db->get($table);
		return $query->result_array();
	}
	public function get_and_result_3($current,$lang,$and,$third,$third_item)
	{
		$this->db->where($this->id_key,$lang);
		$this->db->where($and,$current);
		$this->db->where($third,$third_item);
		$query=$this->db->get($this->table);
		return $query->result_array();
		
	}
	public function get_row($obj_id)
	{
	
	  
	    $this->db->where($this->id_key,$obj_id);
		$query=$this->db->get($this->table);
		return $query->row_array();
		
	}
	public function get_limit($limit,$id_key,$order)
	{
	    $this->db->order_by($id_key,$order);    
		$query=$this->db->get($this->table,$limit);
		return $query->result_array();
		
	}
	public function insert($data){
	$this->db->insert($this->table, $data); 
	}
	public function update($data,$id,$id_item){
	$this->db->where($id, $id_item);
	$this->db->update($this->table, $data);
	}
	
	public function delete($id,$id_item){
	$this->db->where($id, $id_item);
	$this->db->delete($this->table);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */