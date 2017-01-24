
<div class="span2c" id="left_side">
<div class="prostir">
</div>
<div id="filter_interior" class="box effect2">
<div id="filter_btn_block">
<div class="doors_type_btn mezh_active" id="mezhkomnatnie_btn">
<h3 class="mezhkomnatnie_txt">Межкомнатные</h3>
</div>
<div class="doors_type_btn" id="vhodnie_btn">
<h3 class="vhodnie_txt">Входные</h3>
</div>
</div>
<form id="filter_form" action="/interior" method="post">
<div id="example_id_block">
<h3 class="select_text">Выберите интервал цен</h3>
</br>
<?
if(isset($price_start)){
?>
<input type="text" id="example_id" name="example_name" value="<?=$price_start.';'.$price_end?>" />
<?
}
else{
?>
<input type="text" id="example_id" name="example_name" value=""/>
<?
}
?>


</div>
<input name="type" type="hidden" value="1">
<h3 class="style_text">Стиль интеръера</h3>
<div style="width:95%;margin-left:10px;" id="producer_select">
<select name="styles2"  class="filter_select" id="styles_select">
<option disabled> Стиль дверей </option>
<option value="1">Техно</option>
<option value="2">Класика</option>
<option value="3">Модерн</option>
<option value="4">Кухня</option>
<option value="5">Ванная</option>
</select>
</div>
<div id="doors_options">
<?
foreach($filter2 as $key=>$val)
{
echo $val;
}
?>
</div>
<input id="filter_btn" class="button" type="submit" value="Показать">
</form>
</div>
<div id="close_filter_btn" class="left_arrow">
<h3 class="mezhkomnatnie_txt" style="left:5px;top:13px"><</h3>
</div>
</div>


<script>
//we can do it
$('#close_filter_btn').click(function(){
var width=$('#left_side').width()
if ($(this).hasClass('left_arrow') ) {
$(this).removeClass('left_arrow')
$('#filter_interior').fadeOut();
$(this).css('left','0px');
$(this).css('top','270px');
$(this).find('h3').text('>')		
}
else 
{
$(this).addClass('left_arrow')
$('#filter_interior').fadeIn();
$('#left_side').animate({
        'marginLeft' : "+=0px" //moves left
        });
		$(this).find('h3').text('<')
$(this).css('left','100%');
$(this).css('top','-400px');		
}


})

</script>
<script type="text/javascript">
$(".filter_select").selectbox({
	onOpen: function (inst) {
	//console.log("open", inst);
},
	onClose: function (inst) {
	//console.log("close", inst);
},
	onChange: function (val, inst) {
	select_id=$(this).attr('id');
	aj(val,select_id)
},
	effect: "slide"
});

$('#vhodnie_btn').click(function(){
var inp=$('input[name="type"]');
if(inp.val()==1){
inp.val(2)
$(this).find('h3').css('color','#fff')
$('#filter_btn_block').css('background','#0A3F4C')
$('#mezhkomnatnie_btn').removeClass('mezh_active')
$('#mezhkomnatnie_btn').addClass('mezh_non_active')
$('#mezhkomnatnie_btn').find('h3').css('color','#0A3F4C')
aj(0,'producer');
}
})

$('#mezhkomnatnie_btn').click(function(){
var inp=$('input[name="type"]');
if(inp.val()==2){
inp.val(1)
$(this).find('h3').css('color','#fff')
$('#filter_btn_block').css('background','#fff')
$('#mezhkomnatnie_btn').removeClass('mezh_non_active')
$('#mezhkomnatnie_btn').addClass('mezh_active')
$('#vhodnie_btn').find('h3').css('color','#0A3F4C')
aj(0,'producer');
}
})
function aj(val,select_id){

var type_s=$('input[name=type]').val();

// Array.some || (Array.some = Function.prototype.call.bind(Array.prototype.some));
var txt,
txt1;
var select_=$('select');
/* var someIsPositive = Array.some(select_, function(select) {
	if(select.id!=select_id && val!=0){
	   return select.value > 0;
	}
    });
if (someIsPositive) {
	    alert('Есть положительные');
	    } 
		else { */
	
		$.ajax({
		type: "POST",
		dataType: 'json',
		url: "/functions_filter/form_filter",
		data: {id:val,select_id:select_id,type_s:type_s},
		success: function (data) {
		
		var select_name;
		//создать массив из уже выбранных значений селектов
		$.each(data,function(key,select){
		switch(key){
		case 'producer':
		select_name='producer';
		txt='Выберите производителя';
		txt1='Все производители';
		break;
		case 'material':
		select_name='producer_2';
		txt='Выберите материал';
		txt1='Все материалы';
		break;
		case 'style':
		select_name='producer_3';
		txt='Выберите стиль';
		txt1='Все стили';
		break;
		case 'color':
		select_name='producer_4';
		txt='Выберите цвет';
		txt1='Все цвета';
		break;
		}
		var sel_opt=$('#'+select_name+'').attr("selected","selected").val();
		$("#"+select_name+"").empty();
		$("#"+select_name+"").append('<option disabled>'+txt+'</option>')	
		if(val==0 && select_id==select_name){
		$("#"+select_name+"").append('<option selected value="0">'+txt1+'</option>')
		}
		else{
		$("#"+select_name+"").append('<option value="0">'+txt1+'</option>')
		}
		$("#"+select_name+"").selectbox('detach');
		
		$.each(select,function(key_s,value_s){
		
		
			if(select_name==select_id){//к примеру producer == producer
					if(value_s.id==val){
					$("#"+select_name+"").append('<option selected value="'+value_s.id+'">'+value_s.name+'</option>')
					}
					else{
					if(key_s!='not'){
					$("#"+select_name+"").append('<option value="'+value_s.id+'">'+value_s.name+'</option>')
					}
					else{
					$.each(value_s,function(key_n,value_n){
					$("#"+select_name+"").append('<option value="'+value_n.id+'">'+value_n.name+'</option>')
					})
					}
					}
			}
			else{
				if(key_s!='not'){
				if(sel_opt==value_s.id){
				$("#"+select_name+"").append('<option selected value="'+value_s.id+'">'+value_s.name+'</option>')
				}
				else{
				$("#"+select_name+"").append('<option value="'+value_s.id+'">'+value_s.name+'</option>')
				}
				}
				else{
				$.each(value_s,function(key_n,value_n){
				$("#"+select_name+"").append('<option class="relative" value="'+value_n.id+'">'+value_n.name+'</option>')
				})
				}	
			}
		})

		// $('#producer_select').html(data);
		$("#"+select_name+"").selectbox({
		onOpen: function (inst) {
			//console.log("open", inst);
		},
		onClose: function (inst) {
			//console.log("close", inst);
		},
		onChange: function (val, inst) {
		select_id=$(this).attr('id');
		aj(val,select_id)
		},
		effect: "slide"
	});
		
	}) 
	

}

}); 
/* 	        alert('Все нулевые');
	    } */
 
//если значение любого из селектов > 0
}




	var width=$(window).width();
	if(width>1024){
    $('#left_side').fixTo('body', {
    zIndex: 998,
    top: 110
});
}
else{

/*     $('#left_side').fixTo('body', {
    zIndex: 998,
    top: 45
}); */
}

$("#example_id").ionRangeSlider({
    min: 0,
    max: 2000,
    type: 'double',
    prefix: "€",
    maxPostfix: "+",
    prettify: false,
    hasGrid: true,
	 onFinish: function(obj) {
        console.log(obj.fromNumber+'x '+obj.toNumber);
		var from=obj.fromNumber
		var to=obj.toNumber
    },
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
