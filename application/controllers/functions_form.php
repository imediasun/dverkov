<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions_form extends CI_Controller {

public function __construct()
	 {
	parent:: __construct();
	$this->load->helper('url');
	$this->load->model('seo_model');
	$this->load->model('door_model');
	$this->load->model('sizes_model');
	$this->load->model('nalichnik_model');
	$this->load->model('dobornaya_doska_model');
	$this->load->model('boxes_model');
	$this->load->model('sizes_id_model');
	$this->load->model('collection_model');
	$this->load->model('materials_model');
	$this->load->model('styles_model');
	$this->load->model('colors_model');
	$this->load->model('gallery_model');
	$this->load->model('photos_model');
	$this->load->helper('language');
	$this->load->model('articles_en_model');
	$this->load->model('articles_ru_model');
	$this->load->model('articles_chi_model');
	$this->current_lang = $this->uri->segment(1);
	
	} 
	
	public function edit_box($id=null){
	if($_POST['name'] == "" and $_POST['price']== 0){
	$this->boxes_model->delete('id',$id);
	}
	$data['name']=$_POST['name'];
	$data['price']=$_POST['price'];
	if($id==null){
	$data['producer']=$_POST['prod_ind'];
	if(isset($_POST['coll_ind'])){
	$data['collection']=$_POST['coll_ind'];
	}
	$this->boxes_model->insert($data);
	}
	else{
	$this->boxes_model->update($data,'id',$id);
	}
	header('Location:'.base_url().'/admin/pages/5');
	}
	
	public function add_pictures(){
	session_start();
	$n=0;
	foreach($_POST as $key=>$val){
	if(stristr($key, 'descript_photo') == true){
	$ver['descript_photo']=$val;
	}
	if(stristr($key, 'path') == true){ 
	$ver['path']=$val;
	}
	if(isset($ver['descript_photo']) and isset($ver['path'])){
	$data[$n]=$ver;
	$this->gallery_model->insert($data[$n]);
	unset ($_SESSION['gal_photo']);
	}
	$n++;
	}
	header('Location:'.base_url().'admin/pages/8');
	} 
	
	
	public function refresh(){
	session_start();
	unset ($_SESSION['gal_photo']);
	header('Location:'.base_url().'admin/pages/8');
	}
	
	public function edit_nalik($id=null){
	if($_POST['name'] == "" and $_POST['price']== 0){
	$this->nalichnik_model->delete('id',$id);
	}
	$data['name']=$_POST['name'];
	$data['price']=$_POST['price'];
	if($id==null){
	$data['producer']=$_POST['prod_ind'];
	if(isset($_POST['coll_ind'])){
	$data['collection']=$_POST['coll_ind'];
	}
	$this->nalichnik_model->insert($data);
	}
	else{
	$this->nalichnik_model->update($data,'id',$id);
	}
	header('Location:'.base_url().'/admin/pages/6');
	}
	
	public function edit_dobor($id=null){
	if($_POST['name'] == "" and $_POST['price']== 0){
	$this->dobornaya_doska_model->delete('id',$id);
	}
	$data['name']=$_POST['name'];
	$data['price']=$_POST['price'];
	if($id==null){
	$data['producer']=$_POST['prod_ind'];
	if(isset($_POST['coll_ind'])){
	$data['collection']=$_POST['coll_ind'];
	}
	$this->dobornaya_doska_model->insert($data);
	}
	else{
	$this->dobornaya_doska_model->update($data,'id',$id);
	}
	header('Location:'.base_url().'/admin/pages/7');
	}
	
	public function save_door(){
	$producer=$_POST['producer_in'];
	$data['collection']=$_POST['col_id'];
	$data['type']=$_POST['type'];
	$data['model']=$_POST['door_model'];
	$data['name']=$_POST['name_prod'];
	$data['price']=$_POST['price_prod'];
	$data['color']=$_POST['colors'];
	$data['description']=$_POST['editor_text'];
	$this->door_model->insert($data);
	$rata['id_door'] = mysql_insert_id(); 
	foreach ($_POST as $key=>$val){
		if(stristr($key, 'photo_')){
		$rata['path']=$val;
		$this->photos_model->insert($rata);
	}
	}
	header('Location:'.base_url().'/admin/dveri_edit/'.$data['type'].'/'.$producer.'');
	}
	
	public function calc(){
	print_r($_POST);
	if(isset($_POST['polotno_sel'])){
	$polotno=$_POST['polotno_sel'];
	}
	else{
	$polotno=0;
	}
	if(isset($_POST['polotno'])){
	$price=$_POST['polotno'];
	}
	else{
	$price=0;
	}
	if(isset($_POST['korobka_sel'])){
	$korobka=$_POST['korobka_sel'];
	}
	else{
	$korobka=0;
	}
	if(isset($_POST['nalichnik_sel'])){
	$nalichnik=$_POST['nalichnik_sel'];
	}
	else{
	$nalichnik=0;
	}
	if(isset($_POST['doska_sel'])){
	$doska=$_POST['doska_sel'];
	}
	else{
	$doska=0;
	}
	$door_id=$_POST['door_id'];
	$id_model=$this->sizes_id_model->get_obj($polotno);
	$id_model=$id_model[0]['id_model'];
	$id_korobka=$this->boxes_model->get_obj($korobka);
	$korobka_price=$id_korobka[0]['price'];
	$id_nalichnik=$this->nalichnik_model->get_obj($nalichnik);
	$nalichnik_price=$id_nalichnik[0]['price'];
	$id_doska=$this->dobornaya_doska_model->get_obj($doska);
	$doska_price=$id_doska[0]['price'];
	$full_price=$price+$korobka_price+$nalichnik_price+$doska_price;
	header('Location:'.base_url().'/door/'.$door_id."/".$polotno."/".$price."/".$korobka."/".$nalichnik."/".$doska."/".$full_price.'');
	}
	
	public function save_collection(){
	
	$data['producer']=$_POST['producer_in'];
	$data['type']=$_POST['type'];
	$data['name']=$_POST['name_prod'];
	$data['photo']=$_POST['photo'];
	$this->collection_model->insert($data);
	$coll_id = mysql_insert_id(); 
	header('Location:'.base_url().'/admin/dveri_edit/'.$data['type'].'/'.$data['producer'].'');
	}
	
	public function update_proc(){
	print_r($_POST);
	$type=$_POST['type'];
	$proc=$_POST['proc'];
	$model=$proc.'_model';
	$data['name']=$_POST['name'];
	$data['id']=$_POST['id'];
		foreach ($_POST as $key=>$val){
		if(stristr($key, 'type_')){
		if(!isset($data['type'])){
		$data['type']=$val;
		}
		else{
		
		$data['type'].=','.$val;
		}
		
	}
	
	}
	print_r($data);
	$this->$model->update($data,'id',$data['id']);
	header('Location:'.base_url().'/admin/'.$proc.'/'.$type.'');
	}
	
/* 	public function update_style(){
	print_r($_POST);
	$data['name']=$_POST['name'];
	$data['id']=$_POST['id'];
		foreach ($_POST as $key=>$val){
		if(stristr($key, 'type_')){
		if(!isset($data['type'])){
		$data['type']=$val;
		}
		else{
		$data['type'].=','.$val;
		}
		
	}
	
	}
	print_r($data);
	$this->styles_model->update($data,'id',$data['id']);

	} */
	public function edit_description(){
	header('Content-Type: text/html; charset=utf-8');
	$data['description']=$_POST['description'];
	$is_descript=$this->door_model->get_obj($_POST['id_door']);
	if(count($is_descript)>0){
	$this->door_model->update($data,'id',$_POST['id_door']);
	}
    header('Location:'.base_url().'/admin/door_edit/'.$_POST['id_door'].'/'.$_POST['type'].'/'.$_POST['producer'].'');
	}
	
	public function edit_podrobno(){
	header('Content-Type: text/html; charset=utf-8');
	$data['podrobno']=$_POST['podrobno'];
	$is_descript=$this->door_model->get_obj($_POST['id_door']);
	if(count($is_descript)>0){
	$this->door_model->update($data,'id',$_POST['id_door']);
	}
    header('Location:'.base_url().'/admin/door_edit/'.$_POST['id_door'].'/'.$_POST['type'].'/'.$_POST['producer'].'');
	}
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */