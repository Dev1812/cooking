<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>

<div class="login_content">

<div class="form_block">

<div class="form_title">Вход</div>

<div class="form_body">
	<style type="text/css">
	
.login_content{margin:94px 0;}

	</style>


<FORM action="" method="POST">
<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Email:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="login_email_0" placeholder="Ваш email" class="form_big_input_section__text_field"></div>
	</div>
</div>


@csrf

	<?php
if(!empty($result)) {
	var_dump($result);
}


	?>




<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Пароль:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="login_password_0" placeholder="Ваш Пароль" class="form_big_input_section__text_field"></div>
	</div>
</div>




<div class="form_section" style="margin-top: 9px">
	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="submit" name="login_submit_0" placeholder="Ваше Имя" class="button" value="Войти"></div>
	</div>
</div>
</FORM>

</div>

</div>


















</div>
























</div>

<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';

?>