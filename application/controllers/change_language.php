<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_language extends CI_Controller {

public function __construct()
	{
	parent:: __construct();
	$this->load->helper('url');
	$this->load->model('menu_model');
	$this->load->model('menu_lang_model');
	} 
	public function change_lang($language)
    {
	
	$url=$_SERVER['HTTP_REFERER'];
	$url = parse_url($url);
	
	$url = $url['path'];
	$current=explode("/", $url);
	
	
	
	
	
	function iflang($current,$url){
	
	echo "<br>";
	if (($current == 'en')or($current == 'ru')or($current == 'chi')){
	    $url=str_replace($current.'/',"",$url);
	}
	return $url;
	}
	
        if ($language === 'en') {
          $url=iflang($current[1],$url);  
		  $this->current_lang = 'en';
		  $num_lang=2;		
        } 
		if ($language === 'ru') {
          $url=iflang($current[1],$url);  
			$this->current_lang = 'ru';
			$num_lang=1;
        } 
		if ($language === 'chi') {
            $url=iflang($current[1],$url);
			$this->current_lang = 'chi';
			$num_lang=3;
			
        } 
		
		$lang = $this->current_lang;
		/*print(base_url() . $lang.$url); 
		 
		*/
		
		//выбрать строку в которой эквивалент равен единице и язык выбранному
	
		
		
		$url2= (explode("/", $url));
		
		if(count($url2)==4){
		$page_id=$this->menu_model->get_obj($current[4]);
		
	    $eq_page=$this->menu_lang_model->get_and($page_id[0]['eq'],$num_lang,'eq');
		
		$url3= str_replace($url2[3],"",$url);
		$url=$url3.$eq_page['id'];
		}
		if(count($url2)<4){
		
		$page_id=$this->menu_model->get_obj(6);
		$eq_page=$this->menu_lang_model->get_and($page_id[0]['eq'],$num_lang,'eq');
		
		$url='/pages/page'.$url.$eq_page['id'];
		}
		/* print($url); */
		header('Location: '.base_url() . $lang.$url.'');
    }	
	
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */