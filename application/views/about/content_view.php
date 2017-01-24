<div class="span8">
	<main class="content">
    
   
	   <?
	   foreach ($article as $key=>$value){
	   ?>
	   <h3 class="head_of_article"><strong><?=$value['title']?></strong></h3>
	   <p><?=$value['text']?></p>
	   <?
	   
	   }
	   ?>


	</main><!-- .content -->
			
</div>	
		
		</div><!-- .container--><div id="content_prostir"></div>
		<style>
		.container{
		margin-top:80px;
		}
		</style>

	