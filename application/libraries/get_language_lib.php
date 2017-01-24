<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_language_lib extends CI_Controller {

public function __construct()
	 {
	parent:: __construct();
	$this->load->helper('language');
	$this->load->model('articles_en_model');
	$this->load->model('articles_ru_model');
	$this->load->model('articles_chi_model');
	$this->load->model('articles_model');
	$this->current_lang = $this->uri->segment(1);
	$this->load->library('get_menu_lib');
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
	public function get_current_lang($page){
	$lang=$this->get_lang();
	if ($lang=='ru/'){
	$this->lang->load('interface', 'ru');
	$data['menu']=$this->get_menu_lib->menu(1);
	$data['title']='Компания Висдом Сервис';
	$myrow = $this->articles_model->get_obj($page);
	}
	if ($lang=='en/'){
	$this->lang->load('interface', 'en');
	$data['menu']=$this->get_menu_lib->menu(2);
	$data['title']='Wisdom Services LLC';
	$myrow = $this->articles_model->get_obj($page);
	}
	if ($lang=='chi/'){
	$this->lang->load('interface', 'chi');
	$data['menu']=$this->get_menu_lib->menu(3);
	$data['title']='Wisdom Services LLC';
	$myrow = $this->articles_model->get_obj($page);
	}
	if ($lang==''){
	$this->lang->load('interface', 'en');
	$data['menu']=$this->get_menu_lib->menu(2);
	$data['title']='Wisdom Services LLC';
	$myrow = $this->articles_en_model->get_obj($page);
	}
	$data['lang']=$lang;
	$data['main']= $this->lang->language;
	$data['article']=$myrow;
	return $data;
	}

	
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */