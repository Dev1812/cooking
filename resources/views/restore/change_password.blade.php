<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>

<style type="text/css">
	.reg_content{padding:54px 0;}

</style>
<div class="reg_content">

<div class="form_block">

<div class="form_title">Изменить пароль</div>

<div class="form_body">

	<?php
var_dump(session('restore_email'));
	?>
	<style type="text/css">
	
.reg_content{margin:94px 0;}

	</style>
	<FORM action="/restore/change" method="POST">
@csrf
<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Email:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="password" placeholder="Ваш email" class="form_big_input_section__text_field"></div>
	</div>
</div>



<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Новый пароль:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="" placeholder="Новый пароль" class="form_big_input_section__text_field"></div>
	</div>
</div>


	


<div class="form_section" style="margin-top: 9px">
	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="submit" name="" placeholder="Ваше Имя" class="button" value="Восстановить"></div>
	</div>
</div>

</div>

</div>













</FORM>




</div>
























</div>

<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';

?>