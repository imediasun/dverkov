<script type="text/javascript">
$(document).ready(function() {
	$('.MYCLASS').jqzoom({
           zoomType: 'standard',  
            preloadImages: true,  
            alwaysOn:false,  
            zoomWidth: 400,  
            zoomHeight: 630,  
            xOffset:190,  
            position:'right' 
        });
	
});


</script>
door
	<div id="door_info_block" style="float:left" class="span10a">
    <div id="door_photo"class="door_view span4 photo_door_span">
		<div class="door effect2" >
			

			<a  style="clear:both;" href="<?=$door_photo?>" class="MYCLASS"  title="<?=$door['name']?>" rel="gal1">
			<p style="text-align:center;">
			<img  height="420px" src="<?=$door_photo?>">
			</p>
			</a>
			
	
	
	
	    </div>
		<div id="miniatures"> 
			<div id="owl-demo0" class="owl-carousel owl-theme">
			<?
			foreach($meniatures as $key=>$value){
			?>
			<a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=$value['path']?>',largeimage: '<?=$value['path']?>'}">  
				<img  width="" height="150px" src="<?=$value['path']?>">  
			</a> 
			
			<?
			}
			?>
			
			
			
			
			
			
			
			</div>
			</div>
	</div>
		<div id="door_description" class="door_description span8">
			</br>
			<div class="door_name"><h3 class="door_text"><?=$door['name']?></h3></div>
			</br>
			
			<div class="door_name"><h3 class="door_text">Производитель: <?=$producer;?></h3><img height="40px;" src="<?=$producer_logo;?>"></div>
			</br>
			<div class="door_name"><h3 style="" class="door_text">Цена полотна</h3>
			
				<h3 class="door_price"><?=$door['price'];?> &#8372;</h3>
				<h3 style="margin-left:10px;" class="door_text">Общая стоимость</h3>
				<?if(isset($full_price)){?>
				<h3 class="door_price_final"><span><?=$full_price;?></span> &#8372;</h3>
				<?}
				else{
				?>
				<h3 class="door_price_final"><span><?=$door['price'];?></span> &#8372;</h3>
				<?
				}
				?>
				
			</div>
			
			<div id="calc" class="box effect2">

			<form id="calc_form" action="/functions_form/calc" method="post">
				<div class="select_box">
				<h3 class="select_text">Полотно</h3>
				</br>
				<input type="hidden" name="door_id" value="<?=$door_id;?>">
			<input type="hidden" name="polotno" value="<?=$door['price'];?>">
			
				<?
				if(isset($polotno1)){
				?>
				<select class="calc" name="polotno_sel" id="polotno_sel">
				<option value="0">Не выбрано</option>
				<?
				foreach($polotno as $key=>$value){
				if($value['id']==$polotno1){
				?>
				<option value="<?=$polotno1?>" selected > <?=$value['width'].'X'.$value['height']?> </option>
				<?
				}
				else{
				?>
				<option value="<?=$value['id']?>" > <?=$value['width'].'X'.$value['height']?> </option>
				<?
				}
			    }
				?>
				</select>
				<?
				}
				else
				{
				?>
				<select class="calc" name="polotno_sel" id="polotno_sel">
				<option value="0" selected>Не выбрано</option>
				<?
				foreach($polotno as $key=>$value){
				?>
				<option value="<?=$value['id']?>"> <?=$value['width'].'X'.$value['height']?> </option>
				<?
				}
				?>
				</select>
				<?
				}
				?>
				</div>
				<div class="select_box">
				<h3 class="select_text">Коробка</h3>
				</br>
				
				<?
				if(isset ($korobka1)){
				?>
				<select class="calc" name="korobka_sel" id="korobka_sel">
				<option value="0" selected>Не выбрано</option>
				<?foreach($boxes as $key=>$value){
				if($value['id']==$korobka1){
				?>
				<option value="<?=$value['id']?>" selected ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				else{
				?>
				
				<option value="<?=$value['id']?>" ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				}
				?>
				</select>
				<?
				}
				else
				{
				?>
				<select class="calc" name="korobka_sel" id="korobka_sel">
				<option value="0" selected>Не выбрано</option>
				<?foreach($boxes as $value){?>
				<option value="<?=$value['id']?>" ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				?>
				</select>
				<?
				}
				?>
				
				</div>
				<div class="select_box">
				<h3 class="select_text">Наличник</h3>
				</br>
				<?
				if(isset($nalichnik1)){
				?>
				<select class="calc" name="nalichnik_sel" id="nalichnik_sel">
				<option value="0">Не выбрано</option>
				<?foreach($nalichnik as $key=>$value){
				if($value['id']==$nalichnik1){
				?>
				
				<option value="<?=$value['id']?>" selected><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				else{
				?>
				<option value="<?=$value['id']?>" ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				 
				}
				?>
				</select>
				<?
				}
				else{
				?>
				<select class="calc" name="nalichnik_sel" id="nalichnik_sel">
				<option value="0">Не выбрано</option>
				<?foreach($nalichnik as $key=>$value){
				
				?>
				<option value="<?=$value['id']?>" ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				?>
				</select>
				<? 
				}
				?>
				
				</div>
				<div class="select_box">
				<h3 class="select_text">Доборная доска</h3>
				</br>
				<?
				if(isset($doska1)){
				?>
				<select class="calc" name="doska_sel" id="doska_sel">
				<option value="0" selected>Не выбрано</option>
				<?foreach($dobornaya_doska as $value){
				if($value['id']==$doska1){
				?>
				<option value="<?=$value['id']?>" selected><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				}
				else{
				?>
				<option value="<?=$value['id']?>" ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				
				}
				
				}
				?>
				</select>
				<?
				}
				else{
				?>
				<select class="calc" name="doska_sel" id="doska_sel">
				<option value="0" selected>Не выбрано</option>
				<?foreach($dobornaya_doska as $value){
				
				?>
				<option value="<?=$value['id']?>" ><?=$value['name'].' ('.$value['price'].' грн.)'?></option>
				<?
				
				}
				?>
				</select>
				<?
				}
				?>
				</div>
				<input id="calc_btn" class="button" type="submit" value="Показать">
			</form>
			</div>
			
		</div>
		<div id="description_text" class="span12">
		
			<div class="blk">
			<div id="des" class="title des_title"><h3 style="padding:7px;">Описание</h3></div>
			<div class="des_txt" style="display:block">
			
				<div id="" class="info_text des_txt_inside"><?=$door['description']?></div>
			</div>
			</div>
			
			<div class="blk">
			<div id="pod" class="title podrobno_title"><h3 style="padding:7px;">Характеристика</h3></div>
			<div class="des_txt">
				<div class="info_text des_txt_inside"><h3 class="door_text "><?=$door['podrobno']?></h3></div>
			</div>
			</div>
			
			<div class="blk">
			<div id="podob" class="title podrobno_title"><h3 style="padding:7px;">Подобные товары</h3></div>
			<div class="des_txt">
			<ul class="cat_min">
				<?
				if(isset($doors)){
				?>
				<br></br><br>
				<?
				foreach($doors as $key=>$value){
				?>
				<a href="/door/<?=$value['id']?>">
				<li>
					<div class="door_min effect2" >
						<p style="text-align: center;height:inherit">
						<img height="140px" src="<?=$value['photo']?>">
						</p>
					</div>
					<div class="info_block_min">
						<h6 class="name_of_door_min"><?=$value['name']?></h3>
						
						<h3 class="price_of_door"><?=$value['price']?></h3>
						<a class="view" href="/rus/view-in-interior/68.html">View</a>
					</div>
				
				</li>
				</a>
				<?
				}
			}
			?>
			</ul>
			</div>
			</div>
			
		</div>
	</div>
</div>	<!-- .row-fluid-->
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
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