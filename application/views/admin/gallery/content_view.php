

<div class="span10a">	
	<div id="progress_bar">
	
		
		<div class="icon_text_div"><h3 class="icon_text">Добавить фото</h3></div>
		<div id="add_producer" class="win_btn"></div>
		<div class="icon_text_div"><h3 class="icon_text">Добавить видео</h3></div>
		<a href="/admin/pages/9"><div id="add_producer3" class=""></div></a>
		<div class="icon_text_div"><h3 class="icon_text">Обновить</h3></div>
		<div id="add_producer2" ></div>
	</div>
	<div style="" class="row row_style">
	
	</div>	
				
</div>	
<div class="span10a">
    
	
		
		<div id="article">
			<?include('gallery/GammaGallery/index_in.html');?>
		</div>
	
	
			
	</div>		
	    </div>
		</div><!-- #container-->
	</div><!-- #content-->
<script> 
$('#add_producer3').click(function(){
alert()
$.ajax({
type: "POST",
dataType: 'json',
url: "/functions_form/refresh/",
data: {},
cache: false,
success: function(data){
}
})
}) 

$('#add_producer2').click(function(){
alert()
$.ajax({
type: "POST",
dataType: 'json',
url: "/functions_form/refresh/",
data: {},
cache: false,
success: function(data){
}
})
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