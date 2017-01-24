<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_lib

{

//Формируем массив для передачи в вид
	public function pagination_array($array, $page = 1, $link_prefix,  $link_suffix, $limit_page, $limit_number)
				{
				
				if (empty($page) or !$limit_page) $page = 1;
				$num_rows = count($array);
				if (!$num_rows /* or $limit_page >= $num_rows */) return false;
				$num_pages = ceil($num_rows / $limit_page);
				
				$page_offset = ($page-1) * $limit_page;
				//Calculating the first number to show.
				if ($limit_number)
				{
				$limit_number_start = $page - ceil($limit_number / 2);
				$limit_number_end = ceil($page + $limit_number / 2) - 1;
				if ($limit_number_start < 1) $limit_number_start = 1;
				//In case if the current page is at the beginning.
				$dif = ($limit_number_end - $limit_number_start);
				if ($dif < $limit_number) $limit_number_end = $limit_number_end + ($limit_number - ($dif + 1));
				if ($limit_number_end > $num_pages) $limit_number_end = $num_pages;
				//In case if the current page is at the ending.
				$dif = ($limit_number_end - $limit_number_start);
				if ($limit_number_start < 1) $limit_number_start = 1;
				}
				else
				{
				$limit_number_start = 1;
				$limit_number_end = $num_pages;
				}
				$panel="";
				//Generating page links.
				for ($i = $limit_number_start; $i <= $limit_number_end; $i++)
				{
				$page_cur = "<a href='$link_prefix$i$link_suffix'>$i</a>";
				if ($page == $i) $page_cur = "<b>$i</b>";
				else $page_cur = "<a href='$link_prefix$i$link_suffix'>$i</a>";
				
				$panel .= " <span>$page_cur</span>";
				}
				 
				$panel = trim($panel);
				//Navigation arrows.
				if ($limit_number_start > 1) $panel = "<b><a href='$link_prefix".(1)."$link_suffix'>&lt;&lt;</a>  <a href='$link_prefix".($page - 1)."$link_suffix'>&lt;</a></b> $panel";
				if ($limit_number_end < $num_pages) $panel = "$panel <b><a href='$link_prefix".($page + 1)."$link_suffix'>&gt;</a> <a href='$link_prefix$num_pages$link_suffix'>&gt;&gt;</a></b>";
				 
				$output['panel'] = $panel; //Panel HTML source.
				$output['offset'] = $page_offset; //Current page number.
				$output['limit'] = $limit_page; //Number of resuts per page.
				$output['works'] = array_slice($array, $page_offset, $limit_page, true); //Array of current page results.
				$output['count'] = count ($array);
				return $output;
				
				}


















}
?>