


	<div class="span10a">
	<div id="progress_bar">

		<div class="icon_text_div"><h3 class="icon_text">Изменить картинку</h3></div>
		<div id="edit_producer" class="win_btn">
		</div>

		<div class="icon_text_div"><h3 class="icon_text">Добавить тип дверей</h3></div>
			<select style="margin-top:-25px;" name="type_of_door">
				<option disabled selected>Добавить тип дверей</option>
				<?
				foreach($type_name as $key=>$value){
				?>
				<option value="<?=$value['id']?>"><?=$value['name']?></option>
				<?
				}
				?>
			</select>
		
		<div class="icon_text_div"><h3 class="icon_text_red">Теперь выберите производителя</h3></div>
	</div>
	<div style="" class="row row_style">
		<div class="span2">
			<div class="prostir"></div>
			<?if($material[0]['image']!=''){?>
			<img width="100%" height="150px" src="<?=$material[0]['image']?>">
			<?}?>
		</div>
		<div style="border-left:1px solid #000;padding:10px;" class="span4">
			<div class="prostir"></div>
			<form action="/functions_form/update_proc" method="POST">
			<h3 class="lab_">Название материала</h3>
			<input name="name" style="height:30px;width:80%" type="text" value="<?=$material[0]['name']?>">
			<input name="id" type="hidden" value="<?=$material[0]['id']?>">
			<input name="type" type="hidden" value="<?=$type_page?>">
			<input name="proc" type="hidden" value="materials">
			<br>
			<h3 class="lab_">Типы дверей которые производит данный производитель</h3>
			<div id="bar_block">
			<?
			foreach($div_prod_type as $key=>$val){
			?>
			
			<div class="bar">
			<h3 class="lab_1"><?=$val['name']?></h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" name="type_<?=$key;?>" value="<?=$val['id']?>">
			</div>
			<?
			}
			?>
			</div>
			<br>
			</br>
			<input class="prod_btn" type="submit" value="Принять">
			</form>
		</div>
	</div>		
	</div>	
	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>
/* $('.prod_btn').click(function(){
var oper=<?=$producer_index;?>;
var obj =$('#bar_block').find('div');
var name_prod = $('input[name=name_prod]').val()
var type_ar=[];
$.each(obj, function(key,value) {
type_ar.push(value.children[2].value);
})
var inf='';
var ses='';
ses='<?if(isset($_SESSION['logo'])){echo $_SESSION['logo'];}?>';

if(ses!==''){
if(type_ar.length<1){
inf+='\n\r Не выбран ни один тип дверей ';
}
if(!name_prod){
inf+='\n\r Не определено название производителя';
}
if(inf!==''){
alert(inf)
}
else{
 $.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/save_producer/',
		  data:{oper:oper,name_prod:name_prod,type_ar:type_ar},
          success: function(data) {
		  alert('Информация о производителе обновлена в базе данных')
		  location.reload();
          },
          error:  function(xhr, str){
           alert('Возникла ошибка: ' + xhr.responseCode);
            }
        }); 
}
}
else{
alert('Вы не добавили логотип')
}
}) */

$('select[name=type_of_door]').change(function(){
var bar_ar=[];
var val_sel=$(this).val();
var sel_text=$(this).find("option:selected").text();
var bars=$('.bar').find('input');
$.each(bars, function(key,value) {
bar_ar.push(value.value)
window.point=key+1;
})
if(jQuery.inArray(val_sel, bar_ar) > -1 ){
alert('Этот тип дверей уже выбран')
}
else{

$('#bar_block').append(
'<div class="bar"><h3 class="lab_1">'+sel_text+'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" name="type_'+window.point+'" value="'+val_sel+'"></div>'
);
}
$('.close_type').click(function(){
$(this).parent('.bar').remove();
})
})

$('.close_type').click(function(){
$(this).parent('.bar').remove();
})

$('.win_btn').click(function(){
$('#window').css('display','block');
$('#appl_window').css('display','block');
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