
	<div class="span10a">
		<div id="progress_bar">
			<div class="icon_text_div"><h3 class="icon_text">Добавить дверь</h3></div>
			<a href="/admin/add_door/<?=$type_page;?>/<?=$producer?>/<?=$coll?>"><div id="add_producer">
			</div></a>
			<div class="icon_text_div"><h3 class="icon_text">Редактировать коллекцию</h3></div>
			<a href="/admin/collection_edit/1"><div id="edit_producer" class=""> 
			</div></a>
			
		</div>
    <ul class="cat">
	<div class="prostir"></div>
		
		<?
		
		foreach($doors as $key=>$value){
		?>
		<div style="position:relative;width:280px;height:630px;display:inline-block;margin: 15px 0px 0px 5px;">
			<a href="/admin/door_edit/<?=$value['id']?>/<?=$type_page;?>/<?=$producer?>">
				<li>
				
				<div class="door effect2" >
				<p style="text-align:center;height:inherit">
				<img height="90%" src="<?=$value['photo']?>">
				</p>
				</div>
				<div class="info_block">
				<h3 class="name_of_door"><?=$value['id']?></h3>
				<h3 class="name_of_door"><?=$value['name']?></h3>
				<h4 class="color_of_door"><?=$value['color']?></h3>
				<h4 class="feature_of_door"><?=$value['type']?></h3>
				<h3 class="price_of_door"><?=$value['price']?></h3>
				<?
				?>
				<a class="view" href="/rus/view-in-interior/68.html">View</a>
				</div>
				</li>
			</a>
			<div class="del_prod">
			
			
			<input type="hidden" value="<?=$value['id']?>">
			</div>
		</div>	
		<?
		}
		?>

	</ul>
			
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
<script>
var obj = $('.cat li');
$( "#edit_producer" ).click(function() {
$( this ).toggleClass( "highlight" );
if($( this ).is('.highlight')){
window.key_href = new Array();
$('.icon_text_red').css('display','block')
$.each(obj, function(key,value) {
var link =$(this).parent('div').find('a')
var link_href=link.attr('href')
window.key_href.push(link_href)
var prod_index=link_href.split('/');
link.attr('href','/admin/collection_edit/'+prod_index[3]+'/'+prod_index[4]+'/'+prod_index[5]);
});
}
else{
$('.icon_text_red').css('display','none')
$.each(obj,function(key,value) {
var link =$(this).parent('div').find('a')
var link_href=link.attr('href')
link.attr('href',''+window.key_href[key]+'')
})
}
});
function print_r(arr, level) {
    var print_red_text = "";
    if(!level) level = 0;
    var level_padding = "";
    for(var j=0; j<level+1; j++) level_padding += "    ";
    if(typeof(arr) == 'object') {
        for(var item in arr) {
            var value = arr[item];
            if(typeof(value) == 'object') {
                print_red_text += level_padding + "'" + item + "' :\n";
                print_red_text += print_r(value,level+1);
		} 
            else 
                print_red_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
        }
    } 
    else  print_red_text = "===>"+arr+"<===("+typeof(arr)+")";
    return print_red_text;
}
</script>	