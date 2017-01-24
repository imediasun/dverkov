<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doors_formation extends CI_Controller

{
//Этот класс формирует навигацию по сайту
	
	public function __construct()
	{
	parent:: __construct();
	
	$this->load->model('models_materials_model');
	$this->load->model('models_styles_model');
	$this->load->model('models_model');
	$this->load->model('models_type_model');
	$this->load->model('doors_model');
	$this->load->model('photos_model');
	}
	

	
	function show_doors($type,$first_step_args,$colors,$price_start,$price_end){
	
	//самое главное для php разработчика иметь опыт использования как можно большего количества функций - меньше велосипедов будет изобретено в итоге
	$arg_list = func_get_args();
	$first_step_array=array_filter($arg_list[1]);
	
	foreach($first_step_args as $key=>$val){
	if($val>0){
	$step[$key]=$val;
	}
	}
	if(isset($step)){
	
	$models=$this->models_model->get_where_array($step,$type);
	
	//требуется проверка верна ли модель
	}
	else{
	$models=$this->models_type_model->get_obj($type);
	}
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
	else if($colors==0){
	
	$door=$this->doors_model->get_obj($value['id']);
	
	}
	else{
	$door=$this->doors_model->get_and_result($colors,$value['id'],'color');
	}
	
	if($door){
	
	foreach($door as $key=>$value){
	if(($value['price']>=$price_start)&&($value['price']<=$price_end)){
	$doors[$n]=$value;
	$nab=$this->photos_model->get_obj($value['id']);
	$doors[$n]['photo']=$nab[0]['path'];
	$n=$n+1;
	}
	}
	}
	
	
	} 
	
	if(isset($doors)){
	
	return $doors;
	}
	}
	public function show_collection($door){
	
	}
}
?>