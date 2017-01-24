<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {

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
	$this->load->library('filter');
	}
	



	
	public function index()
	{
	print('index');
$ curl -X POST http://textbelt.com/text \ -d number=380965441120 \ -d "message=I sent this message for free with textbelt.com" - See more at: http://textbelt.com/#sthash.hAYtLfOw.dpuf
	}
		

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */