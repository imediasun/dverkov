<script type='text/javascript'>
$(function(){
 
});
</script>

<div class="span10a">	
	<div id="progress_bar">
	
		
		<div class="icon_text_div"><h3 class="icon_text">Добавить наличник</h3></div>
		<div id="add_producer"></div>
		
		
	
	</div>
	<div style="" class="row row_style">
	
	</div>	
				
			</div>		
	    </div>
		</div><!-- #container-->
	</div><!-- #content-->
<script>


$('#select1').change(function(){
$('#select2').empty();
var value = $(this).val();
$('.row_style').empty()
window.prod=value
  $('#add_producer').click(function(){
  $('.new_nalik').remove();
    $('.row_style').append('<form class="new_nalik" action="/functions_form/edit_nalik/" method="post"><div style="height:10px;width:100%;background:#CAD5E0;"></div>	<input type="hidden" name="prod_ind" value="'+window.prod+'"> <input type="text" style="height:30px;width:400px" name="name" value="">	<input type="text" style="height:30px;width:150px" name="price" value="">	<input type="submit" style="margin-top:-10px;" value="Добавить"><div style="height:10px;width:100%;background:#CAD5E0;"></div></form>')
	
    });
$.ajax({

type: "POST",
dataType: 'json',
url: "/functions_ajax/get_colls_nal",
data: {menu_value:value},
cache: false,
success: function(data){
//получение второстепенного меню
 $('#select2').css('display','block');
$("#select2").append('<option disabled selected>Коллекции</option>');
   $.each(data.colls, function(key, val) { 
	$("#select2").append('<option value="'+val.id+'">'+val.name+'</option>'); 
	});
	$.each(data.naliki, function(key, val) { 
	$('.row_style').append('<form action="/functions_form/edit_nalik/'+val.id+'" method="post"><div style="height:10px;width:100%;background:#CAD5E0;"></div>	<input type="text" style="height:30px;width:400px" name="name" value="'+val.name+'">	<input type="text" style="height:30px;width:150px" name="price" value="'+val.price+'">	<input type="submit" style="margin-top:-10px;" value="Поменять"><div style="height:10px;width:100%;background:#CAD5E0;"></div></form>')
	}) 
}
});
});
</script>

<script>
$('#select2').change(function(){
var value = $(this).val();
$('.row_style').empty()
  $('#add_producer').click(function(){
  $('.new_nalik').remove();
    $('.row_style').append('<form class="new_nalik" action="/functions_form/edit_nalik/" method="post"><div style="height:10px;width:100%;background:#CAD5E0;"></div>	<input type="hidden" name="prod_ind" value="'+window.prod+'"> <input type="hidden" name="coll_ind" value="'+value+'"> <input type="text" style="height:30px;width:400px" name="name" value="">	<input type="text" style="height:30px;width:150px" name="price" value="">	<input type="submit" style="margin-top:-10px;" value="Добавить"><div style="height:10px;width:100%;background:#CAD5E0;"></div></form>')
	
    });
$.ajax({
type: "POST",
dataType: 'json',
url: "/functions_ajax/get_colls_naliki",
data: {menu_value:value},
cache: false,
success: function(data){

$.each(data, function(key, val) { 
	$('.row_style').append('<form action="/functions_form/edit_nalik/'+val.id+'" method="post"><div style="height:10px;width:100%;background:#CAD5E0;"></div>	<input type="text" style="height:30px;width:400px" name="name" value="'+val.name+'">	<input type="text" style="height:30px;width:150px" name="price" value="'+val.price+'">	<input type="submit" style="margin-top:-10px;" value="Поменять"><div style="height:10px;width:100%;background:#CAD5E0;"></div></form>')
	})
 
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