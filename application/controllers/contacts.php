<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

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
	$this->load->helper('language');
	$this->load->model('articles_en_model');
	$this->load->model('articles_ru_model');
	$this->load->model('articles_chi_model');
	$this->current_lang = $this->uri->segment(1);
	} 
	function get_lang()
       {
            $CI =& get_instance();
           
            $fsu = $CI->uri->segment(1);
           
            if($CI->config->item($fsu, 'languages') && ($fsu != $CI->config->item('language_default')))
            {
                return $fsu . '/';
            }
           
            return;
        }
	public function index()
	{
	$lang=$this->get_lang();
		if ($lang=='ru/'){
		$this->lang->load('interface', 'ru');
		$myrow = $this->articles_ru_model->get_obj(1);
		}
		if ($lang=='en/'){
		$this->lang->load('interface', 'en');
		$myrow = $this->articles_en_model->get_obj(1);
		
		
		}
		if ($lang=='chi/'){
		$this->lang->load('interface', 'chi');
		$myrow = $this->articles_chi_model->get_obj(1);
		}
		if ($lang==''){
		$this->lang->load('interface', 'en');
		$myrow = $this->articles_en_model->get_obj(1);
		}
		$data['lang']=$lang;
		
		$data['main']= $this->lang->language;
		$data['article']=$myrow;
	
	
	if (isset($_GET['name'])){
	$data['name']=$_GET['name'];
	}
	if (isset($_GET['email'])){
	$data['phone']=$_GET['phone'];
	}	
	if (isset($_GET['phone'])){
	$data['email']=$_GET['email'];
	}
	if (isset($_GET['msg'])){
	$data['msg']=$_GET['msg'];
	}
	
		$data['title']='Контакты по всем вопросам утилизации отходов, вторсырья и по другим вопросам в области экологии - Центр экологической безопасности, Одесса';
		$path_to_page='contacts';
		$this->display_lib->template($path_to_page,$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */