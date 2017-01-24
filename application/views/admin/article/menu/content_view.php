
	<div class="span10a">
	
<div style="z-index:999999;" id="preloader_back">
<div id="preloader"></div>
</div>	

					<div class="span8 yellow_border_admin">
					123
						<div id ="article_admin_1">
							<div id="editorsm" style="position:relative;display:block;">
								
								<div id="header_menu_editor">
									
								</div>
								
								<div id="header_article_editor">
									<h3 class="header_article_admin"></h3>
								</div>
								<div id="form">
								123
								<?
								if(isset($_GET['insert'])){
								if($_GET['insert']==1){
								echo "<h6>Статья успешно добавлена</h6>";
								}
								}
								?>
								</div>
								
								<div class="results" ></div>
							</div>
							
						</div>
												
					</div>
			</div>		
	
		</div><!-- #container-->
	</div><!-- #content-->
<script>
$(document).ready(function(){
$("#select1 option").prop("selected", false).filter(":nth-child(1)").prop("selected", true);
});
</script>

<script>

function formation_art_new(){
$('#form').append('<form id="form_new" action="/admin/add_art"  method="post">  <p>Дата</p>  <input id="news_date" type="text" onfocus="this.value=\'\'" name="date1" class="tcal" value="" />    <label>Название статьи</label> <input type="text" style="width:98%"   name="title"> <label>Содержание статьи</label>  <textarea class="ckeditor" cols="180" id="editor_new" name="editor_text" rows="15"></textarea> <br> <input id="submit_new" type="submit" value="Принять изменения"></form>')
}



</script>



<script>
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
			
	</div>	
	</div>	
		</div><!-- .container--><div id="content_prostir"></div>
<div class="prostir"></div>
	