<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions extends CI_Controller {

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
	
	$this->load->model('articles_model');
	$this->load->model('clients_model');
	$this->load->model('clients_del_model');
	$this->load->model('slider_model');
	$this->load->model('portfolio_model');
	$this->load->model('portfolio_del_model');
	$this->load->model('baget_model');
	$this->load->library('image_lib');
	} 
		public function add_photo_baget()
	{  
echo'
	        <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br />Получен файл  байт ";
	        </script>
	    ';
	if($_FILES['upload_file']['size']>0) {
	
	    /* echo'
	        <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br />Получен файл '.$_FILES['upload_file']['name'].' размером '.$_FILES['upload_file']['size'].' байт ";
	        </script>
	    '; */
		// Каталог, в который мы будем принимать файл:
		$uploaddir = './photos/';
		$uniq = uniqid();
		$uploadfile = $uniq.basename($_FILES['upload_file']['name']);
		$upload=$uploaddir.$uploadfile;
				
		// Копируем файл из каталога для временного хранения файлов:
		if (copy($_FILES['upload_file']['tmp_name'],$upload))
		{
		/* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Файл '.$upload.'успешно загружен на сервер</h3>";
	        </script>';  */
		$image_info = GetImageSize($upload);
		$ratio_img=$image_info[0]/$image_info[1];
		
		//Первый ресайз по ширине 1000px
		$img_height=600;
		$img_width=600;
		$source_image=$upload;
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['quality'] = 100;
		$config['source_image'] = $source_image;
		$config['new_image'] = './photos/';
		$config['maintain_ratio'] = TRUE;
		$crop_image=$_FILES['upload_file']['name'];
		if (($image_info[0]/$image_info[1])>1){
		$config['height'] = $img_width/$ratio_img;
		$config['width'] = $img_width;
		$this->initial_resize($config);
		$this->image_lib->clear();
		$this->initial_crop($crop_image,$img_height,$img_width);
		}
		
		$type=$_POST['type_baget'];
		$name=$_POST['name_baget'];
		
		
		$data = array(
               'img' => '/photos/'.$uploadfile,
			   'type'=> $type_baget,
			   'name'=>$name_baget
        );
		$this->baget_model->insert($data);
		}
		else { /* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Файл '.$_FILES['upload_file']['name'].' не загружен на сервер</h3>";
	        </script>'; */ exit; }
	}
	
	}

	
	public function change_photo1()
	{  
	if($_FILES['upload_file']['size']>0) {
		
	
	   /*  echo'
	        <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br />Получен файл '.$_FILES['upload_file']['name'].' размером '.$_FILES['upload_file']['size'].' байт ";
	        </script>
	    '; */ 
		// Каталог, в который мы будем принимать файл:
		$uploaddir = './works/';
		$uniq = uniqid();
		$uploadfile = $uniq.basename($_FILES['upload_file']['name']);
		$upload=$uploaddir.$uploadfile;
				
		// Копируем файл из каталога для временного хранения файлов:
		if (copy($_FILES['upload_file']['tmp_name'],$upload ))
		{
		
		 /* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Файл '.$upload.'успешно загружен на сервер</h3>";
	        </script>';  */
		$image_info = GetImageSize($upload);
		$ratio_img=$image_info[0]/$image_info[1];
		$img_height=$_POST['img_height'];
		$img_width=$_POST['img_width'];
		$string=(string)$image_info[0];
		/* echo ' <script type="text/javascript">
		var elm=parent.window.document.getElementById("result");
		elm.innerHTML=elm.innerHTML+"'.preg_replace('/\n/m', "\\\n",$string).'";
		</script>'; */ 
		$this->image_lib->clear();
		$source_image=$upload;
		$config['image_library'] = 'gd2';
		$config['quality'] = 100;
		$config['source_image'] = $source_image;
		$config['new_image'] = './works/thumbs';
		/* $config['create_thumb'] = TRUE; */
		$config['maintain_ratio'] = TRUE;
		$crop_image='./works/thumbs/'.$uploadfile;
		if (($image_info[0]/$image_info[1])>1.4){
		$config['height'] = $img_height;
		$config['width'] = $img_height*$ratio_img;
		$this->initial_resize($config);
		$this->image_lib->clear();
		$this->initial_crop($crop_image,$img_height,$img_width);
		}
		else{
		$config['height']=$img_width/$ratio_img;
		$config['width'] = $img_width;
		$this->initial_resize($config);
		$this->image_lib->clear();
		$this->initial_crop($crop_image,$img_height,$img_width);
		}
		$id_photo=$_POST['id_photo'];
		$id_article=$_POST['id_article'];
		$model=$_POST['model'];
		$id=$_POST['id'];
		/*  echo'
	        <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br />id_article '.str_replace("\r","",str_replace("\n","<br />",htmlspecialchars(stripslashes($_POST['id_article'])))).' id_photo '.str_replace("\r","",str_replace("\n","<br />",htmlspecialchars(stripslashes($_POST['id_photo'])))).' ";
	        </script>
	    ';  */
		$data = array(
               $id_photo => '/works/thumbs/'.$uploadfile
        );
		$this->$model->update($data,$id,$id_article);
		}
		else {  /* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Файл '.$_FILES['upload_file']['name'].' не загружен на сервер</h3>";
	        </script>'; */  exit; }
	}
	
	}
	public function initial_resize($config){
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();	
		if ( ! $this->image_lib->resize())
		{
			$string=$this->image_lib->display_errors();
			$string=(string) $string;
			/*  echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Файл ' .$string .'</h3>";
	        </script>'; */
		}
		else{
		/*  echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Ресайз произведен</h3>";
	        </script>'; */
		}
		}
public function initial_crop($crop_image,$img_height,$img_width){  
		$crop_image =$crop_image;
		/* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>crop start' .$crop_image .'</h3>";
	        </script>'; */
		$image_info = GetImageSize($crop_image);
		  /* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>image_info' .$image_info[0].'</h3>";
	        </script>'; */
		$config['quality'] = 100;
		$config['image_library'] = 'gd2';
		$config['maintain_ratio'] = FALSE;
		$config['create_thumb'] = FALSE;
		$config['source_image'] = $crop_image;
		$config['width'] = $img_width;
		$config['height'] = $img_height;
	 	$config['x_axis'] = ($image_info[0]-$img_width)/2;
		$config['y_axis'] = ($image_info[1]-$img_height)/2; 
		$config['new_image'] = $crop_image; 
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		
		if ( ! $this->image_lib->crop())
		{
			echo $this->image_lib->display_errors();
		}
		else{ 
		
		/* echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>crop complete</h3>";
	        </script>'; */ } 
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */