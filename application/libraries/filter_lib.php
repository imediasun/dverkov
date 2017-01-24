<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter_lib extends CI_Controller {
	public function __construct()
	{
	parent:: __construct();
	$this->load->helper('url');
	$this->load->model('models_producer_model');
	$this->load->model('models_id_model');
	$this->load->model('models_type_model');
	$this->load->model('materials_model');
	$this->load->model('free_model');
	$this->load->model('styles_model');
	$this->load->model('colors_model');
	$this->load->model('doors_model_model');
	$this->load->model('doors_type_model');
	$this->load->model('doors_color_model');
	} 
	
	public function get_case($key){
	switch ($key){
	case 'producer' :
	$table='producer';
	$text="Все производители";
	break;
	case 'material':
	$table='materials';
	$text="Все материалы";
	break;
	case 'style':
	$table='styles';
	$text="Все стили";
	break;
	case 'color':
	$table='colors';
	$text="Все цвета";
	break;
	default:
	break;
	}
	$ret['table']=$table;
	$ret['text']=$text;
	return $ret;
	}
	
	public function get_colors($id,$type){
	if($id>0){
	$doors_by_color=$this->doors_color_model->get_obj($id);
	foreach($doors_by_color as $key=>$value){
	$pieces = explode(",",$value['type']);
	if(in_array($type,$pieces)){
	$doors_by_color[]=$value;
	}
	}
	}
	else{
	$doors_col=$this->doors_type_model->get();

	$doors_by_color=$doors_col;
	
	}
		foreach($doors_by_color as $key=>$value){
		
		$models_list[]=$value['model'];
		
		}
		foreach($models_list as $value){
		$m=$this->models_id_model->get_obj($value);
		if($m[0]['type']==$type){
		$models[]=$m[0];
		}
		}
	return $models;	
	}
		
	public function filter_defin($type,$id,$select_id,$style){
	
	$models_setings_array['producer']='producer';
	$models_setings_array['producer_2']='material';
	$models_setings_array['producer_3']='style';
	$models_setings_array['producer_4']='color';
	$models_setings_array['styles2']='style';
	
	if($select_id){
		switch ($select_id){
		case 'producer':
		case 'producer_2':
		case 'producer_3':
		$models=$this->models_id_model->get_table($models_setings_array[$select_id],$id,$type,null);
		$if_color=null;
		break;
		case 'styles2':
		$models=$this->models_type_model->get_obj($type);
		$if_color=null;
		break;
		case 'producer_4':
		$models=$this->get_colors($id,$type);
		$if_color=true;
		break;
		}
	}
	else{
	$models=$this->models_type_model->get_obj($type);
	$if_color=null;
	}
	/* echo "<pre>";
	print_r($models);
	echo "</pre>"; */
	foreach($models as $key=>$value){
	$item['producer'][]=$value['producer'];
	$item['material'][]=$value['material'];
	$item['style'][]=$value['style'];
		if(!$if_color){
		
			$it_color_item=$this->doors_model_model->get_obj($value['id']);
			
			if(count($it_color_item)>0){
			foreach($it_color_item as $key3=>$val){
			$item['color'][]=$val['color'];
			}
			}
			else{
			$all_colors=$this->colors_model->get();
			foreach($all_colors as $keys=>$vald){
			$types=explode(",",$vald['type']);
			
			foreach($types as $keyr=>$valr){
			if($type==$valr){
			$item['color'][]=$vald['id'];
			
			
			}
			}
			}
			}
		
		}
	}
	
	if($if_color){
	$item['color'][0]=$id;
	}
	
	foreach($item as $key=>$value){
	$item_uniq[$key]=array_unique($value);
	}
	
	//формирование массива соответствий
	
	foreach($item_uniq as $key=>$value){
	$n=0;
	foreach($value as $key3=>$value3){
	$case=$this->get_case($key);
	$itm=$this->free_model->get_free($case['table'],'id',$value3);
		foreach($itm as $key2=>$value2){
		$final_array[$key][$n]['id']=$value2['id'];
		$final_array[$key][$n]['name']=$value2['name'];
		}
		// проверка на существование ключа в финальном массиве
		if(isset($final_array) && array_key_exists($key,$final_array)){
		$n=$n+1;
		}
	}
	}
	//формирование мосива несоответствий
	//добавить в финальный массив не смежные значения
	
	foreach($final_array as $key=>$val){
	$case=$this->get_case($key);
	
	$exe=$this->free_model->get_except_array($case['table'],'id',$val);
	
	foreach($exe as $key4=>$val4){
	$t=explode(",",$val4['type']);
	if(in_array($type,$t)){
	$ex[$key][]=$val4;
	}
	}
	
	if(isset($ex[$key]) /* && count($ex)>0 */ ){
	$final_array[$key]['not']=$ex[$key];
	} 
	}	
	
	return $final_array;
	}
	
	public function filter_html($post,$type){
	
	//по первому значению поста которое не равно нулю выводим смежные селекты
	if($post){
	
	foreach($post as $key=>$value){
	if($value !== null && $key!=='example_name' && $key!=='type'){
	if(isset ($post['styles2'])){
	$final=$this->filter_defin($post['type'],$value,$key,$post['styles2']);
	}
	else{
	$final=$this->filter_defin($post['type'],$value,$key,null);
	}
	
	break;
	}
	}
	}
	
	else{
	$final=$this->filter_defin($type,null,null,null);
	}
	$end_select='</select></div></div>';
	
	foreach($final as $key=>$val){
	
	$final_ar='';
	switch ($key){
	
	case 'producer':
	$text='Все производители';
	$case="producer";
	$start_select='<div class="select_box">
	<h3 class="select_text">Производитель</h3>
	</br>
	<div id="producer_select">
	<select name="producer" class="filter_select" id="producer">
	<option disabled>Производитель дверей</option>';
	break;
	case 'material':
	$text='Все материалы';
	$case="material";
	$start_select='<div class="select_box">
<h3 class="select_text">Материал</h3>
</br>
<div id="material_select">
<select name="material" class="filter_select" id="producer_2">
<option disabled>Материал дверей</option>';
	break;
	case 'style':
	$text='Все стили';
	$case="styles";
	$start_select='<div class="select_box">
<h3 class="select_text">Стиль</h3>
</br>
<div id="styles_select">
<select name="styles" class="filter_select" id="producer_3">
<option disabled>Стиль дверей</option>';
	break;
	case 'color':
	$text='Все цвета';
	$case="colors";
	$start_select='<div class="select_box">
<h3 class="select_text">Палитра Цветов</h3>
</br>
<div id="colors_select">
<select name="colors" class="filter_select" id="producer_4">
<option disabled>Палитра цветов</option>';
	break;
	}
		
		if($post[$case]==0){
		$middle_select[$case][]='<option selected value="0">'.$text.'</option>';
		}
		else{
		$middle_select[$case][]='<option value="0">'.$text.'</option>';
		}
		
		foreach($val as $key2=>$value){ 
		if($key2!=='not'){
		if($post[$case]==$value['id']){
		$middle_select[$case][]='<option selected value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		else{
		$middle_select[$case][]='<option value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		}
		else{
		foreach($value as $key6=>$val6){
		$middle_select[$case][]='<option class="relative" value="'.$val6['id'].'">'.$val6['name'].'</option>';
		}
		}
		}
	
	$final_ar=$start_select;
	foreach($middle_select[$case] as $key3=>$val3){
	$final_ar.=$val3;
	}
	$final_ar.=$end_select;
	$fin[]=$final_ar;
	}
	
	return $fin;
	}

}
?>