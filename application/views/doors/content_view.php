
	<div class="span10a">
    <ul class="cat">
	
		
		<?
		
		if(isset($doors)){
		
		foreach($doors as $key=>$value){
			?>
			<a href="/door/<?=$value['id']?>/<?=$value['id']?>"><li>
			<div class="door effect2" >
				<p style="text-align:center;height:inherit"><img height="100%" src="<?=$value['photo']?>"></p>
			</div>
			<div class="info_block">
			<h3 class="name_of_door"><?=$value['name']?></h3>
			<?
			
			?>
			
			<a class="view" href="/rus/view-in-interior/68.html">View</a>
			</div>
			
			</li></a>
			<?
			}
		}
		else{
		
		?>
		<div id="nodoors"> 
		
		<h3 class="adt">Нет дверей соответствующих вашему выбору</h3>
		</div>
		<?
		}
		?>
		
		
		
		
		
	
	</ul>
			
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
	