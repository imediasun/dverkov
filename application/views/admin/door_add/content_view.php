123
<div class="span10a">

	<div id="progress_bar">

		<div class="icon_text_div"><span class="logo_add_btn"><h3 class="icon_text"> Добавить фотографии двери</h3></span></div>
		<div id="add_producer" class="win_btn">
		</div>

	</div>

</div>

	<div class="span10a">
	
	<div class="prostir">
	<br>
	<h3 style="padding-left:10px;" class="icon_text"><?=$query_logo_text?></h3>
	</div>
	
	<div style="" class="row row_style">
		
		<div class="door_view span4">
			<div class="door effect2" >
			<?
			
			if(isset($meniatures)){
			?>
			<a  style="clear:both;" href="<?=$meniatures[0]['path']?>" class="MYCLASS"  title="" rel="gal1">
			<p style="text-align:center;">
			<img  height="420px" src="<?=$meniatures[0]['path']?>">
			</p>
			</a>
			<?
			}
			
			?>

	    </div>
			<div id="miniatures"> 
				<div id="owl-demo0" class="owl-carousel owl-theme">
				<?
				if(isset($meniatures)){
				foreach($meniatures as $key=>$value){
				?>
				<div class="owl_block">
				<a href="javascript:void(0);"  rel="{gallery: 'gal1', smallimage: '<?=$value['path']?>',largeimage: '<?=$value['path']?>'}">  
					<p style="text-align:center" >
					<img  width="" height="150px" src="<?=$value['path']?>">  
					</p>
				</a> 
				<div style="width:20px;height:20px;margin-top:-10px;margin:left:-10px;cursor:pointer;z-index:9999999;" class="del_prod">
					<input type="hidden" value="<?=$value['id']?>">
				</div>
				</div>
				<?
				}
				}
				?>
				</div>
			</div>
	</div>
	
	
			<div style="border-left:1px solid #000;padding:10px;" class="span4">
				<div class="prostir"></div>
				<form action="/functions_form/save_door" method="POST">
				<h3 class="lab_">Коллекция</h3>
				<?
				if(isset($coll)){
				?>
				<input type="hidden" name="col_id" value="<?=$coll[0]['id']?>">
				<input style="height:30px;width:280px" type="text" value="<?=$coll[0]['name']?>" disabled>
				<?
				}
				else{
				?>
				<input type="hidden" name="col_id" value="0">
				<input style="height:30px;width:280px" type="text" value="Без коллекции" disabled>
				<?
				}
				?>
				
				<div id="photos_of_door">
				<?
				if(isset($meniatures)){
				foreach($meniatures as $key=>$value){
				?>
				<input type="hidden" name="photo_<?=$key?>" value="<?=$value['path']?>">
				<?
				}
				}
				?>
				</div>
				<!--<h3 class="lab_">Стиль двери</h3>
				
				<select id="door_model" name="door_model">
				<?
				/* foreach($styles as $key=>$val){ */
				?>
				<option value="<?/* =$val['id'] */?>"><?/* =$val['name'] */?></option>
				<?
				/* } */
				?>
				</select>-->
				<h3 class="lab_">Выберите модель двери</h3>
				<select id="door_model" name="door_model">
				<?
				foreach($models as $key=>$val){
				?>
				<option value="<?=$val['id']?>"><?=$val['name']?></option>
				<?
				}
				?>
				</select>
				<h3 class="lab_">Название двери</h3>
				<input id="door_name" style="height:30px;width:80%" name="name_prod" type="text" value="">
				<br>
				<input type="hidden" id="producer_in" name="producer_in" value="<?=$producer_in?>">
				<input type="hidden" id="type" name="type" value="<?=$type?>">
				<h3 class="lab_">Цена двери</h3>
				<input id="door_price" style="height:30px;width:80%" name="price_prod" type="text" value="">
				<h3 class="lab_">Выберите цвет двери</h3>
				<select id="colors" name="colors">
				<?
				foreach($colors as $key=>$val){
				?>
				<option value="<?=$val['id']?>"><?=$val['name']?></option>
				<?
				}
				?>
				</select>
				<h3 class="lab_">Описание двери</h3>
				<textarea class="ckeditor" cols="180" id="editor_new" name="editor_text" rows="15"></textarea>
				<div id="bar_block">
				
				</div>
				
				<br>
				<br>
				<input class="prod_btn" type="submit" value="Принять">
				</form>
			</div>
	</div>		
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>

<script>
/* $('.prod_btn').click(function(){
var door_model=$('#door_model option:selected').val();
var door_name=$('#door_name').val();
var door_price=$('#door_price').val();
var producer=$('#producer_in').val();
var type=$('#type').val();
alert(door_price)
 $.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/save_door/',
		  data:{door_model:door_model,door_name:door_name, door_price:door_price, producer:producer,type:type},
          success: function(data){
		},
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
}) */

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
<script>
    $(document).ready(function() {
 	owl_show();
    });
</script>
<script>
function owl_show(){
   var length=$('.owl-carousel').length;
 	for (i=0; i<=length; i++){
	   var owl = $("#owl-demo"+i+"");
     
    owl.owlCarousel({
    items : 4, //10 items above 1000px browser width
    itemsDesktop : [1000,5], //5 items between 1000px and 901px
    itemsDesktopSmall : [900,3], // betweem 900px and 601px
    itemsTablet: [600,2], //2 items between 600 and 0
    itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
    });
	}
}
</script>