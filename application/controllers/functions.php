<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions extends CI_Controller {

public function __construct()
	 {
	parent:: __construct();
	$this->load->helper('url');
	$this->load->model('seo_model');
	$this->load->helper('language');
	$this->load->model('articles_en_model');
	$this->load->model('articles_ru_model');
	$this->load->model('articles_chi_model');
	$this->current_lang = $this->uri->segment(1);
	} 
		function get_lang()
       {
            $CI =& get_instance();
           
            $fsu = $CI->uri->segment(1);
           
            if($CI->config->item($fsu, 'languages') && ($fsu != $CI->config->item('language_default')))
            {
                return $fsu . '/';
            }
           
            return;
        }
	public function contact_form(){
	$lang=$this->get_lang();
		if ($lang=='ru/'){
		$this->lang->load('interface', 'ru');
		$myrow = $this->articles_ru_model->get_obj(1);
		}
		if ($lang=='en/'){
		$this->lang->load('interface', 'en');
		$myrow = $this->articles_en_model->get_obj(1);
		
		
		}
		if ($lang=='chi/'){
		$this->lang->load('interface', 'chi');
		$myrow = $this->articles_chi_model->get_obj(1);
		}
		if ($lang==''){
		$this->lang->load('interface', 'en');
		$myrow = $this->articles_en_model->get_obj(1);
		}
		$data['lang']=$lang;
		
		$data['main']= $this->lang->language;
		$data['article']=$myrow;
	
	
	$myrow=$this->seo_model->get();
	$data['title'] = $myrow[0]['title'];
	$data['keywords'] = $myrow[0]['keywords'];
	$data['description'] = $myrow[0]['description'];		 
	
	if(isset($_POST['submit'])){
	$data['name']=$_POST['name'];
	$data['phone']=$_POST['phone'];
	$data['email']=$_POST['email'];
	$data['msg']=$_POST['msg'];
	$data['service']=$_POST['service'];
	
	if (empty($_POST['name'])or empty($_POST['phone'])or empty($_POST['email'])or empty($_POST['msg'])){
	$data['error']=$this->config_contact_form('warning',$data);
	$path_to_page='/contacts';
	$this->display_lib->template($path_to_page,$data);
	}
	else{
	$name=stripslashes(htmlspecialchars($data['name']));
	$phone=stripslashes(htmlspecialchars($data['phone']));
	$email=stripslashes(htmlspecialchars($data['email']));
	$msg=stripslashes(htmlspecialchars($data['msg']));
	$service=stripslashes(htmlspecialchars($data['service']));
	if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email))
	{
	$data['error']=$this->config_contact_form('email_warning',$data);
	$path_to_page='/contacts';
	$this->display_lib->template($path_to_page,$data);
	}
	else{
	$message ="Пишет: $name\nТелефон: $phone\nE-mail: $email\nУслуга: $service\nСообщение: $msg";
	$this->load->library('email');
	$config['protocol'] = 'sendmail';
	$config['mailpath'] = '/usr/sbin/sendmail';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE;
	$config['smtp_host'] = 'wisdom-services.net';
	$config['smtp_user'] = 'info@wisdom-services.net';
	$config['smtp_path'] = 'wisdom';
	$config['smtp_port'] = '2525';
	$this->email->initialize($config);
	$to='dpgluhov@gmail.com,forwarding@wisdom.od.ua'; 
	$this->email->reply_to($email, $this->_mail_encode($name, "utf-8"));
	$this->email->from($email, $this->_mail_encode($name, "utf-8"));
	$this->email->to($to);
	$this->email->subject("Письмо из контактной формы");
	$this->email->message($message);
	if ($this->email->send())
	// if (mail($this->config_contact_form('mymail'),$this->config_contact_form('topic'),$message,"Content-type:text/plain;charset = utf-8\r\n"))
	{
	$data['error']=$this->config_contact_form('sucsess',$data);
	$path_to_page='/contacts';
	$this->display_lib->template($path_to_page,$data);
	header("Refresh: 5; URL=".$this->config_contact_form('url',$data)."");
	}
	
	}
	
	}
	
	}
	else{
	$data['error']=$this->config_contact_form('direct_access');
	echo $data['error'];
	}
	}
	public function _mail_encode($text, $encoding) {
	$result = "=?".$encoding."?b?".base64_encode($text)."?=";
	return $result;
	}
	public function config_contact_form($a,$data){
	switch ($a)
	{
	case 'mymail':
	$b='info@wisdom-services.net';
	break;
	case 'topic':
	$b='Письмо из контактной формы';
	break;
	case 'warning':
	$b='<div class="error" style="font-family:Verdana,Arial,Helvetica,sans-serif;
	border-radius:9px;-moz-border-radius:9px;background:#fff;padding-left:12px;padding-right:12px;border:1px solid #dfdfdf;color:#000;
	text-align:center;"><h2 style="font-size:16px;color:#000;">Для отправки сообщения нужно заполнить все поля</h2>
	<p style="font-size:14px;"><a href="http://wisdom-services.net/contacts/?name='.$data['name'].'&phone='.$data['phone'].'&email='.$data['email'].'&msg='.$data['msg'].'">Вернуться назад</a></p></div>';
	break;
	case 'email_warning':
	$b='<div class="error" style="font-family:Verdana,Arial,Helvetica,sans-serif;
	border-radius:9px;-moz-border-radius:9px;background:#fff;padding-left:12px;padding-right:12px;border:1px solid #dfdfdf;color:#000;
	text-align:center;"><h2 style="font-size:16px;color:#000;">Проверьте правильнсть ввода email адреса</h2>
	<p style="font-size:14px;"><a href="http://wisdom-services.net/contacts/?name='.$data['name'].'&phone='.$data['phone'].'&email='.$data['email'].'&msg='.$data['msg'].'">Вернуться назад</a></p></div>';
	break;
	case 'sucsess': 
	$b='<div class="error" style="font-family:Verdana,Arial,Helvetica,sans-serif;
	border-radius:9px;-moz-border-radius:9px;background:#fff;padding-left:12px;padding-right:12px;border:1px solid #dfdfdf;color:#000;
	text-align:center;"><h2 style="font-size:16px;color:#00bf00;">Письмо успешно отправлено</h2>
	<p style="font-size:14px;">Я отвечу на него в течении 24 часов</p></div>';
	break;
	case 'fails':
	$b='<div class="error" style="font-family:Verdana,Arial,Helvetica,sans-serif;
	border-radius:9px;-moz-border-radius:9px;background:#fff;padding-left:12px;padding-right:12px;border:1px solid #dfdfdf;color:#000;
	text-align:center;"><h2 style="font-size:16px;color:#00bf00;">Сообщение на было отправлено пожалуйста 
	сообщите об этом администратору</h2>
	</div>';
	break;
	case 'direct_access':
	$b='<div class="error" style="font-family:Verdana,Arial,Helvetica,sans-serif;
	border-radius:9px;-moz-border-radius:9px;background:#fff;padding-left:12px;padding-right:12px;border:1px solid #dfdfdf;color:#000;
	text-align:center;"><h2 style="font-size:16px;color:#00bf00;">Вы обратились к обработчику напрямую не передав параметров</h2>
	</div>';
	break;
	case 'url':
	$b='http://wisdom-services.net/contacts';
	break;
	}
	return $b;
	}
	
}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */