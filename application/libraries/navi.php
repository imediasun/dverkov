<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navi extends CI_Controller

{
//Этот класс формирует навигацию по сайту
	
	public function __construct()
	{
	parent:: __construct();
	$this->load->model('producers_model');
	$this->load->model('producers_id_model');
	$this->load->model('models_materials_model');
	$this->load->model('models_styles_model');
	$this->load->model('models_model');
	$this->load->model('doors_model');
	$this->load->model('door_model');
	$this->load->model('collection_info_model');
	}
	
	public function get_params($func,$controler,$type,$producer,$coll,$page,$door){
	
	print($coll);
	$main_text='Главная';
	$main_link='http://dverkov.com.ua';
	$hystory='';
	switch($func){
	case 1:
	$link_f='';
	break;
	case 2:
	$link_f='/admin';
	break;
	}
	
	
	switch($controler){
	case 'Dveri':
	case 'Catalog':
	case 'Door':
	$controler_link='/dveri';
	break;
	case 'dveri_edit':
	$controler_link='/dveri_edit';
	break;
	case 'add_model':
	$controler_link='/add_model';
	break;
	case 'Pages':
	$controler_link='/pages';
	break;
	case 'Admin':
	$controler_link='';
	break;
	case 'Door':
	$controler_link='';
	break;
	case 'Interior':
	$controler_link='';
	break;
	}
	
	$hystory.='<a  href="'.$main_link.$link_f.$controler_link.'"><span class="hystory">'.$main_text.'/'.'</span></a>';
	if($type){
	switch($type){
	case 0:
	$type_text='';
	break;
	case 1:
	$type_text='Межкомнатные/';
	break;
	case 2:
	$type_text='Входные/';
	break;
	case 3:
	$type_text='Раздвижные/';
	break;
	case 4:
	$type_text='Фурнитура/';
	break;
	}
	$hystory.='<a href="'.$main_link.$link_f.$controler_link.'/'.$type.'"><span class="hystory">'.$type_text.'</span></a>';
	}
	if($producer>0){
	$prod_name=$this->producers_id_model->get_obj($producer);
	
	$prod_index='/'.$prod_name[0]['id'].'';
	$prod_text=$prod_name[0]['name'];
	$hystory.='<a href="'.$main_link.$link_f.$controler_link.'/'.$type.$prod_index.'"><span class="hystory">'.$prod_text.'/'.'</span></a>';
	}
	if(isset($coll)){
	$coll_name=$this->collection_info_model->get_obj($coll);
	$cur_coll='/'.$coll_name[0]['id'].'';
	$coll_text=$coll_name[0]['name'];
	$hystory.='<a href="'.$main_link.$link_f.$controler_link.'/'.$type.$prod_index.$cur_coll.'"><span class="hystory">Коллекция '.$coll_text.'/'.'</span></a>';
	}
	if($page!=null){
	$hystory.=$page;
	}
	if(isset($door)){
	$door_name=$this->door_model->get_obj($door);
	$hystory.='<a href=""><span class="hystory">'.$door_name[0]['name'].'/'.'</span></a>';
	}
	return $hystory;
}
	
	function show_doors($first_step_args,$colors,$price_start,$price_end){
	//самое главное для php разработчика иметь опыт использования как можно большего количества функций - меньше велосипедов будет изобретено в итоге
	$arg_list = func_get_args();
	$first_step_array=array_filter($arg_list[0]);
	$models=$this->models_model->get_where_array($first_step_array);
	
	//начинающий написал бы так
	/* if($producers==null && $materials!==null && $styles==null){
	
	$models=$this->models_materials_model->get_obj($materials);
	}
	else if($materials==null && $styles!==null && $producers!==null){
	$models=$this->models_styles_model->get_and_result($producers,$styles,'producer');
	}
	else if($materials==null && $styles==null && $producers!==null){
	$models=$this->models_model->get_obj($producers);
	}
	else if($styles==null && $materials!==null && $producers!==null ){
	if($materials==0){
	
	}
	$models=$this->models_materials_model->get_and_result($producers,$materials,'producer');;
	}
	else if($styles!==null  && $materials!==null && $producers!==null ){
	$models=$this->models_model->get_and_result_3($styles,$producers,'style','material',$materials);
	}
	else{
	$models=$this->models_materials_model->get();
	}*/
	$n=0;
	foreach($models as $key=>$value){
	if($colors==null){
	$door=$this->doors_model->get_obj($value['id']);
	}
	else{
	$door=$this->doors_model->get_and_result($colors,$value['id'],'color');
	}
	
	foreach($door as $key=>$value){
	if(($value['price']>=$price_start)&& ($value['price']<=$price_end)){
	$doors[$n]=$value;
	$n=$n+1;
	}
	}
	} 
	return $doors;
	}
	
}
?>