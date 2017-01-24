producers
	<div class="span10a">
	<ul class="prod">
	<div class="prostir"></div>
	<?
	if(isset($producers)){
	foreach($producers as $key=>$value){
	?>
	<a href="/dveri/<?=$type_page;?>/<?=$value['id']?>">
	<li>
	<p style="text-align:center;vertical-align:middle;position:relative;margin-top:auto 0">
	<img style="" height="90px" src="<?=$value['logo']?>">
	</p>
	<h3 style="position:absolute;bottom:10px;color:#000;width:100%"><?=$value['name']?></h3>	
	</li>
	</a>
	<?
	}
	}
	?>	
	
		
	</ul>
			
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
	