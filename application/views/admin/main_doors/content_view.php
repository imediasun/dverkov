
	<div class="span10a">
	
	<div id="progress_bar">
	<div id="progress_bar">
		
	</div>
</div>
	<ul class="cat">
	
		
		<?
		if(isset($doors)){
		foreach($doors as $key=>$value){
		?>
		<div style="position:relative;width:295px;height:630px;display:inline-block;margin: 15px 0px 0px 5px;">
		<a href="">
		<li>
		<input type="hidden" name="id_door" value="<?=$value['id']?>">
			<div class="door effect2" >
				<p style="text-align: center;height:inherit">
				<img height="100%" src="<?=$value['photo']?>">
				</p>
			</div>
			<div class="info_block">
				<h3 class="name_of_door"><?=$value['name']?></h3>
				<div class="msg"></div>
				<a class="view" href="/rus/view-in-interior/68.html">View</a>
				<a style="margin-left:20px;cursor:pointer" class="del_corner"  >Delete corner</a>
				<a style="margin-left:20px;cursor:pointer" class="add_corner" onclick="add_corner()" >Add corner</a>
			</div>
			<div style="display:none;background:#fff" class="info_block corners_block">
				<?
				foreach($corners_box as $key=>$val){
				
				?>
				<div class="corner_box" style="">
					<input type="hidden" name="id_corner" value="<?=$val['id']?>">
					<img height="100%" src="<?=$val['corner']?>">
				</div>
				<?
				}
				?>
			</div>
			
		<?
		if($value['corner']){
		?>
		<img class="corner" src="<?=$value['corner']?>">
		<?
		}
		?>
		</li>
		</a>
		<div class="del_prod">
		<input type="hidden" value="<?=$value['id']?>">
		</div>
		</div>
		<?
		}
		}
		else{
		
		?>
		<div id="nodoors">
		<h3 class="adv">Нет дверей соответствующих вашему выбору</h3>
		</div>
		<?
		}
		?>
	
	</ul>
	
	<br><br><br><br><br><br>			
	<h3 style="color:#000;padding:20px;" >Вы можете добавить двери на главную страницу расположенные ниже</h3>
	<h3 style="color:#000;padding:20px;" >Воспользуйтесь фильтром слева для выбора других дверей</h3>
		<div class="row" style="margin-top:50px;border-bottom:1px solid #000;">
		<div class="span12 item_doors_slider">
		<div class="doors-items door_slider doors_slider">
		<?
		if(isset($in_interior)){
		foreach ($in_interior as $key => $value){
		
		?>
		<div class="y">
		<div class="item_door_slide door_point">
		<img class="door_img" src="<?=$value['photo']?>">
			
		<input type="checkbox" name="check_add" value="<?=$value['id']?>">	
		</div>
		
		</div>
		<?
		}
		}
		?>	
		</div>
	
		</div>
		</div>
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>

$('.corner_box').click(function(){
var id_door=$(this).parent('div').parent('li').find('input[name=id_door]').val()
var id_corner=$(this).find('input[name=id_corner]').val()
if (confirm("Добавить этот информер?")) {
$.ajax({
			type: 'POST',
			url: '/admin/add_corner_main_page/',
			data: {id_door:id_door,id_corner:id_corner},
			success: function(data) {
			alert("Информер добавлен")
			
			location.reload()
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
        }
  });

 
} else {
  alert("Вы нажали кнопку отмена")
}

})
$('input[name=check_add]').click(function(){
var point=$(this).val();
$.ajax({
			type: 'POST',
			url: '/admin/add_main_page_door/',
			data: {point},
			success: function(data) {
			alert('Дверь добавлена на первую страницу')
			location.reload()
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
        }
  });
})

$('.add_corner').click(function(){
var info=$(this).parent('.info_block').parent('li').find('.corners_block')
info.fadeIn();
});
$('.cat li').mouseleave(function(){

$(this).find('.corners_block').fadeOut();
})
$('.item_door_slide').mouseover(function(){
$(this).css('background','#fff');
})
$('.item_door_slide').mouseleave(function(){
$(this).css('background','#ee9');
})
$('.view').mouseover(function(){
$('.msg').empty();
$('.msg').append('<p style="padding-left:10px;color:#fff;font-size:100%;">Вы можете просмотреть эту дверь</p>');
})
$('.view').mouseleave(function(){
$('.msg').empty();
})
$('.del_corner').mouseover(function(){
$('.msg').empty();
$('.msg').append('<p style="padding-left:10px;color:#fff;font-size:100%;">Вы можете удалить информер</p>');
})
$('.del_corner').mouseleave(function(){
$('.msg').empty();
})
$('.add_corner').mouseover(function(){
$('.msg').empty();
$('.msg').append('<p style="padding-left:10px;color:#fff;font-size:100%;">Вы можете добавить информер</p>');
})
$('.add_corner').mouseleave(function(){
$('.msg').empty();
})
$('.del_corner').click(function(){
var corner=$(this).parent('.info_block').parent('li').find('input[name=id_door]').val()
$.ajax({
			type: 'POST',
			url: '/admin/del_corner_main_page/',
			data: {corner},
			success: function(data) {
			alert('информер удален')
			location.reload();
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
        }
        });

})
$('.doors-items').slick({
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 5
});
$('.del_prod').click(function(){
var id_door=$(this).parent('div').find('input[name=id_door]').val();
$.ajax({
			type: 'POST',
			url: '/admin/del_main_page_door/',
			data: {id_door},
			success: function(data) {
			alert(data)
			location.reload()
          },
          error:  function(xhr, str){
          alert('Возникла ошибка: ' + xhr.responseCode);
        }
        });
})
</script>