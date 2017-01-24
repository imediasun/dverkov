<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Door extends CI_Controller {

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
	$this->load->model('nalichnik_model');
	$this->load->model('naliki_coll_model');
	$this->load->model('dobornaya_doska_model');
	$this->load->model('dobor_coll_model');
	$this->load->model('dobor_prod_model');
	$this->load->model('boxes_model');
	$this->load->model('boxes_prod_model');
	$this->load->model('boxes_coll_model');
	$this->load->model('door_model');
	$this->load->model('photos_iddoor_model');
	$this->load->model('producers_id_model');
	$this->load->model('models_id_model');
	$this->load->model('meniatures_model');
	$this->load->model('sizes_model');
	$this->load->library('filter_lib');
	$this->load->library('navi');
	}
	



	
	public function index($door=null,$polotno=null,$price=null,$korobka=null,$nalichnik=null,$doska=null,$full_price=null)
	{
	$b= new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);	
	$data['page_num']=1;
	if($polotno!=null){
	$data['polotno1']=$polotno;
	}
	if($full_price!=null){
	$data['full_price']=$full_price;
	}
	if($korobka!=null){
	$data['korobka1']=$korobka; 
	}
	if($nalichnik!=null){
	$data['nalichnik1']=$nalichnik; 
	}
	if($doska!=null){
	$data['doska1']=$doska; 
	}
		$path_to_page='/door';
		$data['title']='Компания Висдом Сервис';
		$data['menu']=$this->menu_model->get_obj(1);
		$data['meniatures']=$this->meniatures_model->get_obj($door);
		$t_door=$this->door_model->get_obj($door); 
		$data['door']=$t_door[0];
		$data['door_id']=$door;
		$type_ind=explode(',',$data['door']['podobnie']);
		$n=1;
		foreach($type_ind as $key=>$val){
		$d_p=$this->door_model->get_obj($val);
		if($d_p){
		$data['doors'][]=$d_p[0];
		}
		}
		
		/* $data['doors']=$this->door_model->get_obj($door); */
		if(isset($data['doors'])){
		$dop_doors=$data['doors'];
		}
		$d_photo=$this->photos_iddoor_model->get_obj($t_door[0]['id']);
		$n=0;
		if(isset($dop_doors)){
		foreach($dop_doors as $key=>$val){
		$dop_photo=$this->photos_iddoor_model->get_obj($val['id']);
		$data['doors'][$n]['photo']=$dop_photo[0]['path'];
		$n++;
		}
		}
		$data['door_photo']=$d_photo[0]['path'];
		
		$prod=$this->models_id_model->get_obj($data['door']['model']);
		$data['polotno']=$this->sizes_model->get_obj($data['door']['model']);
		$door_for_coll=$this->door_model->get_obj($door);
		$collection=$door_for_coll[0]['collection'];
		if(isset($collection)){
		$data['boxes']=$this->boxes_coll_model->get_obj($collection);
		$data['nalichnik']=$this->naliki_coll_model->get_obj($collection);
		$data['dobornaya_doska']=$this->dobor_coll_model->get_obj($collection);
		}
		else{
		$data['boxes']=$this->boxes_prod_model->get_obj($prod[0]['producer']);
		$data['nalichnik']=$this->nalichnik_model->get_obj($prod[0]['producer']);
		$data['dobornaya_doska']=$this->dobor_prod_model->get_obj($prod[0]['producer']);
		}
	
		
		
    	$producer=$prod[0]['producer'];
		$producer=$this->producers_id_model->get_obj($producer);
		$data['producer_logo']=$producer[0]['logo'];
		$data['producer']=$producer[0]['name'];
		
		
	$c=new Navi();	
	$data['hystory']=$c->get_params(1,get_class($this),$data['page_num'],$producer[0]['id'],null,null,$door);	
	$this->display_lib->door($path_to_page,$data);
	}
		
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */