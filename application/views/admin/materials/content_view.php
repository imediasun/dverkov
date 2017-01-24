﻿
<div class="span10a">
	<div id="progress_bar">
		<div class="icon_text_div"><h3 class="icon_text">Добавить материал</h3></div>
		<a href="/admin/materials/<?=$type_page;?>/<?=0?>/<?=1?>"><div id="add_producer">
		</div></a>
		
		<div class="icon_text_div"><h3 class="icon_text_red">Теперь выберите материал</h3></div>
		
		<div class="icon_text_div"><h3 class="icon_text">Стили</h3></div>
		<a href="/admin/styles/<?=$type_page;?>"><div id="add_styles">
		</div></a>
		<div class="icon_text_div"><h3 class="icon_text">Палитра цветов</h3></div>
		<a href="/admin/colors/<?=$type_page;?>"><div id="add_colors">
		</div></a>
	</div>
	
	
	<ul class="prod">
	<div class="prostir"></div>
	<?
	if(isset($materials)){
	foreach($materials as $key=>$value){
	?>
	<div style="position:relative;width:365px;height:165px;display:inline-block;margin: 15px 0px 0px 5px;">
		<a href="/admin/materials/<?=$type_page;?>/<?=$value['id']?>">
		<li>
		
		
		<?
		if(isset($value['image'])&&$value['image']!=''){
		?>
		<p style="text-align:center;vertical-align:middle;position:relative;margin-top:auto 0">
		<img style="" height="74px" src="<?=$value['image']?>"></p>
		<?
		}
		else{
		?>
		<h3 style="position:absolute;top:10px;color:#000;width:100%">Нет логотипа</h3>
		<?
		}
		?>
		<h3 class="name_of_prod" style="position:absolute;bottom:10px;color:#000;width:100%"><?=$value['name']?></h3>	
		</li>
		</a>
	<div class="del_prod">
	<input type="hidden" value="<?=$value['id']?>">
	</div>
	</div>
	<?
	}
	}
	else{
	?>
	
	<h3 class="adt">Нет материалов соответствующих вашему выбору</h3>
	
	<?
	}
	?>	
	
	</ul>
			
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>
$('.win_btn').click(function(){
$('#window').css('display','block');
$('#appl_window').css('display','block');
});

$('.del_prod').click(function(){
var name=$(this).parent('div').find('a').find('li').find('.name_of_prod').text();
var id=$(this).find('input').val();
var typep=<?=$type_page;?>;
if (confirm('Удалить информацию о производителе '+name+'?'+'')) {
   $.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/delete_material/',
		  data:{id:id,typep:typep},
          success: function(data) {
			alert('Информация о материале удалена из базы данных')
			location.reload();
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
} else {
alert("Вы нажали кнопку отмена")
}

})

var obj=$('.prod li')
$( "#edit_producer" ).click(function() {
$( this ).toggleClass( "highlight" );
if($( this ).is('.highlight')){
window.key_href = new Array();
$('.icon_text_red').css('display','block')
$.each(obj, function(key,value) {
var link =$(this).parent('a')
var link_href=link.attr('href')
window.key_href.push(link_href)
var prod_index=link_href.split('/');
link.attr('href','/admin/materials_edit/'+prod_index[3]+'/'+prod_index[4]+'');
});
}
else{
$('.icon_text_red').css('display','none')
$.each(obj,function(key,value) {
var link =$(this).parent('a')
var link_href=link.attr('href')
link.attr('href',''+window.key_href[key]+'')
})
}
});

function print_r(arr, level) {
    var print_red_text = "";
    if(!level) level = 0;
    var level_padding = "";
    for(var j=0; j<level+1; j++) level_padding += "    ";
    if(typeof(arr) == 'object') {
        for(var item in arr) {
            var value = arr[item];
            if(typeof(value) == 'object') {
                print_red_text += level_padding + "'" + item + "' :\n";
                print_red_text += print_r(value,level+1);
		} 
            else 
                print_red_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
        }
    } 
    else  print_red_text = "===>"+arr+"<===("+typeof(arr)+")";
    return print_red_text;
}
</script>	