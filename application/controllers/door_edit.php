<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Door_edit extends CI_Controller {

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
	$this->load->model('menu_model');
	$this->load->model('door_model');
	$this->load->model('producers_id_model');
	$this->load->model('models_id_model');
	$this->load->model('meniatures_model');
	$this->load->model('sizes_model');
	$this->load->library('filter_lib');
	}
	



	
	public function index($door=null)
	{
	$b= new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);	
		$path_to_page='/door';
		$data['title']='Компания Висдом Сервис';
		$data['menu']=$this->menu_model->get_obj(1);
		$data['meniatures']=$this->meniatures_model->get_obj($door);
		$door=$this->door_model->get_obj($door);
		$data['door']=$door[0];
		$prod=$this->models_id_model->get_obj($data['door']['model']);
		$data['polotno']=$this->sizes_model->get_obj($data['door']['model']);
		
		$producer=$prod[0]['producer'];
		$producer=$this->producers_id_model->get_obj($producer);
		$data['producer_logo']=$producer[0]['logo'];
		$data['producer']=$producer[0]['name'];
		
		
	$this->display_lib->door_edit($path_to_page,$data);
	}
		
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */