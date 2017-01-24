<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

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
	$this->load->model('models_styles_model');
	$this->load->model('models_materials_model');
	$this->load->model('doors_model');
	$this->load->model('doors_coll_model');
	$this->load->model('color_model');
	$this->load->model('photos_model');
	$this->load->model('photos_iddoor_model');
	$this->load->model('types_model');
	$this->load->model('corners_model');
	$this->load->model('collection_model');
	$this->load->library('filter');
	$this->load->library('filter_lib');
	$this->load->library('doors_formation');
	$this->load->library('navi');
	}
	
	public function index() 
	{
	
	$data['page_num']=1;
	if(count($_POST)<1){
	header('Location: '.base_url().'/');
	}
	header('Content-Type: text/html; charset=utf-8');
	/* $a= new Filter();
	$data['filter']=$a->index(); */
	
	$a= new Filter_lib();
	
	//в посте надо принять тип
	if(isset($_POST['type'])){
	
	$data['filter2']=$a->filter_html($_POST,$_POST['type']);
	}
	else{
	$data['filter2']=$a->filter_html($_POST,null);
	}
	$data['filter_type']=$_POST['type'];
    $price=$_POST['example_name'];
	$price_arr=explode(';',$price);
	$price_start=$price_arr[0];
	$price_end=$price_arr[1];
	if(isset($_POST['example_name'])){
	$data['$price_start']=$price_start;
	$data['$price_end']=$price_end;
	}
	$type=$_POST['type'];
	if(isset($_POST['producer'])){
	$data['cur_producer']=$_POST['producer'];
	}
	else{
	$data['cur_producer']=null;
	}
	if(isset($_POST['material'])){
	$data['cur_material']=$_POST['material'];
	}
	else{
	$data['cur_material']=null;
	}
	if(isset($_POST['styles'])){
	$data['cur_style']=$_POST['styles'];
	}
	else{
	$data['cur_style']=null;
	}
	if(isset($_POST['colors'])){
	$data['cur_color']=$_POST['colors'];
	}
	else{
	$data['cur_color']=null;
	}
	
	$data['menu']=$this->menu_model->get_obj(1);
	$path_to_page='/doors';
	
/* 		if((!array_key_exists('producers', $_POST) or ($_POST['producers']==0)) && ($_POST['material']>0) && (!isset($_POST['styles']) or $_POST['styles']==0)){
	$models=$this->models_materials_model->get_obj($_POST['material']);
	}
	else if((!isset($_POST['material'])or $_POST['material']==0)&& isset($_POST['styles']) && (isset($_POST['producers']))){
	$models=$this->models_styles_model->get_and_result($_POST['producers'],$_POST['styles'],'producer');
	}
	else if((!isset($_POST['material'])or $_POST['material']==0) && (!isset($_POST['styles'])or $_POST['styles']==0) && (isset($_POST['producers']))){
	$models=$this->models_model->get_obj($_POST['producers']);
	}
	else if((!isset($_POST['styles']) or $_POST['styles']==0) && (isset($_POST['material'])) && (isset($_POST['producers']) )){
	$models=$this->models_materials_model->get_and_result($_POST['producers'],$_POST['material'],'producer');;
	}
	else if(isset($_POST['styles'])  && (isset($_POST['material'])) && (isset($_POST['producers']) )){
	$models=$this->models_model->get_and_result_3($_POST['styles'],$_POST['producers'],'style','material',$_POST['material']);
	}
	else{
	$models=$this->models_materials_model->get();
	}
	$n=0;
	foreach($models as $key=>$value){
	if(!isset($_POST['colors']) or ($_POST['colors'])==0){
	$door=$this->doors_model->get_obj($value['id']);
	
	}
	else{
	$door=$this->doors_model->get_and_result($_POST['colors'],$value['id'],'color');
	
	}
	foreach($door as $key=>$value){
	if(($value['price']>=$price_start)&& ($value['price']<=$price_end)){
	$doors[$n]=$value;
	$n=$n+1;
	}
	
	}
	}
	if(isset($doors)){
	$data['doors']=$doors;
	}*/
	$b=new Navi();
	$func=1;
	
	$data['hystory']=$b->get_params($func,get_class($this),$type,$data['cur_producer'],null,null,null);
	$first_step_args['producer']=$data['cur_producer'];
	$first_step_args['material']=$data['cur_material'];
	$first_step_args['style']=$data['cur_style'];
	$c=new Doors_formation();
	$data['doors']=$c->show_doors($type,$first_step_args,$data['cur_color'],$price_start,$price_end);
	
	if(isset($data['doors'])){
	foreach($data['doors'] as $key=>$value){
	$photo=$this->photos_iddoor_model->get_obj($value['id']);
	if(count($photo)>0){	
	$data['doors'][$key]['photo']=$photo[0]['path'];
	}
	}
	}
	
	$this->display_lib->catalog($path_to_page,$data);
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */