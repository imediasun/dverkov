sad
	<div class="span10a" style="width:100%">
	
		<div id="progress_bar">

			<div class="icon_text_div"><h3 class="icon_text">Добавить фурнитуру</h3></div>
			<div id="add_producer" class="win_btn"></div>
			<div class="icon_text_div"><h3 class="icon_text">Добавить коллекцию</h3></div>
			<div id="add_collection" class="win_btn"></div>
			<div class="icon_text_div"><h3 class="icon_text">Добавить модель фурнитуры</h3></div>
			<div id="add_model" class="win_btn"></div>
			
		</div>

	</div>
	
	<ul class="cat">
	<div style="background:#ee9;margin-top:50px;" class="prostir"></div>
	
		<?
		if(isset($doors) or isset($colls)){
		if(isset($doors)){
		foreach($doors as $key=>$value){
		?>
		<div style="position:relative;float:left;width:295px;height:630px;display:inline-block;margin: 15px 0px 0px 5px;">
		<a href="/admin/door_edit/<?=$value['id']?>/<?=$type_page;?>/<?=$producer;?>/<?=$coll;?>">
			<li style="float:left">
			
			<div class="door effect2">
				<p style="text-align: center;height:inherit">
				<img height="90%" src="<?=$value['photo']?>">
				</p>
			</div>
			<div class="info_block">
			<h3 class="name_of_door"><?=$value['id']?></h3>
				<h3 class="name_of_door"><?=$value['name']?></h3>
				<h4 class="color_of_door"><?=$value['color']?></h3>
				<h4 class="feature_of_door"><?=$value['type']?></h3>
				<h3 class="price_of_door"><?=$value['price']?></h3>
				<a class="view" href="/rus/view-in-interior/68.html">View</a>
			</div>
			<?if($value['corner']){?>
			<img class="corner" src="<?=$value['corner']?>">
			<?}?>
			</li>
		</a>
		<div class="del_prod">
		<input type="hidden" name="dor_col" value="1">
		<input type="hidden" class="door_index" value="<?=$value['id']?>">
		</div>
		</div>
		<?
		}
		}
		if(isset($colls)){
		
		foreach($colls as $key=>$value){
		?>
		<div style="position:relative;width:280px;height:630px;display:inline-block;margin: 15px 0px 0px 5px;">
			<a href="/admin/dveri_edit/<?=$type_page;?>/<?=$value['producer']?>/<?=$value['id']?>">
				<li>
				
				<div class="door effect2" >
				<p style="text-align:center;height:inherit">
				<img height="90%" src="<?=$value['photo']?>">
				</p>
				</div>
				<div class="info_block">
				<h3 class="name_of_door">Коллекция <?=$value['name']?></h3>
				<?
				?>
				<a class="view" href="/rus/view-in-interior/68.html">View</a>
				</div>
				</li>
			</a>
			<div class="del_prod">
			<input type="hidden" name="dor_col" value="2">
			<input type="hidden" class="door_index" value="<?=$value['id']?>">
			</div>
		</div>	
		<?
		}
		
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
	<div class="prostir"></div>		
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>
$('.del_prod').click(function(){
var del_index=$(this).find('.door_index').val()
var dor_col=$(this).find('input[name=dor_col]').val()
$.ajax({
          type: 'POST',
		  dataType:'html',
          url: '/functions_ajax/del_door/',
		  data:{del_index:del_index,dor_col:dor_col},
          success: function(data){
		alert(data)
		location.reload()
		},
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
})

$('#add_producer').click(function(){
location.href = '/admin/add_door_furn/<?=$type_page;?>/<?=$producer;?>'
})
$('#add_model').click(function(){
location.href = '/admin/add_model_furn/<?=$type_page;?>/<?=$producer;?>'
})
$('#add_collection').click(function(){
location.href = '/admin/add_collection_furn/<?=$type_page;?>/<?=$producer;?>'  
})
</script>	