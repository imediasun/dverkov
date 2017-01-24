<html>
<head>
	<link rel="stylesheet" href="/css/style_auth.css" type="text/css" media="screen, projection" />
</head>
<body>
			<br><br>
			<div class="auth_form">
			<div id="antique_key">
			</div>
			<h3 style="font-size:200%;position:absolute;top:50px;left:200px;">Login</h3>
			<form action="/admin/dveri_edit/1" method="post" class="login_form">
			<h3>Логин</h3>
			<input class="inp_login" name="login" type="text">
			<h3>Пароль</h3>
			<input class="inp_login" name="password" type="password">
			<input class="sub_btn" name="submit" type="submit" value="Вход">
			</form>
			</div>
			<div class="auth_form_bottom">
			<?
			if(isset($auth)){
			?>
			<div style="width:200px;position:absolute;left:0px;right:0px;margin:auto;">
			<h3 style="color:#fff;font-size:100%;text-align:center;" >Введен не правельный пароль либо логин</h3>
			</div
			<?
			}
			?>
			</div>
</body>
</html>
