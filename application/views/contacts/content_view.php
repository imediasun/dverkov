<div class="span8">
			<main class="content">
   
   
   
   
   <?
   foreach ($article as $key=>$value){
   ?>
   
   <p><?=$value['text']?></p>
   <?
   }
   ?>
   <br><br>
   <div id="form">
						<div id="form_specify">
							<div>
							<h3 class="head_of_article"><?=$main['contact_form_head'];?></h3>
							
							</div>
							<form id="contact_form" method="post" action="/functions/contact_form">
							
							<table width="450"  border="0">
							<tr>
							<td width="150" align="left">
							<label><?=$main['contact_form_name'];?>:</label>
							</td>
							<td width="300" align="right">
							
							<input type="text" style="width:255px;" name="name" value="<?if (isset($name)) echo $name;?>" size="45">
							</td>
							</tr>
							<tr>
							<td width="150" align="left">
							<label><?=$main['contact_form_phone'];?>:</label>
							</td>
							<td width="300"  align="right">
							
							<input type="text" style="width:255px;" name="phone" value="<?if (isset($phone)) echo $phone;?>" size="45">
							</td>
							</tr>
							<tr>
							<td width="150" align="left">
							<label><?=$main['contact_form_email'];?>:</label>
							</td>
							<td width="300" align="right">
							
							<input type="email" style="width:255px;" name="email" value="<?if (isset($email)) echo $email;?>" size="45">
							</td>
							</tr>
							<tr>
							<td width="150" align="left">
							<label><?=$main['contact_form_service'];?>:</label>
							</td>
							<td width="300" align="right">
							
							<select name="service" style="width:255px;">
							<option selected value="<?=$main['contact_form_service0'];?>"><?=$main['contact_form_service0'];?></option>
							<option value="<?=$main['contact_form_service1'];?>"><?=$main['contact_form_service1'];?></option>
							<option value="<?=$main['contact_form_service2'];?>"><?=$main['contact_form_service2'];?></option>
							<option value="<?=$main['contact_form_service3'];?>"><?=$main['contact_form_service3'];?></option>
							<option value="<?=$main['contact_form_service4'];?>"><?=$main['contact_form_service4'];?></option>
							

							</select>
							</td>
							</tr>
							
							
							<tr>
							
							
							<td width="150" align="left" valign="top">
							
							
							<label><?=$main['contact_form_message'];?>:</label>
							</td>
							<td width="300" align="right">
							
							<textarea cols="42" style="width:255px;" name="msg" rows="8"> <?if (isset($msg)) echo $msg;?></textarea>
							<br>
							<div class="btn" id="order_btn"><p><?=$main['contact_form_send'];?></p></div>
							</td>
							</tr>
							</table>
							<input id="submit_form" type="submit" name="submit">
							</form>
							
						</div>
				
							<div id="answer_form"> 
							<?
							if (isset($error)){
							echo $error;
							?>
							<script>
							$(window).scrollTo( 0, 1600, {queue:true});
							</script>
							
							<?
							}
							?>
							</div>
					</div>
   
	
 

 


			</main><!-- .content -->
			
		</div>	
		
		</div><!-- .container--><div id="content_prostir"></div>
		<style>
		.container{
		margin-top:80px;
		}
		</style>

<script>
$('#order_btn').click(function(){
$('#submit_form').click();
});

</script>	