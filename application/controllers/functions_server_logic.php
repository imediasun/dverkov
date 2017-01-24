<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions_server_logic extends CI_Controller {

public function __construct()
	 {
	parent:: __construct();
	$this->load->library('image_lib');
	
	/* $this->load->model('tour_model');
	$this->load->model('photo_model'); */
	require('server/FirePHP.class.php');
  $firephp = FirePHP::getInstance(true);
  $firephp -> fb("hello world! i'm warning you!",FirePHP::WARN);
	} 
	public function index(){
    if(!empty($_FILES)) {
    print_r ($_FILES);
    // Файл передан через обычный массив $_FILES
    echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
    $file = $_FILES['my-pic'];
	$file_name=$file['name'];
	$ppos = strrpos($file_name, '.');
	$file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);
	session_start();
	$_SESSION['file_name']=$file_name;	
	$tmp_name=$file['tmp_name'];
	$uploads_dir='./photos/tours/';  
	$upload=$uploads_dir.'/'.$file_name;
	/* if (move_uploaded_file($tmp_name, "$uploads_dir/$file_name")){ */
	if (move_uploaded_file($tmp_name, "$uploads_dir/$file_name"))/* (copy($_FILES['my-pic']['tmp_name'],$upload)) */{
	$image_info = GetImageSize($upload);
		$ratio_img=$image_info[0]/$image_info[1];
	//Первый ресайз по ширине 1000px
		$img_height=200;
		$img_width=290;
		$ratio_index=$img_width/$img_height;
		//$ratio_index=1,45
		if ($ratio_img>$ratio_index){
		print('img>index' .$ratio_img.' '.$ratio_index);
		$img_height=200;
		$img_width=$img_height*$ratio_img;
		}
		else {
		print('img<index'.$ratio_img.' '.$ratio_index);
		$img_height=$img_width/$ratio_img;
		$img_width=290;
		}
		$source_image=$upload;
		$target='./photos/tours';
		$config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_image,
        'new_image' => $target,
        'maintain_ratio' => TRUE,
        'create_thumb' => FALSE,
        'thumb_marker' => '_thumb',
        'width' => $img_width,
        'height' => $img_height
    );
    
	$this->initial_resize($config_manip);
	$img_width=290;
	$img_height=200;
	$crop_image=$upload;
	// clear //
	$upload=substr($upload, 1);
	$data_present_photo['tour_present_photo_big']=$upload;
	
	$this->image_lib->clear();
    $this->initial_crop($crop_image,$img_height,$img_width,false);
	$rows=$this->tour_model->get_limit(1,'id','desc');
	$this->tour_model->update($data_present_photo,'id',$rows[0]['id']);
    

		

} 

}
}
	public function second(){
if(!empty($_FILES)) {

    // Файл передан через обычный массив $_FILES
    echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
    $file = $_FILES['my-pic'];
	$file_name=$file['name'];
	$ppos = strrpos($file_name, '.');
	$file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);
	session_start();
	$_SESSION['file_name']=$file_name;	
	$tmp_name=$file['tmp_name'];
	$uploads_dir='./photos/tours/';  
	$upload=$uploads_dir.'/'.$file_name;
	/* if (move_uploaded_file($tmp_name, "$uploads_dir/$file_name")){ */
	if (copy($_FILES['my-pic']['tmp_name'],$upload)){
	$image_info = GetImageSize($upload);
		$ratio_img=$image_info[1]/$image_info[0];
		print('ratio_image'.$ratio_img);
		//Первый ресайз по ширине 1000px
		$img_height=200;
		$img_width=170;
		$ratio_index=$img_height/$img_width;
		print('ratio_index'.$ratio_index);
		//$ratio_index=1,45
		if ($ratio_img<$ratio_index){
		print('img<index' .$ratio_img.' '.$ratio_index);
		$img_height=200;
		$img_width=$img_height/$ratio_img;
		}
		else {
		print('img>index'.$ratio_img.' '.$ratio_index);
		$img_width=170;
		$img_height=$img_width*$ratio_img;
		
		}
		$source_image=$upload;
		$target='./photos/tours';
		$config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_image,
        'new_image' => $target,
		'bg_rgb'=> array(255, 255, 255),
        'maintain_ratio' => TRUE,
        'create_thumb' => FALSE,
        'thumb_marker' => '_thumb',
        'width' => $img_width,
        'height' => $img_height
    );
    
	$this->initial_resize($config_manip);
	$img_width=170;
	$img_height=200;
	$crop_image=$upload;
	// clear //
	$this->image_lib->clear();
    $this->initial_crop($crop_image,$img_height,$img_width,false); 
	$upload=substr($upload,1);
	$data_present_photo['tour_present_photo']=$upload;
	/* $this->image_lib->clear();
    $this->initial_crop($crop_image,$img_height,$img_width); */
	$rows=$this->tour_model->get_limit(1,'id','desc');
	$this->tour_model->update($data_present_photo,'id',$rows[0]['id']);
    

		

} 

}
}
	
	
	
	
	public function initial_resize($config){
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
	
		if ( ! $this->image_lib->resize())
		{
			$string=$this->image_lib->display_errors();
			$string=(string) $string;
			print($string);
			/*  echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Файл ' .$string .'</h3>";
	        </script>'; */
		}
		else{
		print('ok');
		/*  echo ' <script type="text/javascript">
	        var elm=parent.window.document.getElementById("result");
	        elm.innerHTML=elm.innerHTML+"<br /><h3>Ресайз произведен</h3>";
	        </script>'; */
		}
		}
public function initial_crop($crop_image,$img_height,$img_width,$thumb){  
	
		$image_info = GetImageSize($crop_image);
		$config['quality'] = 100;
		$config['image_library'] = 'gd2';
		$config['maintain_ratio'] = FALSE;
		$config['create_thumb'] = $thumb;
		$config['thumb_marker']= '_thumb';
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
        
		echo "crop_ok";
		} 
		
	}	
	public function add_resort_photos(){
	session_start();
    if(!empty($_FILES)) {
    // Файл передан через обычный массив $_FILES
    echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
    $file = $_FILES['my-pic'];
	$file_name=$file['name'];
	$ppos = strrpos($file_name, '.');
	$file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);
	$tmp_name=$file['tmp_name'];
	$uploads_dir='./producers';  
	$upload=$uploads_dir.'/'.$file_name;
	if (move_uploaded_file($tmp_name, "$uploads_dir/$file_name")){
	$image_info = GetImageSize($upload);
		$ratio_img=$image_info[0]/$image_info[1];
		print_r($image_info);
		if($image_info[0]>273 or $image_info[1]>74){
	/* 	if($image_info[0]>$image_info[1]){
		$img_width=273;
		$img_height=$img_width/$ratio_img;
		print('width '.$img_width.'х'.' height '.$img_height);
		}
		else{ */
		$img_height=74;
		$img_width=$img_height*$ratio_img;
		print('width '.$img_width.'х'.' height '.$img_height);
		/* } */
		}
		else{
		$img_width=$image_info[0];
		$img_height=$image_info[1];
		}
		$ratio_index=$img_width/$img_height;
		$source_image=$upload;
		$target='./producers';
		$config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_image,
        'new_image' => $target,
        'maintain_ratio' => TRUE,
        'create_thumb' => FALSE,
        'width' => $img_width,
        'height' => $img_height
    );
    
	$this->initial_resize($config_manip);
	$source=substr($source_image, -4); 
	$source_start=substr($source_image, 0, -4);
	$crop_image=$source_start.$source;
	print('crop_image'.$crop_image); 
	$img_width=273;
	$img_height=74;
	
	// clear //
	 $this->image_lib->clear();
	 $this->initial_crop($crop_image,$img_height,$img_width,false); 
 /* $data['path']=substr($source_image, 1);
	$data['thumb']=substr($crop_image, 1);
	$data['id_country']=$_SESSION['add_photo_country'];
	$data['id_resort']=$_SESSION['add_photo_resort'];
	$data['id_place']=$_SESSION['add_photo_place'];
	$this->photo_model->insert($data); */

} 

$expansion=substr(strrchr($file_name, '.'), 1);
$filename = basename($file_name, $expansion); 
$width = 273;
$height = 74;
$mime = $image_info['mime'];
// What sort of image?

$type = substr(strrchr($mime, '/'), 1);

switch ($type) 
{
case 'jpeg':
    $image_create_func = 'ImageCreateFromJPEG';
    $image_save_func = 'ImageJPEG';
	$new_image_ext = 'jpg';
    break;

case 'png':
    $image_create_func = 'ImageCreateFromPNG';
    $image_save_func = 'ImagePNG';
	$new_image_ext = 'png';
    break;
case 'bmp':
    $image_create_func = 'ImageCreateFromBMP';
    $image_save_func = 'ImageBMP';
	$new_image_ext = 'bmp';
    break;
case 'gif':
    $image_create_func = 'ImageCreateFromGIF';
    $image_save_func = 'ImageGIF';
	$new_image_ext = 'gif';
    break;
case 'vnd.wap.wbmp':
    $image_create_func = 'ImageCreateFromWBMP';
    $image_save_func = 'ImageWBMP';
	$new_image_ext = 'bmp';
    break;
case 'xbm':
    $image_create_func = 'ImageCreateFromXBM';
    $image_save_func = 'ImageXBM';
	$new_image_ext = 'xbm';
    break;
default: 
	$image_create_func = 'ImageCreateFromJPEG';
    $image_save_func = 'ImageJPEG';
	$new_image_ext = 'jpg';
}


// Transparent Background
$im = $image_create_func($upload);
$new_im = imagecreatetruecolor($width,$height);
/* imagecolortransparent($new_im, imagecolorallocate($new_im, 0, 0, 0));
imagecopyresampled($new_im,$im,0,0,0,0,$width,$height,$width,$height); */
$white = imagecolorallocate($im,255,255,255);
imagecolortransparent($im,$white);
header('Content-Type: image/png');
ImagePNG($im,$uploads_dir.'/'.$filename.'.png');



}


	// header('Location:"http://interclient.net/admin_photos/add_photo"');
}
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */