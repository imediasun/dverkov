<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	session_start();
	parent:: __construct();
	$this->load->helper('url');
	$this->load->model('seo_model');
	$this->load->model('menu_model');
	$this->load->model('menu_parent');
	$this->load->model('doors_fp_model');
	$this->load->model('menu_admin_model');
	$this->load->model('menu_parent_model');
	$this->load->model('producers_model');
	$this->load->model('producers_id_model');
	$this->load->model('photos_model');
	$this->load->model('photos_iddoor_model');
	$this->load->model('models_model');
	$this->load->model('models_producer_model');
	$this->load->model('styles_model');
	$this->load->model('doors_model');
	$this->load->model('materials_model');
	$this->load->model('doors_coll_model');
	$this->load->model('doors_type_model');
	$this->load->model('color_model');
	$this->load->model('video_types_model');
	$this->load->model('colors_model');
	$this->load->model('types_model');
	$this->load->model('corners_model');
	$this->load->model('collection_model');
	$this->load->model('collection_info_model');
	$this->load->model('auth_model');
	$this->load->model('sizes_model');
	$this->load->model('boxes_model');
	$this->load->model('models_id_model');
	$this->load->model('door_model');
	$this->load->model('meniatures_model');
	$this->load->model('doortypes_model');
	$this->load->model('articles_model');
	$this->load->model('gallery_model');
	$this->load->model('gallery_type_model');
	$this->load->model('nalichnik_model');
	$this->load->model('dobornaya_doska_model');
	$this->load->library('filter');
	$this->load->library('navi');
	$this->load->library('filter_lib');
	$this->load->library('Doors_formation');
	$this->load->library('Admin_oper_lib');
	$data['menu']=$this->menu_admin_model->get_obj(1);
	require('server/FirePHP.class.php');
	$firephp = FirePHP::getInstance(true);
	$firephp -> fb("hello world! i'm warning you!",FirePHP::WARN);
	if(isset($_SESSION['auth'])){

	}
	else{
	if($_POST){
	$login=$_POST['login'];
	$pass=$_POST['password'];
	$log_check=$this->auth_model->get_obj($login);
	if($log_check[0]['pass']==$pass){
	$_SESSION['auth']=1;
	}
	else{
	header('Location:'.base_url().'auth_form/1');
	}
	}
	else{
	header('Location:'.base_url().'auth_form');
	}	
	}
	}

	public function main(){
	$data['image_index']=null;
	$data['image_width']=419;
	$data['image_height']=940;
	$data['upload_dir']='./doors';
	$data['image_type']='door';
	$data['page_num']=1;
	if(count($_POST)<1){
	header('Location:'.base_url().'/admin/main');
	}
	header('Content-Type: text/html; charset=utf-8');
	$a= new Filter_lib();
	$data['filter2']=$a->filter_html($_POST,null);
    $price=$_POST['example_name'];
	$price_arr=explode(';',$price);
	$price_start=$price_arr[0];
	$price_end=$price_arr[1];
	if(isset($_POST['example_name'])){
	$data['$price_start']=$price_start;
	$data['$price_end']=$price_end;
	}
	$type=$_POST['type'];
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
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$path_to_page='/catalog';
	$b=new Navi();
	$func=1;
	$data['hystory']=$b->get_params($func,get_class($this),$type,$data['cur_producer'],null,null,null);
	$first_step_args['producer']=$data['cur_producer'];
	$first_step_args['material']=$data['cur_material'];
	$first_step_args['style']=$data['cur_style'];
	$c=new Doors_formation();
	$data['doors']=$c->show_doors($type,$first_step_args,$data['cur_color'],$price_start,$price_end);
	$this->display_lib->catalog_edit($path_to_page,$data);
	}	

	
	public function pages($page=null){
	$data['page_num']=$page;
	$data=array();
	if(isset($_GET['arr'])){ 
	$doors_ar=explode(',',$_GET['arr']);
	 
	/* $doors_ar=(json_decode($_GET['arr'], true)); */
	}
	switch($page){
	case 1:
	$path_to_page='/article';
	$data['menu2']=$this->menu_parent->get_obj(0);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор статей/</span></a>';
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->article_edit($path_to_page,$data);
	break;
	case 2:
	$path_to_page='/menu';
	$data['menu2']=$this->menu_parent->get_obj(0);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор меню/</span></a>';
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->article_edit($path_to_page,$data);
	break;
	case 3:
	header('Location:'.base_url().'/admin/dveri_edit/1');
	break;
	case 4:
	$path_to_page='/main_doors';
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['corners_box']=$this->corners_model->get();
	$data['doors']=$this->doors_fp_model->get_obj(1);
	$models_by_prod=$this->models_producer_model->get_obj(1);
		if(isset($doors_ar)){
		$data['doors_in_interior']=$doors_ar;
		
		$n=0;
		foreach ($data['doors_in_interior'] as $key=>$val){
		$val=(int)$val;
		
		if($val>0){
		print($val);
		$nab=$this->photos_model->get_obj($val);
		
		$data['in_interior'][$n]['id']=$val;
		$data['in_interior'][$n]['photo']=$nab[0]['path'];
		$n++;
		
		}
		}
		
		}	
		else if (!empty ($models_by_prod)){
		
		$data['in_interior']=$this->doors_model->get_obj($models_by_prod[0]['id']);
		
		}
		foreach($data['doors'] as $key=>$value){
		$color=$this->color_model->get_obj($value['color']);
		if($color){
		$data['doors'][$key]['color']=$color[0]['name'];
		}
		$type=$this->types_model->get_obj($value['type']);
		if($type){
		$data['doors'][$key]['type']=$type[0]['name'];
		}
		$corner=$this->corners_model->get_obj($value['corner']);
		if($corner){
		$data['doors'][$key]['corner']=$corner[0]['corner'];
		}
		}
		$n=0;
		foreach ($data['doors'] as $key=>$val){
		$nab=$this->photos_model->get_obj($val['id']);
		$data['doors'][$n]['photo']=$nab[0]['path'];
		$n++;
		}
		$data['menu']=$this->menu_admin_model->get_obj(1);
		$page_in='<a href'.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор стартовой страницы/</span></a>';
		$c=new Navi();
		$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
		$this->display_lib->main_door_edit($path_to_page,$data);
	break;
	case 5:
	$path_to_page='/boxes';
	
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['producers']=$this->producers_id_model->get();
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор коробок/</span></a>';
	$data['boxes']=$this->boxes_model->get();
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->article_edit($path_to_page,$data);
	break;
	case 6:
	$path_to_page='/naliki';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['producers']=$this->producers_id_model->get();
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор наличников/</span></a>';
	$data['naliki']=$this->nalichnik_model->get();
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->article_edit($path_to_page,$data);
	break;
	case 7:
	$path_to_page='/dobor';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['producers']=$this->producers_id_model->get();
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор доборной доски/</span></a>';
	$data['dobor']=$this->dobornaya_doska_model->get();
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->article_edit($path_to_page,$data);
	break;
	case 8:
	$data['msg']='Фотография в галлерею добавлена';
	$data['image_type']='gallery'; 
	$data['type_index']=1; 
	$data['image_index']=0; 
	$data['image_width']=640;
	$data['image_height']=480;
	$data['upload_dir']='./gallery';
	$data['count_images']=10;
	$path_to_page='/gallery';
	
	if(isset($_SESSION['gal_photo'])){
	foreach($_SESSION['gal_photo']as $key=>$val){
	$data['gal_photos'][]=$val;
	}
	}
	$video_ready=$this->gallery_type_model->get(); 
	$n=0;
	foreach($video_ready as $key=>$val){
	if($val['type']>0){
	$video_type=$this->video_types_model->get_obj($val['type']);
	$data['video_ready'][$n]=$val;
	$data['video_ready'][$n]['type']=$video_type[0]['type'];
	}
	$n++;
	}
	$data['photos_ready']=$this->gallery_type_model->get_obj(0);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['producers']=$this->producers_id_model->get();
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор галлереи/</span></a>';
	$data['dobor']=$this->dobornaya_doska_model->get();
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->gallery_edit($path_to_page,$data);
	break;
	case 9:
	$data['msg']='Видеофайл в галлерею добавлен';
	$data['image_type']='video'; 
	$data['type_index']=1; 
	$data['image_index']=0; 
	$data['image_width']='';
	$data['image_height']='';
	$data['upload_dir']='./gallery';
	$data['count_images']=10;
	$path_to_page='/gallery_video';
	if(isset($_SESSION['gal_video'])){
	foreach($_SESSION['gal_video'] as $key=>$val){
	$data['gal_video'][$key][]=$val;
	}
	}
	unset ($_SESSION['gal_video']);
	$data['photos_ready']=$this->gallery_type_model->get_obj(1);
	
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['producers']=$this->producers_id_model->get();
	$page_in='<a href='.base_url().'/admin/pages/'.$page.'><span class="hystory">Редактор галлереи/</span></a>';
	$data['dobor']=$this->dobornaya_doska_model->get();
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',null,null,null,$page_in,null); 
	$this->display_lib->gallery_edit($path_to_page,$data);
	break;
	
	}
	
	}
	

	
	public function add_menu(){
	
	$article=$_POST;
	$data['parent_id']=$_POST['menu1_id'];
	$data['name']=$_POST['menu1_text'];
	$data['language']=1;
	$this->menu_model->insert($data);
	print('Пункт меню добавлен');
	}
	public function add_main_page_door(){
	$id_item=$_POST['point'];
	$data['fp']=1;
	$this->door_model->update($data,'id',$id_item);
	header('Location:'.base_url().'/');
	}
	
	public function del_menu(){
	$id=$_POST['menu2_id'];
	$this->menu_model->delete('id',$id);
	print('Пункт меню удален'); 
	}
	public function change_menu(){
	$data['id']=$_POST['menu2_id'];
	$data['name']=$_POST['menu2_name'];
	$this->menu_model->update($data,'id',$data['id']);
	print('Информация изменена');
	}
	
	public function category(){
	header('Content-Type: application/json; charset=utf-8');
	$menu=$_POST['menu_value'];
	$my_rows['menu']=$this->menu_parent_model->get_obj($menu);
	$my_rows['article']=$this->articles_model->get_obj($menu);
		if($my_rows){
		echo json_encode($my_rows);
		}
		else{
		echo json_encode(NULL);
		}
	}
	
	
	
	public function colors_edit($type=null,$id=null){
	$data['menu']=$this->menu_admin_model->get_obj(1);
	if($id!=null){
	$data['color']=$this->colors_model->get_obj($id);
		foreach($data['color'] as $key4=>$val4){
		$type_indexes=$val4['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key=>$val){
		if($val==$type){
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		else{
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		}
	}
	$data['type_name']=$this->doortypes_model->get();
	$path_to_page='/colors/editor';
	$page='<a href='.base_url().'/admin/colors_edit/'.$type.'><span class="hystory">Редактор цветов/</span></a><a href='.base_url().'/admin/colors_edit/'.$type.'/'.$id.'"><span class="hystory">'.$data['color'][0]['name'].'/</span></a>';
	}
	else{
	$data['type_page']=$type;
	$path_to_page='/colors';
	//выбрать материалы в которых тип содержит $type
	$materials=$this->colors_model->get();
	foreach($materials as $key=>$val){
	$t=explode(',',$val['type']);
	foreach($t as $key2=>$val2){
	if($val2==$type){
	$data['colors'][]=$val;
	continue;
	}
	}
	}
	$page='<a href=""><span class="hystory">Редактор цветов/</span></a>';
	}
	$c=new Navi();
	
	$data['hystory']=$c->get_params(2,'dveri_edit',$type,null,null,$page,null); 
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	
	public function styles_edit($type=null,$id=null){
	$data['type_index']=$type;
	$data['image_index']=$id;
	$data['image_width']=273;
	$data['image_height']=74;
	$data['upload_dir']='./doors/styles';
	$data['count_images']=1;
	$b=new Filter_lib();
	$data['type_name']=$this->doortypes_model->get();
	$data['filter2']=$b->filter_html(null,1);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	if($id!=null){
	$data['image_index']=$id;
	$data['style']=$this->styles_model->get_obj($id);
		foreach($data['style'] as $key4=>$val4){
		$type_indexes=$val4['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key=>$val){
		if($val==$type){
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		else{
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		}
	}
	
	$data['type_name']=$this->doortypes_model->get();
	
	$path_to_page='/styles/editor';
	$page='<a href='.base_url().'/admin/styles_edit/'.$type.'><span class="hystory">Стили/</span></a><a href='.base_url().'/admin/styles_edit/'.$type.'/'.$id.'"><span class="hystory">'.$data['style'][0]['name'].'/</span></a>';
	}
	else{
	$data['image_index']=null;
	$data['type_page']=$type;
	$path_to_page='/styles';
	//выбрать материалы в которых тип содержит $type
	$materials=$this->styles_model->get();
	foreach($materials as $key=>$val){
	$t=explode(',',$val['type']);
	foreach($t as $key2=>$val2){
	if($val2==$type){
	$data['styles'][]=$val;
	continue;
	}
	}
	}
	$page='<a href=""><span class="hystory">Стили/</span></a>';
	}
	$c=new Navi();
	
	$data['hystory']=$c->get_params(2,'dveri_edit',$type,null,null,$page,null); 
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	public function colors($type=null,$id=null,$add=null){
	$data['type_index']=$type;
	$data['type_page']=$type;
	$data['image_index']=null;
	$data['image_width']=273;
	$data['image_height']=74;
	$data['upload_dir']='./colors';
	$data['count_images']=1;
	if($id!=null){
	$data['msg']='Фотографияцвета изменена';
	$data['image_type']='color_edit';
	$data['image_index']=$id;
	$data['color']=$this->colors_model->get_obj($id);
	$t=explode(',',$data['color'][0]['type']);
	$n=0;
	foreach($t as $key2=>$val2){
	$door_type=$this->doortypes_model->get_obj($val2);
	$data['div_prod_type'][$n]['id']=$door_type[0]['id'];
	$data['div_prod_type'][$n]['name']=$door_type[0]['name'];
	$n=$n+1;
	}
	$path_to_page='/colors/editor';
	$page='<a href='.base_url().'/admin/colors/'.$type.'><span class="hystory">Цветовая палитра/</span></a><a href='.base_url().'/admin/colors/'.$type.'/'.$id.'"><span class="hystory">'.$data['color'][0]['name'].'/</span></a>';
	}
	else{
	$data['type_name']=$this->doortypes_model->get();
	$page='<a href=""><span class="hystory">Цветовая палитра/</span></a>';
	$path_to_page='/colors';
	}
	
	if($add!=null){
	$data['msg']='Фотография цвета добавлена';
	$data['image_type']='color';
	$data['type_page']=$type;
	$data['image_index']=null;
	$path_to_page='/colors_add';
	if(!isset($_SESSION['color_photo'])){
	$data['query_color_text']='Добавьте сперва фотографию а затем добавьте информацию';
	}
	else{
	$data['ses']=$_SESSION['color_photo'];
	/*print($data['ses']); */
	unset($_SESSION['color_photo']);
	$data['query_color_text']='Фотография добавлена, можете добавить информацию';
	}
	}
	$r=new Admin_oper_lib();
	foreach ($r->oper($type,$page) as $key=>$val){
	$data[$key]=$val;
	}
	$mat=$r->get_data('colors',$type);
	$data['colors']=$mat['colors'];
	
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	
	public function styles($type=null,$id=null,$add=null){
	$data['type_index']=$type;
	$data['type_page']=$type;
	$data['image_index']=null;
	$data['image_width']=273;
	$data['image_height']=74;
	$data['upload_dir']='./styles';
	$data['count_images']=1;
	$data['id_num']=$id;
	
	if($id!=null){
	$data['msg']='Фотография стиля изменена';
	$data['image_type']='style_edit';
	$data['image_index']=$id;
	$data['style']=$this->styles_model->get_obj($id);
	$t=explode(',',$data['style'][0]['type']);
	$n=0;
	foreach($t as $key2=>$val2){
	$door_type=$this->doortypes_model->get_obj($val2);
	$data['div_prod_type'][$n]['id']=$door_type[0]['id'];
	$data['div_prod_type'][$n]['name']=$door_type[0]['name'];
	$n=$n+1;
	}
	$path_to_page='/styles/editor';
	$page='<a href='.base_url().'/admin/styles/'.$type.'><span class="hystory">Стили/</span></a> <a href='.base_url().'/admin/sales/'.$type.'/'.$id.'"> <span class="hystory">'.$data['style'][0]['name'].'/</span></a>';
	}
	else{
	$data['type_name']=$this->doortypes_model->get();
	$page='<a href=""><span class="hystory">Стили/</span></a>';
	$path_to_page='/styles';
	}
	
	if($add!=null){
	$data['msg']='Фотография стиля добавлена';
	$data['image_type']='style';
	$data['type_page']=$type;
	$data['image_index']=null;
	$path_to_page='/styles_add';
	if(!isset($_SESSION['style_photo'])){
	$data['query_style_text']='Добавьте сперва фотографию а затем добавьте информацию';
	}
	else{
	$data['ses']=$_SESSION['style_photo'];
	unset($_SESSION['style_photo']);
	$data['query_style_text']='Фотография добавлена, можете добавить информацию';
	}
	
	}
	
	$r=new Admin_oper_lib();
	foreach ($r->oper($type,$page) as $key=>$val){
	$data[$key]=$val;
	}
	$mat=$r->get_data('styles',$type);
	$data['styles']=$mat['styles'];
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	public function materials($type=null,$id=null,$add=null){
	$data['type_index']=$type;
	$data['type_page']=$type;
	$data['image_index']=null;
	$data['image_width']=273;
	$data['image_height']=74;
	$data['upload_dir']='./materials';
	$data['count_images']=1;
	if($id!=null){
	if($id==0){
	$data['material']="";
	$page="";
	}
	else{
	$data['material']=$this->materials_model->get_obj($id);
	$data['msg']='Фотография материала изменена';
	$data['image_type']='material_edit';
	$data['image_index']=$id;
	$t=explode(',',$data['material'][0]['type']);
	$n=0;
	foreach($t as $key2=>$val2){
	$door_type=$this->doortypes_model->get_obj($val2);
	$data['div_prod_type'][$n]['id']=$door_type[0]['id'];
	$data['div_prod_type'][$n]['name']=$door_type[0]['name'];
	$n=$n+1;
	}
	$path_to_page='/materials/editor';
	$page='<a href='.base_url().'/admin/materials/'.$type.'<span class="hystory">Материалы/</span></a><a href='.base_url().'/admin/materials/'.$type.'/'.$id.'><span class="hystory">'.$data['material'][0]['name'].'/</span></a>';
	}
	}
	else{
	$data['type_name']=$this->doortypes_model->get();
	$page='<a href=""><span class="hystory">Материалы/</span></a>';
	$path_to_page='/materials';
	}
	if($add!=null){
	$data['msg']='Фотография материала добавлена';
	$data['image_type']='material';
	$data['type_page']=$type;
	$data['image_index']=null;
	$path_to_page='/materials_add';
	if(!isset($_SESSION['mat_photo'])){
	$data['query_mat_text']='Добавьте сперва фотографию а затем добавьте информацию';
	}
	else{
	$data['ses']=$_SESSION['mat_photo'];
	unset($_SESSION['mat_photo']);
	$data['query_mat_text']='Фотография добавлена, можете добавить информацию';
	}
	}
	$r=new Admin_oper_lib();
	foreach ($r->oper($type,$page) as $key=>$val){
	$data[$key]=$val;
	}
	$mat=$r->get_data('materials',$type);
	$data['materials']=$mat['materials'];
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	
	public function dveri_edit($type=null,$producer=null,$coll=null) 
	{
	$data['image_index']=null;
	$data['image_width']=419;
	$data['image_height']=940;
	$data['upload_dir']='./doors';
	$data['image_type']='door';
	if($type==null){
	header("Location:http://dverkov.com.ua/admin/dveri_edit/1");
	}
	else{
	header('Content-Type: text/html; charset=utf-8');
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['title']='Дверков';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['type_page']=$type;
	if($producer){
	$data['producer']=$producer;
	}
	$prod_info=$this->producers_id_model->get_obj($producer);
	if($coll){
	
	$doors=$this->doors_coll_model->get_obj($coll);
	$path_to_page='/collection';
	$data['coll']=$coll;
	$data['doors']=$doors;
	$coll_info=$this->collection_info_model->get_obj($coll);
	$data['doors']=$this->get_doors($doors);
	}
	else{ 
	if ($producer==null){
	
	$path_to_page='/producers';
	$pr=$this->producers_model->get();
	foreach($pr as $key=>$val){
	$t=explode(',',$val['type']);
	foreach($t as $key2=>$val2){
	if($val2==$type){
	$data['producers'][]=$val;
	continue;
	}
	}
	}
	}
	else{
	
	$models=$this->models_model->get_and($type,$producer,'type');
	$collections=$this->collection_model->get_and($type,$producer,'type');
	/* if($collections){ 
	
	$path_to_page='/collection'; */
	$data['colls']=$collections;
	// $coll=$data['doors'][0]['id'];
	/* }
		else{ */
		$data['count_images']=10;
		$data['coll']=null;
		$path_to_page='/catalog';
		if($models){
		if(!$collections){
			$n=0;
			foreach($models as $key => $value){
			$door=$this->doors_model->get_obj($value['id']);
			foreach($door as $key2=>$value2){
			$doors[$n]=$value2;
			$n=$n+1;
			}
			}
			if(isset($doors)){
			$data['doors']=$this->get_doors($doors);
			}
		}
		else{
		$n=0;
			foreach($models as $key => $value){
			$door=$this->doors_model->get_obj($value['id']);
			
			foreach($door as $key2=>$value2){
			
			if($value2['collection']==0){
			$doors[$n]=$value2;
			}
			$n=$n+1;
			
			}
			}
			if(isset($doors)){
			$data['doors']=$this->get_doors($doors);
			}
		}
	/* 	$n=0;
		foreach($models as $key => $value){
		$door=$this->doors_model->get_obj($value['id']);
		foreach($door as $key2=>$value2){
		$doors[$n]=$value2;
		$n=$n+1;
		}
		}
		
		$data['doors']=$this->get_doors($doors);*/
		
		
		}
		/* } */
		
	}
    }
	if(isset($data['doors'])){
	foreach($data['doors'] as $key=>$val){
		$ph=$this->photos_iddoor_model->get_obj($val['id']);
		if(isset($ph[0]['path'])){
		$data['doors'][$key]['photo']=$ph[0]['path'] ;
		}
		}
	}
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',$data['type_page'],$producer,$coll,null,null); 
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	}
	
	public function furnitura_edit($type=null,$producer=null,$coll=null) 
	{
	$data['image_index']=null;
	$data['image_width']=419;
	$data['image_height']=940;
	$data['upload_dir']='./doors';
	$data['image_type']='door';
	if($type==null){
	header("Location:http://dverkov.com.ua/admin/dveri_edit/1");
	}
	else{
	header('Content-Type: text/html; charset=utf-8');
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['title']='Дверков';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['type_page']=$type;
	if($producer){
	$data['producer']=$producer;
	}
	$prod_info=$this->producers_id_model->get_obj($producer);
	if($coll){
	$doors=$this->doors_coll_model->get_obj($coll);
	$path_to_page='/fura_view/collection_furn';
	$data['coll']=$coll;
	$data['doors']=$doors;
	$coll_info=$this->collection_info_model->get_obj($coll);
	$data['doors']=$this->get_doors($doors);
	}
	else{ 
	if ($producer==null){
	$path_to_page='/fura_view/producers_furn';
	$pr=$this->producers_model->get();
	foreach($pr as $key=>$val){
	$t=explode(',',$val['type']);
	foreach($t as $key2=>$val2){
	if($val2==$type){
	$data['producers'][]=$val;
	continue;
	}
	}
	}
	}
	else{
	$models=$this->models_model->get_and($type,$producer,'type');
	$collections=$this->collection_model->get_and($type,$producer,'type');
	/* if($collections){ 
	
	$path_to_page='/collection'; */
	$data['colls']=$collections;
	// $coll=$data['doors'][0]['id'];
	/* }
		else{ */
		$data['count_images']=10;
		$data['coll']=null;
		$path_to_page='/fura_view/catalog_furn';
		if($models){
		if(!$collections){
			$n=0;
			foreach($models as $key => $value){
			$door=$this->doors_model->get_obj($value['id']);
			foreach($door as $key2=>$value2){
			$doors[$n]=$value2;
			$n=$n+1;
			}
			}
			if(isset($doors)){
			$data['doors']=$this->get_doors($doors);
			}
		}
		else{
		$n=0;
			foreach($models as $key => $value){
			$door=$this->doors_model->get_obj($value['id']);
			
			foreach($door as $key2=>$value2){
			
			if($value2['collection']==0){
			$doors[$n]=$value2;
			}
			$n=$n+1;
			
			}
			}
			if(isset($doors)){
			$data['doors']=$this->get_doors($doors);
			}
		}
	/* 	$n=0;
		foreach($models as $key => $value){
		$door=$this->doors_model->get_obj($value['id']);
		foreach($door as $key2=>$value2){
		$doors[$n]=$value2;
		$n=$n+1;
		}
		}
		
		$data['doors']=$this->get_doors($doors);*/
		
		
		}
		/* } */
		
	}
    }
	if(isset($data['doors'])){
	foreach($data['doors'] as $key=>$val){
		$ph=$this->photos_iddoor_model->get_obj($val['id']);
		if(isset($ph[0]['path'])){
		$data['doors'][$key]['photo']=$ph[0]['path'] ;
		}
		}
	}
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',$data['type_page'],$producer,$coll,null,null); 
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	}
	
	public function producer_edit($type=null,$producer=null){
	$data['type_index']=$type;
	$data['image_index']=$producer;
	$data['image_width']=273;
	$data['image_height']=74;
	$data['upload_dir']='./producers';
	$data['count_images']=1;
	$b=new Filter_lib();
	$data['type_name']=$this->doortypes_model->get();
	$data['filter2']=$b->filter_html(null,1);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	if ($producer!=null){
	$data['image_type']='logo_edit';
	$data['msg']='логотип изменен';
	$data['producer']=$this->producers_id_model->get_obj($producer);
	$data['image']=$data['producer'][0]['logo'];
		foreach($data['producer'] as $key4=>$val4){
		$type_indexes=$val4['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key=>$val){
		if($val==$type){
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		else{
		$type_name=$this->doortypes_model->get_obj($val);
		$data['div_prod_type'][]='<div class="bar"><h3 class="lab_1">'.$type_name[0]['name'].'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'.$type_name[0]['id'].'"></div>';
		}
		}
	}
	$path_to_page='/producer_edit';	
	}
	
	else{
	$data['image_type']='logo';
	$data['msg']='логотип добавлен';
	if(!isset($_SESSION['logo'])){
	$data['query_logo_text']='Добавьте сперва логотип а затем добавьте информацию';
	}
	else{
	unset($_SESSION['logo']);
	$data['query_logo_text']='Логотип добавлен, можете добавить информацию';
	}
	$path_to_page='/producer_add';
	
	}
	
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',$data['type_index'],$producer,null,null,null);
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	
	function get_doors($doors){
	
	foreach($doors as $key=>$value){
		$color=$this->color_model->get_obj($value['color']);
		if($color){
		$doors[$key]['color']=$color[0]['name'];
		}
		$type=$this->types_model->get_obj($value['type']);
		if($type){
		$doors[$key]['type']=$type[0]['name'];
		}
		$corner=$this->corners_model->get_obj($value['corner']);
		if($corner){
		$doors[$key]['corner']=$corner[0]['corner'];
		}
		}
	return $doors;	
	}
	
	public function door_edit($door=null,$type=null,$producer=null,$coll=null)
	{
	function curPageURL() {
	 $pageURL = 'http';
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}
	$url = curPageURL();
	if (substr($url, -6, 6)=='1/1/1/') {
		echo "Your url is ok.";
	} else {
		echo "Wrong url.";
	}
	$data['id_door']=$door;
	$data['image_index']=$door;
	$data['msg']='Фотография двери добавлена';
	$data['image_width']=419;
	$data['image_height']=940;
	$data['upload_dir']='./doors';
	$data['image_type']='door';
	$data['count_images']=10;
	$door_index=$door;
	$b= new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);	
	$data['type_index']=$type;
		$path_to_page='/door';
		$data['title']='Дверков';
		$data['menu']=$this->menu_admin_model->get_obj(1);
		$data['meniatures']=$this->meniatures_model->get_obj($door);
		$door=$this->door_model->get_obj($door);
		$data['door']=$door[0];
		if($door[0]['podobnie']){
		$type_ind=explode(',',$door[0]['podobnie']);
		foreach($type_ind as $key=>$val){
		$door_name=$this->door_model->get_obj($val);
		$data['type_ind'][$key]['name']=$door_name[0]['name'];
		$data['type_ind'][$key]['id']=$val;
		}
		}
		$prod=$this->models_id_model->get_obj($data['door']['model']);
		$data['polotno']=$this->sizes_model->get_obj($data['door']['model']);
		$producer=$prod[0]['producer'];
		$producer=$this->producers_id_model->get_obj($producer);
		$data['producer_logo']=$producer[0]['logo'];
		$data['producer']=$producer[0]['name'];
		$data['prod_id']=$producer[0]['id'];
		$door_photo=$this->photos_iddoor_model->get_obj($door[0]['id']);
		if(count($door_photo)>0){
		$data['door_photo']=$door_photo[0]['path'];
		}
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',$data['type_index'],$producer[0]['id'],$coll,null,$door_index);
	$this->display_lib->door_edit($path_to_page,$data);
	}
	
	
	public function collection_edit($type=null,$producer=null,$collection=null){
	$data['type_index']=$type;
	$data['producer_index']=$producer;
	$b=new Filter_lib();
	$data['type_name']=$this->doortypes_model->get();
	$data['filter2']=$b->filter_html(null,1);
	$data['menu']=$this->menu_model->get_obj(1);
	$path_to_page='/collection_edit';
	$data['collection']=$this->collection_info_model->get_obj($collection);
	$data['type']=$this->doortypes_model->get_obj($data['collection'][0]['type']);
	$c=new Navi();
	$data['hystory']=$c->get_params(2,'dveri_edit',$data['type_index'],$producer,$collection,null,null);
	$this->display_lib->catalog_edit($path_to_page,$data);
	}
	
	public function add_article(){
	print_r($_POST);
	$data['title']=$_POST['title'];
	$data['page']=$_POST['id_page'];
	$data['text']=$_POST['articles_special_text'];
	if(isset($_POST['id_article']) and ($_POST['id_article'])>0){
	$this->articles_model->update($data,'id',$_POST['id_article']);
	}
	else{
	$this->articles_model->insert($data);
	}
	 
	$redicet = $_SERVER['HTTP_REFERER'];
	header("Location:$redicet");
	}
	
	public function del_main_page_door(){
	
	$data['fp']=0;
	$this->door_model->update($data,'id',$_POST['id_door']);
	print('Дверь удалена с первой страницы');
	}
	
	public function main_page_filter(){
	header('Content-type: application/json; charset=utf-8');
	parse_str($_POST['msg'], $output);
	$data['page_num']=1;
	$a= new Filter_lib();
	$data['filter2']=$a->filter_html($output,null);
    $price=$output['example_name'];
	$price_arr=explode(';',$price);
	$price_start=$price_arr[0];
	$price_end=$price_arr[1];
	if(isset($output['example_name'])){
	$data['$price_start']=$price_start;
	$data['$price_end']=$price_end;
	}
	$type=$output['type'];
	if(isset($output['producer'])){
	$data['cur_producer']=$output['producer'];
	}
	else{
	$data['cur_producer']=null;
	}
	if(isset($output['material'])){
	$data['cur_material']=$output['material'];
	}
	else{
	$data['cur_material']=null;
	}
	if(isset($output['styles'])){
	$data['cur_style']=$output['styles'];
	}
	else{
	$data['cur_style']=null;
	}
	if(isset($output['colors'])){
	$data['cur_color']=$output['colors'];
	}
	else{
	$data['cur_color']=null;
	}
	$data['menu']=$this->menu_model->get_obj(1);
	$path_to_page='/doors';
	$b=new Navi();
	$func=1;
	// $data['hystory']=$b->get_params($func,get_class($this),$type,$data['cur_producer'],null,null,null);
	$first_step_args['producer']=$data['cur_producer'];
	$first_step_args['material']=$data['cur_material'];
	$first_step_args['style']=$data['cur_style'];
	$c=new Doors_formation();
	$my_rows=$c->show_doors($type,$first_step_args,$data['cur_color'],$price_start,$price_end);
	
	if($my_rows){
	echo json_encode($my_rows);
	}
	else{
	echo json_encode(NULL);
	}
	}
	
	
	public function del_corner_main_page(){
	$data['corner']=0;
	$this->door_model->update($data,'id',$_POST['corner']);
	
	}
	
	public function add_corner_main_page(){
	$data['corner']=$_POST['id_corner'];
	$this->door_model->update($data,'id',$_POST['id_door']);
	
	}
	
	
	
	public function add_door($type,$producer,$coll=null){
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['count_images']=10;
	$data['msg']='Фотографии двери добавлены';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['image_index']=null;
	$data['image_width']=/* 419 */250;
	$data['image_height']=/* 940 */600;
	$data['upload_dir']='./doors';
	$data['image_type']='door_add';
	$data['type']=$type;
	$data['producer_in']=$producer;
	if($coll){
	$data['coll']=$this->collection_info_model->get_obj($coll);
	}
	$data['styles']=$this->styles_model->get();
	$data['models']=$this->models_producer_model->get_and($type,$producer,'type');
	if(!isset($_SESSION['photo_door'])){
	$data['query_logo_text']='Добавьте сперва фотографии двери а затем добавьте информацию';
	}
	else{
	$data['query_logo_text']='Фотографии двери добавлены, можете добавить информацию';
	$n=0;
	foreach($_SESSION['photo_door'] as $key=>$val){
	$data['meniatures'][$n]['path']=$val;
	$data['meniatures'][$n]['id']=$key;
	$n=$n+1;
	}
	unset ($_SESSION['photo_door']);
	}
	$colors=$this->colors_model->get();//проверка!
	
	foreach($colors  as $key=>$val){
		$type_indexes=$val['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key2=>$val2){
		if($val2==$type){
		$data['colors'][]=$val;
		}
	}
	}
	
	$path_to_page='/fura_view';	
	$this->display_lib->door_edit($path_to_page,$data);
	}

	public function add_door_furn($type,$producer,$coll=null){
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['count_images']=10;
	$data['msg']='Фотографии двери добавлены';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['image_index']=null;
	$data['image_width']=/* 419 */250;
	$data['image_height']=/* 940 */600;
	$data['upload_dir']='./doors';
	$data['image_type']='door_add';
	$data['type']=$type;
	$data['producer_in']=$producer;
	if($coll){
	$data['coll']=$this->collection_info_model->get_obj($coll);
	}
	$data['styles']=$this->styles_model->get();
	$data['models']=$this->models_producer_model->get_and($type,$producer,'type');
	if(!isset($_SESSION['photo_door'])){
	$data['query_logo_text']='Добавьте сперва фотографии фурнитуры а затем добавьте информацию';
	}
	else{
	$data['query_logo_text']='Фотографии фурнитуры добавлены, можете добавить информацию';
	$n=0;
	foreach($_SESSION['photo_door'] as $key=>$val){
	$data['meniatures'][$n]['path']=$val;
	$data['meniatures'][$n]['id']=$key;
	$n=$n+1;
	}
	unset ($_SESSION['photo_door']);
	}
	$colors=$this->colors_model->get();//проверка!
	print_r($colors);
	foreach($colors  as $key=>$val){
		$type_indexes=$val['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key2=>$val2){
		if($val2==$type){
		$data['colors'][]=$val;
		}
	}
	}
	
	$path_to_page='/fura_view/add_door_furn';	
	$this->display_lib->door_edit($path_to_page,$data);
	}

	
	public function add_model($type,$producer){
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['type']=$type;
	$data['producer_in']=$producer;
	/* $data['styles_types']=$this->types_model->get(); */
	$data['styles_types']=$this->styles_model->get();
	$materials=$this->materials_model->get();
	foreach($materials as $key=>$val){
		$type_indexes=$val['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key2=>$val2){
		if($val2==$type){
		$data['materials'][]=$val;
		}
	}
	}
	
	$c=new Navi();
	$page='<a href='.base_url().'/admin/add_model/'.$type.'/'.$producer.'"><span class="hystory">Добавление модели/</span></a>';
	$data['hystory']=$c->get_params(2,'dveri_edit',$type,$producer,null,$page,null);
	$path_to_page='/model_add';	
	$this->display_lib->model_edit($path_to_page,$data);
	}
	
	public function add_model_furn($type,$producer){
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['type']=$type;
	$data['producer_in']=$producer;
	/* $data['styles_types']=$this->types_model->get(); */
	$data['styles_types']=$this->styles_model->get();
	$materials=$this->materials_model->get();
	foreach($materials as $key=>$val){
		$type_indexes=$val['type'];
		$type_ind=explode(',',$type_indexes);
		foreach($type_ind as $key2=>$val2){
		if($val2==$type){
		$data['materials'][]=$val;
		}
	}
	}
	
	$c=new Navi();
	$page='<a href='.base_url().'/admin/add_model/'.$type.'/'.$producer.'"><span class="hystory">Добавление модели/</span></a>';
	$data['hystory']=$c->get_params(2,'dveri_edit',$type,$producer,null,$page,null);
	$path_to_page='/fura_view/model_add';	
	$this->display_lib->model_edit($path_to_page,$data);
	}
	
	public function add_collection($type,$producer){
	$b=new Filter_lib();
	$data['filter2']=$b->filter_html(null,1);
	$data['count_images']=1;
	$data['msg']='Фотографии коллекции добавлены';
	$data['menu']=$this->menu_admin_model->get_obj(1);
	$data['image_index']=null;
	$data['image_width']=419;
	$data['image_height']=940;
	$data['upload_dir']='./doors';
	$data['image_type']='collection_add';
	$data['type']=$type;
	$data['producer_in']=$producer;
	if(!isset($_SESSION['photo_door'])){
	$data['query_logo_text']='Добавьте сперва фотографии коллекции а затем добавьте информацию';
	}
	else{
	$data['query_logo_text']='Фотография коллекции добавлена, можете добавить информацию';
	$data['meniatures']=$_SESSION['photo_door'][0];
	print('meniature');
	print_r($data['meniatures']);
	unset ($_SESSION['photo_door']);
	}

	$path_to_page='/collection_add';	
	$this->display_lib->door_edit($path_to_page,$data);
	}
	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */