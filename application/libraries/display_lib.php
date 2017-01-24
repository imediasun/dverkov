<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display_lib

{
//$data - массив с переменными, $name - начало имени файла вида

			public function auth_form($data)
			{
				$CI =& get_instance ();
				$CI->load->view('/admin/auth_form/content_view',$data);
            } 
			
			public function template($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/preheader_view',$data);
                $CI->load->view('/header_view',$data);
				$CI->load->view('/horizontal_menu_view',$data);
				$CI->load->view('/header_end');
				$CI->load->view('/slider_view',$data); 
				$CI->load->view('/second_menu_view',$data);
				$CI->load->view('/container_start_view',$data);
				$CI->load->view('/left_side_view',$data);			
                $CI->load->view($path_to_page.'/content_view',$data);	
				$CI->load->view('/footer_view',$data);
		    } 
	
			public function catalog($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/preheader_view',$data);
                $CI->load->view('/header_view',$data);
				$CI->load->view('/horizontal_menu_view',$data);
				$CI->load->view('/header_end');
				$CI->load->view('/show_room_link_view',$data);
				$CI->load->view('/second_menu_view',$data);
				$CI->load->view('/container_start_view',$data);
				$CI->load->view('/left_side_view',$data);				
                $CI->load->view($path_to_page.'/content_view',$data);
				$CI->load->view('/footer_view',$data);
		    } 
			public function article($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/article/preheader_view',$data);
                $CI->load->view('/header_view',$data);
				$CI->load->view('/horizontal_menu_view',$data);
				$CI->load->view('/header_end');
				$CI->load->view('/show_room_link_view',$data);
				$CI->load->view('/second_menu_view',$data);
				$CI->load->view('/container_start_view',$data);
				$CI->load->view('/left_side_view',$data);				
                $CI->load->view('/'.$path_to_page.'/content_view',$data);
				$CI->load->view('/footer_view',$data);
		    }
			public function article_edit($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('admin/article/preheader_view',$data);
                $CI->load->view('admin/header_view',$data);
				$CI->load->view('admin/horizontal_menu_view',$data);
				$CI->load->view('admin/header_end');
				$CI->load->view('admin/second_menu_view',$data);
				$CI->load->view('admin/container_start_view',$data);
				$CI->load->view('admin/'.$path_to_page.'/left_side_view',$data);				
                $CI->load->view('admin/'.$path_to_page.'/content_view',$data);
				$CI->load->view('admin/footer_view',$data);
		    }
			
			public function gallery_edit($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/admin'.$path_to_page.'/preheader_view',$data);
				$CI->load->view('/admin/appl_window_view',$data);
                $CI->load->view('/admin/header_view',$data);
				$CI->load->view('/admin/horizontal_menu_view',$data);
				$CI->load->view('/admin/header_end');
				$CI->load->view('/admin/second_menu_view',$data);
				$CI->load->view('/admin/container_start_view',$data);
				$CI->load->view('/admin'.$path_to_page.'/left_side_view',$data);				
                $CI->load->view('/admin'.$path_to_page.'/content_view',$data);
				$CI->load->view('/admin/footer_view',$data);
		    }
			
			public function interior($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view($path_to_page.'/preheader_view',$data);
                $CI->load->view('/header_view',$data);
				$CI->load->view('/horizontal_menu_view',$data);
				$CI->load->view('/header_end');
				$CI->load->view('/second_menu_view',$data);
				$CI->load->view('/container_start_view',$data);
				$CI->load->view($path_to_page.'/left_side_view',$data);				
                $CI->load->view($path_to_page.'/content_view',$data);
				$CI->load->view('/footer_view',$data);
		    } 
			
			public function door($path_to_page,$data)
			{
				 $CI =& get_instance ();
				$CI->load->view($path_to_page.'/preheader_view',$data);
                $CI->load->view('/header_view',$data);
				$CI->load->view('/horizontal_menu_view',$data);
				$CI->load->view('/header_end');
				$CI->load->view('/show_room_link_view',$data);
				$CI->load->view('/second_menu_view',$data);
				$CI->load->view('/container_start_view',$data);
				$CI->load->view('/left_side_view',$data);				
                 $CI->load->view($path_to_page.'/content_view',$data);
				$CI->load->view('/footer_view',$data);
		    }
			public function admin($path_to_page,$data,$path)
			{
				 $CI =& get_instance ();
				$CI->load->view($path.'/preheader_view',$data);
               $CI->load->view($path.'/header_view',$data);	
                 $CI->load->view($path.'/horizontal_menu_view',$data);	
               	 $CI->load->view($path_to_page.'/left_side_view',$data);				
				$CI->load->view($path_to_page.'/content_view',$data);
				
				$CI->load->view($path.'/footer_view',$data);
		    } 	
			public function catalog_edit($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/admin/preheader_view',$data);
				$CI->load->view('/admin/appl_window_view',$data);
                $CI->load->view('/admin/header_view',$data);
				$CI->load->view('/admin/horizontal_menu_view',$data);
				$CI->load->view('/admin/header_end');
				$CI->load->view('/admin/second_menu_view',$data);
				$CI->load->view('/admin/container_start_view',$data);
				/* $CI->load->view('/admin/left_side_view',$data);	 */			
                $CI->load->view('/admin'.$path_to_page.'/content_view',$data);
				$CI->load->view('/admin/footer_view',$data);
		    }
			public function model_edit($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/admin/preheader_view',$data);
				$CI->load->view('/admin/header_view',$data);
				$CI->load->view('/admin/horizontal_menu_view',$data);
				$CI->load->view('/admin/header_end');
				$CI->load->view('/admin/second_menu_view',$data);
				$CI->load->view('/admin/container_start_view',$data);
				$CI->load->view('/admin/left_side_view',$data);				
                $CI->load->view('/admin'.$path_to_page.'/content_view',$data);
				$CI->load->view('/admin/footer_view',$data);
		    }		
			public function door_edit($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/admin'.$path_to_page.'/preheader_view',$data);
				$CI->load->view('/admin/appl_window_view',$data);
                $CI->load->view('/admin/header_view',$data);
				$CI->load->view('/admin/horizontal_menu_view',$data);
				$CI->load->view('/admin/header_end');
				$CI->load->view('/admin/second_menu_view',$data);
				$CI->load->view('/admin/container_start_view',$data);
				$CI->load->view('/admin/left_side_view',$data);				
                $CI->load->view('/admin'.$path_to_page.'/content_view',$data);
				$CI->load->view('/admin/footer_view',$data);
		    }
			
				public function main_door_edit($path_to_page,$data)
			{
				$CI =& get_instance ();
				$CI->load->view('/admin'.$path_to_page.'/preheader_view',$data);
                $CI->load->view('/admin/header_view',$data);
				$CI->load->view('/admin/horizontal_menu_view',$data);
				$CI->load->view('/admin/header_end');
				$CI->load->view('/admin/second_menu_view',$data);
				$CI->load->view('/admin/container_start_view',$data);
				$CI->load->view('/admin'.$path_to_page.'/left_side_view',$data);				
                $CI->load->view('/admin'.$path_to_page.'/content_view',$data);
				$CI->load->view('/admin/footer_view',$data);
		    }
}
?>