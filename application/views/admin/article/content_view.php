<div class="span10a">	
	<div id="progress_bar">
		<div class="add_art">
		<div class="icon_text_div"><h3 class="icon_text">Добавить статью</h3></div>
		<div id="add_producer">
		</div>
		</div>
	
	</div>

					<div class="span8 yellow_border_admin" style="margin-top:0px;left:-20px;">
					
						<div id="form_menu_inp">
						
						</div>
										
					</div>
			</div>		
	    </div>
		</div><!-- #container-->
	</div><!-- #content-->
<script>
$(document).ready(function(){
$("#select1 option").prop("selected", false).filter(":nth-child(1)").prop("selected", true);
// $('.yellow_border_admin').empty();
$('.add_art').css('display','none');

});

</script>
<script>

function add_menu(){

 var msg   = $('#form_menu').serialize();
        $.ajax({
          type: 'POST',
          url: '/admin/add_menu/',
          data: msg,
          success: function(data) {
            alert(data);
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        }); 
}
function edit_menu(){

 var msg   = $('#form_menu_edit').serialize();
        $.ajax({
          type: 'POST',
          url: '/admin/change_menu/',
          data: msg,
          success: function(data) {
            $('.change_results').html('<span style="color:red">'+data+'</span>');
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        }); 
}
</script>	
<script>
/* function formation (){
$('.yellow_border_admin').html('<div id ="article_admin_1"><div id="editorsm" style="position:relative;display:block;"><div id="header_menu"></div><form id="form_menu_edit" action="javascript:void(null);" onsubmit="edit_menu()" method="post"><div id="form_menu_edit_text"><p>Вы можете изменить название текущего пункта меню <span class="current_menu"></span></p></div><input type="hidden" name="menu2_id" id="menu2_id" > <input type="text" name="menu2_name" id="menu2_name" > <input style="margin-top:-10px;" type="submit" value="Изменить"> <input type="button" style="margin-top:-10px;" id="del_btn" value="Удалить">  </form><div class="change_results"></div><div id="header_menu_editor"></div>                 <form id="form_menu" action="javascript:void(null);" onsubmit="add_menu()" method="post"><input type="hidden" name="menu1_id" id="menu1_id" ><div id="form_menu_inp"></div></form><div class="change_results2"></div><div id="header_article_editor"><h3 class="header_article_admin"></h3></div></div></div>');
$('#del_btn').click(function(){
 var msg   = $('#form_menu_edit').serialize();
        $.ajax({
          type: 'POST',
          url: '/admin/del_menu/',
          data: msg,
          success: function(data) {
            $('.change_results').html('<span style="color:red">'+data+'</span>');
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        }); 

})
} */
</script>
<script>
function new_format_art(value,key){
$('#form_menu_inp').append('<form id="form_article" action="/admin/add_article" method="post">  <input type="hidden" name="id_page" value="'+value+'"> <h1 class="header_title">Статья №_'+key+'</h1>  <br>    <p>Заголовок</p>   <input type="text" class="news_inp" name="title" />     <br>     <p>Полный текст</p> <textarea name="articles_special_text" id="editor2_'+key+'" class="ckeditor" cols="20"  rows="20"></textarea>    <input id="news_submit" type="submit" value="Принять изменения">             <input id="articles_special_delete" class="art_del_btn" type="button" value="Удалить статью"> </form>');      
CKEDITOR.replace( "editor2_"+key+"");
}

$('#select1').change(function(){
$('#form_menu_inp').empty();
$('#select2').empty();
$('#select3').empty();
$('#select3').css('display','none');
var value = $(this).val();
window.val=value;
var text = $(this).find('option:selected').text();
window.menu=text;

$.ajax({
type: "POST",
dataType: 'json',
url: "/admin/category",
data: {menu_value:value},
cache: false,
success: function(data){
//получение второстепенного меню
if(data.article.length > 0){

$.each(data.article, function(key, val) { 
$('#form_menu_inp').append('<form id="form_article" action="/admin/add_article" method="post"> <input type="hidden" name="id_article" value="'+val.id+'"> <input type="hidden" name="id_page" value="'+value+'"> <h1 class="header_title">Статья №_'+key+'</h1>  <br>    <p>Заголовок</p>   <input type="text" class="news_inp" name="title" value="'+val.title+'"/>     <br>     <p>Полный текст</p> <textarea name="articles_special_text" id="editor2_'+key+'" class="ckeditor" cols="20"  rows="20">'+val.text+'</textarea>    <input id="news_submit" type="submit" value="Принять изменения">             <input id="articles_special_delete_'+key+'" class="art_del_btn" type="button" value="Удалить статью"> </form>');      
CKEDITOR.replace( "editor2_"+key+"");
});      


$('#add_producer').click(function(){
new_format_art(value,data.article.length)
})
$('.art_del_btn').click(function(){
var id_art=$(this).parent('form').find('input[name=id_article]').val()
$.ajax({

type: "POST",
dataType: 'json',
url: "/functions_ajax/del_art",
data: {id_art:id_art},
cache: false,
success: function(data){
if(data==1){
location.reload();
}


}})
})
}
else{

$('.add_art').css('display','none');
new_format_art(value,0)
}

$('#menu1_id').val(value);
$('#menu2_id').val(value);
$('#menu2_name').val(text);
$('.current_menu').html(text);
if (data.menu.length != 0){
$('#select2').css('display','block');
$("#select2").append('<option>Категория</option>');
$.each(data.menu, function(key, val){ 
$("#select2").append('<option value="'+val.id+'">'+val.name+'</option>'); 
});
$('#header_menu_editor').empty();
$('#header_article_editor').empty();
$('#select2').css('display','block');
$('#header_article_editor').prepend('<p>Выберите категорию слева для редактирования статьи в категориях</p>' ); 

               
}
else{
$('#select2').css('display','none');

//тут писать
}

}
});
});

</script>

<script>
$('#select2').change(function(){
$('#select3').empty();
var value = $(this).val();
window.val=value;
var text = $(this).find('option:selected').text();
window.menu2=text;

$.ajax({
type: "POST",
dataType: 'json',
url: "/admin/category",
data: {menu_value:value},
cache: false,
success: function(data){
$('#form_menu_inp').empty();
$('#menu1_id').val(value);
$('#menu2_id').val(value);
$('#menu2_name').val(text);	
$('.current_menu').html(text);
if (data.article.length <1){
$('.add_art').css('display','none');
new_format_art(value,0)
}
else{
$('.add_art').css('display','block');

$.each(data.article, function(key, val) { 
$('#form_menu_inp').append('<form id="form_article" action="/admin/add_article" method="post"> <input type="hidden" name="id_article" value="'+val.id+'"> <input type="hidden" name="id_page" value="'+value+'"> <h1 class="header_title">Статья №_'+key+'</h1>  <br>    <p>Заголовок</p>   <input type="text" class="news_inp" name="title" value="'+val.title+'"/>     <br>     <p>Полный текст</p> <textarea name="articles_special_text" id="editor2_'+key+'" class="ckeditor" cols="20"  rows="20">'+val.text+'</textarea>    <input id="news_submit" type="submit" value="Принять изменения">             <input id="articles_special_delete_'+key+'" class="art_del_btn" type="button" value="Удалить статью"> </form>');      
CKEDITOR.replace( "editor2_"+key+"");
});

$('#add_producer').click(function(){
new_format_art(value,data.article.length)
})
$('.art_del_btn').click(function(){
var id_art=$(this).parent('form').find('input[name=id_article]').val()
$.ajax({

type: "POST",
dataType: 'json',
url: "/functions_ajax/del_art",
data: {id_art:id_art},
cache: false,
success: function(data){
if(data==1){
location.reload();
}


}})
})
}

}
});
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