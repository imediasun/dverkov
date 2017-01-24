<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mezhkomnatnie extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
	parent:: __construct();
	$this->load->helper('url');
	$this->load->model('seo_model');
	$this->load->model('menu_model');
	$this->load->model('producers_model');
	$this->load->model('producers_id_model');
	$this->load->model('models_model');
	$this->load->model('doors_model');
	$this->load->model('doors_coll_model');
	$this->load->model('color_model');
	$this->load->model('types_model');
	$this->load->model('corners_model');
	$this->load->model('collection_model');
	$this->load->model('collection_info_model');
	$this->load->library('filter');
	$this->load->library('filter_lib');
	}
	
	public function index($producer=null,$coll=null) 
	{
	// $a= new Filter();
	$type=1;
	/* $data['producers']=$a->producer($type);
	print_r($data['producers']); */
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,$type);
	$data['title']='Компания Висдом Сервис';
	$data['menu']=$this->menu_model->get_obj(1);
	header('Content-Type: text/html; charset=utf-8');
	$prod_info=$this->producers_id_model->get_obj($producer);
	if($coll){
	$doors=$this->doors_coll_model->get_obj($coll);
	$path_to_page='/catalog';
	$data['doors']=$doors;
	$coll_info=$this->collection_info_model->get_obj($coll);
	$data['doors']=$this->get_doors($doors);
	}
	else{
	
	if ($producer==null){
	$path_to_page='/producers';
	$data['producers']=$this->producers_model->get_obj($type);
	}
	else{
	
    $models=$this->models_model->get_obj($producer);
	$collections=$this->collection_model->get_obj($producer);
	if($collections){
	$path_to_page='/collection';
	$data['doors']=$collections;
	}
	else{
	$path_to_page='/catalog';
	$n=0;
	foreach($models as $key => $value){
	$door=$this->doors_model->get_obj($value['id']);
	foreach($door as $key2=>$value2){
	$doors[$n]=$value2;
	$n=$n+1;
	}
	}
	$data['doors']=$this->get_doors($doors);
	}
	}
    }	
	
	$main='<a href='.base_url().' class="hystory">Главная</a>';
	$cur_page='<a href="http://exportgrain.net/mezhkomnatnie" class="hystory">Межкомнатные</a>';
	if(count($prod_info)>0 && isset($coll_info)){
	$cur_prod='<a href="http://exportgrain.net/mezhkomnatnie/'.$prod_info[0]['id'].'" class="hystory">'.$prod_info[0]['name'].'</a>';
	$coll_item='<span> / </span><a href="http://exportgrain.net/mezhkomnatnie/'.$producer.'/'.$coll.'" class="hystory">'.$coll_info[0]['name'].'</a>';
	$data['hystory']=$main."<span> / </span>".$cur_page."<span> / </span>".$cur_prod.$coll_item;
	}
	else if(count($prod_info)>0 && !isset($coll_info)){
	$cur_prod='<a href="http://exportgrain.net/mezhkomnatnie/'.$prod_info[0]['id'].'" class="hystory">'.$prod_info[0]['name'].'</a>';
	$data['hystory']=$main."<span> / </span>".$cur_page."<span> / </span>".$cur_prod;
	}
	else{
	$data['hystory']=$main."<span> / </span>".$cur_page;
	}	
	$this->display_lib->catalog($path_to_page,$data);
	
	}
	
	function get_doors($doors){
	
	foreach($doors as $key=>$value){
		$color=$this->color_model->get_obj($value['color']);
		if($color){
		$doors[$key]['color']=$color[0]['name'];
		}
		$type=$this->types_model->get_obj($value['type']);
		if($type){
		$doors[$key]['type']=$type[0]['name'];
		}
		$corner=$this->corners_model->get_obj($value['corner']);
		if($corner){
		$doors[$key]['corner']=$corner[0]['corner'];
		}
		}
	return $doors;	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */