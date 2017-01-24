
	<div class="span10a">
	
	<div class="prostir">
	<br>
	<h3 style="padding-left:10px;" class="icon_text">Введите параметры добавляемой модели</h3>
	</div>
	
	<div style="" class="row row_style">

			<div style="border-left:1px solid #000;padding:10px;" class="span4">
				<div class="prostir"></div>
				<input id="type" type="hidden" value="<?=$type;?>">
				<input id="producer_in" type="hidden" value="<?=$producer_in;?>">
				<h3 class="lab_">Выберите стиль двери</h3>
				<select id="sel">
				<?
				foreach($styles_types as $key=>$val){
				?>
				<option value="<?=$val['id'];?>"><?=$val['name'];?></option>
				<?
				}
				?>
				</select>
				<h3 class="lab_">Название модели</h3>
				<input id="door_name" style="height:30px;width:80%" name="name_prod" type="text" value="">
				<br>
				
				<h3 class="lab_">Материалы двери</h3>
				<select id="material_door">
				<?
				foreach($materials as $key=>$val){
				?>
				<option value="<?=$val['id']?>"><?=$val['name']?></option>
				<?
				}
				?>
				</select>
				
				
				
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

$('.prod_btn').click(function(){
var style = $("#sel").val();
var producer=$('#producer_in').val();
var type=$('#type').val();
var name=$('#door_name').val();
var material=$('#material_door').val();
$.ajax({
          type: 'POST',
		  dataType:'html',
          url: '/functions_ajax/save_model/',
		  data:{type:type,style:style,producer:producer,name:name,material:material},
          success: function(data){
		  alert(data)
		  location.href="http://dverkov.com.ua/admin/furnitura_edit/"+type+"/"+producer+"";
		},
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
})

$('.win_btn').click(function(){
$('#window').css('display','block');
$('#appl_window').css('display','block');
});
$('#close_window').click(function(){
$('#window').css('display','none');
$('#appl_window').css('display','none');
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
