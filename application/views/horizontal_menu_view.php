
<div id="nav" >
<div id="menu" class="mn">
		
				
<div id="menu_block">
	<nav class="navbar-block nav-wrap">
		<?
		$CI =& get_instance();
		$lang=$CI->uri->segment(1);
		if(!$lang){$lang='en';}
		function get_cat($menu) {
		
		if(!$menu) {
			return NULL;
		}
		$arr_cat = array();
		if(count($menu) != 0) {
			
		//В цикле формируем массив
			
			foreach ($menu as $key=>$row){
			
			//Формируем массив где ключами являются адишники на родительские категории
			if(empty($arr_cat[$row['parent_id']])) {
				$arr_cat[$row['parent_id']] = array();
			}	
			$arr_cat[$row['parent_id']][] = $row;
		}		
		

		//возвращаем массив
		return $arr_cat;
	}
}


//вывод каталогa с помощью рекурсии		
function view_cat($arr,$lang,$parent_id = 0) {

	//Условия выхода из рекурсии
	if(empty($arr[$parent_id])) {
		return;
	}
	echo '<ul class="men dropdown_menu menu_prop parent'.$parent_id.'" role="menu">';
	//перебираем в цикле массив и выводим на экран
	for($i = 0; $i < count($arr[$parent_id]);$i++) {
	
		echo '<li class="men"><a href="/pages/page/'.$arr[$parent_id][$i]['id'].'">'.$arr[$parent_id][$i]['name'].'</a>';
		//рекурсия - проверяем нет ли дочерних категорий
		view_cat($arr,$lang,$arr[$parent_id][$i]['id']);
		echo '</li>';
	}
	echo '</ul>';
	
}
$result = get_cat($menu);
//Выводи каталог на экран с помощью рекурсивной функции

view_cat($result,$lang);
	
?>
   </nav>

   
</div>	
		
</div>
</div>












  <!-- <link rel="stylesheet" href="http://yandex.st/highlightjs/7.0/styles/monokai.min.css">
  <script src="http://yandex.st/highlightjs/7.0/highlight.min.js"></script> -->
<script type="text/javascript">
$(function() {
    $('.dropdown_menu').dropdown_menu();
});
</script>
  <script>
    $('#nav').fixTo('body', {
    
    zIndex: 99999,
    
    top: 0
});
  </script>



<script>
/* $('#menu_block ul li').mouseover(function(){ 

$(this).find('> ul').fadeIn();

});
$('#menu_block ul li').mouseleave(function(){
$(this).find('ul').fadeOut();

});  */
</script>
<script>

var menu=jQuery('.navbar-block ul:first')
menu.attr('id','example-one')
menu.addClass('group')
jQuery('.navbar-block ul:first li:nth-child('+<?echo $page_num?>+')').addClass("current_page_item")


</script>
<script>
$(function() {

    var $el, leftPos, newWidth,
        $mainNav = $("#example-one");
    
    $mainNav.append("<li id='magic-line'></li>");
    var $magicLine = $("#magic-line");
    
    $magicLine
        .width($(".current_page_item").width())
        .css("left", $(".current_page_item a").position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());
        
    $("#example-one > li > a ").hover(function() {
        $el = $(this);
        leftPos = $el.position().left;
        newWidth = $el.parent().width();
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        });    
    });
	
	
});

</script>