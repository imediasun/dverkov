<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vhodnie extends CI_Controller {

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
	$this->load->model('models_model');
	$this->load->model('doors_model');
	$this->load->model('doors_coll_model');
	$this->load->model('color_model');
	$this->load->model('types_model');
	$this->load->model('corners_model');
	$this->load->model('collection_model');
	$this->load->library('filter');
	}
	
	public function index($producer=null,$coll=null) 
	{
	$a= new Filter();
	$a->producer();
	$data['producers']=$a->producers;
	$data['title']='Компания Висдом Сервис';
	$data['menu']=$this->menu_model->get_obj(1);
	header('Content-Type: text/html; charset=utf-8');
	$data['bread'][0]=array('[link]=>"/vhodnie",[text]=>"Входные"');
	print_r($data['bread']);
	if($coll){
	$doors=$this->doors_coll_model->get_obj($coll);
	$path_to_page='/doors';
	$data['doors']=$doors;
	}
	else{
	if ($producer==null){
	$path_to_page='/producers';
	$data['producers']=$this->producers_model->get();
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
	$data['doors'][$n]=$value2;
	$n=$n+1;
	}
	}
	}
			
	}
    }		
	$this->display_lib->catalog($path_to_page,$data);
	
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */