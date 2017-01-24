<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

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
	$this->load->model('slider_model');
	$this->load->model('articles_model');
	$this->load->model('baget_model');
	$this->load->model('menu_model');
	$this->load->model('gallery_model');
	$this->load->library('pagination_lib'); 
	$this->load->library('filter_lib');
	}
	
	public function page($page)
	{
	$b= new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['menu']=$this->menu_model->get_obj(1);
	$data['page_num']=$page;
	$data['filter_type']=1;
	$path_to_page='/article';
	switch($page){
	case 1:
	header("Location:http://dverkov.com.ua");
	break;
	
	case 18:
	$path_to_page='/gallery';
	$data['photos']=$this->gallery_model->get();
	break;
	default:
	}
	$data['articles']=$this->articles_model->get_obj($page);
	$this->display_lib->article($path_to_page,$data);   
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */