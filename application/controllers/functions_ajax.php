<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions_ajax extends CI_Controller {

public function __construct()
	 {
	parent:: __construct();
	$this->load->helper('url');
	require('server/FirePHP.class.php');
	$this->load->model('floor_model');
	$this->load->model('door_model');
	$this->load->model('models_model');
	$this->load->model('articles_id_model');
	$this->load->model('menu_parent');
	$this->load->model('photos_model');
	$this->load->model('materials_model');
	$this->load->model('doortypes_model');
	$this->load->model('walls_model');
	$this->load->model('styles_model');
	$this->load->model('gallery_model');
	$this->load->model('colors_model');
	$this->load->model('plintus_model');
	$this->load->model('walls_room_model');
	$this->load->model('producers_id_model');
	$this->load->model('collection_model');
	$this->load->model('boxes_prod_model');
	$this->load->model('boxes_coll_model');$this->load->model('dobor_coll_model');
	$this->load->model('Nalichniki_prod_model');
	$this->load->model('naliki_coll_model');$this->load->model('dobor_prod_model');
	$this->load->model('Collection_info_model');
	
    $firephp = FirePHP::getInstance(true);
    $firephp -> fb("hello world! i'm warning you!",FirePHP::WARN);
	} 
	
	public function get_colls(){
	$colls['colls']=$this->collection_model->get_obj($_POST['menu_value']);
	$colls['boxes']=$this->boxes_prod_model->get_obj($_POST['menu_value']);
	if($colls){
		echo json_encode($colls);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	public function change_door_name() {
	$data['name']=$_POST['door_name'];
	$id_door=$_POST['id_door'];
	$this->door_model->update($data,'id',$id_door);
	}
	
		public function change_door_price() {
	$data['price']=$_POST['door_price'];
	$id_door=$_POST['id_door'];
	$this->door_model->update($data,'id',$id_door);
	}
	
	public function get_name_of_door(){
	$val=$this->door_model->get_obj($_POST['id_door']);
	if($val[0]['podobnie']!=""){
	$data['podobnie']=$val[0]['podobnie'].",".$_POST['id'];
	}
	else{
	$data['podobnie']=$_POST['id'];
	}
	$this->door_model->update($data,'id',$_POST['id_door']);
	$value=$this->door_model->get_obj($_POST['id']);
	if($value){
		echo json_encode($value);
		}
		else{
		echo json_encode(NULL);
		}
	}
	
	public function del_gal(){
	$this->gallery_model->delete('id',$_POST['del_index']);
	
	}
	
	public function del_pod_door(){
	
	$value=$this->door_model->get_obj($_POST['id_door']);
	print_r($value);
	$string=$value[0]['podobnie'];
	print($string);
	$str1=",".$_POST['id'];
	$strlen=strlen($string);
	if($strlen>1){
	$str2=$_POST['id'].",";
	}
	else{
	$str2=$_POST['id'];
	}
	$pos1=stripos($string,$str1);
	$f_str=substr($string, 0, 1);
	if($pos1>0){
	$fin_string = str_replace($str1,"",$string);
	}
	else if($f_str==$_POST['id']){
	$fin_string=str_replace($str2,"",$string);
	}
	print($fin_string);
	$data['podobnie']=$fin_string;
	$this->door_model->update($data,'id',$_POST['id_door']);
	}
	
	public function get_colls_nal(){
	$colls['colls']=$this->collection_model->get_obj($_POST['menu_value']);
	$colls['naliki']=$this->Nalichniki_prod_model->get_obj($_POST['menu_value']);
	if($colls){
		echo json_encode($colls);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	public function get_colls_dob(){
	$colls['colls']=$this->collection_model->get_obj($_POST['menu_value']);
	$colls['dobor']=$this->dobor_prod_model->get_obj($_POST['menu_value']);
	if($colls){
		echo json_encode($colls);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	public function get_colls_boxes(){
	$colls=$this->boxes_coll_model->get_obj($_POST['menu_value']);
	if($colls){
		echo json_encode($colls);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	
	public function get_colls_naliki(){
	$colls=$this->naliki_coll_model->get_obj($_POST['menu_value']);
	if($colls){
		echo json_encode($colls);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	
		public function get_colls_dobor(){
	$colls=$this->dobor_coll_model->get_obj($_POST['menu_value']);
	if($colls){
		echo json_encode($colls);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	
	public function del_art(){
	$this->articles_id_model->delete('id',$_POST['id_art']);
	$num=1;
		echo json_encode ($num);
		
	}
	
	
	public function delete_door_photos(){
	$this->photos_model->delete('id',$_POST['id']);
	}
	
	public function get_floor(){
	header('Content-Type: application/json');
	$id=$_POST['id'];
	$floor=$this->floor_model->get_obj($id);
	if($floor){
		echo json_encode($floor[0]['path']);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	public function get_plintus(){
	header('Content-Type: application/json');
	$id=$_POST['id'];
	$plintus=$this->plintus_model->get_obj($id);
	if($plintus){
		echo json_encode($plintus[0]['path']);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	public function get_walls(){
	header('Content-Type: application/json');
	$id=$_POST['id'];
	$room=$_POST['model'];
	
	if($room=='walls'){
	$walls=$this->walls_model->get_obj($id);
	}
	else{
	$walls=$this->walls_room_model->get_obj($id);
	}
	echo json_encode($walls);
		
	}
	
	public function save_producer(){
	header('Content-Type: application/json');
	session_start();
	$data['name']=$_POST['name_prod'];//название продюсера
	$type_ar=$_POST['type_ar'];//массив с типами дверей
	foreach($type_ar as $key=>$val){
	if($key!==0){
	$str_types.=','.$val.'';
	}
	else{
	$str_types=''.$val.'';
	}
	}
	$data['type']=$str_types;
	$data['logo']=$_SESSION['logo'];
	if(isset($_POST['oper'])){
	$this->producers_id_model->update($data,'id',$_POST['oper']);
	}
	else{
	$this->producers_id_model->insert($data);
	}
	if($this->db->affected_rows()){
	$last_id=$this->db->insert_id(); 
	unset($_SESSION['logo']);
	echo json_encode($last_id);
	}
	else if(isset($_POST['oper'])){
	echo json_encode(true);
	}
	else{
	echo json_encode(null);
	}
	}
	
	
	public function get_type(){
	header('Content-Type: application/json');
	$door_type=$this->doortypes_model->get_obj($_POST['val_sel']);
	if(isset($door_type)){
	echo json_encode($door_type);
	}
	else{
	echo json_encode(null);
	}
	}
	
	public function delete_producer(){
	//удалить все модели в которых присутствует id продьюсера
	$this->models_model->delete('producer',$_POST['id']);
	$this->producers_id_model->delete('id',$_POST['id']);
	}
	
	public function delete_style(){
	$type_page=$_POST['typep'];
	$type=$this->styles_model->get_obj($_POST['id']);
	$type=$type[0]['type'];//1,2
	//разбить строку
	$ex=explode(',', $type );
	$type=(string)$type;
	
	foreach($ex as $key=>$val){
	if(count($ex)>1){
	//удалить часть строки из 1,2
	if($type[0]==$val and $val==$type_page){
	$strvsl=$val.",";
	$strvsl=(string)$strvsl;
	$data['type'] = str_replace($strvsl,"", $type);
	$this->styles_model->update($data,'id',$_POST['id']);
	break;
	}
	else{
	if($type_page==$val){
	$strvsl=",".$val;
	$strvsl=(string)$strvsl;
	$data['type'] = str_replace($strvsl, "", $type);
    $this->styles_model->update($data,'id',$_POST['id']);
	break;
	}
	}
	}
	else{
	$this->styles_model->delete('id',$_POST['id']);
	}
	}
	$sub="";
	echo json_encode($sub);
	}
	
	public function delete_color(){
	$type_page=$_POST['typep'];
	$type=$this->colors_model->get_obj($_POST['id']);
	$type=$type[0]['type'];//1,2
	//разбить строку
	$ex=explode(',', $type );
	$type=(string)$type;
	
	foreach($ex as $key=>$val){
	if(count($ex)>1){
	//удалить часть строки из 1,2
	if($type[0]==$val and $val==$type_page){
	$strvsl=$val.",";
	$strvsl=(string)$strvsl;
	$data['type'] = str_replace($strvsl,"", $type);
	$this->colors_model->update($data,'id',$_POST['id']);
	break;
	}
	else{
	if($type_page==$val){
	$strvsl=",".$val;
	$strvsl=(string)$strvsl;
	$data['type'] = str_replace($strvsl, "", $type);
    $this->colors_model->update($data,'id',$_POST['id']);
	break;
	}
	}
	}
	else{
	$this->colors_model->delete('id',$_POST['id']);
	}
	}
	$sub="";
	echo json_encode($sub);
	}
	
	public function delete_material(){
	$type_page=$_POST['typep'];
	$type=$this->materials_model->get_obj($_POST['id']);
	$type=$type[0]['type'];//1,2
	//разбить строку
	$ex=explode(',', $type );
	$type=(string)$type;
	
	foreach($ex as $key=>$val){
	if(count($ex)>1){
	//удалить часть строки из 1,2
	if($type[0]==$val and $val==$type_page){
	$strvsl=$val.",";
	$strvsl=(string)$strvsl;
	$data['type'] = str_replace($strvsl,"", $type);
	$this->materials_model->update($data,'id',$_POST['id']);
	break;
	}
	else{
	if($type_page==$val){
	$strvsl=",".$val;
	$strvsl=(string)$strvsl;
	$data['type'] = str_replace($strvsl, "", $type);
    $this->materials_model->update($data,'id',$_POST['id']);
	break;
	}
	}
	}
	else{
	$this->materials_model->delete('id',$_POST['id']);
	}
	}
	$sub="";
	echo json_encode($sub);
	}
	
	public function reset_producer(){
	session_start();
	unset($_SESSION['logo']);
	}
	
	public function save_door(){
	$data['name']=$_POST['door_name'];
	$data['price']=$_POST['door_price'];
	$data['description']=$_POST['description'];
	$data['type']=$_POST['type'];
	$data['model']=$_POST['door_model'];
	$this->door_model->insert($data);
	}
	
	public function save_material(){
	$data['name']=$_POST['name_prod'];
	$data['image']=$_POST['ses'];
	foreach($_POST['type_ar'] as $key=>$val){
	if(isset($data['type'])){
	$data['type'].=",".$val;
	}
	else{
	$data['type']=$val;
	}
	}
	$this->materials_model->insert($data);
	}
	
	public function save_styles(){
	$data['name']=$_POST['name_prod'];
	$data['image']=$_POST['ses'];
	foreach($_POST['type_ar'] as $key=>$val){
	if(isset($data['type'])){
	$data['type'].=",".$val;
	}
	else{
	$data['type']=$val;
	}
	}
	$this->styles_model->insert($data);
	}
	
	public function save_color(){
	$data['name']=$_POST['name_prod'];
	$data['img']=$_POST['ses'];
	foreach($_POST['type_ar'] as $key=>$val){
	if(isset($data['type'])){
	$data['type'].=",".$val;
	}
	else{
	$data['type']=$val;
	}
	}
	$this->colors_model->insert($data);
	}
	
	public function save_model(){
	$this->models_model->insert($_POST);
	print('Модель создана!');
	}
	
	public function del_door(){
	
	if($_POST['dor_col']==1){
	$this->door_model->delete('id',$_POST['del_index']);
	print('дверь удалена!');
	}
	else{
	$this->Collection_info_model->delete('id',$_POST['del_index']);
	print('коллекция удалена!');
	} 
	
	}
	public function get_submenu(){
	$menu_value=$_POST['menu_value'];
	$sub_menu=$this->menu_parent->get_obj($_POST['menu_value']);
	if(isset($sub_menu)){
	echo json_encode($sub_menu);
	}
	else{
	echo json_encode(null);
	}
	}
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */