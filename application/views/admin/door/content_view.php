door_edit
<script type="text/javascript">

$(document).ready(function() {
	$('.MYCLASS').jqzoom({
           zoomType: 'standard',  
            lens:true,  
            preloadImages: true,  
            alwaysOn:false,  
            zoomWidth: 400,  
            zoomHeight: 630,  
            xOffset:190,  
              
            position:'right' 
        });
	
});


</script>
	<div class="span10a row-fluid">
	<div class="span12">
 	<div id="progress_bar">
		<div class="icon_text_div"><h3 class="icon_text">Добавить фотографию</h3></div>
		<div id="add_producer" class="win_btn">
		</div>
		
	</div>
	</div>
	</div>
	<div id="door_info_block" class=" span10a row-fluid">
   
		<div class="door_view span4">
			<div class="door effect2" >
			<?
			if(isset($door_photo)){
			?>
			<a  style="clear:both;" href="<?=$door_photo?>" class="MYCLASS"  title="<?=$door['name']?>" rel="gal1">
			<p style="text-align:center;">
			<img  height="420px" src="<?=$door_photo?>">
			</p>
			</a>
			<?
			}
			?>
	
	
	
	    </div>
		<div id="miniatures"> 
			<div id="owl-demo0" class="owl-carousel owl-theme">
			<?
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
			?>
			
			
			
			
			
			
			
			</div>
			</div>
	</div>
		<div  style="" class="door_description span8">
			</br>
			<div class="door_name">
			<input style="height:30px;width:450px;margin-top:5px" type="text" name="door_name" value="<?=$door['name']?>"></div>
			<input type="hidden" name="id_door" value="<?=$door['id']?>">
			</br>
			
			<div class="door_name"><h3 class="door_text">Производитель:<?=$producer;?></h3><img height="40px;" src="<?=$producer_logo;?>"></div>
			</br>
			<div class="door_name"><input type="text" style="height:30px;width:150px;margin-top:5px" name="door_price" value="<?=$door['price'];?>"><h3 style="display:inline-block;color:black" > &nbsp,00 &#8364;</h3></div>
			<div id="calc" class="box effect2">

			<form id="calc_form" action="/catalog/index" method="post">
			<div class="select_box">
			<h3 class="select_text">Полотно</h3>
			</br>
			<select class="calc" name="polotno_sel" id="polotno_sel">
			<option value="0" disabled selected>Не выбрано</option>
			<?
			foreach($polotno as $key=>$value){
			?>
			<option value="<?=$value['id']?>"> <?=$value['width'].'X'.$value['height']?> </option>
			<?
			}
			?>
			
			</select>
			</div>
			<div class="select_box">
			<h3 class="select_text">Коробка</h3>
			</br>
			<select class="calc" name="korobka_sel" id="korobka_sel">
			<option value="0" disabled selected>Не выбрано</option>
			</select>
			</div>
			<div class="select_box">
			<h3 class="select_text">Наличник</h3>
			</br>
			<select class="calc" name="nalichnik_sel" id="nalichnik_sel">
			<option value="0">Не выбрано</option>
			</select>
			</div>
			<div class="select_box">
			<h3 class="select_text">Доборная доска</h3>
			</br>
			<select class="calc" name="doska_sel" id="doska_sel">
			<option value="0" disabled selected>Не выбрано</option>
			</select>
			</div>
			<input id="calc_btn" class="button" type="submit" value="Показать">
			</form>
			</div>
			
		</div>
		<div id="description_text" class="span12">
		
			<div class="blk">
			<div id="des" class="title des_title"><h3 style="padding:7px;">Описание</h3></div>
			<div class="des_txt" style="display:block">
			
			<div id="" class="info_text des_txt_inside">
				<form action="/functions_form/edit_description" method="post">
				<input type="hidden" name="id_door" value="<?=$id_door?>">
				<input type="hidden" name="type" value="<?=$type_index?>">
				<input type="hidden" name="producer" value="<?=$prod_id?>">
				<textarea id="ckeditor" name="description" class="ckeditor" cols="20"  rows="20"><?=$door['description']?></textarea>
				<input type="submit" value="Принять">
				</form>
				
			</div>
			</div>
			</div>
			
			<div class="blk">
			<div id="pod" class="title podrobno_title"><h3 style="padding:7px;">Характеристика</h3></div>
			<div class="des_txt">
			<div id="" class="info_text des_txt_inside">
			<form action="/functions_form/edit_podrobno" method="post">
				<input type="hidden" name="id_door" value="<?=$id_door?>">
				<input type="hidden" name="type" value="<?=$type_index?>">
				<input type="hidden" name="producer" value="<?=$prod_id?>">
				<textarea id="ckeditor2" name="podrobno" class="ckeditor" cols="20"  rows="20"><?=$door['podrobno']?></textarea>
				<input type="submit" value="Принять">
			</form>
			</div>
			</div>
			</div>
			
			<div class="blk">
			<div id="podob" class="title podrobno_title"><h3 style="padding:7px;">Подобные товары</h3></div>
			<div class="des_txt">
			<br>
			<br>
			<div id="add_pod">
			<h3 class="door_text ">Номер подобной двери</h3>
			<input type="text" name="id_door" style="width:200px;height:30px" >
			<input id="add_pod_btn" style="margin-top:-10px;" type="button" value="Добавить">
				<div id="bar_block">
				<?
				if(isset($type_ind)){
				foreach($type_ind as $key=>$val){
				?>
				<div class="bar"><h3 class="lab_1"><?=$val['name']?></h3><h3 class="close_type">    X&nbsp;</h3> <input type="hidden" value="<?=$val['id']?>"></div>
				<?
				}
				}
				?>
				</div>
			</div>
			</div>
			</div>
			
		</div>
</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>
$('input[name=door_name]').change(function(){
var door_name=$(this).val()
var id_door=$('input[name=id_door]').val()
$.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/change_door_name/',
		  data:{door_name:door_name,id_door:id_door},
          success: function(data) {

          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
})


$('input[name=door_price]').change(function(){
var door_price=$(this).val()
var id_door=$('input[name=id_door]').val()
$.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/change_door_price/',
		  data:{door_price:door_price,id_door:id_door},
          success: function(data) {

          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
})
</script>


<script>
CKEDITOR.replace("ckeditor");
CKEDITOR.replace("ckeditor2");
$('.close_type').click(function(){
var val_sel=$(this).parent('.bar').find('input').val();
var id_door=<?=$door['id'];?>;
$.ajax({
          type: 'POST',
		  dataType:'html',
          url: '/functions_ajax/del_pod_door/',
		  data:{id:val_sel,id_door:id_door},
          success: function(data) {
		  location.reload()
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
})

$('#add_pod_btn').click(function(){
var val_sel=$(this).parent('#add_pod').find('input[name=id_door]').val();
var id_door=<?=$door['id'];?>;
$.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/get_name_of_door/',
		  data:{id:val_sel,id_door:id_door},
          success: function(data) {
		  var sel_text=data[0].name;
			
			$('#bar_block').append(
			'<div class="bar"><h3 class="lab_1">'+sel_text+'</h3><h3 class="close_type2">    X&nbsp;</h3> <input type="hidden" value="'+val_sel+'"></div>'
			);
			
		$('.close_type2').click(function(){
			var val_sel=$(this).parent('.bar').find('input').val();
			var id_door=<?=$door['id'];?>;
			$.ajax({
          type: 'POST',
		  dataType:'html',
          url: '/functions_ajax/del_pod_door/',
		  data:{id:val_sel,id_door:id_door},
          success: function(data) {
		  location.reload()
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
})
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });


})
</script>
<script>
$('.title').click(function(){

if($(this).hasClass("des_title")){
$(this).removeClass( "des_title" );
$(this).addClass( "podrobno_title" );


}
else{
$(this).removeClass("podrobno_title");
$(this).addClass("des_title");
}
var this_=$(this)
$('.title').not(this_).removeClass( "des_title" );
$('.title').not(this_).addClass( "podrobno_title" );
$('.des_txt').css('display','none')
$(this).parent('.blk').find('.des_txt').css('display','block')
})
</script>
<script>
$('.win_btn').click(function(){
$('#window').css('display','block');
$('#appl_window').css('display','block');
});
$('.del_prod').click(function(){

if (confirm("Удалить фото?")) {
var id=$(this).find('input').val()
   $.ajax({
          type: 'POST',
		  dataType:'json',
          url: '/functions_ajax/delete_door_photos/',
		  data:{id:id},
          success: function(data) {
			alert("Фотография удалена!")
			location.reload();
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
  
} else {
  alert("Вы нажали кнопку отмена")
}
})
$("select").selectbox({
})
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