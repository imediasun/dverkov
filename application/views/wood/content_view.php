<div class="span8">
	<main class="content">
    
   
	   <?
	   
	   foreach ($baget['works'] as $key=>$value){
	   ?>
	   <div class="baget_frame">
	   <a href="<?=$value['img']?>" data-lightbox="image-1" data-title="<?=$value['name']?>"><img class="baget" src="<?=$value['img']?>"></a>
	   
	   <p><?=$value['name']?></p>
	   </div>
	   <?
	   
	   }
	   ?>
		<div class="panel">
						
			<div id="panel">
			<?
			echo $baget['panel'];
			?>
			</div>
		</div>

	</main><!-- .content -->
			
</div>	
		
		</div><!-- .container--><div id="content_prostir"></div>

	