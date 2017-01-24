<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_form extends CI_Controller {

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
	}
	
	
	public function index($auth=null){
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	if(isset($_SESSION['auth'])){
	header('Location:'.base_url().'/admin/dveri_edit/1');
	}
	else{
	if($auth==1){
	$data['auth']=$auth;
	}
	else{
	$data=array();
	}
	$path_to_page='/auth_form';
	$this->display_lib->auth_form($data);
	}
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */