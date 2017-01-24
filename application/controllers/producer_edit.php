<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producer_edit extends CI_Controller {

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
	$this->load->library('navi');
	$this->load->library('filter_lib');
	}
	
	public function index($type=null,$producer=null) 
	{
	header('Content-Type: text/html; charset=utf-8');
	$b=new Filter_lib();
	$path_to_page='/producer_edit';
	$data['filter2']=$b->filter_html(null,1);
	$data['title']='Компания Висдом Сервис';
	$data['menu']=$this->menu_model->get_obj(1);
	$data['type_page']=$type;
	$prod_info=$this->producers_id_model->get_obj($producer);

	
	$c=new Navi();
	$data['hystory']=$c->get_params($type,$producer,null);
	$this->display_lib->catalog_edit($path_to_page,$data);
	
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