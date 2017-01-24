		<div class="door_view span4">
		<a style="outline-style: none; text-decoration: none;" href="./imgProd/triumph_big2.jpg" rel="gal1" id="demo1" title="">
</a>
			<div class="door effect2" >
			
			<p style="text-align:center;height:inherit">
			<a  style="clear:both;" href="<?=$door['photo']?>" class="MYCLASS"  title="<?=$door['name']?>" rel="gal1">
			<img  height="100%" src="<?=$door['photo']?>">
			</a>
			</p>
			
			
			</div>
			
			<?if($door['corner']){?>
			<img class="corner" src="<?=$door['corner']?>">
			<?}?>
			<div id="miniatures"> 
			<ul id="thumblist" class="clearfix">
			<?
			foreach($meniatures as $key=>$value){
			?>
			<li>
			<a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=$value['path']?>',largeimage: '<?=$value['path']?>'}">  
				<img  width="" height="150px" src="<?=$value['path']?>">  
			</a> 
			</li>
			<?
			}
			?>
			</ul>
			<div id="owl-demo0" class="owl-carousel owl-theme">
			
			
			
			
			
			
			</div>
			</div>
		
		</div>