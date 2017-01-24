<div class="span10c">
	<div class="container">
	
	<h3 style="color:#000;padding:20px;">Уважаемые клиенты, на этой странице Вы можете просмотреть любую дверь из нашего каталога в разных интеръерах, а так же поэксперементировать с подбором полов, обоев и плинтусов. </h3>
	<br>			
	
	<h3 style="color:#000;padding:20px;">Воспользуйтесь фильтром слева для выбора других дверей</h3>
	<div id="int_frame" >
		<canvas height='500' width='1000' id='sample1-canvas'>Обновите браузер</canvas>
	
	</div>	
	
		<div class="row" style="margin-top:0px;border-bottom:1px solid #000;">
		<div class="span12 item_doors_slider">
		<div class="doors-items door_slider doors_slider">
		<?
		foreach ($doors_in_interior as $key => $value){
		?>
		<div class="y">
			<div class="item_door_slide door_point">
			<img class="door_img" src="<?=$value['photo']?>">
			</div>
		</div>
		<?
		}
		?>	
		</div>
	
		</div>
		</div>
		<div class="row" style="margin-top:50px;">
		<div class="span4 item_slider">
		<h3>ОБОИ</h3>
		<div class="multiple-items slick-slider floor_slider">
		<?foreach($walls_thumbs as $key=>$value){
		
		?>	
			<div class="y_walls">
			<div class="item_slide walls_point">
			<input type="hidden" value="<?=$value['id']?>">
			<img class="item_img" src="<?=$value['thumb']?>">
			</div>
			</div>
		<?}?>	
		</div>
		<div class="vertical_line">
		</div>
		</div>
		
		<div class="span4 item_slider" >
		<h3>ПОЛЫ</h3>
		<div class="multiple-items slick-slider floor_slider">
		<?
		foreach($floors_thumbs as $key=>$value){
		?>	
		<div class="y_floor">
			<div class="item_slide floor_point">
				<input type="hidden" value="<?=$value['id']?>">
				<img class="item_img" src="<?=$value['thumb']?>">
			</div>
		</div>
		<?
		}
		?>	
		</div>
		<div class="vertical_line"></div>
		</div>
		<div class="span4 item_slider" >
		<h3>ПЛИНТУСА</h3>
		<div class="multiple-items slick-slider floor_slider">
		<?
		foreach($plintus_thumbs as $key=>$value){
		?>	
		<div class="y_plintus">
			<div class="item_slide plintus_point">
				<input type="hidden" value="<?=$value['id']?>">
				<img class="item_img" src="<?=$value['thumb']?>">
			</div>
		</div>
		<?
		}
		?>	
		</div>
		</div>
		</div>
	</div>	
	
</div>
	</div>	
		</div><!-- .container-fluid--><div id="content_prostir"></div>
<div class="prostir"></div>

<script>
window.walls='<?echo $walls['path'];?>';
window.floor='<?echo $floor['path'];?>';
window.plintus='<?echo $plintus['path'];?>';
window.door='<?echo $doors_in_interior[0]['photo']?>';
/* var sel=$('select[name=styles] option:selected').val(); */
sel='<?echo $sel?>';
load_scene(window.walls,window.floor,window.plintus,window.door,sel);
$('.plintus_point').click(function(){
var item_plintus_slide=$('.y_plintus').find('div').attr('class','current_item')
item_plintus_slide.removeClass('current_item').addClass('item_slide')
$(this).addClass('current_item')
plintus_id=$(this).find('input').val()
$.ajax({
		type: "POST",
		dataType: 'json',
		url: "/functions_ajax/get_plintus",
		data: {id:plintus_id},
		success: function (data){
window.plintus=data;
load_scene(window.walls,window.floor,window.plintus,window.door,sel);
}
}); 
})
$('.door_point').click(function(){
var item_door_slide=$('.y').find('div').attr('class','current_door_slide')
item_door_slide.removeClass('current_door_slide').addClass('item_door_slide')
$(this).addClass('current_door_slide')
window.door=$(this).find('img').attr('src')
load_scene(window.walls,window.floor,window.plintus,window.door,sel);
})

$('.floor_point').click(function(){
var item_floor_slide=$('.y_floor').find('div').attr('class','current_item')
item_floor_slide.removeClass('current_item').addClass('item_slide')
$(this).addClass('current_item')
floor_id=$(this).find('input').val()
$.ajax({
		type: "POST",
		dataType: 'json',
		url: "/functions_ajax/get_floor",
		data: {id:floor_id},
		success: function (data){
window.floor=data;
load_scene(window.walls,window.floor,window.plintus,window.door,sel);
}
}); 
})

$('.walls_point').click(function(){
var item_walls_slide=$('.y_walls').find('div').attr('class','current_item')
item_walls_slide.removeClass('current_item').addClass('item_slide')
$(this).addClass('current_item')
walls_id=$(this).find('input').val()
window.walls=aj_wall(walls_id,sel)
window.walls=window.walls[0].path
load_scene(window.walls,window.floor,window.plintus,window.door,sel);
})

function aj_wall(walls_id,room_id){
if(walls_id==null){
id=room_id
model='room'
}
else{
id=walls_id
model='walls'
}
var jq = aj_proc(id,model);
return (jq);
}

function aj_proc(id,model){
var result= new Array();
$.ajax({
		type: "POST",
		url: "/functions_ajax/get_walls",
		data: {id:id,model:model},
		async: false,
		success: function(data){
		result = data;	
}
});
return result
}

function load_scene(walls,plintus,floor,door,sel){
// Create the loader and queue our 3 images. Images will not 
// begin downloading until we tell the loader to start. 
var loader = new PxLoader();
if(walls!=null){

var backgroundImg = loader.addImage(walls)
}
if(plintus!=null){	

var treesImg = loader.addImage(plintus)
}
if(floor!=null){ 

var ufoImg = loader.addImage(floor); 
}
if(door!=null){	

var doorImg = loader.addImage(door); 
}	

// callback that will be run once images are ready 
loader.addCompletionListener(function(){ 


    var canvas = document.getElementById('sample1-canvas'), 
    ctx = canvas.getContext('2d');
	$('#door_in').remove();
	
	if(backgroundImg!=null){
     ctx.drawImage(backgroundImg, 0, 0);
	
    }
	if(treesImg){
	ctx.drawImage(treesImg, 0, 0); 
	}
	if(ufoImg){
    ctx.drawImage(ufoImg, 0, 0); 
	}
	if(doorImg){
	var html = document.createElement('div');
	var int_frame = document.getElementById('int_frame')
	var img = document.createElement("img");
	img.src = door;
	
	if(sel==2){
	
	html.style.bottom = 35+"px";
	}
	else if(sel==4){
	html.style.bottom = 25+"px";
	}
	else if(sel==5){
	html.style.bottom = 25+"px";
	}
	else{
	html.style.bottom = 20;
    }
	img.style.height=100+"%";
	html.id = 'door_in';
    html.style.right = 0;
    int_frame.appendChild(html);
	html.appendChild(img);
	}
}); 
loader.start();
} 

// begin downloading images 
 
</script>

<script>
var first=$('.y').first().find('div')
first.removeClass('item_door_slide')
first.addClass('current_door_slide')
var first_floor=$('.y_floor').first().find('div')
first_floor.removeClass('item_slide')
first_floor.addClass('current_item')
var first_walls=$('.y_walls').first().find('div')
first_walls.removeClass('item_slide')
first_walls.addClass('current_item')

$('.multiple-items').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3
});
$('.doors-items').slick({
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 5
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