
	<div class="span10a">
	<ul class="cat">
	<div class="prostir"></div>
		
		<?
		if(isset($doors) or isset($doors_colls)){
		
			if(isset($doors)){
				foreach($doors as $key=>$value){
				?>
				
				<a href="/door/<?=$value['id']?>">
				<li>
					<div class="door effect2" >
						<p style="text-align: center;height:inherit">
						<img height="100%" src="<?=$value['photo']?>">
						</p>
					</div>
					<div class="info_block">
						<h3 class="name_of_door"><?=$value['name']?></h3>
						<h4 class="color_of_door"><?=$value['color']?></h3>
						<h4 class="feature_of_door"><?=$value['type']?></h3>
						<h3 class="price_of_door"><?=$value['price']?>грн.</h3>
						<h5 class="id_door">&nbsp #<?=$value['id']?></h5>
						<a class="view" href="/rus/view-in-interior/68.html">View</a>
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
				<?
				}
			}
		if(isset($doors_colls)){		
			foreach($doors_colls as $key=>$value){
			?>
			
			<a href="/dveri/<?=$value['type']?>/<?=$producer?>/<?=$value['id']?>">
			<li>
				<div class="door effect2" >
					<p style="text-align: center;height:inherit">
					<img height="100%" src="<?=$value['photo']?>">
					</p>
				</div>
				<div class="info_block">
					<h3 class="name_of_door"><span>Коллекция </span><?=$value['name']?></h3>
					
					<a class="view" href="/rus/view-in-interior/68.html">View</a>
				</div>
		
			</li>
			</a>
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
	