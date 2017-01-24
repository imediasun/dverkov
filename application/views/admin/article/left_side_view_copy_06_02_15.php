<link rel="stylesheet" href="/css/style_admin.css" type="text/css" media="screen, projection" />




<div class="span2a" id="left_side">
<div class="prostir">
</div>
<div id="filter" class="box effect2">
<div id="filter_btn_block">
<div style="width:600px;" class="doors_type_btn" id="mezhkomnatnie_btn">
<h3 style="margin:40px 0px;color:#000;" class="head_strip">Редактирование статей</h3>
</div>

</div>


	<div class="left_side">
	<select id="select4">
	<option value="0" selected disabled>Выберите пункт меню</option>
						<?
						foreach($menu2 as $key=>$value){
						?>
						<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
						<?
						}
						?>
	</select>
	<div id="sub"></div>
					<div >
					<select id="select2">
					<option>категория</option>
					</select>
					<select id="select3">
					<option>категория</option>
					</select>
					</div>
	<select id="select1">
		<option value="1" disabled>Выберите действие</option>
		<option value="2">Редактировать статью</option>
		<option value="3">Добавить статью</option>
	</select>
	</div>
</div>
</div>					
<script>

$('#select1').change(function(){
if ($(this).val()==2){
$('#sub_date').css('display','block');
}
else if ($(this).val()==3){
$('#form').empty();
/* $('#form').append('<form id="form_0" action="javascript:void(null);" onsubmit="add_news(this.id_news.value,this.date.value,this.title.value,this.short_text.value,this.news_text.value)" method="post">  <input name="id_news" type="hidden" value=""><h3 class="h3_news">Добавить новую новость</h3> <p>Дата</p><input id="news_date" type="text" onfocus="this.value=\'\'" name="date" class="tcal" value="" />   <p>Заголовок</p>    <input type="text" class="news_inp" name="title" value=""/>     <p>Короткий текст</p>       <textarea name="short_text" cols="20" class="news_inp" rows="20"></textarea>  <p>Полный текст</p> <textarea name="news_text" class="news_inp" cols="20" rows="20"></textarea>                      <input id="news0_submit" type="submit" value="Добавить новость"> </form>');      
 */
/* formation_art_new(); */
print_articles_special(null,null);
CKEDITOR.replace("editor_new23");
/*get_authors('new')
 $('#editor_new').val(''); */
var d = new Date();
var curr_date = d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
$('#news_date').val(curr_date);
f_tcalInit();
}

});
function get_articles_special(formated){
/* alert('formated_date: '+formated) */
$.ajax({
		type: "POST",
		dataType: 'json',
		url: "/admin/get_articles_special",
		data: {date:formated},
		cache: false,
		success: function(data){ 
		if(!data){
		alert('Не найдено статей по указанной дате')
		}
		else{
		$('#form').empty();
		$.each(data, function(key, val) {
		/* alert(print_r(val)) */
		print_articles_special(val,key);
		CKEDITOR.replace( "editor2"+key+"");
		/* alert('preauthors') 
		get_authors(val.author,key)*/
		});
		}
		}
});
}
function print_articles_special(articles_special,id){

if(articles_special){
/* alert('print_articles_special_id'+id) */
$('#form').append('<form id="form_'+id+'" action="/admin/add_article" method="post">  <input name="id_articles_special" type="hidden" value="'+articles_special.id+'"><h1 class="header_title">Статья №'+(id+1)+'</h1>  <br>    <p>Заголовок</p>   <input type="text" class="news_inp" name="title" value="'+articles_special.title+'"/>     <br>     <p>Полный текст</p> <textarea name="articles_special_text" id="editor2'+id+'" class="ckeditor" cols="20"  rows="20">'+articles_special.text+'</textarea>                      <input id="news'+id+'_submit" type="submit" value="Принять изменения">             <input id="articles_special'+id+'_delete" class="art_del_btn" type="button" value="Удалить статью"> </form>');      
}
else{
/* alert('articles_special=null') */
$('#form').append('<form id="form_new" action="/admin/add_article" method="post">  <input name="id_articles_special" type="hidden" value=""><h1 class="header_title">Статья №'+(id+1)+'</h1> <br> <br>  <p>Заголовок</p>   <input type="text" class="news_inp" name="title" value=""/>     <br>     <p>Полный текст</p> <textarea name="articles_special_text" id="editor_new23" class="ckeditor" cols="20"  rows="20"></textarea>                      <input id="news_submit" type="submit" value="Принять изменения">             <input id="articles_special_delete" class="art_del_btn" type="button" value="Удалить статью"> </form>');      
}

f_tcalInit();
$('.art_del_btn').click(function(){
var id_articles_special= $(this).closest('form').find('input[name=id_articles_special]').val()
if (confirm("Удалить этот пост?")) {
$.ajax({
			type: 'POST',
			url: '/admin/del_articles_special/',
			data: {id_articles_special:id_articles_special},
			success: function(data) {
			alert(data)
			location.reload();
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
        }
        });
}
else{
 alert("Вы нажали кнопку отмена")
}
});
$('.art_edit_btn').click(function(){
var form=this.form;
 var msg   = $(form).serialize();
$.ajax({
			type: 'POST',
			url: '/admin/edit_articles_special/',
			data: msg,/* id_news:id_news,date:date,title:title,short_text:short_text,news_text:news_text },*/
			success: function(data) {
			alert(data)
		
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
    }
});

});

}
function call_articles_special(id,form_id,date,title,text) {
alert('call_articles_special : id '+id+' form_id '+form_id+' date '+date+' title '+title+' text '+text)
	
	$('#preloader_back').fadeIn();
	//Необходимо проверить есть ли уже статья в этом разделе или нет если нет то передать код страницы в обработчик и инфу о событии добавления
     check_articles_special(/* author,*/id,form_id,date,title,text); 
   
}
function check_articles_special( id,form_id,date,title,text){
/*var msg   = $('#'+id+'').serialize(); */
 alert('check_articles_special'+id+'form_id'+form_id+'date'+date+''+text+''); 
 str = '123';
$.ajax({
			type: 'POST',
			url: '/admin/check_articles_special/',
			data:{id:id,str:str,date:date},
			success: function(data) {
			/* alert(data) */
			if (data=='NULL'){
			/* alert('no article') */
			/* alert('Таких статей нет') */ 
			add_articles_special(form_id)
			}
			if (data=='NEWS'){
			/* alert('is article') */
			edit_articles_special(form_id);
			}
		
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
    }
});
}
function edit_articles_special(form_id){
 /* alert('edit_articles_special'); */
 var msg   = $('#'+form_id+'').serialize();

$.ajax({
			type: 'POST',
			url: '/admin/edit_articles_special/',
			data: msg,/* id_news:id_news,date:date,title:title,short_text:short_text,news_text:news_text },*/
			success: function(data) {
			$('#preloader').css('display','none');
			/* alert(data) */
			alert('Изменения внесены')
		$('#preloader_back').fadeOut().query(function(){
		$('#preloader').css('display','block');
		});
		
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
           }
        });
}

function add_articles_special(form_id){
 /* alert('add_articles_special'); */
 var msg   = $('#'+form_id+'').serialize();
$.ajax({
			type: 'POST',
			url: '/admin/add_articles_special/',
			data:msg,
			success: function(data) {
			alert(data)
		    location.reload();
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
           }
        });
	
}
</script>