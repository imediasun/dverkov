<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dveri extends CI_Controller {

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
	$this->load->model('photos_iddoor_model');
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
	$this->load->library('navi');
	$this->load->library('filter_lib');
	}
	
	public function index($type=null,$producer=null,$coll=null) 
	{
	$data['type']=$type;
	if($producer){
	$data['producer']=$producer;
	}
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['page_num']=1;
	$data['title']='Компания Висдом Сервис';
	$data['menu']=$this->menu_model->get_obj(1);
	$data['type_page']=$type;
	header('Content-Type: text/html; charset=utf-8');
	$prod_info=$this->producers_id_model->get_obj($producer);
	if($coll){
	
	$doors=$this->doors_coll_model->get_obj($coll);
	$path_to_page='/catalog';
	$coll_info=$this->collection_info_model->get_obj($coll);
	$data['doors']=$this->get_doors($doors);
	
	}
	else{
	if ($producer==null){
	$path_to_page='/producers';
	$prod_diaposon=$this->producers_model->get();
	foreach($prod_diaposon as $key=>$value){
	$pieces = explode(",", $value['type']);
	if(in_array($type,$pieces)){
	$data['producers'][]=$value;
	}
	}
	}
	else{
	
    $models=$this->models_model->get_and_result($type,$producer,'type');
	$collections=$this->collection_model->get_and_result($type,$producer,'type');
	/* $path_to_page='/collection'; */
	$data['doors_colls']=$collections;
	// else{
	$path_to_page='/catalog';
	if($models){
	
	if(!$collections){
			$n=0;
			echo "<pre>";
			print_r($models);
			echo "</pre>";
			
			foreach($models as $key => $value){
			$door=$this->doors_model->get_obj($value['id']);
			foreach($door as $key2=>$value2){
			$doors[$n]=$value2;
			$n=$n+1;
			}
			}
			
			$data['doors']=$this->get_doors($doors);
		}
		
		
		else{
		$n=0;
			foreach($models as $key => $value){
			$door=$this->doors_model->get_obj($value['id']);
			
			foreach($door as $key2=>$value2){
			
			if($value2['collection']==0){
			$doors[$n]=$value2;
			}
			$n=$n+1;
			
			}
			}
			if(isset($doors)){
			$data['doors']=$this->get_doors($doors);
			}
		}	
	}
	// }
	}
    }
	if(isset($data['doors'])){	
	foreach($data['doors'] as $key=>$val){
		$ph=$this->photos_iddoor_model->get_obj($val['id']);
		if(isset($ph[0]['path'])){
		$data['doors'][$key]['photo']=$ph[0]['path'] ;
		}
		}
	}	
		
	$c=new Navi();
	$data['hystory']=$c->get_params(1,get_class($this),$type,$producer,$coll,null,null);
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