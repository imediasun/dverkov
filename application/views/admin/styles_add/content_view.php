добавить стили
<div class="span10a">
<div id="progress_bar">
	<div id="progress_bar">

		<div class="icon_text_div"><span class="logo_add_btn"><h3 class="icon_text"> Добавить картинку</h3></span></div>
		<div id="add_producer" class="win_btn">
		</div>

		<div class="icon_text_div"><h3 class="icon_text">Добавить тип дверей</h3></div>
			<select style="margin-top:-25px;"  name="type_of_door">
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
</div>
</div>

	<div class="span10a">
	
	<div class="prostir">
	<br>
	<h3 style="padding-left:10px;" class="icon_text"><?=$query_style_text?></h3>
	</div>
	
		<div style="" class="row row_style">
		
			<div style="padding:10px;" class="span2">
				<div class="prostir"></div>
				<div id="img_block">
				
				<?if(isset($ses)){?>
				<img src="<?=$ses?>">
				<input id="ses" type="hidden" name="ses" value="<?=$ses?>">
				<?}?>
				
				</div>
				<br></br></br>
	
			</div>
			<div style="border-left:1px solid #000;padding:10px;" class="span4">
				<div class="prostir"></div>
				<h3 class="lab_">Название стиля</h3>
				<input style="height:30px;width:80%" name="name_prod" type="text" value="">
				<br>
							
				<div id="bar_block">
				
				</div>
				
				<br>
				<br>
				<input class="prod_btn" type="button" value="Принять">
			</div>
		</div>		
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>
$('.win_btn').click(function(){
$('#window').css('display','block');
$('#appl_window').css('display','block');
});


$('select[name=type_of_door]').change(function(){
var bar_ar=[];
var val_sel=$(this).val();
var sel_text=$(this).find("option:selected").text();
var bars=$('.bar').find('input');
var bnt=$('#ses').val();
$.each(bars, function(key,value) {
bar_ar.push(value.value)
})
if(jQuery.inArray(val_sel, bar_ar) > -1 ){
alert('Этот тип дверей уже выбран')
}
else{
$('#bar_block').append(
'<div class="bar"><h3 class="lab_1">'+sel_text+'</h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="'+val_sel+'"></div>'
);
}
$('.close_type').click(function(){
$(this).parent('.bar').remove();
})
})

$('.prod_btn').click(function(){
var obj =$('#bar_block').find('div');
var name_prod = $('input[name=name_prod]').val()
var type_ar=[];
$.each(obj, function(key,value){
type_ar.push(value.children[2].value);
})
var inf='';
var ses=$('#img_block img').attr('src');

if(typeof (ses)!=='undefined'){
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
          url: '/functions_ajax/save_styles/',
		  data:{name_prod:name_prod,type_ar:type_ar,ses:ses},
          success: function(data) {
		 
			alert('Информация о производителе добавлена в базу данных')
			window.location.href = 'http://exportgrain.net/admin/styles/'+<?echo $type_index;?>+'';
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
})


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