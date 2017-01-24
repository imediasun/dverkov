<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
	$this->load->model('doors_fp_model');
	$this->load->model('slider_model');
	$this->load->model('color_model');
	$this->load->model('types_model');
	$this->load->model('corners_model');
	$this->load->model('photos_model');
	$this->load->library('filter');
	$this->load->library('filter_lib');
	}
	



	
	public function index()
	{
	$type=1;
	/* $a= new Filter();
	$data['filter']=$a->index(); */
	/*$a->producer();
	$data['producers']=$a->producers;
	$a->material();
	$data['materials']=$a->materials;
	$a->styles();
	$data['styles']=$a->styles; */
	$data['filter_type']=$type;
	$b= new Filter_lib();
	$data['filter2']=$b->filter_html(null,$type);
	$data['page_num']=1;
		$path_to_page='/catalog';
		$data['title']='Ковтуненко двери';
		$data['slider']=$this->slider_model->get();
		$data['menu']=$this->menu_model->get_obj(1);
		$data['doors']=$this->doors_fp_model->get_obj(1);
		foreach($data['doors'] as $key=>$value){
		$color=$this->color_model->get_obj($value['color']);
		if($color){
		$data['doors'][$key]['color']=$color[0]['name'];
		}
		$type=$this->types_model->get_obj($value['type']);
		if($type){
		$data['doors'][$key]['type']=$type[0]['name'];
		}
		$corner=$this->corners_model->get_obj($value['corner']);
		if($corner){
		$data['doors'][$key]['corner']=$corner[0]['corner'];
		}
		$n=0;
		foreach ($data['doors'] as $key=>$val){
		$nab=$this->photos_model->get_obj($val['id']);
		$data['doors'][$n]['photo']=$nab[0]['path'];
		$n++;
		}
		}
		$this->display_lib->template($path_to_page,$data);
	}
		
		
		
	public function pages($page_id)
	 {
		$data=array();
		switch ($page_id)
		{
		//Если страница Главная
		case 'home':
			$myrow=$this->seo_model->get();
			
			$name='index';
			
			$this->display_lib->template($name,$data);
		break;
		case 'about':
			$myrow=$this->seo_model->get();
			
			$name='about';
		    
			
			$this->display_lib->template($name,$data);
		break;
		case 'services':
			$myrow=$this->seo_model->get();
			$name='services';
			
			$this->display_lib->template($name,$data);
		break;
		case 'news':
			$myrow=$this->seo_model->get();
			
			$name='news';
			
			$this->display_lib->template($name,$data);
		break;
		case 'contacts':
		  
			$myrow=$this->seo_model->get();
			
			$name='contacts';
			$this->display_lib->template($name,$data);
		break;
		default:
			$data['title']='Компания Висдом Сервис';
			$name='index';
		    $this->display_lib->template($name,$data);
		}
		
		
		}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */