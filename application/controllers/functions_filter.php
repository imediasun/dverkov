<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions_filter extends CI_Controller {

	public function __construct()
	{
	parent:: __construct();
	$this->load->library('filter_lib');
	require('server/FirePHP.class.php');
    $firephp = FirePHP::getInstance(true);
    $firephp ->fb("hello world! i'm warning you!",FirePHP::WARN);
	} 

	public function form_filter(){//не срабатывает вывод дверей при неперегрузке фильтра
	header('Content-Type: application/json');
	$id=$_POST['id'];
	$select_id=$_POST['select_id'];
	$type=$_POST['type_s'];
	$a=new Filter_lib();
	$final_array=$a->filter_defin($type,$id,$select_id,null);
	 if($final_array){
		echo json_encode($final_array);
		}
		else{
		echo json_encode(NULL);
		} 
	}
	
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */