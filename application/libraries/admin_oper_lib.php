<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_oper_lib extends CI_Controller {
	public function __construct()
	{
	parent:: __construct();
	$this->load->model('menu_admin_model');
	$this->load->model('materials_model');
	$this->load->model('styles_model');
	$this->load->model('colors_model');
	$this->load->model('Doors_type_types_model');
	$this->load->library('navi');
	$this->load->library('filter_lib');
	} 
	
	public function oper($type=null,$page=null){
	 
	$a= new Filter_lib();
	$data['filter2']=$a->filter_html(null,$type);
	$c=new Navi();
	$data['type_name']=$this->Doors_type_types_model->get();
	$data['hystory']=$c->get_params(2,'dveri_edit',$type,null,null,$page,null);
	$data['menu']=$this->menu_admin_model->get_obj(1);
    return $data;
	}
	
	public function get_data($name=null,$type=null){
	$path_to_page='/'.$name;
	$name_model=$name.'_model';
	//выбрать операнды в которых тип содержит $type
	$query=$this->$name_model->get();
	
		foreach($query as $key=>$val){
		
		$t=explode(',',$val['type']);
		foreach($t as $key2=>$val2){
		if($val2==$type){
		
		$data[$name][]=$val;
		continue;
		}
		}
		}
	if(isset($data)){
	return $data;
	}
	else{
	return null;
	}
	}
	
	public function get_indexes($name=null){
	$name_model=$name.'_model';
	$data[$name]=$this->$name_model->get_obj($id);
		foreach($data[$name] as $key4=>$val4){
		$type_indexes=$val4['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key=>$val){
		if($val==$type){
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		else{
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		}
	}
	return $data;
	}
	
	public function get_info_txt($name=null){
	if(!isset($_SESSION[$name])){
	$data['info_text']='Добавьте сперва фотографию а затем добавьте информацию';
	}
	else{
	unset($_SESSION[$name]);
	$data['info_text']='Фотография добавлена, можете добавить информацию';
	}
	return $data;
	}
}
?>