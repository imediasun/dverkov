<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_menu_lib extends CI_Controller {

public function __construct()
	 {
	parent:: __construct();
	$this->load->model('menu_lang_model');
	} 

	public function menu($lang){
	$data=$this->menu_lang_model->get_obj($lang);
	return $data;
	}

	
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */