<link rel="stylesheet" href="/css/style_admin.css" type="text/css" media="screen, projection" />




<div class="span2a" id="left_side">
<div class="prostir">
</div>
<div id="filter" class="box effect2">
<div id="filter_btn_block">
	<div style="width:400px;" class="doors_type_btn" id="mezhkomnatnie_btn">
	<h3 style="margin:40px 0px;color:#000;" class="head_strip">Редактирование наличников</h3>
	</div>
</div>
					<div class="left_side">
					
					<select id="select1">
					<option value="1" disabled selected>Выберите производителя</option>
					<?
					foreach($producers as $key=>$value){  
					?>
					<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
					<?
					}
					?>
					</select>
					<div id="sub"></div>
					<div >
					<select id="select2">
					<option>категория</option>
					</select>
					
					</div>
					</div>
					
</div>
</div>	