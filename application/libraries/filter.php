<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter extends CI_Controller

{
//$data - массив с переменными, $name - начало имени файла вида
	
	public function __construct()
	{
	parent:: __construct();
	$this->load->model('producers_model');
	$this->load->model('materials_model');
	$this->load->model('styles_model');
	$this->load->model('colors_model');
    }	
	public function index(){
	$data['producers']=$this->producer();
	$data['materials']=$this->material();
	$data['styles']=$this->style();
	$data['colors']=$this->color();
	return $data;
	}
	
	public function producer($type)
	{
	return $this->producers_model->get_obj($type);	
	} 
	
	public function material()
	{
	return $this->materials_model->get();	
	} 
	public function style()
	{
	return $this->styles_model->get();	
	}
	public function color()
	{
	return $this->colors_model->get();	
	}
}
?>