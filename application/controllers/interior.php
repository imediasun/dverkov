<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interior extends CI_Controller {

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
	$this->load->model('doors_in_int_model');
	$this->load->model('door_model');
	$this->load->model('walls_model');
	$this->load->model('walls_room_model');
	$this->load->model('floor_model');
	$this->load->model('floor_room_model');
	$this->load->model('plintus_model');
	$this->load->model('plintus_room_model');
	$this->load->model('photos_iddoor_model');
	$this->load->library('filter');
	$this->load->library('filter_lib');
	$this->load->library('Doors_formation');
	$this->load->library('Navi');
	}
	
	public function index($door=null) 
	{
	header("Content-Type: text/html; charset=utf-8");
	$type=1;
	$data['page_num']=1;
	$path_to_page='/interior';
	$data['menu']=$this->menu_model->get_obj(1);
	$a=new Filter_lib();
	if($_POST){
		$price=$_POST['example_name'];
		$price_arr=explode(';',$price);
		$price_start=$price_arr[0];
		$price_end=$price_arr[1];
		if(isset($_POST['example_name'])){
	$data['$price_start']=$price_start;
	$data['$price_end']=$price_end;
	}
	$type=$_POST['type'];
	$data['filter2']=$a->filter_html($_POST,$type);	
	}
	else{
	
	$type=1;
	$data['filter2']=$a->filter_html(null,$type);
	$price_start=0;
	$price_end=100000;
	}
		if(isset($_POST['producer'])){
		$data['cur_producer']=$_POST['producer'];
		}
		else{
		$data['cur_producer']=null;
		}
		if(isset($_POST['material'])){
		$data['cur_material']=$_POST['material'];
		}
		else{
		$data['cur_material']=null;
		}
		if(isset($_POST['styles'])){
		$data['cur_style']=$_POST['styles'];
		}
		else{
		$data['cur_style']=null;
		}
		if(isset($_POST['colors'])){
		$data['cur_color']=$_POST['colors'];
		}
		else{
		$data['cur_color']=null;
		}
	

	$first_step_args['producer']=$data['cur_producer'];
	$first_step_args['material']=$data['cur_material'];
	$first_step_args['style']=$data['cur_style'];
	$c=new Doors_formation();
	if(!isset($door)){
	$data['doors']=$c->show_doors($type,$first_step_args,$data['cur_color'],$price_start,$price_end);
	
	
	$i=0;
	foreach($data['doors'] as $key=>$val){
	$d_in_i=$this->photos_iddoor_model->get_obj($val['id']);
	$data['doors_in_interior'][$i]=$val;
	if(isset($d_in_i[0]['path'])){
    $data['doors_in_interior'][$i]['photo']=$d_in_i[0]['path'];
	}
	$i=$i+1;
	} 
	}
	else{
	//найти все двери коллекции по этой двери
	$data['doors']=$c->show_collection($door);
	}
    /*$d_i_i=$this->doors_in_int_model->get();
	foreach($d_i_i as $key => $value){
	$d_in_i=$this->door_model->get_obj($value['id_door']);
    $data['doors_in_interior'][]=$d_in_i[0];
	}*/
	if(!isset($_POST['styles2'])){
	$_POST['styles2']=1;
	}
	$walls=$this->walls_room_model->get_obj($_POST['styles2']);
	
	$data['walls']=$walls[0];
	$data['walls_thumbs']=$walls;
	$floor=$this->floor_room_model->get_obj($_POST['styles2']);
	$data['floor']=$floor[0];
	$plintus=$this->plintus_room_model->get_obj($_POST['styles2']);
	$data['plintus']=$plintus[0];
	$data['floors_thumbs']=$floor;
	$data['plintus_thumbs']=$plintus;
	$data['sel']=$_POST['styles2'];
	$b=new Navi();
	$func=1;
	$page='<a href=""><span class="hystory">Двери в интерьере/'.'</span></a>'; 
	$data['hystory']=$b->get_params($func,get_class($this),0,$data['cur_producer'],null,$page,null);
	$this->display_lib->interior($path_to_page,$data);
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */