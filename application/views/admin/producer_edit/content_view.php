


	<div class="span10a">
	
	<div id="progress_bar">

		<div class="icon_text_div"><h3 class="icon_text">Изменить логотип</h3></div>
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
			<?if($image!=''){?>
			<img width="100%" src="<?=$image?>">
			<?}?>
		</div>
		<div style="border-left:1px solid #000;padding:10px;" class="span4">
			<div class="prostir"></div>
			<h3 class="lab_">Название производителя</h3>
			<input name="name_prod" style="height:30px;width:80%" type="text" value="<?=$producer[0]['name']?>">
			
			<br>
			<h3 class="lab_">Типы дверей которые производит данный производитель</h3>
			<div id="bar_block">
			<?
			foreach($div_prod_type as $key=>$val){
			echo $val;
			}
			?>
			</div>
			<br>
			</br>
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

$('.close_type').click(function(){
$(this).parent('.bar').remove();
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